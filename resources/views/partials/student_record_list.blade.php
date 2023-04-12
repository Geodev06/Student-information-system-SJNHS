@if(count($student[0]->student_record) > 0)
<div class="col-lg-12">
    <style>
        .table-data {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .table-data td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .f-12 {
            font-size: 12px;
        }

        .table-data tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <div class="accordion accordion-flush card" id="accordionFlushExample">
        @foreach($student[0]->student_record as $record)
        <div class="accordion-item ">

            <h2 class="accordion-header" id="item_{{$record->id}}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id_{{$record->id}}" aria-expanded="false" aria-controls="id_{{$record->id}}">
                    <span class="fw-bold container-fluid"> ACADEMIC YEAR {{ $record->school_year}}
                        <span class="badge bg-secondary float-end"> Created {{ $record->created_at->format('m-d-Y')}} </span>
                    </span>

                </button>
            </h2>

            <div id="id_{{$record->id}}" id="record-container" class="accordion-collapse collapse" aria-labelledby="item_{{$record->id}}" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body" id="button-container">
                    <div class="d-flex justify-content-between">
                        <p style="font-size:12px">Academic record information</p>
                        <div>
                            <span class="btn-edit" data-id="{{ $record->id }}" data-lrn="{{ $record->lrn }}" style="cursor:pointer">
                                <i class="fs-3 bx bx-edit text-info mr-3"></i>
                            </span>
                            <span class="btn-delete" data-id="{{ $record->id }}" data-lrn="{{ $record->lrn }}" style="cursor:pointer">
                                <i class=" fs-3 bx bx-trash text-danger mr-3"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <table class="table-data">
                                <!-- HEADER -->
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-uppercase">school</span>
                                                <span class="text-uppercase text-muted f-12">{{ $record->school }}</span>
                                            </div>
                                        </th>

                                        <th colspan="4">
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-uppercase">school id</span>
                                                <span class="text-uppercase text-muted f-12 ">{{ $record->school_id }}</span>
                                            </div>
                                        </th>

                                        <th>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-uppercase">district</span>
                                                <span class="text-uppercase text-muted f-12">{{ $record->district }}</span>
                                            </div>
                                        </th>

                                        <th>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-uppercase">division / region</span>
                                                <span class="text-uppercase text-muted f-12">{{ $record->division .' / '. $record->region }}</span>
                                            </div>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-uppercase">Classified as grade</span>
                                                <span class="text-uppercase text-muted f-12">Grade {{ $record->classified_grade }}</span>
                                            </div>
                                        </th>


                                        <th colspan="4">
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-uppercase">section</span>
                                                <span class="text-uppercase text-muted f-12">{{ $record->section }}</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-uppercase">school year</span>
                                                <span class="text-uppercase text-muted f-12">{{ $record->school_year }}</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-uppercase">teacher/adviser</span>
                                                <span class="text-uppercase text-muted f-12">{{ $record->adviser }}</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <!-- END HEADER -->

                                <tbody>
                                    <tr>
                                        <td colspan="7"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-uppercase">Learning areas</td>
                                        <td colspan="4" class="fw-bold text-uppercase">Quarterly rating</td>
                                        <td class="fw-bold text-uppercase">Final rating</td>
                                        <td class="fw-bold text-uppercase">Remarks</td>
                                    </tr>
                                    @foreach($record->data as $data)

                                    <tr class="f-12">
                                        @foreach($data as $subject => $quarter)
                                        <td>{{$subject}}</td>
                                        <td> {{ $quarter['quarter_1']}}</td>
                                        <td> {{ $quarter['quarter_2']}}</td>
                                        <td> {{ $quarter['quarter_3']}}</td>
                                        <td>{{ $quarter['quarter_4']}}</td>
                                        <td> {{ $quarter['final']}}</td>
                                        <td class="{{ $quarter['remark'] === 'PASSED' ? 'text-success' : 'text-danger'}}"> {{ $quarter['remark']}}</td>
                                        @endforeach

                                    </tr>

                                    @endforeach
                                    <tr class="f-12">
                                        <td></td>
                                        <td colspan="4"> General average : {{$record->gen_ave}}</td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7 f-12">Remedial classes <span>Conducted from : {{ $record->remedial_date_from === null? '______________________': $record->remedial_date_from }}</span>
                                            <span>to : {{ $record->remedial_date_to === null ? '______________________' : $record->remedial_date_to }}</span>
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
                                @foreach($record->remedials as $data)
                                <tr>
                                    @foreach($data as $dt)
                                    <td class="f-12 text-uppercase">{{ $dt }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="col-lg-12 mx-4">
    <p>No academic records found!</p>
</div>
@endif
<script>
    $('#accordionFlushExample div div').on('click', ' #button-container .btn-edit', function(e) {
        var route = "{{ route('record.edit',[':id',':lrn']) }}"
        var route_2 = route.replace(':id', $(this)[0].dataset.id)
        var route_3 = route_2.replace(':lrn', $(this)[0].dataset.lrn)
        window.location.href = route_3
    })

    $('#accordionFlushExample div div').on('click', ' #button-container .btn-delete', function(e) {
        $('#msgBox-delete-subj').css('display', 'none')
        $('#msgBox-delete-student-info').css('display', 'none')
        $('#msgBox-btn-confirm').css('display', 'none')
        $('#msgBox-delete-acads').css('display', 'block')
        $('#msgBox-delete-acads').attr('data-id', $(this)[0].dataset.id)
        messageBox('Are you sure you want to delete this record with LRN of ' + $(this)[0].dataset.lrn)
    })

    $('#msgBox-delete-acads').click(function() {
        var delete_route = "{{ route('record.destroy',':id') }}"
        window.location.href = delete_route.replace(':id', $(this)[0].dataset.id)
    })

    $('#msgBox-btn-cancel').click(() => $('#msgBox').modal('hide'))
</script>