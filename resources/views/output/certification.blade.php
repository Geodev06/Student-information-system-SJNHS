                <footer>
                    <div class="color-brown">
                        CERTIFICATION
                    </div>
                    <div class="certification">
                        <p class="pt-2">
                            I CERTIFY that this is a true record of
                            <span>{{ $student[0]->firstname .' '.$student[0]->middlename  .' '.$student[0]->lastname . ''. $student[0]->name_ext ?? ''  }}</span>
                            with LRN <span>{{$student[0]->lrn}}</span>
                            and that he/she is eligible for admission to Grade <span>______</span>
                        </p>
                        <p class="">
                            Name of School <span>{{ $requestdata['school_req'] ?? '' }}</span>
                            School ID: <span>{{ $requestdata['school_req_id'] ?? '' }}</span>
                            Last School Year Attended: <span>_______________</span>
                        </p>

                        <div class="d-flex justify-content-around align-items-center pt-2">
                            <div class="text-center">
                                <p>
                                    <span>{{ now()->format('M/d/Y')}}</span>
                                </p>
                                <p>Date</p>
                            </div>

                            <div class="text-center">
                                <p>
                                    <span>{{ Auth::user()->admin_name ?? '' }}</span>
                                </p>
                                <p>Signature of Principal's/School Head over Printed Name</p>
                            </div>

                            <div class="text-center">
                                <p>
                                    (Affix School Seal here)
                                </p>

                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-between align-items-around">
                        <span style="text-decoration:none; font-size: 8px;"> For Transfer Out / JHS Completer Only</span>
                        <span style="text-decoration:none; font-size: 8px;"> SFRT Revised 2017</span>
                    </div>
                </footer>