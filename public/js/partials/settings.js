function showAlert(msg) {
    $('#msgAlert').modal('show')
    $('#msgAlert-msg').text(msg)
    $('#msgAlert-btn').css('display', 'inherit')
}

function showErrorAlert(msg) {
    $('#msgAlert').modal('show')
    $('#msgAlert-msg').text(msg)
    $('#msgAlert-icon').addClass('bx bx-error-circle')
}

function saveChanges(data, form, route) {

    console.log(form)

    $.ajax({
        url: route,
        type: 'post',
        dataType: 'json',
        data: data,
        beforeSend: () => {
            $(`${form} :input`).each(function () {
                $(this).removeClass('is-invalid')
            })
            $('.error-text').text('')
            $(`${form} :input`).prop("disabled", true)
        },
        success: (data) => {
            $(`${form} :input`).prop("disabled", false)

            if (data.status === 0) {
                $.each(data.error, function (prefix, val) {

                    $('.error_' + prefix).text(val[0]);

                    $("input[name=" + prefix + "]").addClass('is-invalid')
                })
            }

            if (data.status === 401) {
                $('.error_old_password').text(data.error);

                $("input[name=" + 'old_password' + "]").addClass('is-invalid')
            }

            if (data.status === 402) {
                $('.error_old_password_q').text(data.error);

                $("input[name=" + 'old_password_q' + "]").addClass('is-invalid')
            }


            if (data.status === 200) {
                showAlert(data.msg)
            }
        },
        error: (err) => {
            showErrorAlert('Connection to server error')
        }
    })
}
