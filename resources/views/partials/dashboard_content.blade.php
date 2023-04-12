@extends('layouts.dashboard')

@section('content')
<style>
    #calendar-container {
        width: 100%;
        height: 200px;
        font-size: 10px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .fc-header-toolbar {
        /*
    the calendar will be butting up against the edges,
    but let's scoot in the header's buttons
    */

        color: white;
        padding-top: 2px;
        padding-left: 2px;
        padding-right: 2px;
    }

    #calendar-container button {
        background-color: #6D28D9;
        border: none;
    }

    .fc .fc-daygrid-day-number,
    .fc-col-header-cell-cushion {
        text-decoration: none;
        color: rgb(67, 67, 67);
    }

    .fc .fc-day-today {
        background-color: #6D28D9 !important;
        border: none !important;
    }

    .fc-day-today .fc-daygrid-day-number {
        color: white;
    }
</style>
<div class=" p-5">
    <div class="row border p-3 mb-3">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div class="card-body  p-3 d-flex justify-content-between">
                        <div class="d-flex flex-column">
                            <h4>Students</h4>
                            <p style="font-size: 12px;">Total no. of student records .</p>
                        </div>
                        <h1 class="fw-bold text-secondary">{{ $data['student'] }}</h1>
                    </div>
                </div>

                <div class="col-lg-12 mb-2">
                    <div class="card-body  p-3 d-flex justify-content-between">
                        <div class="d-flex flex-column">
                            <h4>Academic records</h4>
                            <p style="font-size: 12px;">Total No of academic records saved.</p>
                        </div>
                        <h1 class="fw-bold text-secondary">{{ $data['acads'] }}</h1>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="card-body  p-3">

                <div id='calendar-container'>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row border p-3">
        <div class="col-lg-12">
            <h5>Recently released.</h4>
                <table class="table table-striped" style="font-size: 12px;">
                    <thead style="font-size: 12px;">
                        <tr>
                            <th style="font-weight:100;">Details</th>
                            <th style="font-weight:100;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['releases'] as $release)
                        <tr>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">LRN - [{{ $release->lrn}}]</span>
                                    <span class="text-muted" style="font-size: 12px;">{{ $release->name_of_school}}</span>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold" style="font-size: 12px;"> {{ $release->created_at->format('m-d-Y')}}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

<script src="{{asset('./js/fullcalendar/index.global.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            height: '100%',
            expandRows: true,
            slotMinTime: '08:00',
            slotMaxTime: '20:00',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            initialDate: new Date(),

            nowIndicator: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: []
        });

        calendar.render();
    });
</script>
@endsection