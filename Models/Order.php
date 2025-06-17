<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "Order";
    protected $primaryKey = "OrderId";
    protected $fillable = [
        "FrontUsersId",
        "OrderPrice",
        "OrderStatus",
        "CreateTime"
    ];

    public function getorder()
    {
        $order = DB::table($this->table . ' as o')
            ->selectRaw("o.OrderId, fu.FrontUserName, fu.FrontUserTel, o.OrderPrice, o.OrderStatus, o.CreateTime")
            ->join('FrontUsers as fu', 'o.FrontUsersId', '=', 'fu.FrontUserId')
            ->orderByRaw("FIELD(o.OrderStatus, 0, 1, -1)")
            ->get();

        return $order;
    }

    public function getthismon()
    {
        $order = DB::table($this->table)
            ->whereMonth('CreateTime', date("m"))
            ->whereYear('CreateTime', date("Y"))
            ->where("OrderStatus", "1");

        $orders = $order->count();
        $ordersale = $order->sum("OrderPrice");

        return [$orders, $ordersale];
    }

    public function getuserorder($userid)
    {
        $order = DB::table($this->table)
            ->selectRaw("OrderId, OrderPrice, OrderStatus, CreateTime")
            ->where("FrontUsersId", $userid)
            ->get();
        return $order;
    }
}
