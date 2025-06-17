@extends('front.app')
@section('content')
<div class="overflow-auto m-2">
    <table class="table" style="background-color: #ececec;">
        <thead class="table-light">
            <tr>
                <th>訂單編號</th>
                <th>總金額</th>
                <th>訂單時間</th>
                <th>狀態</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $data)
            <tr class="order-header" data-target="detail-{{ $data->OrderId }}" style="cursor: pointer;">
                <td>{{ $data->OrderId }}</td>
                <td>{{ $data->OrderPrice }}</td>
                <td>{{ $data->CreateTime }}</td>
                <td>
                    @if($data->OrderStatus == 0)
                    <span>待完成</span>
                    @elseif($data->OrderStatus == 1)
                    <span>已完成</span>
                    @else
                    <span>已取消</span>
                    @endif
                </td>
                <td>
                    <form action="/order/delete" method="post">
                        @csrf
                        @if($data->OrderStatus == 0)
                        <input type="hidden" name="oid" value="{{ $data->OrderId }}">
                        <button type="submit" class="btn btn-danger">取消訂單</button>
                        @endif
                    </form>
                </td>
            </tr>
            <tr class="order-detail detail-{{ $data->OrderId }}" style="display: none;">
                <td colspan="4">
                    <div class="container">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>名稱/加點</th>
                                    <th>小計</th>
                                    <th>數量</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data->op as $item)
                                <tr>
                                    <td style="width: auto;">
                                        <h4>{{ $item->OrderProductsName }}</h4>
                                        <ul>
                                            @foreach($item->addon as $addon)
                                            <li>{{ $addon->OrderAddOnName }} + {{ $addon->OrderAddOnPrice }} 元</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $item->optotal }}</td>
                                    <td>{{ $item->OrderProductsCount }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- jQuery 開關效果 -->
<script>
    $(document).ready(function() {
        $('.order-header').click(function() {
            var target = $(this).data('target');
            $(this).toggleClass('chgbg');
            $('.' + target).toggle();
        });
    });
</script>

<style>
    .chgbg {
        background-color: #666666;
        color: #ececec;
    }
</style>

@endsection