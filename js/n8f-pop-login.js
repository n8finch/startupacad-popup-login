(function($) {

    $(function() {
        $("#n8f-popup-login-message").tabs();
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

    $(document).ready(function() {
        console.log('n8f-pop- load');

        //Register the visitor

        $("#popup-submit-register").on('click', function(event) {
            event.preventDefault();
            var regEmail = $('#popup-email-register').val();
            console.log('Value: ' + regEmail);

            var $apiURL, $inputParams;

            $apiURL = 'http://startupacademy.wpengine.com/wp-content/plugins/membermouse/api/request.php?q=/createMember';

            $inputParams = "apikey=jpuqzijsv9&apisecret=jqsdfh90gg&";
            $inputParams += "email=" + regEmail + "&";
            $inputParams += "membership_level_id=3&";

            $.ajax({
                method: "POST",
                url: $apiURL,
                data: $inputParams

            }).done(function(res) {
                var res = JSON.parse(res);
                var resCode = res['response_code'];
                var resData = res['response_data'];

                if (resCode === '200') {

                		console.log('success');
                		$('#tabs-1 p.status').text('Getting you registered and logged in.');
                		$('form#login #username').val(resData.username);
                    $('form#login #password').val(resData.password);
                    $('form#login').trigger( "submit" );


                }



            }).fail(function(res) {
                console.log('Failed request');
            });

        });



        var loginUser = function( username, password) {
            $('form#login p.status').show().text(ajax_login_object.loadingmessage);
            console.log('Got these: ' + username, password);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_login_object.ajaxurl,
                data: {
                    'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                    'username': $('form#login #username').val(),
                    'password': $('form#login #password').val(),
                    'security': $('form#login #security').val()
                },
                success: function(data) {
                    $('form#login p.status').text(data.message);
                    if (data.loggedin == true) {
                        document.location.href = ajax_login_object.redirecturl;
                    }
                }
            });
            e.preventDefault();
        };



        // Perform AJAX login on form submit
        $('form#login').on('submit', function() {
            $('form#login p.status').show().text(ajax_login_object.loadingmessage);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_login_object.ajaxurl,
                data: {
                    'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                    'username': $('form#login #username').val(),
                    'password': $('form#login #password').val(),
                    'security': $('form#login #security').val()
                },
                success: function(data) {
                    $('form#login p.status').text(data.message);
                    if (data.loggedin == true) {
                        document.location.href = ajax_login_object.redirecturl;
                    }
                }
            });
            e.preventDefault();
        });


    });

}(jQuery));
