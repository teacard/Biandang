@extends('front.app')
@section('content')

@foreach($list as $data)
@if($data->ProductStatus == 'Y')
<!-- 排骨便當 -->
<div class="col-12 col-md-4 mb-3">
    <div class="card shadow-sm h-100">
        <img src="/images/products/{{ $data->ProductImg }}" class="card-img-top" alt="{{ $data->ProductName }}" style="height: 200px; object-fit: cover;">
        <div class="card-body text-center d-flex flex-column">
            <h5 class="card-title">{{ $data->ProductName }}</h5>
            <p class="card-text text-muted">NT$ {{ $data->ProductPrice }} 元</p>
            <button class="btn btn-primary mt-auto" data-bs-toggle="modal" data-bs-target="#modal-{{ $data->ProductId }}">加入訂單</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-{{ $data->ProductId }}" tabindex="-1" aria-labelledby="modalLabel-{{ $data->ProductId }}" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="form-{{ $data->ProductId }}" method="post" action="/shopcart/add">
            @csrf
            <input type="hidden" name="ProductId" value="{{ $data->ProductId }}">
            <input type="hidden" name="ProductName" value="{{ $data->ProductName }}">
            <input type="hidden" name="ProductPrice" value="{{ $data->ProductPrice }}">
            <button type="button" class="btn-close" style="margin-left: auto; margin-right: 1rem; margin-top: 1rem;" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body text-center" style="padding: 0px;">
                <!-- 圖片 -->
                <img src="/images/products/{{ $data->ProductImg }}"
                    class="img-fluid mb-3"
                    alt="{{ $data->ProductName }}"
                    style="width: 100%; height: 300px; object-fit: cover;">

                <!-- 產品名稱 -->
                <h3 class="modal-title fw-bold" id="modalLabel-{{ $data->ProductId }}">{{ $data->ProductName }}</h3>
                <!-- 價格 -->
                <p class="fw-bold">NT$ {{ $data->ProductPrice }} 元</p>

                <!-- 加購蛋 -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center" id="heading-{{ $data->ProductId }}" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $data->ProductId }}" aria-expanded="true" aria-controls="collapse-{{ $data->ProductId }}">
                        <div class="text-start">
                            <h5 class="mb-0">加購選項</h5>
                            <span class="text-secondary" style="font-size: 0.75rem;">可複選</span>
                        </div>

                        <i class="fa-solid fa-angle-down transition-icon"></i>
                    </div>

                    <div id="collapse-{{ $data->ProductId }}" class="collapse show" aria-labelledby="heading-{{ $data->ProductId }}">
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input egg-check" type="checkbox" id="egg-{{ $data->ProductId }}" name="addons[]" value='{"name":"荷包蛋","price":15}'>
                                        <label class="form-check-label" for="egg-{{ $data->ProductId }}">
                                            荷包蛋 +15 元
                                        </label>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input sidedishes-check" type="checkbox" id="sidedishes-{{ $data->ProductId }}" name="addons[]" value='{"name":"配菜","price":15}'>
                                        <label class="form-check-label" for="sidedishes-{{ $data->ProductId }}">
                                            配菜 +15 元
                                        </label>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input rice-check" type="checkbox" id="rice-{{ $data->ProductId }}" name="addons[]" value='{"name":"米飯","price":10}'>
                                        <label class="form-check-label" for="rice-{{ $data->ProductId }}">
                                            米飯 +10 元
                                        </label>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input marinade-check" type="checkbox" id="marinade-{{ $data->ProductId }}" name="addons[]" value='{"name":"滷汁","price":0}'>
                                        <label class="form-check-label" for="marinade-{{ $data->ProductId }}">
                                            加滷汁 +0 元
                                        </label>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input pepper-check" type="checkbox" id="pepper-{{ $data->ProductId }}" name="addons[]" value='{"name":"胡椒粉","price":0}'>
                                        <label class="form-check-label" for="pepper-{{ $data->ProductId }}">
                                            胡椒粉 +0 元
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- 數量選擇 -->
                <div class="d-flex justify-content-center align-items-center mt-3">
                    <button type="button" class="btn btn-outline-secondary btn-md me-2 quantity-decrease">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    <input type="text" name="quantity" class="form-control text-center quantity-input" style="width: 50vw;" value="1" min="1" readonly>
                    <button type="button" class="btn btn-outline-secondary btn-md ms-2 quantity-increase">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary">確認</button>
            </div>
        </form>
    </div>
</div>
@endif
@endforeach
<script>
    $(document).ready(function() {
        // 箭頭圖示切換
        $('[data-bs-toggle="collapse"]').each(function() {
            var $header = $(this);
            var targetSelector = $header.attr('data-bs-target');
            var $icon = $header.find('.transition-icon');
            var $collapse = $(targetSelector);

            if ($collapse.length && $icon.length) {
                $collapse.on('shown.bs.collapse', function() {
                    $icon.removeClass('fa-rotate-180');
                    $header.attr('aria-expanded', 'true');
                });
                $collapse.on('hidden.bs.collapse', function() {
                    $icon.addClass('fa-rotate-180');
                    $header.attr('aria-expanded', 'false');
                });
            }
        });

        // 數量選擇
        $('.quantity-decrease').click(function() {
            let $input = $(this).siblings('input');
            let val = parseInt($input.val());
            if (val > 1) {
                $input.val(val - 1);
            }
        });

        $('.quantity-increase').click(function() {
            let $input = $(this).siblings('input');
            let val = parseInt($input.val());
            $input.val(val + 1);
        });

        // modal 關閉時重置元素
        $('.modal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });

        $(document).on('submit', 'form.modal-content', function(e) {
            e.preventDefault();

            var $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                method: $form.attr('method'),
                data: $form.serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.msg,
                        });
                        // 關閉 modal
                        $form.closest('.modal').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: response.msg,
                        });
                    }
                },
                error: function() {
                    alert('伺服器錯誤');
                }
            });
        });

    });
</script>
@endsection