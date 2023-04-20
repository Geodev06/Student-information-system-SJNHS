@extends('layouts.dashboard')

@section('content')
<!-- datatables -->
<link rel="stylesheet" href="{{ asset('./dataTables/dataTables.bootsrap5.min.css')}}">
<script src="{{ asset('./dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('./dataTables/dataTables.bootstrap5.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('./css/table.css')}}">

<link rel="stylesheet" href="{{ asset('./css/jquery-editable-select.css')}}">
<script src="{{ asset('./js/jquery-editable-select.js') }}"></script>
<div class="p-5">
    <h6 class="fw-bold">Class management</h6>
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary w-auto btn-sm text-white" onclick="$('#addClassModal').modal('show')"> <span class="bx bx-plus"></span> Create class</button>
    </div>

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-5">
            <div class="mb-2 d-flex align-items-baseline justify-content-between">
                <h3 class="fw-bold">Classes</h3>

            </div>

            <table class="display nowrap w-100 table-striped " id="table-section">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Section</th>
                        <th>Adviser</th>
                        <th>Grade level</th>
                        <th>School year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-uppercase">
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- add section modal -->
<div class="modal fade" id="addClassModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="x" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h4 class="">Class information</h4>
                <p style="margin-top: 0; font-size:12px" class="text-info">
                    Note: Make sure that your school information has been set. before creating classes.
                    <a href="/settings" class="mx-1" style="font-size: 12px;">Go to settings</a>
                </p>

                <form id="classForm">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" placeholder="x" name="section" />
                                <label for="">Section name</label>
                                <span class="error_section text-danger error-text"></span>
                            </div>
                        </div>

                        <input type="hidden" name="teacher_id" id="teacher-id">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <select name="" id="select-teacher-id" class="form-control">
                                    <option value="">Choose one</option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" class="text-capitalize">{{ $teacher->lastname .', '.$teacher->firstname .' '. $teacher->middlename }}</option>
                                    @endforeach
                                </select>
                                <label for="">Teacher/Adviser</label>
                            </div>
                            <span class="error_teacher_id text-danger error-text"></span>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <select name="grade_level" id="select-grade-level" class="form-control">
                                    <option value="">Choose one</option>
                                    <option value="Grade 7">Grade 7</option>
                                    <option value="Grade 8">Grade 8</option>
                                    <option value="Grade 9">Grade 9</option>
                                    <option value="Grade 10">Grade 10</option>
                                    <option value="Grade 11">Grade 11</option>
                                    <option value="Grade 12">Grade 12</option>
                                </select>
                                <label for="">Grade level</label>
                            </div>
                            <span class="error_grade_level text-danger error-text"></span>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <select name="school_year" id="select-school-year" class="form-control">
                                </select>
                                <label for="">School_year</label>
                                <span class="error_school_year text-danger error-text"></span>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex float-end">
                        <button type="submit" class="btn btn-primary btn-sm m-2"> <i class="bx bx-save"></i> Save</button>
                        <button type="button" class="btn btn-default btn-sm m-2" onclick="$('#addClassModal').modal('hide')">Cancel</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
<!-- end modal -->

<!-- edit section modal -->
<div class="modal fade" id="editClassModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="x" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h4 class="">Edit Class information</h4>
                <p style="margin-top: 0; font-size:12px" class="text-info">
                    Note: Make sure that your school information has been set. before creating classes.
                    <a href="/settings" class="mx-1" style="font-size: 12px;">Go to settings</a>
                </p>

                <form id="editclassForm">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" autocomplete="off" placeholder="x" name="e_section" id="e-section" />
                                <label for="">Section name</label>
                                <span class="error_e_section text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <select name="e_teacher_id" id="e-select-teacher-id" class="form-control">
                                    <option value="" id="e-teacher-default"></option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" class="text-capitalize">{{ $teacher->lastname .', '.$teacher->firstname .' '. $teacher->middlename }}</option>
                                    @endforeach
                                </select>
                                <label for="">Teacher/Adviser</label>
                            </div>
                            <span class="error_e_teacher_id text-danger error-text"></span>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <select name="e_grade_level" id="select-grade-level" class="form-control">
                                    <option value="" id="e-grade-default">Choose one</option>
                                    <option value="Grade 7">Grade 7</option>
                                    <option value="Grade 8">Grade 8</option>
                                    <option value="Grade 9">Grade 9</option>
                                    <option value="Grade 10">Grade 10</option>
                                    <option value="Grade 11">Grade 11</option>
                                    <option value="Grade 12">Grade 12</option>
                                </select>
                                <label for="">Grade level</label>
                            </div>
                            <span class="error_e_grade_level text-danger error-text"></span>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <select name="e_school_year" id="e-select-school-year" class="form-control">
                                    <option value="" id="e-school-year-default"></option>
                                </select>
                                <label for="">School_year</label>
                                <span class="error_e_school_year text-danger error-text"></span>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex float-end">
                        <button type="submit" class="btn btn-primary btn-sm m-2"> <i class="bx bx-save"></i> Save</button>
                        <button type="button" class="btn btn-default btn-sm m-2" id="btn-submit" onclick="$('#editClassModal').modal('hide')">Cancel</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
<!-- end modal -->

<div class="modal fade" id="dialog" tabindex="-1" aria-labelledby="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="d-flex flex-column p-4 align-items-baseline">
                    <div class="d-flex mb-2">
                        <span class="bx bx-shield fs-4"></span>
                        <h5>Promp Message</h5>
                    </div>
                    <p style="font-size: 12px;" id="dialog-box-text">Delete this class now?</p>
                    <span id="data-section" class="text-uppercase fw-bold text-muted"></span>
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

<x-message-alert />

<script src="{{ asset('./js/partials/settings.js')}}"></script>

<script>
    function loadData() {
        var table = $('#table-section').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            filter: true,
            ajax: "{{ route('class.get') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'section',
                    name: 'section'
                },
                {
                    data: 'teacher_name',
                    name: 'teacher_name'
                },
                {
                    data: 'grade_level',
                    name: 'grade_level'
                },
                {
                    data: 'school_year',
                    name: 'school_year'
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
        $('#msgAlert-icon').addClass('bx bx-error-circle text-danger')
    }

    for (let i = 1900; i < 2050; i++) {
        $('#select-school-year').append('<option value="' + i + '-' + (i + 1) + '">' + i + '-' + (i + 1) + '</option>')
        $('#e-select-school-year').append('<option value="' + i + '-' + (i + 1) + '">' + i + '-' + (i + 1) + '</option>')
    }

    $('#select-teacher-id')
        .editableSelect({
            effects: 'slide'
        })
        .on('select.editable-select', function(e, li) {
            $('#teacher-id').val(li.attr('value'))
        })


    $('#classForm').on('submit', function(e) {
        e.preventDefault()

        $.ajax({
            url: "{{ route('class.store') }}",
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: () => {
                $("#classForm :input").each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $("#classForm :input").prop("disabled", true)
            },
            success: (data) => {
                $("#classForm :input").prop("disabled", false)

                if (data.status === 0) {
                    $.each(data.error, function(prefix, val) {

                        $('.error_' + prefix).text(val[0]);

                        $("input[name=" + prefix + "]").addClass('is-invalid')
                    })
                }

                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#classForm')[0].reset()
                    $('#addClassModal').modal('hide')
                    loadData()
                }

                if (data.status === 500) {
                    showErrorAlert(data.msg)
                }
            },
            error: (err) => {
                $("#classForm :input").prop("disabled", false)
                showErrorAlert('Connection to server error')
            }
        })
    })

    $('#table-section').on('click', 'td .btn-edit', function() {

        $('#e-section').val($(this)[0].dataset.section)
        $('#e-teacher-default').val($(this)[0].dataset.teacherid)
        $('#e-teacher-default').text($(this)[0].dataset.teachername)

        $('#e-grade-default').val($(this)[0].dataset.gradelevel)
        $('#e-grade-default').text($(this)[0].dataset.gradelevel)

        $('#e-school-year-default').val($(this)[0].dataset.sy)
        $('#e-school-year-default').text($(this)[0].dataset.sy)

        $('#btn-submit').attr('data-id', $(this)[0].dataset.id)
        $('#editClassModal').modal('show')
    })

    $('#table-section').on('click', 'td .btn-delete', function() {

        $('#data-section').text($(this)[0].dataset.section)
        $('#dialog-btn-confirm').attr('data-id', $(this)[0].dataset.id)
        $('#dialog').modal('show')
    })

    $('#editclassForm').on('submit', function(e) {
        e.preventDefault()

        var route = "{{ route('class.update',':id') }}"
        $.ajax({
            url: route.replace(':id', $('#btn-submit')[0].dataset.id),
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: () => {
                $("#editclassForm :input").each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $("#editclassForm :input").prop("disabled", true)
            },
            success: (data) => {
                $("#editclassForm :input").prop("disabled", false)

                if (data.status === 0) {
                    $.each(data.error, function(prefix, val) {

                        $('.error_' + prefix).text(val[0]);

                        $("input[name=" + prefix + "]").addClass('is-invalid')
                    })
                }

                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#editclassForm')[0].reset()
                    $('#editClassModal').modal('hide')
                    loadData()
                }

                if (data.status === 500) {
                    showErrorAlert(data.msg)
                }
            },
            error: (err) => {
                $("#editclassForm :input").prop("disabled", false)
                showErrorAlert('Connection to server error')
            }
        })
    })

    $('#dialog-btn-confirm').click(function() {

        let route = "{{ route('class.destroy',':id') }}"
        $.ajax({
            url: route.replace(':id', $(this)[0].dataset.id),
            type: 'get',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: () => {

            },
            success: (data) => {
                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#dialog').modal('hide')
                    loadData()
                }
            },
            error: (err) => {
                $("#classForm :input").prop("disabled", false)
                showErrorAlert('Connection to server error')
            }
        })
    })
</script>
@endsection