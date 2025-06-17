<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>便當系統註冊</title>
    <link href="/front/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">註冊新帳號</h3>
            <form action="/ckregister" method="POST" id="registerForm">
                @csrf
                <div class="mb-3">
                    <label for="account" class="form-label">帳號</label>
                    <input type="text" name="account" id="account" class="form-control" placeholder="請輸入英數混和，5~10字" required>
                    <span class="d-none text-danger account-error">帳號格式錯誤</span>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">密碼</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="請輸入英數混和，5~10字" required>
                    <span class="d-none text-danger password-error">密碼格式錯誤</span>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">姓名</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="EX:王小明" required>
                    <span class="d-none text-danger name-error">姓名格式錯誤</span>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">電話</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="EX:0912345678" required>
                    <span class="d-none text-danger phone-error">電話格式錯誤</span>
                </div>

                @if($errors->has('msg'))
                <p class="text-danger">{{ $errors->first('msg') }}</p>
                @endif
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">註冊</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="/">已經有帳號？登入</a>
            </div>
        </div>
    </div>

    <script src="/front/js/bootstrap.min.js"></script>
</body>
<script src="/front/js/jquery-3.7.1.min.js"></script>
@if($errors->has('msg'))
<script>
    $('#account').addClass('is-invalid');
    $('#password').addClass('is-invalid');
</script>
@endif
<script>
    $('#registerForm').on('submit', function(event) {
        let isValid = true;

        let account = $('#account').val().trim();
        let password = $('#password').val().trim();
        let name = $('#name').val().trim();
        let phone = $('#phone').val().trim();

        // 驗證帳號
        let accountPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,10}$/;
        if (!accountPattern.test(account)) {
            $('#account').addClass('is-invalid');
            $('.account-error').show();
            isValid = false;
        } else {
            $('#account').removeClass('is-invalid');
            $('.account-error').hide();
        }

        // 驗證密碼
        let passwordPattern = /^.{5,10}$/;
        if (!passwordPattern.test(password) || password === account) {
            $('#password').addClass('is-invalid');
            $('.password-error').show();
            isValid = false;
        } else {
            $('#password').removeClass('is-invalid');
            $('.password-error').hide();
        }

        // 驗證姓名
        let namePattern = /^[\u4e00-\u9fa5]{3}$/;
        if (!namePattern.test(name)) {
            $('#name').addClass('is-invalid');
            $('.name-error').show();
            isValid = false;
        } else {
            $('#name').removeClass('is-invalid');
            $('.name-error').hide();
        }

        // 驗證電話
        let phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phone)) {
            $('#phone').addClass('is-invalid');
            $('.phone-error').show();
            isValid = false;
        } else {
            $('#phone').removeClass('is-invalid');
            $('.phone-error').hide();
        }

        if (!isValid) {
            event.preventDefault(); // 阻止送出
        }
    });
</script>

</html>