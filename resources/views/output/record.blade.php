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
    <script src="{{ asset('./js/jquery-3.5.1.js') }}"></script>
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
        font-size: 9px;

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
        padding: 2px;
        border-bottom: 1px solid black;
    }

    .table-data tbody td {
        border: 1px solid black;

        font-size: 9px;
    }

    .record-break {
        background-color: #b2b266;
        height: 5px;
    }

    .table-remedial-data th {
        border: 1px solid black;

    }

    .table-remedial-data td {
        border: 1px solid black;

    }

    @page {
        @bottom-center {
            content: 'bobo';
        }
    }

    footer {

        width: 100%;
        text-align: center;
        page-break-after: always;
    }

    .record-container:last-child {
        page-break-after: always;
    }

    .certification {
        border-left: 2px solid black;
        border-right: 2px solid black;
        border-bottom: 2px solid black;

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
                            <th>Citations (If Any) : <span>{{$student[0]->elem_school_citation}}</th>
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
                            <th>
                                <input type="checkbox">
                            </th>
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


                @foreach($extendedRecords as $index => $value)

                @if($value !== null)

                @include('output.data')

                @else

                <!-- Placeholder for empty record -->
                @include('output.empty_placeholder')

                @endif

                @if(in_array($index,$breakpoints))
                @include('output.certification')
                @endif

                @endforeach






            </div>

        </div>
    </div>
</body>

<script>
    function loadPDF() {
        var element = document.querySelector('#print-body')

        var opt = {
            margin: 0.2,
            filename: "{{$student[0]->lrn.now()->format('i-m/d/Y')}}.pdf",
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

    $(document).ready(function() {
        loadPDF()
    })
</script>

</html>