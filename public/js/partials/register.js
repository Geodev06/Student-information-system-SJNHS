// account registration
function register(route) {
    $('#regForm').on('submit', function (e) {
        e.preventDefault()

        $.ajax({
            url: route,
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {
                $('#regForm :input').each(function () {
                    $(this).removeClass('is-invalid')
                })
                $('.error-text').text('')
                $('#regForm :input').prop("disabled", true)
                $('#btn-spinner').css('display', 'inherit')

            },
            success: function (data) {
                $('#btn-spinner').css('display', 'none')

                $('#regForm :input').prop("disabled", false)
                if (data.status === 0) {
                    $.each(data.error, function (prefix, val) {
                        $('.error_' + prefix).text(val[0]);

                        $("input[name=" + prefix + "]").addClass('is-invalid')
                    })
                }

                if (data.status === 200) {
                    $('#msgAlert').modal('show')
                    $('#msgAlert-msg').text('Account has been successfully created!')
                    setTimeout((e) => {
                        window.location.replace(data.success)
                    }, 1000)
                }

                if (data.status === 401) {
                    $('#msgAlert').modal('show')
                    $('#msgAlert-msg').text('Session expired. you will be redirected to login page.')
                    $('#msgAlert-icon').css('display', 'none')
                    setTimeout(() => {
                        window.location.replace(data.redirect)
                    }, 3000)
                }
            },
            error: function (err) {

                $('#msgAlert').modal('show')
                $('#msgAlert-msg').text('Connection to server error.')
                $('#msgAlert-icon').css('display', 'none')
            }

        })
    })
}