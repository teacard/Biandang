@extends('front.app')
@section('content')
<style>
    body {
        padding: 20px;
    }

    table thead th {
        background-color: #f8f9fa;
    }

    .addon-list {
        font-size: 0.9rem;
        color: #555;
    }

    .text-right {
        text-align: right;
    }

    .total-row {
        font-weight: bold;
        background-color: #f1f1f1;
    }
</style>
<div class="container">
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th style="width: 60vw;">商品/選項</th>
                <th class="text-right" style="width: 20vw;">數量</th>
                <th class="text-right" style="width: 20vw;">小計 (NT$)</th>
            </tr>
        </thead>
        <tbody>
            @if($data!=null)
            @foreach($data as $item)
            <tr>
                <td>
                    <p>
                    <form action="/shopcart/delete" method="post" class="delete">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item['ShopCartId'] }}">
                        <button type="submit" class="btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        {{ $item['ShopCartName'] }}
                    </form>
                    </p>
                    @if(!empty($item['Addon']))
                    <ul class="addon-list mb-0">
                        @foreach($item['Addon'] as $addon)
                        <li>{{ $addon->CartAddOnName }} + {{ $addon->CartAddOnPrice }} 元</li>
                        @endforeach
                    </ul>
                    @endif
                </td>
                <td class="text-center">
                    <!-- 數量選擇 -->
                    <form action="/shopcart/update" method="post" class="count">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item['ShopCartId'] }}">
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <button type="button" class="btn btn-outline-secondary btn-md me-2 quantity-decrease">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input type="text" name="quantity" class="form-control text-center quantity-input" style="width: 10vw;" value="{{ $item['ShopCartCount'] }}" min="1" readonly>
                            <button type="button" class="btn btn-outline-secondary btn-md ms-2 quantity-increase">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </form>
                </td>
                <td class="text-right">小計 {{ $item['total'] }} 元</td> <!-- (130*1 + 10) -->
            </tr>
            @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2" class="text-right">購物車總計</td>
                <td class="text-right">{{ $allprice }} 元</td>
            </tr>
        </tfoot>
    </table>
    <div class="d-flex justify-content-end">
        <form action="/order/add" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $userid }}">
            <input type="hidden" name="total" value="{{ $allprice }}">
            <button type="submit" class="btn btn-primary">結帳去</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        // 數量選擇
        $('.quantity-decrease').click(function() {
            let $form = $(this).closest('form');
            let $input = $(this).siblings('input');
            let val = parseInt($input.val());
            if (val > 1) {
                $input.val(val - 1);
                $form.submit();
            }
        });

        $('.quantity-increase').click(function() {
            let $form = $(this).closest('form');
            let $input = $(this).siblings('input');
            let val = parseInt($input.val());
            $input.val(val + 1);
            $form.submit();
        });

        // 數量修改
        $(document).on('submit', 'form.count', function(e) {
            e.preventDefault();

            var $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                method: $form.attr('method'),
                data: $form.serialize(),
                success: function(response) {
                    if (response.success) {
                        // console.log(response.success);
                        window.location.href = "/shopcart/list";
                    } else {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: response.msg,
                        });
                    }
                },
                error: function($error) {
                    console.log($error);
                }
            });
        });

        // 刪除
        $(document).on('submit', 'form.delete', function(e) {
            e.preventDefault();

            var $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                method: $form.attr('method'),
                data: $form.serialize(),
                success: function(response) {
                    if (response.success) {
                        // console.log(response.success);
                        window.location.href = "/shopcart/list";
                    } else {
                        console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: response.msg,
                        });
                    }
                },
                error: function($error) {
                    console.log($error);
                }
            });
        });
    });
</script>
@endsection