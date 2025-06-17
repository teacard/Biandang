<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\FrontUser;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function login(){
        return view('front.index');
    }

    public function cklogin(Request $req){
        $acct = $req->account;
        $pwd = $req->password;

        $user = new FrontUser();
        $user = (new FrontUser())->getUser($acct, $pwd);

        if(empty($user)){
            return back()->withInput()->withErrors(['msg' => '帳號或密碼錯誤']);
        }else{
            session()->put('front_acct', $user->FrontUserAcct);
            session()->put('front_pwd', $user->FrontUserPwd);
            session()->put('front_name', $user->FrontUserName);
            return redirect('/home');
        }
    }

    public function register(){
        return view('front.register');
    }

    public function ckregister(Request $req){
        $acct = $req->account;
        $pwd = $req->password;
        $name = $req->name;
        $tel = $req->phone;

        $user = new FrontUser();
        $ckuser = (new FrontUser())->checkUser($acct, $pwd, $tel);

        if(!empty($ckuser)){
            return back()->withInput()->withErrors(['msg' => '帳號或密碼已存在']);
        }else{
            $user->FrontUserAcct = $acct;
            $user->FrontUserPwd = $pwd;
            $user->FrontUserName = $name;
            $user->FrontUserTel = $tel;
            $user->save();
            session()->put('front_acct', $acct);
            return redirect('/succ');
        }
    }

    public function success(){
        return view('front.success');
    }

    public function logout(){
        session()->forget('front_acct');
        session()->forget('front_pwd');
        session()->forget('front_name');

        return redirect('/');
    }

    public function index(){
        $list = Product::get();

        return view('front.home', compact('list'));
    }
}
