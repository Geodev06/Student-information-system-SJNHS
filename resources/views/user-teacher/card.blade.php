<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$record[0]->lrn}}</title>
    <link rel="stylesheet" href="{{ asset('./css/Custom.css')}}" />
</head>
<style>
    * {
        font-size: 12px;
        font-family: 'Times New Roman', Times, serif;
        color: #4db8ff;
    }


    p {
        margin: 0;
    }

    .bt {
        border-bottom: 1px solid #4db8ff;
    }

    .fs-14 {
        font-size: 14px;
    }

    #main {
        background-image: url("{{asset('img/sjihs_.jpg')}}");
        background-repeat: no-repeat;
        background-size: 350px;
        background-position-y: 120px;
        background-position-x: center;
    }

    .vt {
        transform: rotate(270deg);
    }

    .table-attendance th {
        padding: 5px;
    }

    .table-attendance th,
    td {
        border: 1px solid #4db8ff;
        text-align: center;
    }

    .table-attendance {
        width: 100%;
    }


    .table-grades th {
        padding: 5px;
        font-size: 12px;
        color: #007acc;
        background-color: #99d6ff;
    }

    .table-grades th,
    td {
        border: 1px solid #4db8ff;
        padding: 5px;
        font-size: 12px;
        font-weight: 600;
        height: 20px;
    }

    .table-grades {
        width: 100%;
    }

    .table-behavior th {
        padding: 5px;
        font-size: 12px;
        text-align: center;
    }

    .table-behavior th,
    td {
        border: 1px solid #4db8ff;
        padding: 5px;
        font-size: 12px;
        font-weight: 600;
        height: 20px;
    }

    .table-behavior {
        width: 100%;
    }

    .table-desc {
        width: 100%;
        font-size: 10px;

        border: none;
    }

    .table-desc tr {
        margin: 0;
        padding: 0;
    }

    .table-desc th {
        text-align: center;
        border: none;
    }

    .table-desc td {
        border: none;
        padding: 0;
        font-size: 10px;
        font-weight: normal;
    }
</style>

<body>

    @if($student)

    <div class="container mt-5 pb-5">
        <div class="row">
            <div class="col-lg-6 mx-auto  p-2">
                <span class="fw-bold">SCHOOL FORM 9 - JHS</span>
                <div class="text-center">
                    <p>Republic of the Philippines</p>
                    <p class="fw-bold">DEPARTMENT OF EDUCATION</p>
                    <p>REGION 4-A CALABARZON</p>
                    <p>Division of San Pablo City</p>
                    <p class="fw-bold">SAN JOSE INTEGRATED HIGH SCHOOL</p>
                    <p>San Jose, San Pablo City, Laguna</p>
                </div>

                <div class="row" id="main">
                    <div class="col-lg-12 mt-4">
                        <span class="w-100 d-flex align-items-center"><span style="font-size: 14px;" class="fst-italic">Name:</span>
                            <span class=" d-flex justify-content-around w-100 bt">
                                <span class="mx-2 fw-bold">{{$student[0]->lastname ?? ''}}</span>
                                <span class="fw-bold">{{$student[0]->firstname ?? ''}} {{$student[0]->name_ext ?? ''}}</span>
                                <span class="mx-3 fw-bold">{{$student[0]->middlename ?? ''}}</span>
                            </span>
                        </span>
                        <span class="w-100 ">
                            <span class="mx-4 d-flex justify-content-around w-100">
                                <span class="mx-2 fst-italic">(Surname)</span>
                                <span class="fst-italic">(Given name)</span>
                                <span class="mx-3 fst-italic">(Middle name)</span>
                            </span>
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex align-items-baseline justify-content-between">
                            <div class="d-flex align-items-baseline justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Age:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">{{$student[0]->age ?? ''}}</span>
                                </span>
                            </div>
                            <div class="d-flex align-items-baseline justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Sex:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">{{$student[0]->sex == 0 ? 'Male': 'Female'}}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex align-items-baseline  justify-content-between">
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Grade:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">Grade {{$record[0]->classified_grade ?? ''}}</span>
                                </span>
                            </div>
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Section:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">{{$record[0]->section ?? ''}}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex align-items-baseline  justify-content-between">
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">School Year: <span class="bt w-100">
                                        <span class="fw-bold mx-3">{{$record[0]->school_year ?? ''}}</span>
                                    </span></span>

                            </div>
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">LRN:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">{{$student[0]->lrn ?? ''}}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-4">
                        <span style="font-size: 14px;">Dear parent:</span>
                        <br>
                        <span style="font-size: 14px;"><span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            This report card shows the ability and progress your child has made in the different learning areas as well as his / her core values.
                        </span>
                        <br>
                        <span style="font-size: 14px;"><span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            The school welcomes you should you desire to know more about your child's progress.
                        </span>

                        <div class="d-flex justify-content-around mt-4 bt">
                            <span class=" fs-14 d-flex flex-column">
                                <span class="bt fs-14">&nbsp;</span>
                                <span class=" fst-italic">Principal</span>
                            </span>
                            <span class=" fs-14 d-flex flex-column">
                                <span class="bt fs-14">{{$record[0]->adviser ?? ''}}</span>
                                <span class=" fst-italic">Class Adviser</span>
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="fw-bold fs-14 fst-italic">Certificate of Transfer</p>
                        </div>

                        <div class="d-flex align-items-baseline  justify-content-between">
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Admitted to grade: ________________
                            </div>

                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Section: _________________________</span>
                            </div>

                        </div>

                        <div class="d-flex align-items-baseline  justify-content-between">
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Eligibility for admission to Grade: _____________________________________
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="fs-14">Approved: </span>
                        </div>

                        <div class="d-flex justify-content-around bt">
                            <span class=" fs-14 d-flex flex-column">
                                <span class="bt fs-14">&nbsp;</span>
                                <span class=" fst-italic">Principal</span>
                            </span>
                            <span class=" fs-14 d-flex flex-column">
                                <span class="bt fs-14">{{$record[0]->adviser ?? ''}}</span>
                                <span class=" fst-italic">Class Adviser</span>
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="fw-bold fs-14 fst-italic">Cancellation of Eligibility to Transfer</p>
                        </div>

                        <div class="d-flex align-items-baseline  justify-content-between">
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Admitted in: _______________________________________________________
                            </div>
                        </div>

                        <div class="d-flex align-items-baseline  justify-content-between">
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Date: ___________________________________
                            </div>
                        </div>

                        <div class="float-end">
                            <div class="d-flex flex-column mx-5">
                                <span class="bt fs-14">&nbsp;</span>
                                <span>Principal</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-center">
                            <p style="font-size: 16px;" class="text-decoration-underline fw-bold">REPORT ON ATTENDANCE</p>
                        </div>

                        <table class="table-attendance">
                            <thead>
                                <tr>
                                    <th>REPORT ON ATTENDANCE</th>
                                    <th class="vt">Aug</th>
                                    <th class="vt">Sept</th>
                                    <th class="vt">Oct</th>
                                    <th class="vt">Nov</th>
                                    <th class="vt">Dec</th>
                                    <th class="vt">Jan</th>
                                    <th class="vt">Feb</th>
                                    <th class="vt">Mar</th>
                                    <th class="vt">Apr</th>
                                    <th class="vt">May</th>
                                    <th class="vt">June</th>
                                    <th class="vt">July</th>
                                    <th class="vt">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>No. of school days</td>
                                    <td>{{$record[0]->attendance[0]['august']['aug_sd'] ?? '' }}</td>
                                    <td>{{$record[0]->attendance[1]['september']['sep_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[2]['october']['oct_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[3]['november']['nov_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[4]['december']['dec_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[5]['january']['jan_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[6]['february']['feb_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[7]['march']['mar_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[8]['april']['apr_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[9]['may']['may_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[10]['june']['jun_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[11]['july']['jul_sd'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[12]['total']['total_days'] ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>No. of days prensent</td>
                                    <td>{{$record[0]->attendance[0]['august']['aug_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[1]['september']['sep_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[2]['october']['oct_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[3]['november']['nov_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[4]['december']['dec_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[5]['january']['jan_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[6]['february']['feb_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[7]['march']['mar_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[8]['april']['apr_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[9]['may']['may_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[10]['june']['jun_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[11]['july']['jul_pr'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[12]['total']['total_present'] ?? ''}}</td>
                                </tr>

                                <tr>
                                    <td>No. of school absent</td>
                                    <td>{{$record[0]->attendance[0]['august']['aug_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[1]['september']['sep_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[2]['october']['oct_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[3]['november']['nov_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[4]['december']['dec_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[5]['january']['jan_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[6]['february']['feb_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[7]['march']['mar_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[8]['april']['apr_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[9]['may']['may_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[10]['june']['jun_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[11]['july']['jul_ab'] ?? ''}}</td>
                                    <td>{{$record[0]->attendance[12]['total']['total_absent'] ?? ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12 mt-3 bt">
                        <div class="text-center fst-italic">
                            <p style="font-size: 16px;" class=" fw-bold">PARENT'S / GUARDIAN'S SIGNATURE</p>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="text-center d-flex flex-column">
                            <span style="font-size: 16px;">1st Quarter <span> _________________________________________________</span></span>
                            <span style="font-size: 16px;">2nd Quarter <span> _________________________________________________</span></span>
                            <span style="font-size: 16px;">3rd Quarter <span> _________________________________________________</span></span>
                            <span style="font-size: 16px;">4th Quarter <span> _________________________________________________</span></span>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

    <div class="container pb-5" style="margin-top: 90px;">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="text-center">
                    <p class="fw-bold text-decoration-underline fs-14">REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</p>
                </div>

                <table class="table-grades">
                    <tr>
                        <th rowspan="2">LEARNING AREA</th>
                        <th colspan="4">Quarter</th>
                        <th rowspan="2">Final Grade</th>
                        <th rowspan="2">Remarks</th>
                    </tr>
                    <tr>

                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                    </tr>

                    <!-- grades -->
                    @if(count($record) > 0)
                    @foreach($record[0]->data as $data)
                    <tr>
                        @foreach($data as $subject => $quarter)
                        <td style="text-align: left;" class="
                        {{ $subject == 'Music' ? 'fw-light mx-2 fst-italic':''}} 
                            {{ $subject == 'Arts' ? 'fw-light mx-2 fst-italic':''}}
                            {{ $subject == 'Physical Education' ? 'fw-light mx-2 fst-italic':''}}
                            {{ $subject == 'Health' ? 'fw-light mx-2 fst-italic':''}}
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
                        <td colspan="5" class="text-end border-0">General average</td>
                        <td>{{ $record[0]->gen_ave}}</td>
                        <td>{{ $record[0]->gen_ave >= 75 ? 'PASSED':'FAILED'}}</td>
                    </tr>
                    @endif
                </table>

                <div class="text-center mt-4">
                    <p class="fw-bold text-decoration-underline fs-14">REPORT ON LEARNER'S OBSERVED VALUES</p>
                </div>

                <table class="table-behavior">
                    <tr>
                        <th rowspan="2">Core Values</th>
                        <th rowspan="2">Behavior Statements</th>
                        <th colspan="4">Quarter</th>
                    </tr>
                    <tr>

                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                    </tr>

                    <!-- grades -->
                    @if(count($record) > 0)

                    @if($decoded_values)
                    <tr>
                        <td rowspan="2">Makadiyos</td>
                        <td class="text-start fw-light p-1">Expresses one's spiritual beliefs while repecting spiritual beliefs of others</td>
                        <!-- <td>Show adherence to ethical principles by upholding truth</td> -->
                        <td>{{$decoded_values[0]->makadiyos->q1}}</td>
                        <td>{{$decoded_values[0]->makadiyos->q2}}</td>
                        <td> {{$decoded_values[0]->makadiyos->q3}}</td>
                        <td>{{$decoded_values[0]->makadiyos->q4}}</td>
                    </tr>

                    <tr>
                        <td class="text-start fw-light p-1">Show adherence to ethical principles by upholding truth</td>
                        <td>{{$decoded_values[1]->makadiyos_2->q1}}</td>
                        <td>{{$decoded_values[1]->makadiyos_2->q2}}</td>
                        <td> {{$decoded_values[1]->makadiyos_2->q3}}</td>
                        <td>{{$decoded_values[1]->makadiyos_2->q4}}</td>
                    </tr>

                    <tr>
                        <td rowspan="2">Makatao</td>
                        <td class="text-start fw-light p-1">Is sensitive to individual, social and cultural differences</td>
                        <td>{{$decoded_values[2]->makatao->q1}}</td>
                        <td>{{$decoded_values[2]->makatao->q2}}</td>
                        <td> {{$decoded_values[2]->makatao->q3}}</td>
                        <td>{{$decoded_values[2]->makatao->q4}}</td>
                    </tr>

                    <tr>

                        <td class="text-start fw-light p-1">Demonstrate contributions toward solidarity</td>
                        <td>{{$decoded_values[3]->makatao_2->q1}}</td>
                        <td>{{$decoded_values[3]->makatao_2->q2}}</td>
                        <td> {{$decoded_values[3]->makatao_2->q3}}</td>
                        <td>{{$decoded_values[3]->makatao_2->q4}}</td>
                    </tr>

                    <tr>
                        <td>Makakalikasan</td>
                        <td class="text-start fw-light p-1">Cares for the enviroment and utilizes resources wisely, judiciously, and economically</td>
                        <td>{{$decoded_values[4]->makakalikasan->q1}}</td>
                        <td>{{$decoded_values[4]->makakalikasan->q2}}</td>
                        <td> {{$decoded_values[4]->makakalikasan->q3}}</td>
                        <td>{{$decoded_values[4]->makakalikasan->q4}}</td>
                    </tr>

                    <tr>
                        <td rowspan="2">Makabansa</td>
                        <td class="text-start fw-light p-1">Demonstrate pride in being a filipino; execises rights and responsibilities of a filipino citizen</td>
                        <td>{{$decoded_values[5]->makabansa->q1}}</td>
                        <td>{{$decoded_values[5]->makabansa->q2}}</td>
                        <td> {{$decoded_values[5]->makabansa->q3}}</td>
                        <td>{{$decoded_values[5]->makabansa->q4}}</td>
                    </tr>

                    <tr>
                        <td class="text-start fw-light p-1">Demonstrates appropriate behavior in carrying out activities in school, community and country.</td>
                        <td>{{$decoded_values[6]->makabansa_2->q1}}</td>
                        <td>{{$decoded_values[6]->makabansa_2->q2}}</td>
                        <td> {{$decoded_values[6]->makabansa_2->q3}}</td>
                        <td>{{$decoded_values[6]->makabansa_2->q4}}</td>
                    </tr>
                    @endif
                    @endif
                </table>
                <div class="row">
                    <p class="mx-3 fst-italic mt-3 fw-bold">Learner Progress and Achievement</p>
                    <div class="col-lg-12">
                        <table class="table-desc">
                            <tr>
                                <th>Descriptors</th>
                                <th>Grading scale</th>
                                <th>Remarks</th>
                                <th></th>
                                <th colspan="4">Observed values</th>
                            </tr>
                            <tr style="font-size: 10px;">
                                <td>Outstanding</td>
                                <td>90-100</td>
                                <td>Passed</td>
                                <td></td>
                                <td class="fw-bold fs-14">AO</td>
                                <td>Always Observed</td>
                                <td class="fw-bold fs-14">SO</td>
                                <td>Sometimes Observed</td>
                            </tr>
                            <tr style="font-size: 10px;">
                                <td>Very Satisfactory</td>
                                <td>85-89</td>
                                <td>Passed</td>
                                <td></td>
                                <td class="fw-bold fs-14">RO</td>
                                <td>Rarely Observed</td>
                                <td class="fw-bold fs-14">NO</td>
                                <td>Not Observed</td>
                            </tr>
                            <tr style="font-size: 10px;">
                                <td>Satisfactory</td>
                                <td>80-84</td>
                                <td>Passed</td>
                                <td></td>
                            </tr>
                            <tr style="font-size: 10px;">
                                <td>Fairly Satisfactory</td>
                                <td>75-79</td>
                                <td>Passed</td>
                                <td></td>
                            </tr>
                            <tr style="font-size: 10px;">
                                <td>Did not meet expectations</td>
                                <td>Below 75</td>
                                <td>Failed</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    @endif
</body>
<script>
    window.print()
</script>

</html>