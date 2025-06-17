<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'AdminUsers';
    protected $primaryKey = 'AdminUserId';
    protected $fillable = [
        'AdminUserAcct',
        'AdminUserPwd',
        'CreateTime',
    ];

    public function getUser($acct, $pwd)
    {
        $user = self::where('AdminUserAcct', $acct)
            ->where('AdminUserPwd', $pwd)
            ->first();
        
        return $user;
    }
}
