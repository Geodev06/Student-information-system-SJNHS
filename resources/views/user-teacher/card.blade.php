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
</style>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5 mx-auto border p-2">
                <span class="fw-bold">SCHOOL FORM 9 - JHS</span>
                <div class="text-center">
                    <p>Republic of the Philippines</p>
                    <p class="fw-bold">DEPARTMENT OF EDUCATION</p>
                    <p>REGION 4-A CALABARZON</p>
                    <p>Division of San Pablo City</p>
                    <p class="fw-bold">SAN JOSE INTEGRATED HIGH SCHOOL</p>
                    <p>San Jose, San Pablo City, Laguna</p>
                </div>

                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <span class="d-flex justify-content-around border-bottom">
                            Name :
                            <span>{{$record[0]->lrn}}</span>
                            <span>{{$record[0]->lrn}}</span>
                            <span>{{$record[0]->lrn}}</span>
                        </span>
                    </div>
                </div>
            </div>


        </div>
    </div>
</body>

</html>