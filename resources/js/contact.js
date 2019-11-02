$(function () {

    $('#contact-form').validator();

    $('#form_email').on('change', function () {

        if ($(this).val().length > 0) {
            $.ajax({
                type: "POST",
                url: '/api/check_email',
                data: {
                    email: $(this).val()
                },
                success: function (data) {
                    console.log(data);

                    if (data.state === 0) {
                        $('.check-email').html(data.message);
                        $('input[type="submit"]').attr('disabled','disabled');
                    } else {
                        $('.check-email').html('');
                        $('input[type="submit"]').removeAttr('disabled');
                    }
                }
            });
        }
    });

    /*$('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                        grecaptcha.reset();
                    }
                }
            });

            return false;
        }
    });*/
});