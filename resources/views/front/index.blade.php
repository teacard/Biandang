<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>BianDang登入</title>
    <link href="/front/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-sm" style="width: 350px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">登入</h3>

            {{-- 錯誤訊息 --}}
            @if ($errors->has('msg'))
                <div class="alert alert-danger">
                    {{ $errors->first('msg') }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="account" class="form-label">帳號</label>
                    <input type="text" name="account" id="account" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">密碼</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">登入</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="/register">註冊新帳號</a>
            </div>
        </div>
    </div>

    <script src="/front/js/bootstrap.min.js"></script>
</body>
</html>
