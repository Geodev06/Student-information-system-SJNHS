@extends('layouts.dashboard')

@section('content')

<div class="p-5">
    <div class="d-flex justify-content-between">
        <h6 class="fw-bold ">Data management / Edit / <span class="badge bg-info">{{ $student[0]->lrn }}</span></h6>
        <span class="bx bx-arrow-back fs-5 text-primary" style="cursor: pointer;" onclick="history.back()"></span>
    </div>
    <span></span>
</div>
<a href="{{ route('record.show',$student[0]->lrn) }}" class="btn btn-primary text-white btn-sm mb-2" type="button"><i class="bx bxs-file-plus"></i>View Records</a>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-2 card card-body">
            <form action="" id="studentForm">
                <div class="row">
                    @csrf
                    <p style="margin-top: 0; font-size:13px" class="text-muted">Learner's information</p>
                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Given name" name="firstname" value="{{ $student[0]->firstname }}" />
                            <label for="">First name.</label>
                            <span class="error_firstname text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Middle name" name="middlename" value="{{ $student[0]->middlename }}" />
                            <label for="">Middle name (optional).</label>
                            <span class="error_middlename text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Sur name" name="lastname" value="{{ $student[0]->lastname }}" />
                            <label for="">Last name.</label>
                            <span class="error_lastname text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Sur name" name="name_ext" value="{{ $student[0]->name_ext }}" />
                            <label for="">Ext.(opt) ex. Jr II III.</label>
                            <span class="error_name_ext text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" autocomplete="off" name="birthdate" value="{{  date('Y-m-d', strtotime($student[0]->birthdate)) }}" />
                            <label for="">Birthdate.</label>
                            <span class="error_birthdate text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-floating mb-3 d-flex align-items-center justify-content-around">
                            <div class="form-check">
                                <input type="radio" name="sex" value="0" class="form-check-input" id="radioMale" @if($student[0]->sex === 0 ) checked @endif />
                                <label for="radio" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="sex" value="1" class="form-check-input" id="radioFemale" @if($student[0]->sex === 1 ) checked @endif >
                                <label for="radio" class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" autocomplete="off" name="lrn" placeholder="Learning reference number. (12 - digits)" value="{{ $student[0]->lrn }}" />
                            <label for="">Learning reference number. (12 - digits).</label>
                            <span class="error_lrn text-danger error-text"></span>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" name="elem_school" placeholder="Graduated elementary school" value="{{ $student[0]->elem_school }}" />
                            <label for="">Name of school (elementary).</label>
                            <span class="error_elem_school text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" name="elem_school_citation" placeholder="Graduated elementary school" value="{{ $student[0]->elem_school_citation }}" />
                            <label for="">Citations (if Any).</label>
                            <span class="error_elem_school_citation text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" name="elem_school_id" placeholder="Graduated elementary school" value="{{ $student[0]->elem_school_id }}" />
                            <label for="">School Id (elementary).</label>
                            <span class="error_elem_school_id text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" name="elem_school_address" placeholder="Graduated elementary school" value="{{ $student[0]->elem_school_address }}" />
                            <label for="">School address (elementary).</label>
                            <span class="error_elem_school_address text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" name="gen_ave" placeholder="Gen ave." value="{{ $student[0]->gen_ave }}" />
                            <label for="">General average.</label>
                            <span class="error_gen_ave text-danger error-text"></span>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="d-flex float-end">

                            <button type="submit" class="btn btn-primary btn-sm m-2"> <i class="bx bx-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12 card card-body mb-5">
            <p style="margin-top: 0; font-size:13px" class="text-muted">Oher information</p>
            <form action="" id="otherInfoForm">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="PEPT rating" name="pept_rating" value="{{ $student[0]->otherinfo->pept_rating ?? '' }}" />
                            <label for="">PEPT Rating.</label>
                            <span class="error_pept_rating text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" autocomplete="off" name="pept_date_assesstment" value="{{ $student[0]->otherinfo->pept_date_assestment ?? '' }}" />
                            <label for="">PEPT date assesment.</label>
                            <span class="error_pept_date_assesstment text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Als rating" name="als_rating" value="{{ $student[0]->otherinfo->als_rating ?? '' }}" />
                            <label for="">AlS A/E Rating.</label>
                            <span class="error_als text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Given" name="als_name_address" value="{{ $student[0]->otherinfo->als_name_address ?? '' }}" />
                            <label for="">ALS Center name/address Rating.</label>
                            <span class="error_als_name_address text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" autocomplete="off" name="others" placeholder="Others." value="{{ $student[0]->otherinfo->others ?? ''}}" />
                            <label for="">Others.</label>
                            <span class="error_others text-danger error-text"></span>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="d-flex float-end">

                            <button type="submit" class="btn btn-primary btn-sm m-2"> <i class="bx bx-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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

    $('#studentForm').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            url: "{{ route('studentinfo.update',$student[0]->id) }}",
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: () => {

                $('#studentForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $('#studentForm :input').prop("disabled", true)
            }
        }).done((data) => {

            $('#studentForm :input').prop("disabled", false)

            if (data.status === 0) {
                $.each(data.error, function(prefix, val) {

                    $('.error_' + prefix).text(val[0]);

                    $("input[name=" + prefix + "]").addClass('is-invalid')
                })
            }

            if (data.status === 200) {

                $('#addStudentModal').modal('hide')
                showAlert(data.msg)

                var route = "{{ route('student.edit',':lrn') }}"

                window.location.href = route.replace(':lrn', $('input[name="lrn"]').val())

            }
            if (data.status === 500) {
                $('.error_lrn').text('LRN is already existing.');

                $("input[name='lrn']").addClass('is-invalid')

            }

        }).fail((err) => {
            showErrorAlert('Connection to server error.')
        })
    })

    $('#otherInfoForm').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            url: "{{ route('otherinfo.store',$student[0]->lrn) }}",
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: () => {

                $('#otherInfoForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $('#otherInfoForm :input').prop("disabled", true)
            }
        }).done((data) => {

            $('#otherInfoForm :input').prop("disabled", false)

            if (data.status === 200) {

                $('#addStudentModal').modal('hide')
                showAlert(data.msg)
            }

        }).fail((err) => {

            showErrorAlert('Connection to server error.')
        })
    })
</script>
@endsection