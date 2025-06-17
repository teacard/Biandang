<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartAddOn extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'CartAddOn';
    protected $primaryKey = 'CartAddOnId';
    protected $fillable = [
        'ShopCartId',
        'CartAddOnName',
        'CartAddOnPrice',
        'CreateTime',
    ];

    public function getAddOn($cartid)
    {
        $data = DB::table('CartAddOn')
            ->selectRaw(' CartAddOnName, CartAddOnPrice')
            ->where('ShopCartId', $cartid)
            ->get();
        return $data;
    }
}
