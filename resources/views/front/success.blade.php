<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8" />
    <title>註冊成功</title>
    <link href="/front/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-sm text-center" style="width: 400px;">
        <div class="card-body">
            <h2 class="text-success mb-4">🎉 註冊成功！</h2>
            <p class="mb-4">註冊成功，將在3秒後切換至登入頁面。</p>
        </div>
    </div>

    <script src="/front/js/bootstrap.min.js"></script>
    <script>
        setTimeout(function() {
            window.location.href = "/";
        }, 3000);
    </script>
</body>
</html>
