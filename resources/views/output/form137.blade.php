<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="TOR keeping system">
    <meta name="author" content="Agnote ageo">
    <meta name="generator" content="Bootstrap 0.108.0">
    <title>{{$student[0]->lrn}}</title>
    <link rel="stylesheet" href="{{ asset('./css/Custom.css')}}" />
</head>
<style>
    p {
        margin: 0;
        font-size: 10px;
    }

    .info-header {
        background-color: #b2b266;
        border: 2px solid black;
        font-weight: 500;
    }

    span {
        font-size: 10px;
    }

    .table-data {
        font-family: arial, sans-serif;
        width: 100%;
    }

    .table-data td,
    th {
        border: 1px solid black;
        text-align: left;
        padding: 2px;
        font-weight: bold;
        font-size: 8px;
        height: 13px;
    }

    .table-data,
    th {

        text-align: center;

    }

    .f-12 {
        font-size: 10px;
    }

    .pfooter {

        font-size: 10px;
    }

    .admin_name {
        border-bottom: 1px solid black;
        width: 100%;

    }

    .certification {
        border-left: 2px solid black;
        border-bottom: 2px solid black;
        border-right: 2px solid black;
    }

    .record-header {
        border-left: 1px solid black;
        border-top: 1px solid black;
        border-right: 1px solid black;
    }
</style>

<body>
    <div class="container-fluid" id="body">
        <div class="row">

            <div class="col-lg-8 mx-auto  mb-5">
                <span>SF10-JHS</span>
                <div class="d-flex justify-content-around align-items-center">
                    <img src="{{ asset('./img/logo.png')}}" alt="logo" width="50px" height="50px">
                    <div class="d-flex flex-column align-items-center">
                        <p>Republic of the philippines</p>
                        <p>Department of education</p>
                        <h6 style="font-size: 12px;">Learner Permanent Record for Junior High School(SF10-JHS)</h6>
                        <p style="font-size: 10px; font-style:italic">(Formerly Form 137)</p>
                    </div>
                    <img src="{{ asset('./img/deped.png')}}" alt="logo" width="100px" height="50px">
                </div>
                <div class="text-center info-header">
                    <p class="text-uppercase">LEARNER'S INFORMATION</p>
                </div>
                <div class="d-flex justify-content-between">
                    <span>LASTNAME: <span class="text-decoration-underline">{{$student[0]->lastname}}</span></span>
                    <span>FIRSTNAME: <span class="text-decoration-underline">{{$student[0]->firstname}}</span></span>
                    <span>NAME EXT. (Jr, I, II): <span class="text-decoration-underline">{{$student[0]->name_ext === null ? '_____' : $student[0]->name_ext}}</span></span>
                    <span>MIDDLE NAME: <span class="text-decoration-underline mx-2">{{$student[0]->middlename === null ? '______________' : $student[0]->middlename }}</span></span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Learner Reference Number (LRN): <span class="text-decoration-underline">{{$student[0]->lrn}}</span></span>
                    <span>Birthdate (mm/dd/yyyy): <span class="text-decoration-underline">{{$student[0]->birthdate}}</span></span>
                    <span>Sex: <span class="text-decoration-underline fw-bold mx-2">{{$student[0]->sex === 0 ? 'M': 'F'}}</span></span>

                </div>
                <div class="text-center info-header">
                    <p class="text-uppercase">ELIGIBILITY FOR JHS</p>
                </div>
                <div class="border mt-1">
                    <div class="d-flex justify-content-between mx-2">
                        <span>Elementary school completer</span>
                        <span>General average: <span class="text-decoration-underline">{{$student[0]->gen_ave}}</span></span>
                        <span>Citations (if Any) : <span class="text-decoration-underline">{{$student[0]->citations === null ? '______________' : $student[0]->citations}}</span></span>
                    </div>
                    <div class="d-flex justify-content-between mx-2">
                        <span>Name of Elementary School: <span class="text-decoration-underline">{{$student[0]->elem_school}}</span> </span>
                        <span>School ID: <span class="text-decoration-underline">{{$student[0]->elem_school_id}}</span> </span>
                        <span>Address of School: <span class="text-decoration-underline">{{$student[0]->elem_school_address}}</span> </span>
                    </div>
                </div>
                @if($student[0]->otherinfo != null)
                <div>
                    <span>Other Credential Presented</span>
                    <div class="d-flex justify-content-between mx-2">
                        <span>PEPT PASSER Rating: <span class="text-decoration-underline">{{ $student[0]->otherinfo->pept_rating === null ? '______________' : $student[0]->otherinfo->pept_rating}}</span></span>
                        <span>ALS A/E PASSER Rating: <span class="text-decoration-underline">{{ $student[0]->otherinfo->als_rating === null ? '______________' : $student[0]->otherinfo->als_rating}}</span></span>
                        <span>Other (PLs. specify): <span class="text-decoration-underline">{{ $student[0]->otherinfo->others === null ? '______________' : $student[0]->otherinfo->others}}</span></span>
                    </div>
                    <div class="d-flex justify-content-between mx-2">
                        <span>Date of Examination/Assessment (mm/dd/yyyy): <span class="text-decoration-underline">{{ $student[0]->otherinfo->pept_date_assestment === '' ? '______________' : $student[0]->otherinfo->pept_date_assestment }}</span></span>
                        <span>Name and Address of Testing Center: <span class="text-decoration-underline">{{ $student[0]->otherinfo->als_name_address === '' ? '______________' : $student[0]->otherinfo->als_name_address }}</span></span>
                    </div>
                </div>
                @else
                <div>
                    <span>Other Credential Presented</span>
                    <div class="d-flex justify-content-between mx-2">
                        <span>PEPT PASSER Rating: _________________</span>
                        <span>ALS A/E PASSER Rating: _________________</span>
                        <span>Other (PLs. specify): _________________</span>
                    </div>
                    <div class="d-flex justify-content-between mx-2">
                        <span>Date of Examination/Assessment (mm/dd/yyyy): _________________</span>
                        <span>Name and Address of Testing Center: ______________________________</span>
                    </div>
                </div>
                @endif
                <div class="text-center info-header">
                    <p class="text-uppercase">SCHOLASTIC RECORD</p>
                </div>


                @if(count($grade_7) > 0)

                @foreach($grade_7 as $record)
                <div class="record-header mt-1">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">{{ $record->school }}</span></span>
                        <span>School ID: <span class="text-decoration-underline">{{ $record->school_id }}</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">{{ $record->district }}</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">{{ $record->division }}</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">{{ $record->region }}</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">{{ $record->classified_grade }}</span></span>
                        <span>Section: <span class="text-decoration-underline">{{ $record->section }}</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">{{ $record->school_year }}</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">{{ $record->adviser }}</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 7 -->
                    @foreach($grade_7[0]->data as $data)
                    <tbody>
                        <tr>
                            @foreach($data as $subject => $quarter)
                            <td class="{{ $subject == 'Music' ? 'fw-light px-2 fst-italic':''}} 
                            {{ $subject == 'Arts' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Physical Education' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Health' ? 'fw-light px-2 fst-italic':''}}
                            ">{{$subject}}</td>
                            <td> {{ $quarter['quarter_1']}}</td>
                            <td> {{ $quarter['quarter_2']}}</td>
                            <td> {{ $quarter['quarter_3']}}</td>
                            <td>{{ $quarter['quarter_4']}}</td>
                            <td> {{ $quarter['final']}}</td>
                            <td>{{ $quarter['remark']}}</td>
                            @endforeach

                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : {{$record->gen_ave}}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">{{ $record->remedial_date_from }}</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">{{ $record->remedial_date_to }}</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>

                    @if(count($record->remedials) <= 0) <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        </tr>
                        <tr>

                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                        </tr>
                        @else
                        @foreach($record->remedials as $data)
                        <tr>
                            @foreach($data as $dt)
                            <td class="f-12 text-uppercase">{{ $dt }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        @endif

                </table>
                @endforeach

                @else

                <div class="record-header mt-1">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">_______________</span></span>
                        <span>School ID: <span class="text-decoration-underline">_______________</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">_______________</span></span>
                        <span>Section: <span class="text-decoration-underline">_______________</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 7 -->

                    <tbody>

                        <tr>
                            <td>Filipino</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mathematics</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Araling Panlipunan (AP)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Edukasyon sa Pagpapakatao (Esp)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Technology and Livelihood Education (TLE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>MAPEH</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Music</span> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Arts</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Physical Education</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Health</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>


                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>
                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>



                </table>
                @endif

                <!-- end grade 7 -->
                <!-- grade 8 -->

                @if(count($grade_8) > 0)

                @foreach($grade_8 as $record)
                <div class="record-header mt-1">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">{{ $record->school }}</span></span>
                        <span>School ID: <span class="text-decoration-underline">{{ $record->school_id }}</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">{{ $record->district }}</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">{{ $record->division }}</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">{{ $record->region }}</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">{{ $record->classified_grade }}</span></span>
                        <span>Section: <span class="text-decoration-underline">{{ $record->section }}</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">{{ $record->school_year }}</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">{{ $record->adviser }}</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 8 -->
                    @foreach($grade_8[0]->data as $data)
                    <tbody>
                        <tr>
                            @foreach($data as $subject => $quarter)
                            <td class="{{ $subject == 'Music' ? 'fw-light px-2 fst-italic':''}} 
                            {{ $subject == 'Arts' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Physical Education' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Health' ? 'fw-light px-2 fst-italic':''}}
                            ">{{$subject}}</td>
                            <td> {{ $quarter['quarter_1']}}</td>
                            <td> {{ $quarter['quarter_2']}}</td>
                            <td> {{ $quarter['quarter_3']}}</td>
                            <td>{{ $quarter['quarter_4']}}</td>
                            <td> {{ $quarter['final']}}</td>
                            <td>{{ $quarter['remark']}}</td>
                            @endforeach

                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : {{$record->gen_ave}}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">{{ $record->remedial_date_from }}</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">{{ $record->remedial_date_to }}</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>

                    @if(count($record->remedials) <= 0) <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        </tr>
                        <tr>

                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                        </tr>
                        @else
                        @foreach($record->remedials as $data)
                        <tr>
                            @foreach($data as $dt)
                            <td class="f-12 text-uppercase">{{ $dt }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        @endif

                </table>
                @endforeach

                @else

                <div class="record-header mt-1">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">_______________</span></span>
                        <span>School ID: <span class="text-decoration-underline">_______________</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">_______________</span></span>
                        <span>Section: <span class="text-decoration-underline">_______________</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 7 -->

                    <tbody>

                        <tr>
                            <td>Filipino</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mathematics</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Araling Panlipunan (AP)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Edukasyon sa Pagpapakatao (Esp)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Technology and Livelihood Education (TLE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>MAPEH</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Music</span> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Arts</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Physical Education</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Health</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>


                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>
                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>



                </table>
                @endif
                <!-- end grade 8 -->



                <!-- certification -->
                <div class="text-center info-header mt-1">
                    <p class="text-uppercase">CERTIFICATION</p>
                </div>
                <div class="certification mb-5">
                    <p class="f-12 text-center mt-2">I CERTIFY that this is a true record of: <span class="text-decoration-underline">{{ $student[0]->lastname .' '. $student[0]->firstname. ' '. $student[0]->name_ext . ' '. $student[0]->middlename }}</span>
                        with LRN: <span class="text-decoration-underline">{{ $student[0]->lrn }} </span>
                        that he/she is eligible for admission to Grade ________
                    </p>
                    <p class="f-12 text-center">Name of School : <span class="text-decoration-underline fw-bold text-capitalize">{{ $name_of_school ?? '' }}</span> <span>School ID: <span class="text-decoration-underline fw-bold text-capitalize">{{ $school_id ?? '' }}</span></span> <span>Last school year Attended: _______________</span></p>
                    <d class="d-flex justify-content-around mt-2 mb-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <span class="text-decoration-underline fw-bold">{{ now()->format('M d. Y')}}</span>
                            <p class="pfooter">date</p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <span class="text-center fw-bold admin_name">{{ $user->admin_name !=''? $user->admin_name : 'You can go to setting to set principal name' }}</span>
                            <p class="pfooter">Signature of Principal/School Head over printed Name</p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <span class="fw-bold"> </span>
                            <p class="pfooter">(Affix School Seal Here)</p>
                        </div>

                    </d>
                </div>


                <br><br><br><br>

                <!-- grade 9 -->
                @if(count($grade_9) > 0)

                @foreach($grade_9 as $record)
                <div class="record-header">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">{{ $record->school }}</span></span>
                        <span>School ID: <span class="text-decoration-underline">{{ $record->school_id }}</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">{{ $record->district }}</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">{{ $record->division }}</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">{{ $record->region }}</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">{{ $record->classified_grade }}</span></span>
                        <span>Section: <span class="text-decoration-underline">{{ $record->section }}</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">{{ $record->school_year }}</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">{{ $record->adviser }}</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 8 -->
                    @foreach($grade_9[0]->data as $data)
                    <tbody>
                        <tr>
                            @foreach($data as $subject => $quarter)
                            <td class="{{ $subject == 'Music' ? 'fw-light px-2 fst-italic':''}} 
                            {{ $subject == 'Arts' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Physical Education' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Health' ? 'fw-light px-2 fst-italic':''}}
                            ">{{$subject}}</td>
                            <td> {{ $quarter['quarter_1']}}</td>
                            <td> {{ $quarter['quarter_2']}}</td>
                            <td> {{ $quarter['quarter_3']}}</td>
                            <td>{{ $quarter['quarter_4']}}</td>
                            <td> {{ $quarter['final']}}</td>
                            <td>{{ $quarter['remark']}}</td>
                            @endforeach

                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : {{$record->gen_ave}}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">{{ $record->remedial_date_from }}</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">{{ $record->remedial_date_to }}</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>

                    @if(count($record->remedials) <= 0) <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        </tr>
                        <tr>

                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                        </tr>
                        @else
                        @foreach($record->remedials as $data)
                        <tr>
                            @foreach($data as $dt)
                            <td class="f-12 text-uppercase">{{ $dt }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        @endif

                </table>
                @endforeach

                @else

                <div class="record-header mt-1">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">_______________</span></span>
                        <span>School ID: <span class="text-decoration-underline">_______________</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">_______________</span></span>
                        <span>Section: <span class="text-decoration-underline">_______________</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 7 -->

                    <tbody>

                        <tr>
                            <td>Filipino</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mathematics</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Araling Panlipunan (AP)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Edukasyon sa Pagpapakatao (Esp)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Technology and Livelihood Education (TLE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>MAPEH</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Music</span> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Arts</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Physical Education</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Health</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>


                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>
                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>



                </table>
                @endif

                <!-- end grade 9 -->

                <!-- grade 9 -->
                @if(count($grade_10) > 0)

                @foreach($grade_10 as $record)
                <div class="record-header mt-1">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">{{ $record->school }}</span></span>
                        <span>School ID: <span class="text-decoration-underline">{{ $record->school_id }}</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">{{ $record->district }}</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">{{ $record->division }}</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">{{ $record->region }}</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">{{ $record->classified_grade }}</span></span>
                        <span>Section: <span class="text-decoration-underline">{{ $record->section }}</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">{{ $record->school_year }}</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">{{ $record->adviser }}</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 8 -->
                    @foreach($grade_10[0]->data as $data)
                    <tbody>
                        <tr>
                            @foreach($data as $subject => $quarter)
                            <td class="{{ $subject == 'Music' ? 'fw-light px-2 fst-italic':''}} 
                            {{ $subject == 'Arts' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Physical Education' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Health' ? 'fw-light px-2 fst-italic':''}}
                            ">{{$subject}}</td>
                            <td> {{ $quarter['quarter_1']}}</td>
                            <td> {{ $quarter['quarter_2']}}</td>
                            <td> {{ $quarter['quarter_3']}}</td>
                            <td>{{ $quarter['quarter_4']}}</td>
                            <td> {{ $quarter['final']}}</td>
                            <td>{{ $quarter['remark']}}</td>
                            @endforeach

                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : {{$record->gen_ave}}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">{{ $record->remedial_date_from }}</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">{{ $record->remedial_date_to }}</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>

                    @if(count($record->remedials) <= 0) <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        </tr>
                        <tr>

                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                            <td class="f-12 text-uppercase"></td>
                        </tr>
                        @else
                        @foreach($record->remedials as $data)
                        <tr>
                            @foreach($data as $dt)
                            <td class="f-12 text-uppercase">{{ $dt }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        @endif

                </table>
                @endforeach

                @else

                <div class="record-header mt-1">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">_______________</span></span>
                        <span>School ID: <span class="text-decoration-underline">_______________</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">_______________</span></span>
                        <span>Section: <span class="text-decoration-underline">_______________</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 7 -->

                    <tbody>

                        <tr>
                            <td>Filipino</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mathematics</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Araling Panlipunan (AP)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Edukasyon sa Pagpapakatao (Esp)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Technology and Livelihood Education (TLE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>MAPEH</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Music</span> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Arts</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Physical Education</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Health</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>


                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>
                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>



                </table>
                @endif

                <!-- end grade 9 -->

                <div class="record-header mt-1">
                    <div class="d-flex justify-content-between">
                        <span>School: <span class="text-decoration-underline">_______________</span></span>
                        <span>School ID: <span class="text-decoration-underline">_______________</span></span>
                        <span>District: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Division: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Region: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Classified as Grade: <span class="text-decoration-underline">_______________</span></span>
                        <span>Section: <span class="text-decoration-underline">_______________</span></span>
                        <span>School year: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Name of Adviser/teacher: <span class="text-decoration-underline text-uppercase">_______________</span></span>
                        <span>Signature: _______________</span>
                    </div>
                </div>

                <table class="table-data">
                    <thead>
                        <tr>
                            <th>Learning Areas</th>
                            <th colspan="4">Quarterly Rating</th>
                            <th>FINAL RATING</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>


                    <!-- grade 7 -->

                    <tbody>

                        <tr>
                            <td>Filipino</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mathematics</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Araling Panlipunan (AP)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Edukasyon sa Pagpapakatao (Esp)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Technology and Livelihood Education (TLE)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>MAPEH</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Music</span> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Arts</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Physical Education</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="mx-2 fw-light fst-italic">Health</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="f-12">
                            <td></td>
                            <td colspan="4"> General average : </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="7 ">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-light mx-2">Remedial Classes</span>
                                    <span class="mx-5">Conducted from (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                    <span class="mx-5">To: (mm/dd/yyyy): <span class="text-decoration-underline">_______________</span></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-data">
                    <tr>
                        <th>Learning Areas</th>
                        <th>Final rating</th>
                        <th>Remedial class mark</th>
                        <th>Final Recomputed grade</th>
                        <th>Remarks</th>
                    </tr>


                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>
                    <tr>

                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                        <td class="f-12 text-uppercase"></td>
                    </tr>



                </table>

                <!-- CERTIFICATION -->
                <!-- certification -->
                <div class="text-center info-header mt-1">
                    <p class="text-uppercase">CERTIFICATION</p>
                </div>
                <div class="certification mb-5">
                    <p class="f-12 text-center mt-2">I CERTIFY that this is a true record of: <span class="text-decoration-underline">{{ $student[0]->lastname .' '. $student[0]->firstname. ' '. $student[0]->name_ext . ' '. $student[0]->middlename }}</span>
                        with LRN: <span class="text-decoration-underline">{{ $student[0]->lrn }} </span>
                        that he/she is eligible for admission to Grade ________
                    </p>
                    <p class="f-12 text-center">Name of School : <span class="text-decoration-underline fw-bold text-capitalize">{{ $name_of_school ?? '' }}</span> <span>School ID: <span class="text-decoration-underline fw-bold text-capitalize">{{ $school_id ?? '' }}</span></span> <span>Last school year Attended: _______________</span></p>
                    <d class="d-flex justify-content-around mt-2 mb-3">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <span class="text-decoration-underline fw-bold">{{ now()->format('M d. Y')}}</span>
                            <p class="pfooter">date</p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <span class="text-center fw-bold admin_name">{{ $user->admin_name !=''? $user->admin_name : 'You can go to setting to set principal name' }}</span>
                            <p class="pfooter">Signature of Principal/School Head over printed Name</p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <span class="fw-bold"> </span>
                            <p class="pfooter">(Affix School Seal Here)</p>
                        </div>

                    </d>
                </div>
            </div>
        </div>
    </div>



</body>
<script>
    // setTimeout(() => {
    //     window.print()
    // }, 1200);
</script>

</html>