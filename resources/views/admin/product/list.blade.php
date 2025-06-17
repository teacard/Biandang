@extends('admin.app')
@section('title', '商品列表')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-1">
                    <a href="add" class="btn btn-info">新增</a>
                    <a href="javascript:checkdelete()" class="btn btn-danger ms-3">刪除</a>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <form action="delete" method="post" style="display: inline;">
                        @csrf
                        <table class="table table-bordered">
                            <tr style="background-color: #cccccc;">
                                <td class="col-1 text-center">
                                    <input type="checkbox" name="checkAll" id="checkAll" class="form-check-input">
                                </td>
                                <td class="col-3 text-center">名稱</td>
                                <td class="col-3 text-center">照片</td>
                                <td class="col-2 text-center">價格</td>
                                <td class="col-2 text-center">狀態</td>
                                <td class="col-1 text-center">修改</td>
                            </tr>
                            @foreach($list as $data)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $data->ProductId }}" class="form-check-input item">
                                </td>
                                <td class="text-center">{{ $data->ProductName }}</td>
                                <td class="text-center">
                                    @if(!empty($data->ProductImg))
                                    <a href="/images/products/{{ $data->ProductImg }}" data-lightbox="products">
                                        <img src="/images/products/{{ $data->ProductImg }}" alt="" class="img-fluid" width="100">
                                    </a>
                                    @endif
                                </td>
                                <td class="text-center">{{ $data->ProductPrice }}</td>
                                <td class="text-center">{{ $data->ProductStatus == "Y" ? '上架中' : '已下架' }}</td>
                                <td class="text-center">
                                    <a href="edit/{{ $data->ProductId }}" class="btn btn-warning">修改</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection