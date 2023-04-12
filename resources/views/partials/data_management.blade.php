@extends('layouts.dashboard')

@section('content')
<!-- datatables -->
<link rel="stylesheet" href="{{ asset('./dataTables/dataTables.bootsrap5.min.css')}}">
<script src="{{ asset('./dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('./dataTables/dataTables.bootstrap5.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('./css/table.css')}}">

<div class="p-5">
    <h6 class="fw-bold">Data management</h6>
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary w-auto btn-sm text-white" id="btn-add-student"> <span class="bx bx-plus"></span> Add student</button>
        <div class="d-flex">
            <a href="{{ route('subject.manage') }}" class="btn btn-primary btn-sm"> <span class="bx bx-book"></span>Manage subjects</a>
        </div>
    </div>

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-5">
            <div class="mb-2 d-flex align-items-baseline justify-content-between">
                <h3 class="fw-bold">Students</h3>
                <x-loader />
            </div>

            <table class="display nowrap w-100 table-striped " id="table-students">
                <thead>
                    <tr>
                        <th>LRN</th>
                        <th>Full name</th>
                        <th>Sex</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- add student modal -->
<div class="modal fade" id="addStudentModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addSubj" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h4 class="mb-3">Add student</h4>
                <form action="" id="studentForm">
                    @csrf
                    <div class="row">
                        <p style="margin-top: 0; font-size:13px" class="text-muted">Learner's information</p>
                        <div class="col-lg-3">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" placeholder="Given name" name="firstname" />
                                <label for="">First name.</label>
                                <span class="error_firstname text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" placeholder="Middle name" name="middlename" />
                                <label for="">Middle name (optional).</label>
                                <span class="error_middlename text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" placeholder="Sur name" name="lastname" />
                                <label for="">Last name.</label>
                                <span class="error_lastname text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" placeholder="Sur name" name="name_ext" />
                                <label for="">Ext.(opt) ex. Jr II III.</label>
                                <span class="error_name_ext text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" autocomplete="off" name="birthdate" />
                                <label for="">Birthdate.</label>
                                <span class="error_birthdate text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-floating mb-3 d-flex align-items-center justify-content-around">
                                <div class="form-check">
                                    <input type="radio" name="sex" value="0" class="form-check-input" id="radio" checked>
                                    <label for="radio" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="sex" value="1" class="form-check-input" id="radio">
                                    <label for="radio" class="form-check-label">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" autocomplete="off" name="lrn" placeholder="Learning reference number. (12 - digits)" />
                                <label for="">Learning reference number. (12 - digits).</label>
                                <span class="error_lrn text-danger error-text"></span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" name="elem_school" placeholder="Graduated elementary school" />
                                <label for="">Name of school (elementary).</label>
                                <span class="error_elem_school text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" name="elem_school_citation" placeholder="Graduated elementary school" />
                                <label for="">Citations (if Any).</label>
                                <span class="error_elem_school_citation text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" name="elem_school_id" placeholder="Graduated elementary school" />
                                <label for="">School Id (elementary).</label>
                                <span class="error_elem_school_id text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" name="elem_school_address" placeholder="Graduated elementary school" />
                                <label for="">School address (elementary).</label>
                                <span class="error_elem_school_address text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" name="gen_ave" placeholder="Gen ave." />
                                <label for="">General average.</label>
                                <span class="error_gen_ave text-danger error-text"></span>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex float-end">
                        <button type="button" class="btn btn-default btn-sm m-2" id="btn-close">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm m-2"> <i class="bx bx-save"></i> Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
<!-- end modal -->

<x-message-alert />
<script>
    function loadData() {
        var table = $('#table-students').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('student.get') }}",
            oLanguage: {
                sSearch: 'Search LRN/Sur name.'
            },
            columns: [{
                    data: 'lrn',
                    name: 'lrn'
                },
                {
                    data: 'fullname',
                    name: 'lastname'
                },
                {
                    data: 'sex',
                    name: 'sex'
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

    $('#studentForm').on('submit', function(e) {
        e.preventDefault()

        $.ajax({
            url: "{{ route('studentinfo.store') }}",
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: () => {

                $('#studentForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $('#studentForm :input').prop("disabled", true)
            },
            success: (data) => {

                $('#studentForm :input').prop("disabled", false)

                if (data.status === 0) {
                    $.each(data.error, function(prefix, val) {

                        $('.error_' + prefix).text(val[0]);

                        $("input[name=" + prefix + "]").addClass('is-invalid')
                    })
                }

                if (data.status === 200) {
                    $('#studentForm')[0].reset()
                    $('#addStudentModal').modal('hide')
                    showAlert(data.msg)
                    loadData()
                }
            },
            error: (err) => {
                showErrorAlert('Connection to server error.')
            }
        })
    })

    $('#table-students tbody').on('click', 'tr .btn-edit', function(e) {

        var route = "{{ route('student.edit',':lrn') }}"
        window.location.href = route.replace(':lrn', $(this)[0].dataset.id)

    })

    $('#table-students tbody').on('click', 'tr .btn-show', function(e) {

        var route = "{{ route('student.show',':lrn') }}"
        window.open(route.replace(':lrn', $(this)[0].dataset.id))

    })

    $('#table-students tbody').on('click', 'tr .btn-delete', function(e) {

        $('#msgBox').modal('show')
        $('#msg-box-text').text('Are you sure you want to delete all of the records of learner - ' + $(this)[0].dataset.id)
        $('#msgBox-delete-student-info').css('display', 'block')
        $('#msgBox-delete-acads').css('display', 'none')
        $('#msgBox-delete-student-info').attr('data-id', $(this)[0].dataset.id)
        $('#msgBox-btn-confirm').css('display', 'none')

    })

    $('#msgBox-delete-student-info').click(function() {

        var route = "{{ route('studentinfo.destroy',':lrn') }}"
        $.ajax({
            url: route.replace(':lrn', $(this)[0].dataset.id),
            type: 'get',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: () => {},
            success: (data) => {
                if (data.status === 200) {
                    $('#msgBox').modal('hide')
                    showAlert(data.msg)
                    loadData()
                }
            },
            error: (err) => {
                showErrorAlert('Connection to server error.')
            }
        })
    })

    $('#btn-add-student').click(() => $('#addStudentModal').modal('show'))
    $('#btn-close').click(() => $('#addStudentModal').modal('hide'))
</script>
@endsection