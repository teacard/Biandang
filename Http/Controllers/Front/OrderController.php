<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CartAddOn;
use App\Models\FrontUser;
use App\Models\Order;
use App\Models\OrderAddOn;
use App\Models\OrderProducts;
use App\Models\ShopCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function list(){
        $userid = (new FrontUser())->getUser(session()->get('front_acct'), session()->get('front_pwd'))->FrontUserId;
        $order = (new Order())->getuserorder($userid);
        foreach($order as $data){
            $data->op = (new OrderProducts())->getorderproduct($data->OrderId);
            foreach($data->op as $item){
                $item->optotal = $item->OrderProductsPrice * $item->OrderProductsCount;
                $item->addon = (new OrderAddOn())->getorderaddon($item->OrderProductsId);
                foreach($item->addon as $addon){
                    $item->optotal += $addon->OrderAddOnPrice * $item->OrderProductsCount;
                }
                
            }
        }

        return view("front.order", compact("order"));
    }

    public function add(Request $req)
    {
        DB::beginTransaction();
        try {
            $orderid = $this->addorder($req);
            $ids = $this->addorderproduct($req, $orderid);
            $this->addorderaddon($ids);

            DB::commit();

            Session::flash("frontmsg", "訂單已送出");
            return redirect('/home');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function delete(Request $req){
        $order = Order::find($req->oid);
        $order->OrderStatus = -1;
        $order->update();

        return redirect('/order/list');
    }

    private function addorder(Request $req)
    {
        $order = new Order();
        $order->FrontUsersId = $req->id;
        $order->OrderPrice = $req->total;

        $order->save();
        return $order->OrderId;
    }

    private function addorderproduct(Request $req, $oid)
    {
        $ids = [];
        $shopcart = ShopCart::where('FrontUsersId', $req->id)->get();
        foreach ($shopcart as $data) {
            $orderproduct = new OrderProducts();
            $orderproduct->OrderId = $oid;
            $orderproduct->OrderProductsName = $data->ShopCartName;
            $orderproduct->OrderProductsPrice = $data->ShopCartPrice;
            $orderproduct->OrderProductsCount = $data->ShopCartCount;

            $orderproduct->save();
            $ids[] = [
                'shopcartid' => $data->ShopCartId,
                'orderproductid' => $orderproduct->OrderProductsId
            ];
        }
        ShopCart::where('FrontUsersId', $req->id)->delete();
        return $ids;
    }

    private function addorderaddon($ids)
    {
        foreach ($ids as $data) {

            $addon = CartAddOn::where('ShopCartId', $data['shopcartid'])->get();
            foreach ($addon as $item) {
                $orderaddon = new OrderAddOn();
                $orderaddon->OrderAddOnName = $item->CartAddOnName;
                $orderaddon->OrderAddOnPrice = $item->CartAddOnPrice;

                $orderaddon->save();
                echo($orderaddon);
            }
            CartAddOn::where('ShopCartId', $data['shopcartid'])->delete();
        }
    }
}
