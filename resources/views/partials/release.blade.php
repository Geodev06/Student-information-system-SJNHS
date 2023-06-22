@extends('layouts.dashboard')

@section('content')

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
                    <input type="text" class="form-control" autocomplete="off" placeholder="school" name="name_of_school" id="txt_nos" />
                    <label for="">Name of institution</label>
                    <span class="error_name_of_school text-danger error-text"></span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-floating mb-3">
                    <select name="type" id="level" class="form-select">
                        <option value="jhs">Junior high</option>
                        <option value="shs">Senior high</option>
                    </select>
                    <label for="select">Level category</label>
                </div>
            </div>

            <div class="col-lg-6 ">
                <button type="submit" class="btn btn-primary btn-sm float-end"><i class="bx bx-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>

<div class="row p-5">
    <h6 class="fw-bold">Releases</h6>
    <table class="table" id="table-release">
        <thead style="font-size: 12px;">
            <tr>
                <th style="font-weight:100;">Details</th>
                <th style="font-weight:100;">Date</th>

            </tr>
        </thead>
        <tbody>
            @foreach($releases as $release)
            <tr>
                <td>
                    <div class="d-flex flex-column">
                        <span class="fw-bold">LRN - [{{ $release->lrn}}]</span>
                        <span class="text-muted" style="font-size: 12px;">{{ $release->name_of_school}}</span>
                    </div>
                </td>
                <td>
                    <span class="fw-bold" style="font-size: 12px;"> {{ $release->created_at->format('m-d-Y')}}</span>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<x-message-alert />

<script>
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