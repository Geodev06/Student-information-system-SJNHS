<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Login</title>
    <link rel="stylesheet" href="{{ asset('./css/Custom.css')}}" />
    <link rel="stylesheet" href="{{ asset('./bs/boxicons.min.css')}}" />

    <script src="{{ asset('./bs/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('./js/popper.min.js') }}"></script>
    <script src="{{ asset('./js/jquery-3.5.1.js') }}"></script>

</head>

<body class="bg-light">
    <div class="container">
        <div class="row mt-5">

            <div class="col-lg-5 mt-5 mx-auto">
                <div class="card-body bg-white p-5 border h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column">
                            <h4 class="mb-4 fw-bold">User authentication</h4>
                            <p style="font-size: 13px;">Student information management System</p>
                        </div>
                        <div>
                            <img src="{{ asset('./img/logo.png') }}" alt="logo" height="100px" width="100px">
                        </div>
                    </div>
                    <form id="loginForm">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="Email address" autocomplete="off" name="email" />
                            <label for="">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                            <label for="">Password</label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label for="remember class=" form-check-label">remember me</label>
                        </div>

                        <button type="submit" id="btn-submit" class="btn w-100 btn-primary mb-3" />
                        <span id="btn-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                        Proceed</button>
                        <p class="text-primary text-decoration-underline" id="btn-reset" style="font-size: 12px; cursor:pointer">Reset password</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-message-alert />
</body>

<script src="{{ asset('./js/partials/login.js') }}"></script>
<script>
    login("{{ route('user.auth') }}")

    $('#btn-reset').click(function(e) {
        e.preventDefault()
        var data = {
            _token: "{{ csrf_token() }}",
            email: $('#email').val()
        }
        resetPassword("{{ route('password.reset') }}", data)
    })
</script>

</html>