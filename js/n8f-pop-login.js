(function($) {



    $(function() {
        $("#n8f-popup-login-message").dialog({
            title: 'You need to register.',
            modal: true,
            height: 350,
            width: 400,
            buttons: {
                Ok: function() {
                    $(this).dialog("close");
                }
            }
        });
    });



}(jQuery));
