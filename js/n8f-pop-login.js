(function($) {

    $(function() {
        $("#tabs").tabs();
    });

    $(function() {
        $("#n8f-popup-login-message").dialog({
            title: 'You need to register.',
            modal: true,
            height: 450,
            width: 400,
            closeOnEscape: false,
        });



    });



    $('#n8f-pop-register-button').on('click', function(e) {
        // Stop the browser from submitting the form.
        var formData = $('#n8f-pop-reg-email-addy').text();

        console.log(formData);
    });

}(jQuery));
