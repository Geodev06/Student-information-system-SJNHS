@extends('layouts.dashboard')

@section('content')

<script src="{{ asset('chartjs/package/dist/chart.js')}}"></script>
<script src="{{ asset('chartjs/datalabels.min.js')}}"></script>


<script src="{{ asset('js/html2pdf.bundle.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/table.css')}}">
<style>
    .syp {
        display: none;
    }

    .border-grades {
        border-left: 4px solid #6D28D9;
        border-top: 1px solid gainsboro;
        border-bottom: 1px solid gainsboro;
        border-right: 1px solid gainsboro;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>
<div class="p-5">
    <div class="d-flex justify-content-between mb-3">
        <h6 class="fw-bold ">Reports</span></h6>
    </div>

    <div class="row bg-light p-3 rounded-3">
        <div class="col-lg-6 mb-3">
            <div class="form-floating">
                <select name="" id="select-sy" class="form-select">
                </select>
                <label for="select">Choose School year</label>
                <span class="error_select_sy text-danger error-text"></span>
            </div>
            <div class="form-floating mt-2">
                <select name="" id="select-grade" class="form-select">
                    <option value="7">Grade 7</option>
                    <option value="8">Grade 8</option>
                    <option value="9">Grade 9</option>
                    <option value="10">Grade 10</option>
                    <option value="11">Grade 11</option>
                    <option value="12">Grade 12</option>
                </select>
                <label for="select">Choose Grade level</label>
                <span class="error_select_sy text-danger error-text"></span>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <button class="btn btn-primary btn-lg" id="btn-generate"> <i class="bx bx-data"></i>Generate</button>
            <button class="btn btn-danger btn-lg" id="btn-download"> <i class="bx bx-download"></i>Download</button>
        </div>

        <div class="row" id="print-body">
            <div class="col-lg-12 text-center" style="display:none;" id="report-header">
                <img src="{{ asset('img/logo.png')}}" alt="logo" height="80px" style="mix-blend-mode: darken;">
                <h4 style="font-family:'Times New Roman', Times, serif; font-size:14px">Republic of the Philippines</h4>
                <h2 style="font-size: 16px;" class="mt-2">Department of Education</h2>
                <h5 style="font-size: 13px;" class="m-0">REGION IV-A CALABARZON</h5>
                <h5 style="font-size: 12px;" class="fw-bold m-0">SCHOOLS DIVISION OF SAN PABLO CITY</h5>
                <h6 style="font-size: 12px;" class="m-0">SAN JOSE INTEGRATED HIGHSCHOOL</h6>
                <h6 style="font-size: 12px;" class="m-0">SAN JOSE, SAN PABLO CITY, LAGUNA</h6>
                <hr>
            </div>
            <h2 class="syp fw-bold mb-3 ">Overall Report</h2>
            <div class="col-lg-6 mb-3">
                <div class="card p-3 gender-div">
                    <h6>Gender chart</h6>
                    <p class="m-0 text-secondary syp" style="font-size: 11px;">Showing the total no. of male and female student in <span class="fw-bold">SY</span> <span class="lbl_sy"></span></p>

                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <div class="card p-3 student-div">
                    <h6>Student chart</h6>
                    <p class="m-0 text-secondary syp" style="font-size: 11px;">Showing the total no. students by grade level in <span class="fw-bold">SY</span> <span class="lbl_sy"></span></p>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <div class="card p-3 student-grade-div">
                    <h6>Student grades chart</h6>
                    <p class="m-0 text-secondary syp" style="font-size: 11px;">Showing the MIX,MAX,and AVG grades of students by grade level in <span class="fw-bold">SY</span> <span class="lbl_sy"></span></p>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <div class="card p-3 subject-div">
                    <h6>Subjects stats</h6>
                    <p class="m-0 text-secondary syp mb-2" style="font-size: 11px;">Showing the MIX,MAX,and AVG grades of of students per subject in <span class="fw-bold">SY</span> <span class="lbl_sy"></span></p>

                    <div class="row p-2">

                        <table class="table table-striped" id="table-subjects">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>SUBJECT NAME</th>
                                    <th>MIN.</th>
                                    <th>MAX.</th>
                                    <th>AVG.</th>
                                </tr>
                            </thead>
                            <tbody class="p-2">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-3">
                <div class="card p-3">
                    <h2 class="syp fw-bold">Grade <span class="lvl_ind"></span> Report</h2>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <div class=" p-3 gender-div-per-level">
                                <h6>Gender chart</h6>
                                <p class="m-0 text-secondary syp" style="font-size: 11px;">Showing the total no. of male and female student in
                                    <span class="fw-bold">SY</span>
                                    <span class="lbl_sy"></span>
                                    in grade
                                    <span class="lvl_ind"></span>
                                </p>

                            </div>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <div class=" p-3">
                                <h6>Grade stats</h6>
                                <div class="row p-2">

                                    <div class="col-lg-4 card bg-info text-white">
                                        <div class="d-flex p-2 justify-content-between">
                                            <h5>Min</h5>
                                            <span id="min_per_level" class="h5 fw-bold">--</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 card bg-dark text-white">
                                        <div class="d-flex p-2 justify-content-between">
                                            <h5>Avg</h5>
                                            <span id="avg_per_level" class="h5 fw-bold">--</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 card bg-primary text-white">
                                        <div class="d-flex p-2 justify-content-between">
                                            <h5>Max</h5>
                                            <span id="max_per_level" class="h5 fw-bold">--</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 text-secondary syp" style="font-size: 11px;">Showing the MIN,MAX and AVG general avg of student in
                                    <span class="fw-bold">SY</span>
                                    <span class="lbl_sy"></span>
                                    in grade
                                    <span class="lvl_ind"></span>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="p-3 subject-div-per-level">
                                <h6>Subjects stats</h6>
                                <p class="m-0 text-secondary syp" style="font-size: 11px;">Showing the total no. of male and female student in
                                    <span class="fw-bold">SY</span>
                                    <span class="lbl_sy"></span>
                                    in grade
                                    <span class="lvl_ind"></span>
                                </p>
                                <div class="row p-2">

                                    <table class="table table-striped" id="table-subjects-per-level">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>SUBJECT NAME</th>
                                                <th>MIN.</th>
                                                <th>MAX.</th>
                                                <th>AVG.</th>
                                            </tr>
                                        </thead>
                                        <tbody class="p-2">

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <p class="syp fw-bold text-muted" style="font-size: 12px;">Generated by Administrator: <span>{{ Auth::user()->lastname . ' '.Auth::user()->firstname .' '.Auth::user()->middlename }}</span></p>
                <p class="syp fw-bold text-muted" style="font-size: 12px;">Date: <span>{{ now()->format('jS, \of F, Y  g:i  A') }}</span></p>
            </div>
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


    for (let i = 1900; i < 2050; i++) {
        $('#select-sy').append('<option value="' + i + '-' + (i + 1) + '">' + i + '-' + (i + 1) + '</option>')
    }


    function randomColor() {
        let value = "#" + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0').toUpperCase()
        return value
    }

    function loadGenderChart(data) {

        let labels = ['Male', 'Female'];
        let dataPoints = [data.gender_count.male, data.gender_count.female]

        var ctx = document.getElementById('chart_gender')

        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: ['Gender'],
                    data: dataPoints,
                    backgroundColor: [
                        '#6D28D9', 'gainsboro'
                    ],
                    borderColor: [
                        'transparent'
                    ],
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels],
            options: {

                plugins: {
                    datalabels: {
                        display: true,
                        formatter: (value, ctx) => {
                            return ctx.chart.data.datasets[0].data[ctx.dataIndex]
                        },
                        backgroundColor: '#6D28D9',
                        color: 'white',
                        borderRadius: 3,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        })
    }

    function loadGenderChart_2(data) {

        let labels = ['Male', 'Female'];
        let dataPoints = [data.gender_count_per_level.male, data.gender_count_per_level.female]

        var ctx = document.getElementById('chart_gender_2')

        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: ['Gender'],
                    data: dataPoints,
                    backgroundColor: [
                        '#6D28D9', 'gainsboro'
                    ],
                    borderColor: [
                        'transparent'
                    ],
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels],
            options: {

                plugins: {
                    datalabels: {
                        display: true,
                        formatter: (value, ctx) => {
                            return ctx.chart.data.datasets[0].data[ctx.dataIndex]
                        },
                        backgroundColor: '#6D28D9',
                        color: 'white',
                        borderRadius: 3,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        })
    }


    function loadStudentChart(data) {

        let labels = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];
        let dataPoints = [data.student_count.grade_7,
            data.student_count.grade_8,
            data.student_count.grade_9,
            data.student_count.grade_10
        ]

        var ctx = document.getElementById('chart_student')

        var colors = []

        for (let index = 0; index < labels.length; index++) {
            colors.push(randomColor())
        }
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: ['Student count'],
                    data: dataPoints,
                    backgroundColor: colors,
                    borderColor: [
                        'transparent'
                    ],
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels],
            options: {

                plugins: {
                    datalabels: {
                        display: true,
                        formatter: (value, ctx) => {
                            return ctx.chart.data.datasets[0].data[ctx.dataIndex]
                        },
                        backgroundColor: '#6D28D9',
                        color: 'white',
                        borderRadius: 3,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        })
    }

    function loadStudentGradeChart(data) {

        let labels = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];


        let min_grades = [
            data.grade_7_grades[0].min_grade,
            data.grade_8_grades[0].min_grade,
            data.grade_9_grades[0].min_grade,
            data.grade_10_grades[0].min_grade
        ]
        let max_grades = [
            data.grade_7_grades[0].max_grade,
            data.grade_8_grades[0].max_grade,
            data.grade_9_grades[0].max_grade,
            data.grade_10_grades[0].max_grade
        ]
        let avg_grades = [
            data.grade_7_grades[0].avg_grade,
            data.grade_8_grades[0].avg_grade,
            data.grade_9_grades[0].avg_grade,
            data.grade_10_grades[0].avg_grade
        ]

        var ctx_g = document.getElementById('chart_grades')


        var chart = new Chart(ctx_g, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'MIN',
                        data: min_grades,
                        backgroundColor: [
                            'dodgerblue'
                        ],
                        borderColor: [
                            'transparent'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'MAX',
                        data: max_grades,
                        backgroundColor: [
                            '#6D28D9'
                        ],
                        borderColor: [
                            'transparent'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'AVG',
                        data: avg_grades,
                        backgroundColor: [
                            'seagreen'
                        ],
                        borderColor: [
                            'transparent'
                        ],
                        borderWidth: 1
                    }
                ]
            },
            plugins: [ChartDataLabels],
            options: {

                plugins: {
                    datalabels: {
                        display: true,
                        formatter: (value, ctx_g) => {
                            return parseInt(value).toFixed(0)
                        },
                        backgroundColor: '#6D28D9',
                        color: 'white',
                        borderRadius: 3,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        })
    }

    function getData(school_year) {

        if (school_year != '') {

            $('.lbl_sy').text(school_year)
            $('.syp').css('display', 'block')
            $.ajax({
                url: "{{ route('report.data.get') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    school_year: school_year
                },
                dataType: 'json',
                beforeSend: () => {


                    $('#error_select_sy').text('')
                    $('#btn-generate').attr('disabled', 'disabled')
                },
                success: (data) => {

                    $('#btn-generate').removeAttr('disabled')

                    if (data.status === 0) {

                    }

                    if (data.status === 200) {

                        $('#chart_gender').remove();
                        $('.gender-div').append('<canvas id="chart_gender" style="max-height: 210px;"></canvas>')


                        $('#chart_student').remove();
                        $('.student-div').append('<canvas id="chart_student" style="max-height: 300px;"></canvas>')

                        $('#chart_grades').remove();
                        $('.student-grade-div').append('<canvas id="chart_grades" style="max-height: 300px;"></canvas>')

                        loadGenderChart(data)
                        loadStudentChart(data)
                        loadStudentGradeChart(data)
                        let subjects = data.subjects

                        $('#table-subjects tbody').html('')


                        let stats = Object.keys(subjects).reduce((acc, key) => {

                            let values = subjects[key]

                            let min = Math.min(...values).toFixed(0)
                            let max = Math.max(...values).toFixed(0)


                            let sum = values.reduce((a, b) => parseFloat(a) + parseFloat(b), 0)

                            let avg = values.length > 0 ? (sum / values.length).toFixed(0) : 0

                            return {
                                ...acc,
                                [key]: {
                                    min,
                                    max,
                                    avg
                                }
                            }

                        }, [])

                        Object.entries(stats).forEach(([key, val]) => {

                            if (key == 'Music' || key == 'Arts' || key == 'Physical Education' || key == 'Health') {
                                return
                            }

                            $('#table-subjects tbody').append(`
                            <tr>
                                <td>${key}</td>
                                <td><i class="bx bx-chevrons-down text-danger"></i> ${val.min}</td>
                                <td><i class="bx bx-chevrons-up text-success"></i>${val.max}</td>
                                <td><i class="bx bx-smile text-primary"></i>${val.avg}</td>
                            </tr>
                            `)

                        })
                    }
                },
                error: (err) => {

                    $('#btn-generate').removeAttr('disabled')
                    showErrorAlert('Connection to server error.')
                }
            })

        } else {
            $('#error_select_sy').text('please select school year')
        }

    }


    function getDataPerLevel(school_year, grade_level) {
        $.ajax({
            url: "{{ route('report.data.get') }}",
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                school_year: school_year,
                grade_level: grade_level
            },
            dataType: 'json',
            beforeSend: () => {
                $('#error_select_sy').text('')
                $('#btn-generate').attr('disabled', 'disabled')
            },
            success: (data) => {

                $('#btn-generate').removeAttr('disabled')

                if (data.status === 0) {

                }
                if (data.status === 200) {

                    $('#chart_gender_2').remove();
                    $('.gender-div-per-level').append('<canvas id="chart_gender_2" style="max-height: 210px;"></canvas>')


                    $('#min_per_level').text(data.stats_perlevel[0].min)
                    $('#avg_per_level').text(parseInt(data.stats_perlevel[0].avg).toFixed(0))
                    $('#max_per_level').text(data.stats_perlevel[0].max)

                    loadGenderChart_2(data)

                    let subjects = data.subjects_perlevel

                    $('#table-subjects-per-level tbody').html('')

                    if (subjects.length <= 0) {
                        $('#table-subjects-per-level tbody').html('')
                    }

                    let stats = Object.keys(subjects).reduce((acc, key) => {

                        let values = subjects[key]

                        let min = Math.min(...values).toFixed(0)
                        let max = Math.max(...values).toFixed(0)


                        let sum = values.reduce((a, b) => parseFloat(a) + parseFloat(b), 0)

                        let avg = values.length > 0 ? (sum / values.length).toFixed(0) : 0

                        return {
                            ...acc,
                            [key]: {
                                min,
                                max,
                                avg
                            }
                        }

                    }, [])

                    Object.entries(stats).forEach(([key, val]) => {

                        if (key == 'Music' || key == 'Arts' || key == 'Physical Education' || key == 'Health') {
                            return
                        }

                        $('#table-subjects-per-level tbody').append(`
                            <tr>
                                <td>${key}</td>
                                <td><i class="bx bx-chevrons-down text-danger"></i> ${val.min}</td>
                                <td><i class="bx bx-chevrons-up text-success"></i>${val.max}</td>
                                <td><i class="bx bx-smile text-primary"></i>${val.avg}</td>
                            </tr>
                            `)

                    })

                }
            },
            error: (err) => {

                $('#btn-generate').removeAttr('disabled')
                showErrorAlert('Connection to server error.')
            }
        })
    }

    $('#btn-generate').click(function() {
        let school_year = $('#select-sy').val()
        let grade_level = $('#select-grade').val()

        $('.lvl_ind').text($('#select-grade').val())
        $('#report-header').css('display', 'block')
        getData(school_year)
        getDataPerLevel(school_year, grade_level)

    })

    $('#btn-download').on('click', function() {
        var element = document.querySelector('#print-body')

        var opt = {
            margin: 0.2,
            filename: 'report.pdf',
            image: {
                type: 'jpeg',
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
    })
</script>
@endsection