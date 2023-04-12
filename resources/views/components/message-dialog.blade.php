<div class="modal fade" id="msgBox" tabindex="-1" aria-labelledby="msgBox" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="d-flex flex-column p-4 align-items-baseline">
                    <div class="d-flex mb-2">
                        <span class="bx bx-shield fs-4"></span>
                        <h5>Promp Message</h5>
                    </div>
                    <p style="font-size: 12px;" id="msg-box-text"></p>
                </div>
            </div>
            <div class="bg-light p-2">
                <div class="d-flex float-end">
                    <!-- logout -->
                    <button class="btn btn-default btn-sm m-2" id="msgBox-btn-cancel">Cancel</button>
                    <button class="btn btn-primary btn-sm m-2" id="msgBox-btn-confirm" style="display: none;">Confirm</button>

                    <!-- delete subject -->
                    <button class="btn btn-primary btn-sm m-2" id="msgBox-delete-subj" style="display: none;">Confirm</button>
                    <!-- delete student-info -->
                    <button class="btn btn-primary btn-sm m-2" id="msgBox-delete-student-info" style="display: none;">Confirm</button>

                    <!-- delete academic-record -->
                    <button class="btn btn-primary btn-sm m-2" id="msgBox-delete-acads" style="display: none;">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>