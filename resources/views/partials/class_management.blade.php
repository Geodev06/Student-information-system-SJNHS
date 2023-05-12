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
                        <th>Section</th>
                        <th>Adviser</th>
                        <th>Grade level</th>
                        <th>School year</th>
                        <th>Using default</th>
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
                                <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="x" name="section" />
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
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>
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

                        <div class="col-lg-12 bg-dark p-2">
                            <div class="form-check mx-2 form-switch">
                                <input type="checkbox" class="form-check-input" id="useDefault" role="switch">
                                <input type="hidden" name="default" id="default" value="0">
                                <label for="useDefault" class="form-check-label text-white" style="font-size: 12px;">(this section uses default subjects)</label>
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
                                <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="x" name="e_section" id="e-section" />
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
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>
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

<!-- add subjects modal -->
<div class="modal fade" id="addSubjectModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="x" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h4 class="">Add subject</h4>

                <form id="subjForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="section_id" id="subj-section-id">
                        <div id="actions">
                            <div class="mb-2">

                                <button id="deleteAllSubject" class="btn btn-danger text-white btn-sm">Delete all</button>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <div class="form-floating">
                                    <select name="subject_code" class="form-control">
                                        <option value="">Choose one</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{$subject->code}}" class="text-uppercase">{{ $subject->code .'-'.$subject->description }}</option>
                                        @endforeach
                                    </select>
                                    <label for="">Subject</label>
                                    <span class="error_subject_code text-danger error-text"></span>
                                </div>

                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex float-end">
                                    <button type="submit" class="btn btn-primary btn-sm m-2"> <i class="bx bx-save"></i> Add</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 mb-3">
                        <table class="display nowrap w-100 table-striped" id="table-section-subjects">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <button type="button" class="btn btn-danger btn-sm m-2" onclick="$('#addSubjectModal').modal('hide')">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- add subjects modal -->
<div class="modal fade" id="addStudentModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="x" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-5">
                <h4 class="">Add Students</h4>
                <div class="mb-2">
                    <button id="deleteAllStudent" class="btn btn-danger text-white btn-sm">Delete all</button>
                </div>
                <form id="studentForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="lrn" id="student-lrn">
                        <input type="hidden" name="section_id" id="student-section-id">

                        <div class="col-lg-12 mb-2">
                            <div class="form-floating mb-3">
                                <select name="student_lrn" class="form-control" id="select-student">
                                    <option value="">Choose one</option>
                                    @foreach($students as $student)
                                    <option value="{{$student->lrn}}" class="text-uppercase">{{$student->lrn .'-'. $student->lastname .', '.$student->firstname  }} {{ $student[0]->middlename ?? '' }}</option>
                                    @endforeach
                                </select>
                                <label for="">Student LRN - Name</label>
                                <span class="error_lrn text-danger error-text"></span>
                            </div>

                        </div>

                        <div class="col-lg-12 mb-3">
                            <table class="display nowrap w-100 table-striped" id="table-section-students">
                                <thead>
                                    <tr>
                                        <th>LRN</th>
                                        <th>Lastname</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex float-end">
                        <button type="submit" class="btn btn-primary btn-sm m-2"> <i class="bx bx-save"></i> Add</button>
                        <button type="button" class="btn btn-default btn-sm m-2" onclick="$('#addStudentModal').modal('hide')">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<x-message-alert />

<script src="{{ asset('./js/partials/settings.js')}}"></script>

<script>
    $('#useDefault').click(function() {
        if ($(this).prop('checked')) {
            $('#default').val(1)
        } else {
            $('#default').val(0)
        }
    })


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

    function loadData() {
        var table = $('#table-section').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            filter: true,
            ajax: "{{ route('class.get') }}",
            columns: [{
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
                    data: 'using_default',
                    name: 'using_default'
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

    var table = $('#table-section-subjects').DataTable({

        'lengthMenu': [
            [5, 10, 15, 20, 50, -1],
            [5, 10, 15, 20, 50, 'All'],
        ]
    })

    var table_students = $('#table-section-students').DataTable({

        'lengthMenu': [
            [5, 10, 15, 20, 50, -1],
            [5, 10, 15, 20, 50, 'All'],
        ]
    })

    function loadSectionSubject(section_id) {

        let route = "{{ route('class.subject.get',':id') }}"
        $.ajax({
            url: route.replace(':id', section_id),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('.btn-remove-subject').css('display', 'none')
            },
            success: function(data) {
                $('.btn-remove-subject').css('display', 'block')
                if (data.status === 200) {
                    table.clear().draw()
                    for (let i = 0; i < data.subject.length; i++) {
                        var btn = data.subject[i].default === 1 ? '' : '<span data-id="' + data.subject[i].id + '" class="btn-remove-subject btn btn-sm btn-danger">remove</span>'
                        table.row.add([data.subject[i].subject_code, data.subject[i].subject, btn]).draw()
                    }
                }

                if (table.row().length > 0) {
                    $('#deleteAllSubject').removeAttr('disabled')
                } else {
                    $('#deleteAllSubject').attr('disabled', 'disabled')
                }
            },
            error: function() {
                showErrorAlert('Connection to server error.')
            }
        })
    }

    function loadSectionStudent(section_id) {

        let route = "{{ route('class.student.get',':id') }}"
        $.ajax({
            url: route.replace(':id', section_id),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('.btn-remove-student').css('display', 'none')
            },
            success: function(data) {
                $('.btn-remove-student').css('display', 'block')
                if (data.status === 200) {
                    table_students.clear().draw()
                    for (let i = 0; i < data.student.length; i++) {

                        var btn = '<span data-id="' + data.student[i].id + '" class="btn-remove-student btn btn-sm btn-danger">remove</span>'
                        table_students.row.add([data.student[i].lrn, data.student[i].fullname, btn]).draw()
                    }
                }

                if (table_students.row().length > 0) {
                    $('#deleteAllStudent').removeAttr('disabled')
                } else {
                    $('#deleteAllStudent').attr('disabled', 'disabled')
                }
            },
            error: function() {
                showErrorAlert('Connection to server error.')
            }
        })
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


    $('#select-student')
        .editableSelect({
            effects: 'slide'
        })
        .on('select.editable-select', function(e, li) {
            $('#student-lrn').val(li.attr('value'))
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

    $('#table-section').on('click', 'td .btn-add-subject', function() {
        $('#subj-section-id').val($(this)[0].dataset.id)
        loadSectionSubject($(this)[0].dataset.id)

        $('.error_subject_code').text('');

        $("select[name=subject_code]").removeClass('is-invalid')
        if ($(this)[0].dataset.usingdefault == 1) {
            $('#actions').css('display', 'none');
        } else {
            $('#actions').css('display', 'block');
        }
        $('#addSubjectModal').modal('show')
    })

    $('#table-section').on('click', 'td .btn-add-student', function() {
        $('#student-section-id').val($(this)[0].dataset.id)
        loadSectionStudent($(this)[0].dataset.id)

        $('.error_lrn').text('');
        $("#select-student").removeClass('is-invalid')
        $('#addStudentModal').modal('show')
    })

    $('#table-section-subjects').on('click', 'td .btn-remove-subject', function(e) {

        let route = "{{ route('class.subject.destroy',':id') }}"
        e.preventDefault()

        $.ajax({
            url: route.replace(':id', $(this)[0].dataset.id),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            success: function(data) {
                loadSectionSubject($('#subj-section-id').val())
            },
            error: function() {
                showErrorAlert('Connection to server error.')
            }
        })
    })

    $('#subjForm').on('submit', function(e) {
        e.preventDefault()

        $.ajax({
            url: "{{ route('class.subject.store') }}",
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: () => {
                $("#subjForm :input").each(function() {
                    $(this).removeClass('is-invalid')
                })
                $("select[name=subject_code]").removeClass('is-invalid')
                $('.error-text').text('')
                $("#subjForm :input").prop("disabled", true)
            },
            success: (data) => {
                $("#subjForm :input").prop("disabled", false)

                if (data.status === 0) {
                    $.each(data.error, function(prefix, val) {

                        $('.error_' + prefix).text(val[0]);

                        $("select[name=" + prefix + "]").addClass('is-invalid')
                    })
                }

                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#subjForm')[0].reset()
                    loadSectionSubject($('#subj-section-id').val())
                }

                if (data.status === 500) {
                    $('.error_subject_code').text(data.msg);

                    $("select[name=subject_code]").addClass('is-invalid')
                }
            },
            error: (err) => {
                $("#subjForm :input").prop("disabled", false)
                showErrorAlert('Connection to server error')
            }
        })
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

    $('#useDefaultSubject').on('click', function(e) {

        let route = "{{ route('class.usedefault',':id') }}"
        e.preventDefault()
        $.ajax({
            url: route.replace(':id', $('#subj-section-id').val()),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('#useDefaultSubject').attr('disabled', 'disabled')
            },
            success: function(data) {
                $('#useDefaultSubject').removeAttr('disabled')
                if (data.status === 200) {
                    showAlert(data.msg)
                    loadSectionSubject($('#subj-section-id').val())
                }
            },
            error: function() {
                $('#useDefaultSubject').removeAttr('disabled')
                showErrorAlert('Connection to server error.')
            }
        })
    })

    $('#deleteAllSubject').on('click', function() {
        let route = "{{ route('class.subject.destroy.all',':id') }}"
        $.ajax({
            url: route.replace(':id', $('#subj-section-id').val()),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('#deleteAllSubject').attr('disabled', 'disabled')
            },
            success: function(data) {
                $('#deleteAllSubject').removeAttr('disabled')
                if (data.status === 200) {
                    showAlert(data.msg)
                    loadSectionSubject($('#subj-section-id').val())
                }
            },
            error: function() {
                $('#deleteAllSubject').removeAttr('disabled')
                showErrorAlert('Connection to server error.')
            }
        })
    })

    $('#studentForm').on('submit', function(e) {
        e.preventDefault()

        e.preventDefault()

        $.ajax({
            url: "{{ route('class.student.store') }}",
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: () => {
                $("#studentForm :input").each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $("#studentForm :input").prop("disabled", true)
            },
            success: (data) => {
                $("#studentForm :input").prop("disabled", false)

                if (data.status === 0) {
                    $.each(data.error, function(prefix, val) {

                        $('.error_' + prefix).text(val[0]);

                        $("#select-student").addClass('is-invalid')
                    })
                }

                if (data.status === 200) {
                    showAlert(data.msg)
                    $('#studentForm')[0].reset()
                    loadSectionStudent($('#student-section-id').val())
                    $('#student-lrn').val('')
                }

                if (data.status === 500) {
                    $('.error_lrn').text(data.msg);
                    $("#select-student").addClass('is-invalid')
                }
            },
            error: (err) => {
                $("#studentForm :input").prop("disabled", false)
                showErrorAlert('Connection to server error')
            }
        })
    })

    $('#table-section-students').on('click', 'td .btn-remove-student', function(e) {

        let route = "{{ route('class.student.destroy',':id') }}"
        e.preventDefault()

        $.ajax({
            url: route.replace(':id', $(this)[0].dataset.id),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {},
            success: function(data) {
                loadSectionStudent($('#student-section-id').val())
            },
            error: function() {
                showErrorAlert('Connection to server error.')
            }
        })
    })

    $('#deleteAllStudent').on('click', function() {
        let route = "{{ route('class.student.destroy.all',':id') }}"
        $.ajax({
            url: route.replace(':id', $('#student-section-id').val()),
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('#deleteAllStudent').attr('disabled', 'disabled')
            },
            success: function(data) {
                $('#deleteAllStudent').removeAttr('disabled')
                if (data.status === 200) {
                    showAlert(data.msg)
                    loadSectionStudent($('#student-section-id').val())
                }
            },
            error: function() {
                $('#deleteAllStudent').removeAttr('disabled')
                showErrorAlert('Connection to server error.')
            }
        })
    })
</script>
@endsection