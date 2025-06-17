<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddOn;
use App\Models\OrderProducts;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function list(){
        $order = (new Order())->getorder();
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

        return view("admin.order", compact("order"));
    }

    public function update(Request $req){
        $order = Order::find($req->oid);

        $order->OrderStatus = 1;
        $order->update();

        return redirect("/admin/order/list");
    }
}
