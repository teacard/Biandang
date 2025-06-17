<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biandang後台登入</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css">
    <script src="/admin/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <form action="cklogin" method="post" class="form-inline">
                    @csrf
                    <div class="d-flex justify-content-center mb-3">
                        <label for="username" class="col-form-label me-2">帳號</label>
                        <input type="text" name="username" id="username" class="form-control" style="width: 200px;" value="{{ old('username') }}" autocomplete="off" required>
                    </div>
                    @if($errors->has('msg'))
                    <div class="row mb-3">
                        <div class="col-12 text-center">
                            <span class="text-danger">{{ $errors->first('msg') }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="d-flex justify-content-center mb-3">
                        <label for="username" class="col-form-label me-2">密碼</label>
                        <input type="password" name="password" id="password" class="form-control" style="width: 200px;" autocomplete="off" required>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2">登入</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>