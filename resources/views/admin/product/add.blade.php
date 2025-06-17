@extends('admin.app')
@section('title', '新增商品')
@section('content')
<form action="insert" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="container">
            <div class="card-header">
                <div class="row">
                    <label for="ProductName" class="col-form-label col-1 text-end">便當名稱</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="請輸入便當名稱" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ProductImg" class="col-form-label col-1 text-end">照片</label>
                    <div class="col-11">
                        <input type="file" class="form-control" id="ProductImg" name="ProductImg" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ProductPrice" class="col-form-label col-1 text-end">價格</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="ProductPrice" name="ProductPrice" min="50" max="1000" placeholder="請輸入價格" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ProductStatus" class="col-form-label col-1 text-end">狀態</label>
                    <div class="col-11">
                        <select class="form-select" id="ProductStatus" name="ProductStatus" required>
                            <option value="">請選擇狀態</option>
                            <option value="Y">上架</option>
                            <option value="N">下架</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection