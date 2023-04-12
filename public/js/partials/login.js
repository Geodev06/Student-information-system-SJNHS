function errorMsg(msg) {

    $('#msgAlert').modal('show')
    $('#msgAlert-icon').addClass('text-danger')
    $('#msgAlert-icon').addClass('bx bx-error-circle')
    $('#msgAlert-msg').text(msg)
}

function login(route) {
    $('#loginForm').on('submit', function (e) {
        e.preventDefault()

        $.ajax({
            url: route,
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {
                $('#loginForm :input').prop("disabled", true)
                $('#btn-spinner').css('display', 'inherit')
            },
            success: function (data) {
                $('#btn-spinner').css('display', 'none')

                $('#loginForm :input').prop("disabled", false)

                if (data.status === 200) {
                    window.location.replace(data.redirect)
                }

                if (data.status === 401) {
                    errorMsg('Authentication failed. Invalid credentials.')
                }
            },
            error: function (err) {
                errorMsg('Connection to server error.')
            }
        })
    })
}

function resetPassword(route, data) {

    $.ajax({
        url: route,
        type: 'post',
        dataType: 'json',
        data: data,
        beforeSend: function () {

        },
        success: function (data) {

            if (data.status === 200) {
                window.location.replace(data.redirect)
            }

            if (data.status === 404) {
                errorMsg(data.msg)
            }
        },
        error: function (err) {
            errorMsg('Connection to server error.')
        }
    })
}