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
            <div class="d-flex  justify-content-between align-items-center bg-light p-2 border rounded-2">
                <div class="d-flex flex-column">
                    <span class="fs-5 fw-bold text-primary">{{$student[0]->lastname .','. $student[0]->firstname .' '.$student[0]->middlename}}</span>
                    <span class="fw-bold text-secondary text-uppercase">{{$section[0]->section}}</span>
                    <span class="m-0" style="font-size: 12px;">{{$student[0]->sex === 0? 'Male':'Female'}}</span>
                </div>

                <button id="btn-generate-card" class="btn btn-primary" data-lrn="{{$student[0]->lrn}}" data-sectionid="{{$section[0]->id}}" data-sy="{{$section[0]->school_year}}">
                    <span class="bx bx-file"></span>
                </button>
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
                    <input type="hidden" name="default" value="{{$section[0]->using_default}}">

                    <table class="table" id="table-student">
                        <thead class="bg-dark text-white">
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
                            @if(count($existingRecord) > 0)

                            @if($existingRecord[0]->default == 1)
                            <!-- has Record with default 1-->
                            <tr>
                                <td><input type="hidden" class="" value="Filipino" name="filipino" />Filipino</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[0]['Filipino']['quarter_1'] }}" name="filipino_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[0]['Filipino']['quarter_2'] }}" name="filipino_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[0]['Filipino']['quarter_3'] }}" name="filipino_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[0]['Filipino']['quarter_4'] }}" name="filipino_q4" /></td>
                                <td> <span class="fw-bold text-muted">{{ $existingRecord[0]->data[0]['Filipino']['final'] }}</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="English" name="english" />English</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[1]['English']['quarter_1'] }}" name="english_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[1]['English']['quarter_2'] }}" name="english_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[1]['English']['quarter_3'] }}" name="english_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[1]['English']['quarter_4'] }}" name="english_q4" /></td>
                                <td> <span class="fw-bold text-muted">{{ $existingRecord[0]->data[1]['English']['final'] }}</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Mathematics" name="mathematics" />Mathematics</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[2]['Mathematics']['quarter_1'] }}" name="mathematics_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[2]['Mathematics']['quarter_2'] }}" name="mathematics_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[2]['Mathematics']['quarter_3'] }}" name="mathematics_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[2]['Mathematics']['quarter_4'] }}" name="mathematics_q4" /></td>
                                <td> <span class="fw-bold text-muted">{{ $existingRecord[0]->data[2]['Mathematics']['final'] }}</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Science" name="science" />Science</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[3]['Science']['quarter_1'] }}" name="science_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[3]['Science']['quarter_2'] }}" name="science_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[3]['Science']['quarter_3'] }}" name="science_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[3]['Science']['quarter_4'] }}" name="science_q4" /></td>
                                <td> <span class="fw-bold text-muted">{{ $existingRecord[0]->data[3]['Science']['final'] }}</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Araling Panlipunan (AP)" name="ap" />Science</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[4]['Araling Panlipunan (AP)']['quarter_1'] }}" name="ap_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[4]['Araling Panlipunan (AP)']['quarter_2'] }}" name="ap_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[4]['Araling Panlipunan (AP)']['quarter_3'] }}" name="ap_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[4]['Araling Panlipunan (AP)']['quarter_4'] }}" name="ap_q4" /></td>
                                <td> <span class="fw-bold text-muted">{{ $existingRecord[0]->data[4]['Araling Panlipunan (AP)']['final'] }}</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Edukasyon sa Pagpapakatao (ESP)" name="esp" />Edukasyon sa Pagpapakatao (ESP)</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[5]['Edukasyon sa Pagpapakatao (ESP)']['quarter_1'] }}" name="esp_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[5]['Edukasyon sa Pagpapakatao (ESP)']['quarter_2'] }}" name="esp_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[5]['Edukasyon sa Pagpapakatao (ESP)']['quarter_3'] }}" name="esp_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[5]['Edukasyon sa Pagpapakatao (ESP)']['quarter_4'] }}" name="esp_q4" /></td>
                                <td> <span class="fw-bold text-muted">{{ $existingRecord[0]->data[5]['Edukasyon sa Pagpapakatao (ESP)']['final'] }}</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Technology and Livelihood Education (TLE)" name="tle" />Technology and Livelihood Education (TLE)</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[6]['Technology and Livelihood Education (TLE)']['quarter_1'] }}" name="tle_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[6]['Technology and Livelihood Education (TLE)']['quarter_2'] }}" name="tle_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[6]['Technology and Livelihood Education (TLE)']['quarter_3'] }}" name="tle_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[6]['Technology and Livelihood Education (TLE)']['quarter_4'] }}" name="tle_q4" /></td>
                                <td> <span class="fw-bold text-muted">{{ $existingRecord[0]->data[6]['Technology and Livelihood Education (TLE)']['final'] }}</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Music" name="music" />Music</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[8]['Music']['quarter_1'] }}" name="music_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[8]['Music']['quarter_2'] }}" name="music_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[8]['Music']['quarter_3'] }}" name="music_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[8]['Music']['quarter_4'] }}" name="music_q4" /></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Arts" name="arts" />Arts</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[9]['Arts']['quarter_1'] }}" name="arts_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[9]['Arts']['quarter_2'] }}" name="arts_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[9]['Arts']['quarter_3'] }}" name="arts_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[9]['Arts']['quarter_4'] }}" name="arts_q4" /></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Physical Education" name="pe" />Physical Education</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[10]['Physical Education']['quarter_1'] }}" name="pe_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[10]['Physical Education']['quarter_2'] }}" name="pe_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[10]['Physical Education']['quarter_3'] }}" name="pe_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[10]['Physical Education']['quarter_4'] }}" name="pe_q4" /></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Health" name="health" />Health</td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[11]['Health']['quarter_1'] }}" name="health_q1" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[11]['Health']['quarter_2'] }}" name="health_q2" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[11]['Health']['quarter_3'] }}" name="health_q3" /></td>
                                <td> <input type="number" class="form-control " value="{{  $existingRecord[0]->data[11]['Health']['quarter_4'] }}" name="health_q4" /></td>
                            </tr>

                            <tr>
                                <td>General average : <span class="fw-bold text-success">{{$existingRecord[0]->gen_ave}}</span></td>
                            </tr>
                            @else


                            @foreach($existingRecord[0]->data as $data)

                            <!-- has Record with default 0-->
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

                            @endif

                            <!-- record not existing -->
                            @else

                            @if($section[0]->using_default == 1)

                            <tr>
                                <td><input type="hidden" class="" value="Filipino" name="filipino" />Filipino</td>
                                <td> <input type="number" class="form-control " value="" name="filipino_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="filipino_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="filipino_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="filipino_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="English" name="english" />English</td>
                                <td> <input type="number" class="form-control " value="" name="english_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="english_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="english_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="english_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Mathematics" name="mathematics" />Mathematics</td>
                                <td> <input type="number" class="form-control " value="" name="mathematics_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="mathematics_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="mathematics_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="mathematics_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="science" name="science" />Science</td>
                                <td> <input type="number" class="form-control " value="" name="science_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="science_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="science_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="science_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Araling Panlipunan (AP)" name="ap" />Araling Panlipunan (AP)</td>
                                <td> <input type="number" class="form-control " value="" name="ap_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="ap_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="ap_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="ap_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Edukasyon sa Pagpapakatao (ESP)" name="esp" />Edukasyon sa Pagpapakatao (ESP)</td>
                                <td> <input type="number" class="form-control " value="" name="esp_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="esp_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="esp_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="esp_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Technology and Livelihood Education (TLE)" name="tle" />Technology and Livelihood Education (TLE)</td>
                                <td> <input type="number" class="form-control " value="" name="tle_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="tle_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="tle_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="tle_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Music" name="music" />Music</td>
                                <td> <input type="number" class="form-control " value="" name="music_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="music_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="music_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="music_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Arts" name="arts" />Arts</td>
                                <td> <input type="number" class="form-control " value="" name="arts_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="arts_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="arts_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="arts_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Physical Education" name="pe" />Physical Education</td>
                                <td> <input type="number" class="form-control " value="" name="pe_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="pe_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="pe_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="pe_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" class="" value="Health" name="health" />Health</td>
                                <td> <input type="number" class="form-control " value="" name="health_q1" /></td>
                                <td> <input type="number" class="form-control " value="" name="health_q2" /></td>
                                <td> <input type="number" class="form-control " value="" name="health_q3" /></td>
                                <td> <input type="number" class="form-control " value="" name="health_q4" /></td>
                                <td> <span class="fw-bold text-muted">(auto)</span></td>
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

                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="card p-3 bg-light">
                    <p class="fw-bold">Attendance</p>

                    <table class=" mb-3" id="">
                        <thead>
                            <tr>
                                <th>Report on attendance</th>
                                <th>Aug</th>
                                <th>Sept</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th>Dec</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>May</th>
                                <th>June</th>
                                <th>July</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($existingRecord) > 0)

                            <tr>
                                <td style="font-size: 10px;">No. of school days</td>
                                <td><input type="number" name="aug_sd" class="form-control" value="{{$existingRecord[0]->attendance[0]['august']['aug_sd'] ?? '' }}" style="font-size: 12px;"></td>
                                <td><input type="number" name="sep_sd" class="form-control" value="{{$existingRecord[0]->attendance[1]['september']['sep_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="oct_sd" class="form-control" value="{{$existingRecord[0]->attendance[2]['october']['oct_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="nov_sd" class="form-control" value="{{$existingRecord[0]->attendance[3]['november']['nov_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="dec_sd" class="form-control" value="{{$existingRecord[0]->attendance[4]['december']['dec_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="jan_sd" class="form-control" value="{{$existingRecord[0]->attendance[5]['january']['jan_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="feb_sd" class="form-control" value="{{$existingRecord[0]->attendance[6]['february']['feb_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="mar_sd" class="form-control" value="{{$existingRecord[0]->attendance[7]['march']['mar_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="apr_sd" class="form-control" value="{{$existingRecord[0]->attendance[8]['april']['apr_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="may_sd" class="form-control" value="{{$existingRecord[0]->attendance[9]['may']['may_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="jun_sd" class="form-control" value="{{$existingRecord[0]->attendance[10]['june']['jun_sd']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="jul_sd" class="form-control" value="{{$existingRecord[0]->attendance[11]['july']['jul_sd']?? ''}}" style="font-size: 12px;"></td>
                            </tr>

                            <tr>
                                <td style="font-size: 10px;">No. of school days</td>
                                <td><input type="number" name="aug_pr" class="form-control" value="{{$existingRecord[0]->attendance[0]['august']['aug_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="sep_pr" class="form-control" value="{{$existingRecord[0]->attendance[1]['september']['sep_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="oct_pr" class="form-control" value="{{$existingRecord[0]->attendance[2]['october']['oct_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="nov_pr" class="form-control" value="{{$existingRecord[0]->attendance[3]['november']['nov_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="dec_pr" class="form-control" value="{{$existingRecord[0]->attendance[4]['december']['dec_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="jan_pr" class="form-control" value="{{$existingRecord[0]->attendance[5]['january']['jan_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="feb_pr" class="form-control" value="{{$existingRecord[0]->attendance[6]['february']['feb_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="mar_pr" class="form-control" value="{{$existingRecord[0]->attendance[7]['march']['mar_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="apr_pr" class="form-control" value="{{$existingRecord[0]->attendance[8]['april']['apr_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="may_pr" class="form-control" value="{{$existingRecord[0]->attendance[9]['may']['may_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="jun_pr" class="form-control" value="{{$existingRecord[0]->attendance[10]['june']['jun_pr']?? ''}}" style="font-size: 12px;"></td>
                                <td><input type="number" name="jul_pr" class="form-control" value="{{$existingRecord[0]->attendance[11]['july']['jul_pr']?? ''}}" style="font-size: 12px;"></td>
                            </tr>

                            @else
                            <!-- no Record -->
                            <tr>
                                <td style="font-size: 10px;">No. of school days</td>
                                <td><input type="number" name="aug_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="sep_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="oct_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="nov_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="dec_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="jan_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="feb_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="mar_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="apr_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="may_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="jun_sd" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="jul_sd" class="form-control" style="font-size: 12px;"></td>
                            </tr>

                            <tr>
                                <td style="font-size: 10px;">No. of days present</td>
                                <td><input type="number" name="aug_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="sep_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="oct_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="nov_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="dec_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="jan_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="feb_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="mar_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="apr_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="may_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="jun_pr" class="form-control" style="font-size: 12px;"></td>
                                <td><input type="number" name="jul_pr" class="form-control" style="font-size: 12px;"></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <div class="card p-3 bg-light">
                    <p class="fw-bold">Observed Values</p>

                    <div class="d-flex justify-content-between p-2 bg-primary text-white">
                        <p class="fw-bold">AO - <span class="fw-light" style="font-size: 12px;"> always observed</span></p>
                        <p class="fw-bold">SO - <span class="fw-light" style="font-size: 12px;"> sometimes observed</span></p>
                        <p class="fw-bold">RO - <span class="fw-light" style="font-size: 12px;"> rarely observed</span></p>
                        <p class="fw-bold">NO - <span class="fw-light" style="font-size: 12px;"> not observed</span></p>
                    </div>
                    <table class="table mb-3" id="">
                        <thead>
                            <tr>
                                <th>Core Values</th>
                                <th>Behavior Statements</th>
                                <th colspan="4">Quarter</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px;">

                            <tr>
                                <td></td>
                                <td></td>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                @if(count($decoded_values) > 0)


                            </tr>
                            <tr>
                                <td class="fw-bold" rowspan="2">Maka-Diyos</td>
                                <td style="font-size: 12px;">Expresses one's spiritual beliefs while repecting spiritual beliefs of others
                                    <br>Show adherence to ethical principles by upholding truth
                                </td>
                                <td>
                                    <select name="mk_d1" class="form-select">
                                        <option value="{{$decoded_values[0]->makadiyos->q1}}">{{$decoded_values[0]->makadiyos->q1}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d2" class="form-select">
                                        <option value="{{$decoded_values[0]->makadiyos->q2}}">{{$decoded_values[0]->makadiyos->q2}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d3" class="form-select">
                                        <option value="{{$decoded_values[0]->makadiyos->q3}}">{{$decoded_values[0]->makadiyos->q3}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d4" class="form-select">
                                        <option value="{{$decoded_values[0]->makadiyos->q4}}">{{$decoded_values[0]->makadiyos->q4}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>

                                <td style="font-size: 12px;">Show adherence to ethical principles by upholding truth
                                </td>
                                <td>
                                    <select name="mk_d12" class="form-select">
                                        <option value="{{$decoded_values[1]->makadiyos_2->q1}}">{{$decoded_values[1]->makadiyos_2->q1}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d22" class="form-select">
                                        <option value="{{$decoded_values[1]->makadiyos_2->q2}}">{{$decoded_values[1]->makadiyos_2->q2}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d32" class="form-select">
                                        <option value="{{$decoded_values[1]->makadiyos_2->q3}}">{{$decoded_values[1]->makadiyos_2->q3}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d42" class="form-select">
                                        <option value="{{$decoded_values[1]->makadiyos_2->q4}}">{{$decoded_values[1]->makadiyos_2->q4}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td class="fw-bold" rowspan="2">Makatao</td>
                                <td style="font-size: 12px;">
                                    Is sensitive to individual, social and cultural differences

                                </td>
                                <td>
                                    <select name="mk_t1" class="form-select">
                                        <option value="{{$decoded_values[2]->makatao->q1}}">{{$decoded_values[2]->makatao->q1}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t2" class="form-select">
                                        <option value="{{$decoded_values[2]->makatao->q2}}">{{$decoded_values[2]->makatao->q2}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t3" class="form-select">
                                        <option value="{{$decoded_values[2]->makatao->q3}}">{{$decoded_values[2]->makatao->q3}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t4" class="form-select">
                                        <option value="{{$decoded_values[2]->makatao->q4}}">{{$decoded_values[2]->makatao->q4}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>

                                <td style="font-size: 12px;">
                                    Demonstrate contributions toward solidarity
                                </td>
                                <td>
                                    <select name="mk_t12" class="form-select">
                                        <option value="{{$decoded_values[3]->makatao_2->q1}}">{{$decoded_values[3]->makatao_2->q1}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t22" class="form-select">
                                        <option value="{{$decoded_values[3]->makatao_2->q2}}">{{$decoded_values[3]->makatao_2->q2}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t32" class="form-select">
                                        <option value="{{$decoded_values[3]->makatao_2->q3}}">{{$decoded_values[3]->makatao_2->q3}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t42" class="form-select">
                                        <option value="{{$decoded_values[3]->makatao_2->q4}}">{{$decoded_values[3]->makatao_2->q4}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>


                            <tr>
                                <td class="fw-bold">Maka-kalikasan</td>
                                <td style="font-size: 12px;">Cares for the enviroment and utilizes resources wisely, judiciously, and economically</td>
                                <td>
                                    <select name="mk_k1" class="form-select">
                                        <option value="{{$decoded_values[4]->makakalikasan->q1}}">{{$decoded_values[4]->makakalikasan->q1}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_k2" class="form-select">
                                        <option value="{{$decoded_values[4]->makakalikasan->q2}}">{{$decoded_values[4]->makakalikasan->q2}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_k3" class="form-select">
                                        <option value="{{$decoded_values[4]->makakalikasan->q3}}">{{$decoded_values[4]->makakalikasan->q3}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_k4" class="form-select">
                                        <option value="{{$decoded_values[4]->makakalikasan->q4}}">{{$decoded_values[4]->makakalikasan->q4}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td class="fw-bold" rowspan="2">Makabansa</td>
                                <td style="font-size: 12px;">Demonstrate pride in being a filipino; execises rights and responsibilities of a filipino citizen
                                </td>
                                <td>
                                    <select name="mk_b1" class="form-select">
                                        <option value="{{$decoded_values[5]->makabansa->q1}}">{{$decoded_values[5]->makabansa->q1}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b2" class="form-select">
                                        <option value="{{$decoded_values[5]->makabansa->q2}}">{{$decoded_values[5]->makabansa->q2}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b3" class="form-select">
                                        <option value="{{$decoded_values[5]->makabansa->q3}}">{{$decoded_values[5]->makabansa->q3}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b4" class="form-select">
                                        <option value="{{$decoded_values[5]->makabansa->q4}}">{{$decoded_values[5]->makabansa->q4}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>


                            <tr>

                                <td style="font-size: 12px;">
                                    Demonstrates appropriate behavior in carrying out activities in school, community and country.
                                </td>
                                <td>
                                    <select name="mk_b12" class="form-select">
                                        <option value="{{$decoded_values[6]->makabansa_2->q1}}">{{$decoded_values[6]->makabansa_2->q1}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b22" class="form-select">
                                        <option value="{{$decoded_values[6]->makabansa_2->q2}}">{{$decoded_values[6]->makabansa_2->q2}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b32" class="form-select">
                                        <option value="{{$decoded_values[6]->makabansa_2->q3}}">{{$decoded_values[6]->makabansa_2->q3}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b42" class="form-select">
                                        <option value="{{$decoded_values[6]->makabansa_2->q4}}">{{$decoded_values[6]->makabansa_2->q4}}</option>
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            @else

                            </tr>
                            <tr>
                                <td class="fw-bold" rowspan="2">Maka-Diyos</td>
                                <td style="font-size: 12px;">Expresses one's spiritual beliefs while repecting spiritual beliefs of others
                                </td>
                                <td>
                                    <select name="mk_d1" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d2" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d3" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d4" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>

                                <td style="font-size: 12px;">
                                    Show adherence to ethical principles by upholding truth
                                </td>
                                <td>
                                    <select name="mk_d12" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d22" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d32" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_d42" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>


                            <tr>
                                <td class="fw-bold" rowspan="2">Makatao</td>
                                <td style="font-size: 12px;">
                                    Is sensitive to individual, social and cultural differences
                                </td>
                                <td>
                                    <select name="mk_t1" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t2" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t3" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t4" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>

                                <td style="font-size: 12px;">
                                    Demonstrate contributions toward solidarity
                                </td>
                                <td>
                                    <select name="mk_t12" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t22" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t32" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_t42" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td class="fw-bold">Maka-kalikasan</td>
                                <td style="font-size: 12px;">Cares for the enviroment and utilizes resources wisely, judiciously, and economically</td>
                                <td>
                                    <select name="mk_k1" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_k2" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_k3" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_k4" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td class="fw-bold" rowspan="2">Makabansa</td>
                                <td style="font-size: 12px;">Demonstrate pride in being a filipino; execises rights and responsibilities of a filipino citizen
                                </td>
                                <td>
                                    <select name="mk_b1" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b2" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b3" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b4" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>

                                <td style="font-size: 12px;">
                                    Demonstrates appropriate behavior in carrying out activities in school, community and country.
                                </td>
                                <td>
                                    <select name="mk_b12" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b22" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b32" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="mk_b42" class="form-select">
                                        <option value="AO">AO</option>
                                        <option value="SO">SO</option>
                                        <option value="RO">RO</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </td>
                            </tr>

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

    $('#btn-generate-card').click(function(e) {
        var lrn = $(this)[0].dataset.lrn
        var section_id = $(this)[0].dataset.sectionid
        var sy = $(this)[0].dataset.sy

        var link = "{{ route('student.card', [':lrn',':sid',':sy']) }}"

        var link_1 = link.replace(':lrn', lrn)
        var link_2 = link_1.replace(':sid', section_id)
        var link_3 = link_2.replace(':sy', sy)
        window.open(link_3)

    })
</script>
@endsection