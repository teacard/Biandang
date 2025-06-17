@extends('admin.app')
@section('title', '商品編輯')
@section('content')
<form action="../update" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="container">
            <div class="card-header">
                <input type="hidden" name="id" value="{{ $product->ProductId }}">
                <div class="row">
                    <label for="ProductName" class="col-form-label col-1 text-end">便當名稱</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="請輸入便當名稱" value="{{ $product->ProductName }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ProductImg" class="col-form-label col-1 text-end">照片</label>
                    <div class="col-11">
                        <input type="file" class="form-control" id="ProductImg" name="ProductImg">
                    </div>
                    @if(!empty($product->ProductImg))
                    <div class="col-1"></div>
                    <div class="col-11">
                        <a href="/images/products/{{ $product->ProductImg }}" data-lightbox="photo">
                            <img src="/images/products/{{ $product->ProductImg }}" alt="" class="img-fluid mt-2" width="100">
                        </a>
                    </div>
                    @endif
                </div>
                <div class="row mt-3">
                    <label for="ProductPrice" class="col-form-label col-1 text-end">價格</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="ProductPrice" name="ProductPrice" min="50" max="1000" placeholder="請輸入價格" value="{{ $product->ProductPrice }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <label for="ProductStatus" class="col-form-label col-1 text-end">狀態</label>
                    <div class="col-11">
                        <select class="form-select" id="ProductStatus" name="ProductStatus" required>
                            <option value="">請選擇狀態</option>
                            <option value="Y" {{ $product->ProductStatus == 'Y' ? 'selected' : '' }}>上架</option>
                            <option value="N" {{ $product->ProductStatus == 'N' ? 'selected' : '' }}>下架</option>
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