

$('#btn-add-row-remedial').click(function () {
    $('#table-remedial tbody').append(`
        <tr>
            <td><input type="text" class="form-control text-uppercase" name="remedials[]"></td>
            <td><input type="text" class="form-control text-uppercase" name="remedials_rating[]"></td>
            <td><input type="text" class="form-control text-uppercase" name="remedials_class_mark[]"></td>
            <td><input type="text" class="form-control text-uppercase" name="remedials_final_grades[]"></td>
            <td><input type="text" class="form-control text-uppercase" name="remedials_remarks[]"></td>
            <td><i class="bx bx-x-circle text-danger btn-remove-row-remedial" style="cursor:pointer"></i></td>
        </tr>`)
})

$('#table-record').on('click', '.btn-remove-row', function (e) {

    if ($('#table-record tbody tr').length - 1 <= 0) {
        $('#btn-save-record').attr('disabled', 'disabled')
    }
    $(this).closest('tr').remove()

})

$('#table-remedial').on('click', '.btn-remove-row-remedial', function (e) {
    $(this).closest('tr').remove()

})

$('#useDefault').on('click', function (e) {

    if ($(this).prop('checked')) {
        $('#table-record tbody').html('')
        $('#default').val(1)
        $('#btn-add-row').css('display', 'none');
        $('#table-record tbody').append(`<tr>
                                                <td><span class="text-uppercase fw-bold">FILIPINO</span>
                                              
                                                <input type="hidden" value="FILIPINO" class="form-control text-uppercase" name="filipino">
                                                </td>
                                                <td><input type="number" class="form-control text-uppercase" name="filipino_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="filipino_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="filipino_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="filipino_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <span class="text-uppercase fw-bold">ENGLISH</span>
                                                <input type="hidden" value="ENGLISH" class="form-control text-uppercase" name="english"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="english_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="english_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="english_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="english_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                            <tr>
                                                <td>
                                                <span class="text-uppercase fw-bold">MATHEMATICS</span>
                                                <input type="hidden" value="MATHEMATICS" class="form-control text-uppercase" name="mathematics"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="mathematics_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="mathematics_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="mathematics_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="mathematics_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                             <tr>
                                                <td>
                                                <span class="text-uppercase fw-bold">SCIENCE</span>
                                                <input type="hidden" value="SCIENCE" class="form-control text-uppercase" name="science"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="science_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="science_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="science_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="science_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                             <tr>
                                                <td>
                                                   <span class="text-uppercase fw-bold">ARALING PANLIPUNAN (AP)</span>
                                                <input type="hidden" value="ARALING PANLIPUNAN (AP)" class="form-control text-uppercase" name="ap"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="ap_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="ap_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="ap_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="ap_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                             <tr>
                                                <td>
                                                 <span class="text-uppercase fw-bold">EDUKASYON SA PAGPAPAKATAO (ESP)</span>
                                                 <input type="hidden" value="EDUKASYON SA PAGPAPAKATAO (ESP)" class="form-control text-uppercase" name="esp"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="esp_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="esp_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="esp_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="esp_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                             <tr>
                                                <td>
                                                  <span class="text-uppercase fw-bold">TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)</span>
                                                  <input type="hidden" value="TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)" class="form-control text-uppercase" name="tle"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="tle_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="tle_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="tle_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="tle_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                              <tr>
                                                <td class="fw-bold">M.A.P.E.H</td>
                                            </tr>
                                             <tr>
                                                <td>
                                                <span class="text-uppercase">MUSIC</span>
                                                <input type="hidden" value="Music" class="form-control" name="music"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="music_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="music_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="music_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="music_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                             <tr>
                                                <td>
                                                     <span class="text-uppercase">ARTS</span>
                                                     <input type="hidden" value="Arts" class="form-control " name="arts"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="arts_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="arts_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="arts_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="arts_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                             <tr>
                                                <td>
                                                     <span class="text-uppercase">PHYSICAL EDUCATION</span>
                                                     <input type="hidden" value="Physical Education" class="form-control" name="pe"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="pe_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="pe_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="pe_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="pe_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>
                                             <tr>
                                                <td>
                                                     <span class="text-uppercase">HEALTH</span>
                                                     <input type="hidden" value="Health" class="form-control" name="health"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="health_q1"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="health_q2"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="health_q3"></td>
                                                <td><input type="number" class="form-control text-uppercase" name="health_q4"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
    
                                            </tr>`)
    } else {
        $('#table-record tbody').html('')
        $('#default').val(0)
        $('#btn-add-row').css('display', 'block');
    }

    if ($('#table-record tbody tr').length > 0) {
        $('#btn-save-record').removeAttr('disabled')
    } else {
        $('#btn-save-record').attr('disabled', 'disabled')
    }
})

