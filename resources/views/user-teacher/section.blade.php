@extends('layouts.dashboard')

@section('content')
<!-- datatables -->
<link rel="stylesheet" href="{{ asset('./dataTables/dataTables.bootsrap5.min.css')}}">
<script src="{{ asset('./dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('./dataTables/dataTables.bootstrap5.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('./css/table.css')}}">

<div class="p-5">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex flex-column">
            <h4 class="fw-bold ">{{ $section[0]->section}}</span></h4>
            <p class="m-0 text-muted" style="font-size: 12px;">Grade {{$section[0]->grade_level }}</p>
        </div>

        <span class="bx bx-arrow-back fs-5 text-primary" style="cursor: pointer;" onclick="history.back()"></span>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="w-100 table-striped" id="table-students">
                <thead>
                    <tr>
                        <th>LRN</th>
                        <th>Student name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function loadData() {
        var table = $('#table-students').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            filter: true,
            ajax: "{{ route('teacher.class.index', $section[0]->id) }}",
            columns: [{
                    data: 'lrn',
                    name: 'lrn'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },

                {
                    data: 'action',
                    name: 'action'
                }
            ],

            'lengthMenu': [
                [10, 10, 15, 20, 50, -1],
                [10, 10, 15, 20, 50, 'All'],
            ]
        })
    }

    loadData()
</script>
@endsection