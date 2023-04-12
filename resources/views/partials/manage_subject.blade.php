@extends('layouts.dashboard')

@section('content')
<!-- datatables -->
<link rel="stylesheet" href="{{ asset('./dataTables/dataTables.bootsrap5.min.css')}}">
<script src="{{ asset('./dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('./dataTables/dataTables.bootstrap5.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('./css/table.css')}}">


<div class="p-5">

    <div class="d-flex justify-content-between">
        <h6 class="fw-bold ">Data management / Subjects</h6>
        <span class="bx bx-arrow-back fs-5 text-primary" style="cursor: pointer;" onclick="history.back()"></span>
    </div>
    <button class="btn btn-primary text-white w-auto btn-sm" id="btn-add-subject"> <span class="bx bx-plus"></span> Add subject</button>
</div>
<div class="container">
    <div class="row">

        <div class="col-lg-12 mb-5">
            <div class="mb-2 d-flex align-items-baseline justify-content-between">
                <h3 class="fw-bold">Subjects</h3>
                <x-loader />
            </div>

            <table class="display nowrap w-100 table-striped " id="table-subjects">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Unit</th>
                        <th>Date created</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="addSubjectModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addSubj" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-5">
                <h4 class="mb-3">Add subject</h4>
                <form action="" id="subjForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control text-uppercase" placeholder="Subject code" autocomplete="off" name="code" />
                                <label for="">Subject code</label>
                                <span class="error_code text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="No. of units" autocomplete="off" name="unit" />
                                <label for="">No. of Units</label>
                                <span class="error_unit text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Subject description" autocomplete="off" name="description" />
                                <label for="">Subject description</label>
                                <span class="error_description text-danger error-text"></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex float-end">
                        <button type="button" class="btn btn-default btn-sm m-2" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm m-2"><i class="bx bx-save"></i> Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
<!-- end modal -->

<!-- Edit modal -->
<div class="modal fade" id="editSubjectModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editSubj" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-5">
                <h4 class="mb-3">Edit subject</h4>
                <form action="" id="editsubjForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control text-uppercase" placeholder="Subject code" autocomplete="off" name="edit_code" id="edit-code" />
                                <label for="">Subject code</label>
                                <span class="error_edit_code text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="No. of units" autocomplete="off" name="edit_unit" id="edit-unit" />
                                <label for="">No. of Units</label>
                                <span class="error_edit_unit text-danger error-text"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Subject description" autocomplete="off" name="edit_description" id="edit-description" />
                                <label for="">Subject description</label>
                                <span class="error_edit_description text-danger error-text"></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex float-end">
                        <button type="button" class="btn btn-default btn-sm m-2" onclick="closeeditModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm m-2"><i class="bx bx-save"></i> Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
<!-- end modal -->

<x-message-alert />

<script>
    var table = $('#table-subjects').DataTable({

        'lengthMenu': [
            [5, 10, 15, 20, 50, -1],
            [5, 10, 15, 20, 50, 'All'],
        ]
    })

    function closeModal() {
        $('#addSubjectModal').modal('hide')
    }

    function closeeditModal() {
        $('#editSubjectModal').modal('hide')
    }

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


    function loadSubjects() {
        $.ajax({
            url: "{{ route('subject.get') }}",
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('#loader').css('display', 'block')
            },
            success: function(data) {
                $('#loader').css('display', 'none')
                table.clear().draw()
                for (let i = 0; i < data.length; i++) {
                    var span = '<div class="d-flex flex-column"><span class="fw-bold">' + data[i].code + '</span><span class="f-12">' + data[i].description + '</span></div>'
                    var btn_action = '<span id="btn-edit" data-id="' + data[i].id + '" data-code="' + data[i].code + '" data-desc="' + data[i].description + '" data-unit="' + data[i].unit + '" class="btn-edit text-success bx bx-edit fs-4"></span> <span data-id="' + data[i].id + '" class="btn-delete bx bx-trash text-danger fs-4"></span>'
                    table.row.add([span, data[i].unit, data[i].date, btn_action]).draw()
                }
            },
            error: function() {
                showErrorAlert('Connection to server error.')
            }
        })
    }


    $(document).ready(function() {


        $('#btn-add-subject').click(() => $('#addSubjectModal').modal('show'))

        $('#subjForm').on('submit', function(e) {

            e.preventDefault()

            $.ajax({
                url: "{{ route('subject.store') }}",
                type: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend: function() {

                    $('#subjForm :input').each(function() {
                        $(this).removeClass('is-invalid')
                    })
                    $('.error-text').text('')

                    $('#subjForm :input').prop("disabled", true)
                },
                success: function(data) {
                    $('#subjForm :input').prop("disabled", false)
                    if (data.status === 0) {
                        $.each(data.error, function(prefix, val) {
                            $('.error_' + prefix).text(val[0]);

                            $("input[name=" + prefix + "]").addClass('is-invalid')
                        })
                    }

                    if (data.status === 200) {
                        showAlert(data.msg)
                        closeModal()
                        $('#subjForm')[0].reset()
                        loadSubjects()
                    }
                },
                error: function() {
                    showErrorAlert('Connection to server error.')
                }
            })
        })

        // delete prompt
        $('#table-subjects tbody').on('click', 'tr .btn-delete', function() {
            $('#msgBox').modal('show')
            $('#msg-box-text').text('Are you sure you want to delete this now?')
            $('#msgBox-delete-subj').css('display', 'block')
            $('#msgBox-delete-subj').attr('data-id', $(this)[0].dataset.id)
            $('#msgBox-btn-confirm').css('display', 'none')
        })

        $('#msgBox-delete-subj').click(function() {

            var route = "{{ route('subject.destroy',':id') }}"

            $.ajax({
                url: route.replace(':id', $(this)[0].dataset.id),
                type: 'get',
                dataType: 'json',
                beforeSend: function() {},
                success: function(data) {
                    if (data.status === 200) {
                        $('#msgBox').modal('hide')
                        showAlert(data.msg)
                        loadSubjects()
                    }
                },
                error: function(err) {
                    showErrorAlert('Connection to server error.')
                }
            })
        })

    })

    function fillupEdit(code, desc, unit) {
        $('#editSubjectModal').modal('show')

        $('#edit-code').val(code)
        $('#edit-description').val(desc)
        $('#edit-unit').val(unit)
    }

    $('#table-subjects tbody').on('click', 'tr .btn-edit', function() {
        fillupEdit($(this)[0].dataset.code, $(this)[0].dataset.desc, $(this)[0].dataset.unit)
        $('#btn-edit').attr('data-id', $(this)[0].dataset.id)
        console.log($('#btn-edit')[0].dataset.id)
    })

    $('#editsubjForm').on('submit', function(e) {
        e.preventDefault()

        var route = "{{ route('subject.update',':id') }}"
        $.ajax({
            url: route.replace(':id', $('#btn-edit')[0].dataset.id),
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function() {

                $('#editsubjForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')

                $('#editsubjForm :input').prop("disabled", true)
            },
            success: function(data) {
                $('#editsubjForm :input').prop("disabled", false)
                if (data.status === 0) {
                    $.each(data.error, function(prefix, val) {
                        $('.error_' + prefix).text(val[0]);

                        $("input[name=" + prefix + "]").addClass('is-invalid')
                    })
                }

                if (data.status === 200) {
                    showAlert(data.msg)
                    closeeditModal()
                    $('#editsubjForm')[0].reset()
                    loadSubjects()
                }

                if (data.status === 500) {
                    $('.error_edit_code').text('code already existing.');
                    $("input[name='edit_code']").addClass('is-invalid')
                }
            },
            error: function() {
                showErrorAlert('Connection to server error.')
            }
        })

    })

    //load table
    loadSubjects()
</script>
@endsection