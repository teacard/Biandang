<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderProducts extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "OrderProducts";
    protected $primaryKey = "OrderProductsId";
    protected $fillable = [
        "OrderId",
        "OrderProductsName",
        "OrderProductsPrice",
        "OrderProductsCount",
        "CreateTime"  
    ];

    public function getorderproduct($oid){
        $orderproduct = DB::table($this->table)
            ->selectRaw("OrderProductsId, OrderProductsName, OrderProductsPrice, OrderProductsCount")
            ->where("OrderId", $oid)
            ->get();

        return $orderproduct;
    }
}
