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
        background-image: url("{{asset('img/logo.png')}}");
        background-repeat: no-repeat;
        background-size: 350px;
        background-position-y: 40px;
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
</style>

<body>

    <div class="container mt-5 pb-5">
        <div class="row">
            <div class="col-lg-6 mx-auto border p-2">
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
                                <span class="mx-2 fw-bold">Agnote</span>
                                <span class="fw-bold">Ageo</span>
                                <span class="mx-3 fw-bold">Vallar</span>
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
                                    <span class="fw-bold mx-3">12</span>
                                </span>
                            </div>
                            <div class="d-flex align-items-baseline justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Sex:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">Male</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex align-items-baseline  justify-content-between">
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Grade:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">Grade 8</span>
                                </span>
                            </div>
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">Section:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">DIAMOND</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex align-items-baseline  justify-content-between">
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">School Year: <span class="bt w-100">
                                        <span class="fw-bold mx-3">2023-2024</span>
                                    </span></span>

                            </div>
                            <div class="d-flex align-items-baseline  justify-content-between w-100">
                                <span style="font-size: 14px;" class="fst-italic">LRN:</span>
                                <span class="bt w-100">
                                    <span class="fw-bold mx-3">0123456789895</span>
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
                                <span class="bt fs-14">Principal</span>
                                <span class=" fst-italic">Principal</span>
                            </span>
                            <span class=" fs-14 d-flex flex-column">
                                <span class="bt fs-14">Class adviser</span>
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
                                <span class="bt fs-14">Principal</span>
                                <span class=" fst-italic">Principal</span>
                            </span>
                            <span class=" fs-14 d-flex flex-column">
                                <span class="bt fs-14">Class adviser</span>
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
                                <span class="bt fs-14">Principal</span>
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
                                    <td>30</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>No. of days prensent</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>No. of school absent</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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

    <div class="container pb-5" style="margin-top: 150px;">
        <h1>Back</h1>
    </div>
</body>

</html>