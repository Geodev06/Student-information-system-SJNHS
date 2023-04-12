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
            <div class="col-lg-8 mt-5 mx-auto">
                <div class="card-body bg-white p-5 border h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column">
                            <h4 class="mb-4 fw-bold">Paswword reset</h4>
                            <p style="font-size: 13px;">Student information management System</p>
                        </div>
                        <div>
                            <img src="{{ asset('./img/logo.png') }}" alt="logo" height="100px" width="100px">
                        </div>
                    </div>
                    <p class="fw-bold"><i class="bx bx-check text-success"></i> {{$data[0]->email}}</p>
                    <form id="resetForm">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="hidden" name="email" value="{{$data[0]->email}}">
                            <input type="password" class="form-control" placeholder="New password" autocomplete="off" name="password" />
                            <label for="">New password</label>
                            <span class="text-danger error_password"></span>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" placeholder="Answer" name="password_confirmation" />
                            <label for="">Confirm password</label>

                        </div>
                        <button type="submit" id="btn-submit" class="btn w-100 btn-primary mb-3" />
                        <span id="btn-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                        Reset</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-message-alert />
</body>

<script>
    function errorMsg(msg) {

        $('#msgAlert').modal('show')
        $('#msgAlert-icon').addClass('text-danger')
        $('#msgAlert-icon').addClass('bx bx-error-circle')
        $('#msgAlert-msg').text(msg)
    }

    $('#resetForm').on('submit', function(e) {
        e.preventDefault()

        $.ajax({
            url: "{{ route('password.saved') }}",
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function() {
                $('#resetForm :input').prop("disabled", true)


                $('#resetForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')

                $('#btn-spinner').css('display', 'inherit')
            },
            success: function(data) {
                $('#btn-spinner').css('display', 'none')

                $('#resetForm :input').prop("disabled", false)

                if (data.status === 0) {

                    $.each(data.error, function(prefix, val) {
                        $('.error_' + prefix).text(val[0]);
                        $("input[name=" + prefix + "]").addClass('is-invalid')
                    })
                }

                if (data.status === 200) {
                    errorMsg(data.msg)
                    window.location.replace("{{ route('login') }}")
                }

                if (data.status === 401) {
                    errorMsg(data.msg)
                }

            },
            error: function(err) {
                errorMsg('Connection to server error.')
            }
        })
    })
</script>

</html>