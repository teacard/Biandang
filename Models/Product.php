<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // timestamps = false; 資料表不使用laravel的時間戳記功能
    public $timestamps = false;
    protected $table = 'Products'; // 資料表名稱
    protected $primaryKey = 'ProductId'; // 主鍵欄位名稱
    // 資料表欄位
    protected $fillable = [
        'ProductName',
        'ProductImg',
        'ProductPrice',
        'ProductStatus',
        'CreateTime',
    ];
}
