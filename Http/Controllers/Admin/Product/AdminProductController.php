<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminProductController extends Controller
{
    public function list()
    {
        $list = Product::get();

        return view('admin.product.list', compact('list'));
    }

    public function add()
    {
        return view('admin.product.add');
    }

    public function insert(Request $req)
    {
        if (!file_exists("images/products")) {
            mkdir("images/products", 0777, true);
        }

        $name = $req->ProductName;
        $photo = $req->ProductImg;
        $price = $req->ProductPrice;
        $status = $req->ProductStatus;

        // exloda(分割) microtime():獲取當前時間的微秒數
        $times = explode(" ", microtime());
        // strftime():格式化時間戳， substr():截取字串， extension():獲取檔案副檔名
        $photoName = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]) . substr($times[0], 2, 3) . "." . $photo->extension();
        // move():將上傳的檔案移動到指定目錄
        $photo->move("images/products", $photoName);


        $product = new Product();
        $product->ProductName = $name;
        $product->ProductImg = $photoName;
        $product->ProductPrice = $price;
        $product->ProductStatus = $status;
        $product->save();

        Session::flash("msg", "已新增");
        return redirect("/admin/product/list");
    }

    public function edit(Request $req)
    {
        $product = Product::find($req->id);

        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $req)
    {
        $id = $req->id;
        $photo = $req->ProductImg;


        $product = Product::find($id);

        if (!empty($photo)) {
            if (!empty($product->ProductImg) && file_exists("images/products/" . $product->ProductImg)) {
                unlink("images/products/" . $product->ProductImg);
            }

            $times = explode(" ", microtime());
            $photoName = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]) . substr($times[0], 2, 3) . "." . $photo->extension();
            $photo->move("images/products", $photoName);
            $product->ProductImg = $photoName;
        }

        $product->ProductName = $req->ProductName;
        $product->ProductPrice = $req->ProductPrice;
        $product->ProductStatus = $req->ProductStatus;
        $product->save();


        Session::flash("msg", "已更新");
        return redirect("/admin/product/list");
    }

    public function delete(Request $req)
    {
        $ids = $req->ids;

        if(!empty($ids)){
            foreach($ids as $id)
            {
                $product = Product::find($id);
                if(!empty($product->ProductImg)){
                    @unlink("images/products/" . $product->ProductImg);
                }
                $product->delete();
            }
            Session::flash("msg", "已刪除");
        }

        return redirect("/admin/product/list");
    }
}
