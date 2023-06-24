 <div class="record-container">
     <div class="record-header">
         <div class="d-flex justify-content-between align-items-center">
             <p>School: <span>{{$value['school'] ?? '' }}</span></p>
             <p>School ID: <span>{{$value['school_id'] ?? '' }}</span></p>
             <p>District: <span>{{$value['district'] ?? '' }}</span></p>
             <p>Division: <span>{{$value['division'] ?? '' }}</span></p>
             <p>Region: <span>{{$value['region'] ?? '' }}</span></p>
         </div>

         <div class="d-flex justify-content-between align-items-center">
             <p>Classified as Grade: <span>{{$value['classified_grade'] ?? '' }}</span></p>
             <p>Section: <span>{{$value['section'] ?? '' }}</span></p>
             <p>School year: <span>{{$value['school_year'] ?? '' }}</span></p>
             <p>Name of Adviser/Teacher: <span>{{$value['adviser'] ?? '' }}</span></p>
             <p>Signature: <span>_____________</span></p>
         </div>
     </div>

     <table class="table-data">

         <tbody>
             <tr>
                 <td class="text-center fw-bold" rowspan="2">LEARNING AREAS</td>
                 <td class="text-center fw-bold" colspan="4">Quarterly Rating</td>
                 <td class="text-center fw-bold" style="width: 15%;">FINAL RATING</td>
                 <td class="text-center fw-bold">REMARKS</td>
             </tr>
             <tr class="text-center">

                 <td class="fw-bold">1</td>
                 <td class="fw-bold">2</td>
                 <td class="fw-bold">3</td>
                 <td class="fw-bold">4</td>
                 <td></td>
                 <td></td>
             </tr>
             @foreach($value['data'] as $dt)
             @foreach($dt as $subject => $quarter)
             <tr>

                 @if($subject == 'Music' ||$subject == 'Arts' ||$subject == 'Physical Education' ||$subject == 'Health' )
                 <td class=" fw-light px-2 fst-italic ">{{$subject}}</td>
                 @else
                 <td class=" fw-bold ">{{$subject}}</td>
                 @endif

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
                 <td class="text-center fw-bold"> {{$value['gen_ave'] ?? '' }}</td>
                 <td class="text-center fw-bold">{{$value['gen_ave'] >= 75 ? 'PASSED':'FAILED' }}</td>
             </tr>
         </tbody>
     </table>

     <div class="record-break"></div>


     <!-- Remedial -->
     <table class="">
         <thead>
             <th class="fw-bold text-end">Remedial Classes</th>
             <th class="text-center">Conducted from (mm/dd/yyyy): <span>{{ $value['remedial_date_from'] ?? ''}}</span></th>
             <th class="text-start">To (mm/dd/yyyy): <span>{{ $value['remedial_date_to'] ?? ''}}</span></th>
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
             @foreach($value['remedials'] as $data)
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