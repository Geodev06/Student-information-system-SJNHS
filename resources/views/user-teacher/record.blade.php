@extends('layouts.dashboard')

@section('content')

<link rel="stylesheet" href="{{ asset('css/table.css')}}">


<div class="p-5">
    <div class="d-flex justify-content-between mb-3">
        <h6 class="fw-bold ">Student LRN [ <span class="text-muted">{{$student[0]->lrn}}</span> ]</span></h6>
        <span class="bx bx-arrow-back fs-5 text-primary" style="cursor: pointer;" onclick="history.back()"></span>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <div class="d-flex  bg-light p-2 border rounded-2">
                <div class="d-flex flex-column">
                    <span class="fs-5 fw-bold text-primary">{{$student[0]->lastname .','. $student[0]->firstname .' '.$student[0]->middlename}}</span>

                    <span class="fw-bold text-secondary text-uppercase">{{$section[0]->section}}</span>
                    <span class="m-0" style="font-size: 12px;">{{$student[0]->sex === 0? 'Male':'Female'}}</span>
                </div>

                <div class="d-flex flex-column mx-5">

                </div>
            </div>
        </div>
        <form id="gradeForm">
            <div class="col-lg-12 mb-3">

                <div class="card p-3 bg-light">
                    <p class="text-danger f-12" id="grade_error"></p>

                    @csrf
                    <input type="hidden" name="lrn" value="{{$student[0]->lrn}}">

                    <input type="hidden" name="classified_grade" value="{{$section[0]->grade_level}}">
                    <input type="hidden" name="section" value="{{$section[0]->section}}">
                    <input type="hidden" name="section_id" value="{{$section[0]->id}}">
                    <input type="hidden" name="school_year" value="{{$section[0]->school_year}}">
                    <input type="hidden" name="adviser" value="{{$section[0]->teacher_name}}">

                    <table class="table" id="table-student">
                        <thead>
                            <tr>
                                <th rowspan="2" class="w-50">Learning areas</th>
                                <th colspan="4" class="text-center">Quarter rating</th>
                                <th>Final rating</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($existingRecord)> 0)

                            @foreach($existingRecord[0]->data as $data)

                            <!-- has Record -->
                            <tr>
                                @foreach($data as $subject => $quarter)
                                <td><input type="hidden" class="text-uppercase" value="{{$subject}}" name="select[]" />{{$subject}}</td>
                                <td> <input type="text" class="form-control " value="{{ $quarter['quarter_1']}}" name="quarter_1[]" /></td>
                                <td> <input type="text" class="form-control " value="{{ $quarter['quarter_2']}}" name="quarter_2[]" /></td>
                                <td> <input type="text" class="form-control " value="{{ $quarter['quarter_3']}}" name="quarter_3[]" /></td>
                                <td> <input type="text" class="form-control " value="{{ $quarter['quarter_4']}}" name="quarter_4[]" /></td>
                                <td> <span class="fw-bold text-muted">{{$quarter['final']}}</span></td>
                                @endforeach

                            </tr>

                            @endforeach
                            <tr>
                                <td>General average : <span class="fw-bold text-success">{{$existingRecord[0]->gen_ave}}</span></td>
                            </tr>
                            @else

                            @foreach($subjects as $subject)
                            <tr>
                                <td><input type="hidden" name="select[]" value="{{$subject->subject}}"> {{$subject->subject}}</td>
                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                <td><input type="text" class="form-control" name="quarter_4[]"></td>
                                <td><span class="badge bg-info text-white text-uppercase" style="font-size:10px">(auto-generated)</span></td>
                            </tr>
                            @endforeach

                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card p-3 bg-light">
                    <p class="fw-bold">Remediation classes</p>
                    <button class="btn btn-danger mb-2 btn-sm w-25" type="button" id="btn-add-row-remedial"><i class="bx bx-plus-circle"></i> Add row</button>

                    <div class="row ">
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" autocomplete="off" name="remedial_date_from" value="{{ count($existingRecord)> 0 ? $existingRecord[0]->remedial_date_from : '' }}" />
                                <label for="">Conducted from.</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" autocomplete="off" name="remedial_date_to" value="{{ count($existingRecord)> 0 ? $existingRecord[0]->remedial_date_to : '' }}" />
                                <label for="">To.</label>
                            </div>
                        </div>
                    </div>
                    <table class="table mb-3" id="table-remedial">
                        <thead>
                            <tr>
                                <th class="w-25"><span style="font-size:12px ;">Remedial classes</span><br><span>(Learning Areas)</span></th>
                                <th>Final rating</th>
                                <th>Remedial class mark</th>
                                <th>Recomputed final grade</th>
                                <th class="w-25">Remarks</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($existingRecord)> 0)

                            <!-- has Record and Remedials -->
                            @foreach($existingRecord[0]->remedials as $remedials)

                            <tr class="f-12">
                                <td><input type="text" class="form-control text-uppercase" name="remedials[]" value="{{$remedials['remedials']}}" /></td>
                                <td><input type="text" class="form-control text-uppercase" name="remedials_rating[]" value="{{$remedials['remedials_rating']}}" /></td>
                                <td><input type="text" class="form-control text-uppercase" name="remedials_class_mark[]" value="{{$remedials['remedial_class_mark']}}" /></td>
                                <td><input type="text" class="form-control text-uppercase" name="remedials_final_grades[]" value="{{$remedials['remedials_final_grade']}}" /></td>
                                <td><input type="text" class="form-control text-uppercase" name="remedials_remarks[]" value="{{$remedials['remedials_remarks']}}" /></td>
                                <td> <i class="bx bx-x-circle text-danger btn-remove-row-remedial" style="cursor:pointer"></i></td>
                            </tr>


                            @endforeach

                            @else

                            <!-- no Remedial classes -->

                            @endif
                        </tbody>
                    </table>
                    <button class="float-end btn btn-primary mb-3"><i class="bx bx-save"></i>Save</button>
                </div>

            </div>
        </form>
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

    $('#gradeForm').on('submit', function(e) {

        e.preventDefault()
        $.ajax({
            url: "{{ route('teacher.record.store') }}",
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: () => {

                $('#gradeForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $('#grade_error').text('')
                $('#gradeForm :input').prop("disabled", true)
            },
            success: (data) => {
                $('#gradeForm :input').prop("disabled", false)

                if (data.status === 0) {

                    $.each(data.error, function(prefix, val) {

                        $('.error_' + prefix).text(val[0]);

                        $("input[name=" + prefix + "]").addClass('is-invalid')

                    })
                }

                if (data.status === 500) {
                    $('#gradeForm :input').prop("disabled", false)
                    $('#grade_error').text(data.error)
                }

                if (data.status === 200) {

                    showAlert(data.msg)

                }
            },
            error: (err) => {
                $('#gradeForm :input').prop("disabled", false)
            }
        })
    })

    $('#btn-add-row-remedial').click(function() {
        $('#table-remedial tbody').append(`
        <tr>
            <td><input type="text" class="form-control text-uppercase" name="remedials[]"></td>
            <td><input type="text" class="form-control text-uppercase" name="remedials_rating[]"></td>
            <td><input type="text" class="form-control text-uppercase" name="remedials_class_mark[]"></td>
            <td><input type="text" class="form-control text-uppercase" name="remedials_final_grades[]"></td>
            <td><input type="text" class="form-control text-uppercase" name="remedials_remarks[]"></td>
            <td><i class="bx bx-x-circle text-danger btn-remove-row-remedial" style="cursor:pointer"></i></td>
        </tr>`)
    })

    $('#table-remedial').on('click', '.btn-remove-row-remedial', function(e) {
        $(this).closest('tr').remove()

    })
</script>
@endsection