<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System register</title>
    <link rel="stylesheet" href="{{ asset('./css/Custom.css')}}" />
    <link rel="stylesheet" href="{{ asset('./bs/boxicons.min.css')}}" />

    <script src="{{ asset('./bs/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('./js/popper.min.js') }}"></script>
    <script src="{{ asset('./js/jquery-3.5.1.js') }}"></script>

</head>

<body class="bg-light">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 mt-4 mx-auto mb-5">
                <div class="card-body bg-white p-5 border h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column">
                            <h4 class="mb-4 fw-bold p-0">Account setup</h4>
                            <p style="font-size: 13px;">Student information management System</p>
                        </div>
                        <div>
                            <img src="{{ asset('./img/logo.png') }}" alt="logo" height="70px" width="70px">
                        </div>
                    </div>
                    <form id="regForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="Firstname" name="firstname" />
                                    <label for="">Firstname</label>
                                    <span class="error_firstname text-danger error-text"></span>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="Lastname" name="lastname" />
                                    <label for="">Lastname</label>
                                    <span class="error_lastname text-danger error-text"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" placeholder="Email address" autocomplete="off" name="email" />
                                    <label for="">Email address</label>
                                    <span class="error_email text-danger error-text"></span>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password" />
                                    <label for="">Your paassword</label>
                                    <span class="error_password text-danger error-text"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" />
                                    <label for="">Confirm paassword</label>
                                    <span class="error_password_confirmation text-danger error-text"></span>
                                </div>
                            </div>

                            <hr>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <select name="security_question" id="select-question" class="form-select">
                                        <option value="">Choose one</option>
                                        <option value="What is your favorite color?">What is your favorite color?</option>
                                        <option value="What primary school did you attend?">What primary school did you attend?</option>
                                        <option value="In what city or town was your first full time job?">In what city or town was your first full time job?</option>
                                        <option value="What is the middle name of your oldest child?">What is the middle name of your oldest child?</option>
                                        <option value="What is your spouse or partner's mothers name?">What is your spouse or partner's mothers name?</option>
                                        <option value="What is the last 5 digits of your phone number?">What is the last 5 digits of your phone number?</option>

                                    </select>
                                    <label for="select">Security Question</label>
                                    <span class="error_security_question text-danger error-text"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" autocomplete="off" placeholder="Security answer" name="security_answer" value="" />
                                    <label for="">Security answer.</label>
                                    <span class="error_security_answer text-danger error-text"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary w-100 mt-2 text-white" id="btn-submit" />
                                <span id="btn-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                Create account
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-message-alert />
</body>
<script src="{{ asset('./js/partials/register.js') }}"></script>
<script>
    register("{{ route('user.store') }}")
</script>

</html>