<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FrontUser extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'FrontUsers';
    protected $primaryKey = 'FrontUserId';
    protected $fillable = [
        'FrontUserAcct',
        'FrontUserPwd',
        'CreateTime',
    ];

    public function getUser($acct, $pwd)
    {
        $user = self::where('FrontUserAcct', $acct)
            ->where('FrontUserPwd', $pwd)
            ->first();

        return $user;
    }

    public function checkUser($acct, $pwd, $tel)
    {
        $user = self::where("FrontUserAcct", $acct)
            ->orWhere("FrontUserPwd", $pwd)
            ->orWhere("FrontUserTel", $tel)
            ->first();

        return $user;
    }

    public function getthismon()
    {
        $user = DB::table($this->table)
            ->whereMonth('CreateTime', date("m"))
            ->whereYear('CreateTime', date("Y"))
            ->count();

        return $user;
    }
}
