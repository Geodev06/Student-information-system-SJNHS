@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('./dataTables/dataTables.bootsrap5.min.css')}}">
<script src="{{ asset('./dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('./dataTables/dataTables.bootstrap5.min.js') }}"></script>

<style>
    #table-students tr th {
        font-size: 12px;
    }
</style>
<link rel="stylesheet" href="{{ asset('./css/table.css')}}">
<div class="p-5">
    <div class="d-flex justify-content-between mb-3">
        <h6 class="fw-bold ">Release form 137</span></h6>
    </div>

    <form id="releaseForm">
        <div class="row align-items-baseline">
            @csrf
            <div class="col-lg-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" autocomplete="off" placeholder="LRN" name="lrn" id="txt_lrn" />
                    <label for="">Student's Learning reference no. (LRN).</label>
                    <span class="error_lrn text-danger error-text"></span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" autocomplete="off" placeholder="LRN" name="school_id" id="txt_school_id" />
                    <label for="">School ID.</label>
                    <span class="error_school_id text-danger error-text"></span>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" style="text-transform: uppercase;" autocomplete="off" placeholder="school" name="name_of_school" id="txt_nos" />
                    <label for="">Name of institution</label>
                    <span class="error_name_of_school text-danger error-text"></span>
                </div>
            </div>


            <div class="col-lg-12 ">
                <button type="submit" class="btn btn-primary btn-sm float-end"><i class="bx bx-download"></i> Download</button>
            </div>
        </div>
    </form>
</div>

<div class="row p-5">
    <h6 class="fw-bold">Releases</h6>
    <table class="table" id="table-students">
        <thead>
            <tr>
                <th>Lrn</th>
                <th>School Id</th>
                <th>Name of institution</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<x-message-alert />

<script>
    function loadData() {
        var table = $('#table-students').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('release.get') }}",
            oLanguage: {
                sSearch: 'Search LRN'
            },
            columns: [{
                    data: 'lrn',
                    name: 'lrn'
                },
                {
                    data: 'school_id',
                    name: 'school_id'
                },
                {
                    data: 'name_of_school',
                    name: 'name_of_school'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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

    $('#releaseForm').on('submit', function(e) {

        e.preventDefault()
        $.ajax({
            url: "{{ route('release.store') }}",
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: () => {

                $('#releaseForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $('#releaseForm :input').prop("disabled", true)
            }
        }).done((data) => {

            $('#releaseForm :input').prop("disabled", false)

            if (data.status === 0) {
                $.each(data.error, function(prefix, val) {

                    $('.error_' + prefix).text(val[0]);

                    $("input[name=" + prefix + "]").addClass('is-invalid')
                })
            }
            if (data.status === -1) {
                $("input[name='lrn']").addClass('is-invalid')
                $('.error_lrn').text(data.error);
            }

            if (data.status === 200) {
                showAlert(data.msg)
                window.open(data.link)
            }

        }).fail((err) => {
            showErrorAlert('Connection to server error.')
        })
    })

    $('#table-release tr').on('click', 'td .btn-v', function() {
        window.open($(this)[0].dataset.link)
    })
</script>
@endsection