<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\FrontUser;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }

    public function cklogin(Request $req)
    {
        $acct = $req->username;
        $pwd = $req->password;

        $user = new AdminUser();
        $user = (new AdminUser())->getUser($acct, $pwd);

        if (empty($user)) {
            return back()->withInput()->withErrors(['msg' => '帳號或密碼錯誤']);
        } else {
            session()->put('acct', $user->AdminUserAcct);
            return redirect('/admin/home');
        }
    }

    public function logout(){
        session()->forget('acct');

        return redirect("/admin/login");
    }

    public function home()
    {
        $order = (new Order())->getthismon();
        $users = (new FrontUser())->getthismon();
        
        return view('admin.home', compact("order", "users"));
    }
}
