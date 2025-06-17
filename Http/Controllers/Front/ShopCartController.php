<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartAddOn;
use App\Models\FrontUser;
use App\Models\ShopCart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ShopCartController extends Controller
{
    public function list()
    {
        $userid = (new FrontUser())->getUser(session('front_acct'), session('front_pwd'))->FrontUserId;
        $shopcart = (new ShopCart())->getShopCart($userid);
        $data = [];
        $allprice = 0;
        foreach ($shopcart as $item) {
            $addon = (new CartAddOn())->getAddOn($item->ShopCartId);
            $total = $item->ShopCartPrice * $item->ShopCartCount;
            foreach ($addon as $add) {
                $total += $add->CartAddOnPrice * $item->ShopCartCount;
            }
            $data[] = [
                'ShopCartId' => $item->ShopCartId,
                'ShopCartName' => $item->ShopCartName,
                'ShopCartCount' => $item->ShopCartCount,
                'Addon' => $addon->toArray(),
                'total' => $total
            ];
            $allprice += $total;
        }

        return view('front.shopcart', compact('data', 'allprice', 'userid'));
    }

    public function add(Request $req)
    {
        DB::beginTransaction();
        try {
            $id = $this->updateCart($req);
            $this->updateAddOn($req, $id);

            DB::commit();
            return response()->json(['success' => true, 'msg' => '已新增至購物車']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => '新增失敗']);
        }
    }

    public function update(Request $req)
    {
        if ($req->quantity > 0) {
            $shopcart = ShopCart::find($req->id);
            $shopcart->ShopCartCount = $req->quantity;
            $shopcart->update();

            return response()->json(['success' => true, 'msg' => '已修改']);
        }
    }

    public function delete(Request $req) {
        if($req->id != null){
            DB::beginTransaction();
            try{
                $this->deleteCart($req);
                $this->deleteAddOn($req);

                DB::commit();
                return response()->json(['success' => true, 'msg' => '已刪除']);
            }catch(Exception $e){
                DB::rollBack();
            }
        }
    }

    private function updateCart(Request $req)
    {
        $userid = (new FrontUser())->getUser(session('front_acct'), session('front_pwd'))->FrontUserId;
        $shopcart = new ShopCart();

        $shopcart->FrontUsersId = $userid;
        $shopcart->ShopCartName = $req->ProductName;
        $shopcart->ShopCartPrice = $req->ProductPrice;
        $shopcart->ShopCartCount = $req->quantity;

        $shopcart->save();

        return $shopcart->ShopCartId;
    }

    private function updateAddOn(Request $req, $id)
    {
        if (isset($req->addons) && is_array($req->addons)) {
            foreach ($req->addons as $add) {
                $add = json_decode($add);  // 轉成物件

                $addon = new CartAddOn();
                $addon->ShopCartId = $id;
                $addon->CartAddOnName = $add->name;
                $addon->CartAddOnPrice = $add->price;
                $addon->save();
            }
        }
    }

    private function deleteCart(Request $req){
        $shopcart = ShopCart::find($req->id)->delete();
    }

    private function deleteAddOn(Request $req){
        $addon = CartAddOn::where('ShopCartId', $req->id)->delete();
    }
}
