<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BianDang</title>
    <!-- Bootstrap -->
    <link href="/front/css/bootstrap.min.css" rel="stylesheet">
    <script src="/front/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="/front/js/jquery-3.7.1.min.js"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/front/css/sweetalert2.min.css">
    <script src="/front/js/sweetalert2.all.min.js"></script>
</head>
<style>
    .row.flex-grow-1.overflow-auto::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }
</style>

<body class="bg-light" style="height: 100vh; margin: 0;">

    <div class="container py-5 d-flex flex-column" style="height: 100%;">
        <div class="d-flex align-items-center justify-content-end mb-4">
            <p style="margin: 0;">歡迎： @if(Session::has('front_name')) {{ Session::get('front_name') }} @endif 使用者</p>
            <a href="/logout" class="btn btn-warning ms-3">登出</a>
        </div>
        <div class="text-center mb-4 position-relative">
            <!-- 回首頁 -->
            <a href="/home" style="position: absolute; top: 0; left: 0;">
                <i class="fa-solid fa-house text-dark" style="font-size: 2.5rem; cursor: pointer;"></i>
            </a>
            <!-- 購物車圖示 -->
            <a href="/shopcart/list" style="position: absolute; top: 0; right: 3rem;">
                <i class="fa-solid fa-cart-shopping" style="font-size: 2.5rem; cursor: pointer; color: #198754;"></i>
            </a>

            <!-- 訂單圖示 -->
            <a href="/order/list" style="position: absolute; top: 0; right: 0;">
                <i class="fa-solid fa-clipboard-list text-primary" style="font-size: 2.5rem; cursor: pointer;"></i>
            </a>


            <h1 class="fw-bold">便當訂購系統</h1>
        </div>

        <div class="row flex-grow-1 overflow-auto">
            @yield('content')
        </div>
    </div>

</body>
@if(Session::has('frontmsg'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ Session::get("frontmsg") }}',
    });
</script>
@endif

</html>