@extends('layouts.dashboard')

@section('content')
<div class="p-5">
    <h6 class="fw-bold mb-3">Settings</h6>

    <div class="card mb-3">
        <div class="card-body">
            <p class="fw-bold">Personal information</p>

            <form id="basicInfo">
                <div class="row">

                    @csrf
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Given name" name="firstname" value="{{ $user->firstname }}" />
                            <label for="">First name.</label>
                            <span class="error_firstname text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Sur name" name="lastname" value="{{ $user->lastname }}" />
                            <label for="">Last name.</label>
                            <span class="error_lastname text-danger error-text"></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Email address" name="email" value="{{ $user->email }}" />
                            <label for="">Email address.</label>
                            <span class="error_email text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-sm float-end"><i class="bx bx-save"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <p class="fw-bold">Password setting</p>

            <form id="passwordInfo">
                <div class="row">
                    @csrf
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" autocomplete="off" placeholder="password" name="old_password" value="" />
                            <label for="">Current Password.</label>
                            <span class="error_old_password text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" autocomplete="off" placeholder="new password" name="password" value="" />
                            <label for="">New password.</label>
                            <span class="error_password text-danger error-text"></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" autocomplete="off" placeholder="password confirmation" name="password_confirmation" value="" />
                            <label for="">Confirm Password.</label>
                            <span class="error_password_confirmation text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-sm float-end"><i class="bx bx-save"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(Auth::user()->role === 0)
    <div class="card mb-3">
        <div class="card-body">
            <p class="fw-bold">Reset Password</p>

            <form id="resetInfo">
                <div class="row">
                    @csrf
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" autocomplete="off" placeholder="Given name" name="old_password_q" value="" />
                            <label for="">Current Password.</label>
                            <span class="error_old_password_q text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <select name="security_question" id="select-question" class="form-select">
                                <option value="{{$user->security_question }}">{{ $user->security_question }}</option>
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
                            <input type="text" class="form-control" autocomplete="off" placeholder="Email address" name="security_answer" value="{{ $user->security_answer}}" />
                            <label for="">Security answer.</label>
                            <span class="error_security_answer text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-sm float-end"><i class="bx bx-save"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if(Auth::user()->role === 0)
    <div class="card mb-3">
        <div class="card-body">
            <p class="fw-bold">Others</p>

            <form id="formOther">
                <div class="row">
                    @csrf
                    <p class="text-warning fw-bold m-0" style="font-size: 12px;">This info will appear in form137</p>
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Principal / admin name" name="admin_name" value="{{ $user->admin_name}}" />
                            <label for="">principal / admin name.</label>
                            <span class="error_admin_name text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-sm float-end"><i class="bx bx-save"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

<x-message-alert />
<script src="{{ asset('./js/partials/settings.js')}}"></script>

<script>
    $('#basicInfo').on('submit', function(e) {
        e.preventDefault()

        saveChanges($(this).serialize(), '#basicInfo', "{{ route('basicinfo.update') }}")
    })

    //password setting
    $('#passwordInfo').on('submit', function(e) {
        e.preventDefault()
        saveChanges($(this).serialize(), '#passwordInfo', "{{ route('passwordinfo.update') }}")

    })

    //reset setting
    $('#resetInfo').on('submit', function(e) {
        e.preventDefault()

        saveChanges($(this).serialize(), '#resetInfo', "{{ route('resetinfo.update') }}")
    })

    $('#formOther').on('submit', function(e) {
        e.preventDefault()
        saveChanges($(this).serialize(), '#formOther', "{{ route('other.save') }}")
    })
</script>
@endsection