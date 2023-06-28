@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('./dataTables/dataTables.bootsrap5.min.css')}}">
<script src="{{ asset('./dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('./dataTables/dataTables.bootstrap5.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('./css/table.css')}}">

<div class="p-5">
    <div class="d-flex justify-content-between mb-3">
        <h6 class="fw-bold ">Manage users</span></h6>
    </div>
    <button class="btn btn-sm btn-primary" id="btn-add-user"> <i class="bx bx-user-plus"></i> Add user</button>

</div>


<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-5">
            <div class="mb-2 d-flex align-items-baseline justify-content-between">
                <h3 class="fw-bold">Users</h3>
                <x-loader />
            </div>

            <table class="display nowrap w-100 table-striped " id="table-users">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- add user modal -->
<div class="modal fade" id="addUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="x" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h4 class="">User information</h4>
                <p style="font-size: 12px;">Note: default password for account is
                <pre class="p-2 rounded-2 bg-dark text-info" style="font-family: 'Courier New', Courier, monospace; font-size:12px"> 'SJIHS2023'</pre>
                </p>
                <form id="userForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Firstname" name="firstname" />
                                <label for="">Firstname</label>
                                <span class="error_firstname text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Firstname" name="middlename" />
                                <label for="">Middlename(optional)</label>
                                <span class="error_middlename text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
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
                            <div class="d-flex">


                                <button type="submit" class="btn btn-primary btn-sm  w-100 mt-2 text-white" id="btn-submit" />
                                <span id="btn-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                Create account
                                </button>

                                <button type="button" class="mx-2 btn btn-default btn-sm  w-100 mt-2" onclick="$('#addUserModal').modal('hide')" />
                                Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>


<!-- edit user modal -->
<div class="modal fade" id="editUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="x1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h4 class="">User information</h4>
                <p style="font-size: 12px;">Note: default password for account is
                <pre class="p-2 rounded-2 bg-dark text-info" style="font-family: 'Courier New', Courier, monospace; font-size:12px"> 'SJIHS2023'</pre>
                </p>
                <form id="edituserForm">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Firstname" name="e_firstname" id="e_firstname" />
                                <label for="">Firstname</label>
                                <span class="error_e_firstname text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Firstname" name="e_middlename" id="e_middlename" />
                                <label for="">Middlename(optional)</label>
                                <span class="error_e_middlename text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Lastname" name="e_lastname" id="e_lastname" />
                                <label for="">Lastname</label>
                                <span class="error_e_lastname text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" placeholder="Email address" autocomplete="off" name="e_email" id="e_email" />
                                <label for="">Email address</label>
                                <span class="error_e_email text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="button" class="btn btn-danger btn-sm  mt-2 text-white" id="btn-reset" />
                            <i class="bx bx-undo"></i>
                            Reset password
                            </button>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary btn-sm  w-100 mt-2 text-white" id="btn-edit-submit" />
                                <span id="btn-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                Save changes
                                </button>

                                <button type="button" class="mx-2 btn btn-default btn-sm  w-100 mt-2" onclick="$('#editUserModal').modal('hide')" />
                                Cancel
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<x-message-alert />

<div class="modal fade" id="dialog" tabindex="-1" aria-labelledby="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="d-flex flex-column p-4 align-items-baseline">
                    <div class="d-flex mb-2">
                        <span class="bx bx-shield fs-4"></span>
                        <h5>Promp Message</h5>
                    </div>
                    <p style="font-size: 12px;" id="dialog-box-text">Delete this user now?</p>
                    <div class="bg-dark text-warning w-100 rounded-2 d-flex flex-column p-2" style="font-family: 'Courier New', Courier, monospace; font-size:12px">
                        <div><span id="fn"></span></div>
                        <div> <span id="mn"></span></div>
                        <div> <span id="ln"></span></div>
                        <div> <span id="em"></span></div>
                    </div>
                </div>
            </div>
            <div class="bg-light p-2">
                <div class="d-flex float-end">
                    <button class="btn btn-danger btn-sm m-2" id="dialog-btn-confirm">Confirm</button>
                    <button class="btn btn-default btn-sm m-2" onclick="$('#dialog').modal('hide')">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadData() {
        var table = $('#table-users').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.show') }}",
            oLanguage: {
                sSearch: 'Search.'
            },
            columns: [{
                    data: 'firstname',
                    name: 'firstname'
                },
                {
                    data: 'middlename',
                    name: 'middlename'
                },
                {
                    data: 'lastname',
                    name: 'lastname'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],

            'lengthMenu': [
                [10, 10, 15, 20, 50, -1],
                [10, 10, 15, 20, 50, 'All'],
            ]
        })
    }

    loadData()

    function showAlert(msg) {
        $('#msgAlert').modal('show')
        $('#msgAlert-msg').text(msg)
        $('#msgAlert-btn').css('display', 'inherit')
    }

    function showErrorAlert(msg) {
        $('#msgAlert').modal('show')
        $('#msgAlert-msg').text(msg)
        $('#msgAlert-icon').addClass('bx bx-error-circle')
    }

    $('#btn-add-user').click(function() {
        $('#addUserModal').modal('show')
    })

    $('#userForm').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            url: "{{ route('user.add') }}",
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function() {

                $('#userForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')

                $('#userForm :input').prop("disabled", true)
            },
            success: function(data) {
                $('#userForm :input').prop("disabled", false)
                if (data.status === 0) {
                    $.each(data.error, function(prefix, val) {
                        $('.error_' + prefix).text(val[0]);
                        $("input[name=" + prefix + "]").addClass('is-invalid')
                    })
                }
                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#userForm')[0].reset()
                    $('#addUserModal').modal('hide')
                    loadData()
                }
            },
            error: function() {
                showErrorAlert('Connection to server error.')
                $('#userForm :input').prop("disabled", false)
            }
        })
    })


    $('#edituserForm').on('submit', function(e) {
        e.preventDefault()
        var route = "{{ route('user.update',':id') }}"
        $.ajax({
            url: route.replace(':id', $('#btn-edit-submit')[0].dataset.id),
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function() {

                $('#edituserForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')

                $('#edituserForm :input').prop("disabled", true)
            },
            success: function(data) {
                $('#edituserForm :input').prop("disabled", false)
                if (data.status === 0) {
                    $.each(data.error, function(prefix, val) {
                        $('.error_' + prefix).text(val[0]);
                        $("input[name=" + prefix + "]").addClass('is-invalid')
                    })
                }
                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#edituserForm')[0].reset()
                    $('#editUserModal').modal('hide')
                    loadData()
                }

                if (data.status === 500) {
                    $('.error_e_email').text(data.msg);
                    $("input[name=e_email]").addClass('is-invalid')
                }
            },
            error: function() {
                showErrorAlert('Connection to server error.')
                $('#edituserForm :input').prop("disabled", false)
            }
        })
    })

    $('#table-users').on('click', 'td .btn-edit', function() {
        $('#editUserModal').modal('show')
        $('#e_firstname').val($(this)[0].dataset.firstname)
        $('#e_middlename').val($(this)[0].dataset.middlename)
        $('#e_lastname').val($(this)[0].dataset.lastname)
        $('#e_email').val($(this)[0].dataset.email)

        $('#btn-edit-submit').attr('data-id', $(this)[0].dataset.id)
        $('#btn-reset').attr('data-id', $(this)[0].dataset.id)
    })

    $('#btn-reset').on('click', function() {
        var route = "{{ route('user.default.password',':id') }}"
        $.ajax({
            url: route.replace(':id', $(this)[0].dataset.id),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {
                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#editUserModal').modal('hide')
                    loadData()
                }
            },
            error: function() {
                showErrorAlert('Connection to server error.')
            }
        })
    })

    $('#table-users').on('click', 'td .btn-delete', function() {

        $('#fn').text($(this)[0].dataset.firstname)
        $('#mn').text($(this)[0].dataset.middlename)
        $('#ln').text($(this)[0].dataset.lastname)
        $('#em').text($(this)[0].dataset.email)

        $('#dialog-btn-confirm').attr('data-id', $(this)[0].dataset.id)
        $('#dialog').modal('show')
    })

    $('#dialog-btn-confirm').click(function() {

        var route = "{{ route('user.destroy',':id') }}"
        $.ajax({
            url: route.replace(':id', $(this)[0].dataset.id),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {
                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#dialog').modal('hide')
                    loadData()
                }
            },
            error: function() {
                showErrorAlert('Connection to server error.')
            }
        })
    })
</script>
@endsection