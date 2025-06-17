<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShopCart extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ShopCart'; // 資料表名稱
    protected $primaryKey = 'ShopCartId'; // 主鍵欄位名稱
    protected $fillable = [
        'FrontUsersId',
        'ShopCartName',
        'ShopCartPrice',
        'ShopCartCount',
        'CreateTime',
    ];

    public function getShopCart($userid)
    {
        $data = DB::table('ShopCart')
            ->where('FrontUsersId', $userid)
            ->get();
        return $data;
    }
}
