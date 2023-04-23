@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user/style.css')}}">

<style>
    .is-hidden {
        display: none;
    }
</style>
<div class="p-5">
    <div class="d-flex justify-content-between mb-3">
        <h6 class="fw-bold ">My Class</span></h6>

    </div>

    <div class="row bg-light p-3 rounded-3">
        <div class="col-lg-8"></div>
        <div class="col-lg-4 mb-3">
            <input type="text" class="form-control" placeholder="search" id="txt-search" onkeyup="search(this.value)">
        </div>
        @if(count($sections) > 0)
        @foreach($sections as $section)
        <div class="col-lg-4 col-md-6 mb-3 section" data-section="{{ $section['section'] }} " data-sy="{{$section['school_year']}}" data-grade_level="{{$section['grade_level']}}">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center p-3 bg-primary text-white">
                    <div class="d-flex flex-column">
                        <h1 class="fw-bold">{{ $section['student_count']}} </h1>
                        <p class="m-0" style="font-size: 12px;">No. of students</p>
                    </div>
                    <div>
                        <i class="bx bx-user fs-1"></i>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-uppercase fw-bold">{{ $section['section']}} </h5>
                        <h6 class="text-uppercase fw-bold text-muted">SY. {{ $section['school_year']}} </h6>
                    </div>
                    <p class="m-0 text-primary" style="font-size: 12px;">Grade {{$section['grade_level']}}</p>
                    <a href="{{ route('teacher.class.get',$section['id'])}}" class="btn btn-primary rounded-5 btn-sm float-end">View</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-lg-12">
            <p>You don't have classes.</p>
        </div>
        @endif
    </div>
</div>

<script>
    function search(value) {
        const section = document.querySelectorAll('.section')

        for (let i = 0; i < section.length; i++) {
            // console.log(section[i].dataset.name)
            if (section[i].dataset.section.includes(value.toLowerCase()) ||
                section[i].dataset.sy.includes(value.toLowerCase()) ||
                section[i].dataset.grade_level.includes(value.toLowerCase())) {
                section[i].classList.remove('is-hidden')
            } else {
                section[i].classList.add('is-hidden')
            }
        }
    }
</script>
@endsection