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

    <script src="{{ asset('js/html2pdf.bundle.min.js')}}"></script>
</head>
<style>
    p {
        font-size: 10px;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p {
        margin: 0;
    }

    .color-brown {
        font-weight: bold;
        font-size: 14px;
        background-color: #b2b266;
        text-align: center;
        text-transform: uppercase;
        border: 2px solid black;
        margin: 0;
    }

    table {
        width: 100%;
    }

    table th,
    td {
        font-weight: normal;
        font-size: 10px;

    }

    span {
        margin-left: 5px;
        text-decoration: underline;
        text-transform: capitalize;
    }

    .box {
        margin-top: 2px;
        border: 1px solid black;
    }

    .record-container {
        margin-top: 2px;
        border: 2px solid black;
        margin-bottom: 5px;
    }

    .record-header {
        border-bottom: 1px solid black;
    }

    .table-data td {
        border: 1px solid black;
    }

    .record-break {
        background-color: #b2b266;
        height: 5px;
    }

    .table-remedial-data th {
        border: 1px solid black;
        padding: 5px;
    }

    .table-remedial-data td {
        border: 1px solid black;

    }
</style>

<body id="print-body">
    <p>SF10-JHS</p>
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12 mx-auto ">
                <img src="{{asset('img/logo.png')}}" alt="img-1" height="50px" class="float-start">
                <img src="{{asset('img/deped.png')}}" alt="img-1" height="50px" class="float-end">
                <p class="text-center">Republic of the Philippines</p>
                <p class="text-center">Department of Education</p>
                <h6 class="text-center">Learner's Permanent Record for Junior High School(SF10-JHS)</h6>
                <p class="text-center" style="font-size: 12px; font-style:italic">(Formerly Form 137)</p>

                <div class="color-brown">
                    LEARNER'S INFORMATION
                </div>

                <table>
                    <thead>
                        <th>LASTNAME: <span>{{$student[0]->lastname ?? ''}}</span></th>
                        <th>FIRSTNAME:<span>{{$student[0]->firstname ?? ''}}</span></th>
                        <th>NAME EXT.(Jr. II):<span>{{$student[0]->name_ext ?? '' }}</span></th>
                        <th>MIDDLENAME:<span>{{$student[0]->middlename ?? ''}}</span></th>
                    </thead>
                    <tbody>
                        <td>Learner's reference Number: (LRN): <span>{{$student[0]->lrn ?? ''}}</span></td>
                        <td colspan="2">Birthdate: (mm/dd/yyyy): <span>{{$student[0]->birthdate ?? ''}}</span></td>
                        <td>Sex: <span style="font-weight: bold;">{{$student[0]->sex === 0 ? 'M' : 'F'}}</span> </td>
                    </tbody>
                </table>

                <div class="color-brown">
                    ELIGIBILITY FOR JHS ENROLLMENT
                </div>

                <div class="box">
                    <table>
                        <thead>
                            <th><input type="checkbox"></th>
                            <th> Elementary school completer : </th>
                            <th>General Average : <span>{{$student[0]->gen_ave ?? ''}}</span></th>
                            <th>Citations (If Any) : <span>{{$student[0]->elem_school_citation == '' ? '__________' : $student[0]->elem_school_citation}}</th>
                        </thead>
                        <tbody>
                            <td></td>
                            <td>Name of Elementary school: <span>{{$student[0]->elem_school ?? '' }}</span></td>
                            <td>School ID: <span>{{$student[0]->elem_school_id ?? '' }}</span></td>
                            <td>Address of School: <span>{{$student[0]->elem_school_address ?? '' }}</span></td>
                        </tbody>
                    </table>
                </div>

                <div>
                    <p class="text-start" style="font-size: 12px;">Other credential presented</p>
                    <table class="record-header">
                        <thead>
                            <th><input type="checkbox"></th>
                            <th>PEPT Passer Rating: <span>{{ $otherinfo[0]->pept_rating ?? ''}}</span></th>
                            <th><input type="checkbox"></th>
                            <th>ALS A & E Passer Rating: <span>{{ $otherinfo[0]->als_rating ?? ''}}</span></th>
                            <th><input type="checkbox"></th>
                            <th>Others(Pls Specify): <span>{{ $otherinfo[0]->others ?? ''}}</span></th>
                        </thead>
                        <tbody>
                            <td></td>
                            <td>Date of Examination/Assessment (mm/dd/yyy): {{ $otherinfo[0]->pept_date_assestment ?? ''}}</td>
                            <td></td>
                            <td>Name and Address of Testing Center: {{ $otherinfo[0]->als_name_address ?? '' }}</td>
                        </tbody>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="color-brown">
                    SCHOLASTIC RECORD
                </div>

                <!-- Grade 7 -->
                <div class="record-container">
                    <table class="record-header">
                        <thead>
                            <th rowspan="2">Name of School: <span>{{ $GRADE_7[0]->school ?? '' }}</span></th>
                            <th>School ID: <span>{{ $GRADE_7[0]->school_id ?? '' }}</span></th>
                            <th>District: <span>{{ $GRADE_7[0]->district ?? '' }}</span></th>
                            <th>Division: <span>{{ $GRADE_7[0]->division ?? '' }}</span></th>
                            <th>Region: <span>{{ $GRADE_7[0]->region ?? '' }}</span></th>
                        </thead>

                        <tbody>
                            <td>Classified grade : <span class="fw-bold">{{ $GRADE_7[0]->classified_grade ?? '' }}</span></td>
                            <td>Section : {{ $GRADE_7[0]->section ?? '' }}</span></td>
                            <td>School Year : <span>{{ $GRADE_7[0]->school_year ?? '' }}</span></td>
                            <td>Name of Adviser/Teacher : <span>{{ $GRADE_7[0]->adviser ?? '' }}</span></td>
                            <td>Signature: ____________</span></td>
                        </tbody>
                    </table>

                    <table class="table-data">
                        <thead>
                            <th class="text-center fw-bold">LEARNING AREAS</th>
                            <th class="text-center fw-bold" colspan="4">Quarterly Rating</th>
                            <th class="text-center fw-bold" style="width: 15%;">FINAL RATING</th>
                            <th class="text-center fw-bold">REMARKS</th>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td></td>
                                <td class="fw-bold">1</td>
                                <td class="fw-bold">2</td>
                                <td class="fw-bold">3</td>
                                <td class="fw-bold">4</td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($GRADE_7[0]->data as $data)
                            @foreach($data as $subject => $quarter)
                            <tr>
                                <td class="{{ $subject == 'Music' ? 'fw-light px-2 fst-italic':''}} 
                            {{ $subject == 'Arts' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Physical Education' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Health' ? 'fw-light px-2 fst-italic':''}}
                            ">{{$subject}}</td>
                                <td class="text-center"> {{ $quarter['quarter_1']}}</td>
                                <td class="text-center"> {{ $quarter['quarter_2']}}</td>
                                <td class="text-center"> {{ $quarter['quarter_3']}}</td>
                                <td class="text-center">{{ $quarter['quarter_4']}}</td>
                                <td class="text-center"> {{ $quarter['final']}}</td>
                                <td class="text-center">{{ $quarter['remark']}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="4" class="text-center fst-italic fw-bold">General Average</td>
                                <td class="text-center fw-bold"> {{$GRADE_7[0]->gen_ave ?? '' }}</td>
                                <td class="text-center fw-bold">{{$GRADE_7[0]->gen_ave >= 75 ? 'PASSED':'FAILED' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="record-break"></div>


                    <!-- Remedial -->
                    <table class="">
                        <thead>
                            <th class="fw-bold text-end">Remedial Classes</th>
                            <th class="text-center">Conducted from (mm/dd/yyyy): <span>{{ $GRADE_7[0]->remedial_date_from ?? ''}}</span></th>
                            <th class="text-start">To (mm/dd/yyyy): <span>{{ $GRADE_7[0]->remedial_date_from ?? ''}}</span></th>
                        </thead>
                    </table>

                    <table class="table-remedial-data">
                        <thead>
                            <th class="fw-bold text-center">Learning Areas</th>
                            <th class="fw-bold text-center">Final Rating</th>
                            <th class="fw-bold text-center">Remedial Class Mark</th>
                            <th class="fw-bold text-center">Recomputed Final Grade</th>
                            <th class="fw-bold text-center">Remarks</th>

                        </thead>
                        <tbody>
                            @foreach($GRADE_7[0]->remedials as $data)
                            <tr>
                                @foreach($data as $dt)
                                <td class="f-12 text-uppercase">{{ $dt }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <!-- End grade 7 -->
                <!--  grade 8 -->
                <div class="record-container">
                    <table class="record-header">
                        <thead>
                            <th rowspan="2">Name of School: <span>{{ $GRADE_8[0]->school ?? '' }}</span></th>
                            <th>School ID: <span>{{ $GRADE_8[0]->school_id ?? '' }}</span></th>
                            <th>District: <span>{{ $GRADE_8[0]->district ?? '' }}</span></th>
                            <th>Division: <span>{{ $GRADE_8[0]->division ?? '' }}</span></th>
                            <th>Region: <span>{{ $GRADE_8[0]->region ?? '' }}</span></th>
                        </thead>

                        <tbody>
                            <td>Classified grade : <span class="fw-bold">{{ $GRADE_8[0]->classified_grade ?? '' }}</span></td>
                            <td>Section : {{ $GRADE_8[0]->section ?? '' }}</span></td>
                            <td>School Year : <span>{{ $GRADE_8[0]->school_year ?? '' }}</span></td>
                            <td>Name of Adviser/Teacher : <span>{{ $GRADE_8[0]->adviser ?? '' }}</span></td>
                            <td>Signature: ____________</span></td>
                        </tbody>
                    </table>

                    <table class="table-data">
                        <thead>
                            <th class="text-center fw-bold">LEARNING AREAS</th>
                            <th class="text-center fw-bold" colspan="4">Quarterly Rating</th>
                            <th class="text-center fw-bold" style="width: 15%;">FINAL RATING</th>
                            <th class="text-center fw-bold">REMARKS</th>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td></td>
                                <td class="fw-bold">1</td>
                                <td class="fw-bold">2</td>
                                <td class="fw-bold">3</td>
                                <td class="fw-bold">4</td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($GRADE_8[0]->data as $data)
                            @foreach($data as $subject => $quarter)
                            <tr>
                                <td class="{{ $subject == 'Music' ? 'fw-light px-2 fst-italic':''}} 
                            {{ $subject == 'Arts' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Physical Education' ? 'fw-light px-2 fst-italic':''}}
                            {{ $subject == 'Health' ? 'fw-light px-2 fst-italic':''}}
                            ">{{$subject}}</td>
                                <td class="text-center"> {{ $quarter['quarter_1']}}</td>
                                <td class="text-center"> {{ $quarter['quarter_2']}}</td>
                                <td class="text-center"> {{ $quarter['quarter_3']}}</td>
                                <td class="text-center">{{ $quarter['quarter_4']}}</td>
                                <td class="text-center"> {{ $quarter['final']}}</td>
                                <td class="text-center">{{ $quarter['remark']}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="4" class="text-center fst-italic fw-bold">General Average</td>
                                <td class="text-center fw-bold"> {{$GRADE_7[0]->gen_ave ?? '' }}</td>
                                <td class="text-center fw-bold">{{$GRADE_7[0]->gen_ave >= 75 ? 'PASSED':'FAILED' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="record-break"></div>


                    <!-- Remedial -->
                    <table class="">
                        <thead>
                            <th class="fw-bold text-end">Remedial Classes</th>
                            <th class="text-center">Conducted from (mm/dd/yyyy): <span>{{ $GRADE_7[0]->remedial_date_from ?? ''}}</span></th>
                            <th class="text-start">To (mm/dd/yyyy): <span>{{ $GRADE_7[0]->remedial_date_from ?? ''}}</span></th>
                        </thead>
                    </table>

                    <table class="table-remedial-data">
                        <thead>
                            <th class="fw-bold text-center">Learning Areas</th>
                            <th class="fw-bold text-center">Final Rating</th>
                            <th class="fw-bold text-center">Remedial Class Mark</th>
                            <th class="fw-bold text-center">Recomputed Final Grade</th>
                            <th class="fw-bold text-center">Remarks</th>

                        </thead>
                        <tbody>
                            @foreach($GRADE_8[0]->remedials as $data)
                            <tr>
                                @foreach($data as $dt)
                                <td class="f-12 text-uppercase">{{ $dt }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</body>

<script>
    function loadPDF() {
        var element = document.querySelector('#print-body')

        var opt = {
            margin: 0.2,
            filename: '{{$student[0]->lrn}}.pdf',
            image: {
                type: 'png',
                quality: 0.98
            },
            html2canvas: {
                scale: 1
            },
            jsPDF: {
                unit: 'in',
                format: 'legal',
                orientation: 'portrait'
            }
        }

        html2pdf().set(opt).from(element).save()
    }

    loadPDF()
</script>

</html>