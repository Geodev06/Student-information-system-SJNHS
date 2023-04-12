@extends('layouts.dashboard')

@section('content')
<style>
    .table tbody tr td,
    .table thead tr th {

        border: 1px solid rgba(90, 90, 90, .30);
    }
</style>
<div class="p-5">
    <div class="d-flex justify-content-between">
        <h6 class="fw-bold ">Data management / Student record / <span class="badge bg-info text-white">{{ $student[0]->lrn }}</span></h6>
        <span class="bx bx-arrow-back fs-5 text-primary" style="cursor: pointer;" onclick="history.back()"></span>
    </div>
    <button class="btn btn-success text-white w-auto btn-sm" id="btn-add-record"> <span class="bx bx-plus"></span> Add academic record</button>
</div>
<div class="container">
    <div class="row" id="academic-content">

    </div>
</div>

<!-- modal -->
<div class="modal fade" id="addRecordModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addRecord" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p2">
                <div class="d-flex justify-content-between">
                    <h4 class="">Add Student Record </h4>
                    <div class="d-flex flex-column mb-3 bg-light p-2">
                        <h6 class="text-uppercase fw-bold">{{ $student[0]->lrn }}</h6>
                        <h6 class="text-uppercase text-muted" style="font-size: 10px;">{{ $student[0]->lastname . ' '. $student[0]->firstname}}</h6>
                    </div>
                </div>
                <form id="recordForm">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                @csrf
                                <input type="hidden" name="lrn" value="{{$student[0]->lrn}}">
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="School" name="school" value="{{ $student[0]->student_record()->school ?? '' }}" />
                                        <label for="">School name</label>
                                        <span class="error_school text-danger error-text"></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="School id" name="school_id" value="{{ $student[0]->student_record()->school_id ?? '' }}" />
                                        <label for="">School id</label>
                                        <span class="error_school_id text-danger error-text"></span>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="District" name="district" value="{{ $student[0]->student_record()->school_district ?? '' }}" />
                                        <label for="">District</label>
                                        <span class="error_district text-danger error-text"></span>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="Division" name="division" value="{{ $student[0]->student_record()->division ?? '' }}" />
                                        <label for="">Division</label>
                                        <span class="error_division text-danger error-text"></span>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="Region" name="region" value="{{ $student[0]->student_record()->region ?? '' }}" />
                                        <label for="">Region</label>
                                        <span class="error_region text-danger error-text"></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <select name="classified_grade" id="grade-level" class="form-select" form="recordForm">
                                            <option value="">Choose one</option>
                                            <option value="7">Grade 7</option>
                                            <option value="8">Grade 8</option>
                                            <option value="9">Grade 9</option>
                                            <option value="10">Grade 10</option>
                                            <option value="11">Grade 11</option>
                                            <option value="12">Grade 12</option>

                                        </select>
                                        <label for="select">Classified as grade</label>
                                        <span class="error_classified_grade text-danger error-text"></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="Section" name="section" value="{{ $student[0]->student_record()->section ?? '' }}" />
                                        <label for="">Section</label>
                                        <span class="error_section text-danger error-text"></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <select name="school_year" id="school-year" class="form-select">
                                            <option value="">Choose school year</option>
                                        </select>
                                        <label for="select">Schoo year</label>
                                        <span class="error_school_year text-danger error-text"></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="Adviser" name="adviser" value="{{ $student[0]->student_record()->adviser ?? '' }}" />
                                        <label for="">Adviser/Teacher name</label>
                                        <span class="error_adviser text-danger error-text"></span>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-lg-12">
                                    <div class="d-flex align-items-baseline bg-light p-2">
                                        <button class="btn btn-primary mb-2 btn-sm" type="button" id="btn-add-row"><i class="bx bx-plus-circle"></i> Add row</button>
                                        <div class="form-check mx-2 form-switch">
                                            <input type="checkbox" class="form-check-input" id="useDefault" role="switch">
                                            <label for="useDefault" class="form-check-label" style="font-size: 12px;">(use default subjects)</label>
                                        </div>
                                    </div>
                                    <p class="text-danger f-12" id="grade_error"></p>
                                    <table class="table" id="table-record">
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


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-danger mb-2 btn-sm" type="button" id="btn-add-row-remedial"><i class="bx bx-plus-circle"></i> Add row</button>
                                    <p>Remediation classes</p>
                                    <div class="row ">
                                        <div class="col-lg-3">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" autocomplete="off" name="remedial_date_from" />
                                                <label for="">Conducted from.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" autocomplete="off" name="remedial_date_to" />
                                                <label for="">To.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" id="table-remedial">
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm float-end" id="btn-save-record" disabled><i class="bx bx-save"></i>Save</button>
                    <button type="button" class="btn btn-sm btn-danger float-end mx-2" onclick="$('#addRecordModal').modal('hide')">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

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


    for (let i = 1900; i < 2050; i++) {
        $('#school-year').append('<option value="' + i + '-' + (i + 1) + '">' + i + '-' + (i + 1) + '</option>')
    }

    function loadAcademicRecords() {

        $.ajax({
            url: "{{ route('academic_record.show', $student[0]->lrn) }}",
            type: 'get',
            dataType: 'json',
            beforeSend: () => {
                $('#academic-content').html('')
            },
            success: (data) => {
                $('#academic-content').html(data)
            },
            error: (err) => {

            }
        });
    }

    $('#recordForm').on('submit', function(e) {
        e.preventDefault()

        $.ajax({
            url: "{{ route('record.store') }}",
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: () => {

                $('#recordForm :input').each(function() {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $('#grade_error').text('')
                $('#recordForm :input').prop("disabled", true)
            },
            success: (data) => {
                $('#recordForm :input').prop("disabled", false)

                if (data.status === 0) {

                    $.each(data.error, function(prefix, val) {

                        $('.error_' + prefix).text(val[0]);

                        $("input[name=" + prefix + "]").addClass('is-invalid')

                    })
                }

                if (data.status === 500) {
                    $('#grade_error').text(data.error)
                }

                if (data.status === 200) {
                    loadAcademicRecords()
                    $('#recordForm')[0].reset()
                    $('#table-record tbody').html('')
                    $('#table-remedial tbody').html('')
                    $('#addRecordModal').modal('hide')
                    showAlert(data.msg)

                }
            },
            error: (err) => {

            }
        })
    })

    $('#btn-add-record').click(function() {
        $('#addRecordModal').modal('show')
    })

    $('#btn-add-row').click(function() {
        $('#table-record tbody').append(`<tr>
        <td><select name="select[]" id="" class="form-select">
        <option value="">Choose one</option>
        @foreach($subjects as $subject)
        <option value="{{ $subject->description }} ">{{ $subject->description }} </option>
        @endforeach
        </select>
        </td>
        <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
        <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
        <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
        <td><input type="text" class="form-control" name="quarter_4[]"></td>
        <td><span class="badge bg-info text-white text-uppercase" style="font-size:10px">(auto-generated)</span></td>
        <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
        </tr>`)

        if ($('#table-record tbody tr').length > 0) {
            $('#btn-save-record').removeAttr('disabled')
        }

    })
    loadAcademicRecords()
</script>
<script src="{{ asset('./js/partials/studentrecord.js') }}"></script>
@endsection