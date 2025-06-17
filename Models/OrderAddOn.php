<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderAddOn extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "OrderAddOn";
    protected $primaryKey = "OrderAddOnId";
    protected $fillable = [
        "OrderProductsId",
        "OrderAddOnName",
        "OrderAddOnPrice",
        "CreateTime"
    ];

    public function getorderaddon($opid)
    {
        $addon = DB::table($this->table)
            ->selectRaw("OrderAddOnName, OrderAddOnPrice")
            ->where("OrderProductsId", $opid)
            ->get();

        return $addon;
    }
}
