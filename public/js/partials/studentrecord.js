

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
        $('#table-record tbody').append(`<tr><td><input type="text" value="FILIPINO" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" value="ENGLISH" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" value="MATHEMATICS" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                             <tr>
                                                <td><input type="text" value="SCIENCE" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                             <tr>
                                                <td><input type="text" value="ARALING PANLIPUNAN (AP)" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                             <tr>
                                                <td><input type="text" value="EDUKASYON SA PAGPAPAKATAO (ESP)" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                             <tr>
                                                <td><input type="text" value="TECHNOLOGY AND LIVELIHOOD EDUCATION (TLE)" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                             <tr>
                                            <td>
                                            <span class="mx-2 fw-bold">M.A.P.E.H</span>
                                            </td>
                                            </tr>
                                             <tr>
                                                <td><input type="text" value="MUSIC" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                             <tr>
                                                <td><input type="text" value="ARTS" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                             <tr>
                                                <td><input type="text" value="PHYSICAL EDUCATION" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>
                                             <tr>
                                                <td><input type="text" value="HEALTH" class="form-control text-uppercase" name="select[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_1[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_2[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_3[]"></td>
                                                <td><input type="text" class="form-control text-uppercase" name="quarter_4[]"></td>
                                                <td><span class="badge bg-info text-white" style="font-size:10px">(auto-generated)</span></td>
                                                <td><i class="bx bx-x-circle text-danger btn-remove-row" style="cursor:pointer"></i></td>
                                            </tr>`)
    } else {
        $('#table-record tbody').html('')
    }

    if ($('#table-record tbody tr').length > 0) {
        $('#btn-save-record').removeAttr('disabled')
    } else {
        $('#btn-save-record').attr('disabled', 'disabled')
    }
})

