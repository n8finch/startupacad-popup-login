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

    $(document).ready(function() {
        console.log('n8f-pop- load');

        // $('#popup-email').on('focus', function() {
        //     console.log('focus');
        // });

        $("#popup-submit").on('click', function(event) {
            event.preventDefault();
            var regEmail = $('#popup-email').val();
            console.log('Value: ' + regEmail);

            var $apiURL, $inputParams;

            $apiURL = 'http://startupacademy.staging.wpengine.com/wp-content/plugins/membermouse/api/request.php?q=/createMember';

            $inputParams = "apikey=jpuqzijsv9&apisecret=jqsdfh90gg&";
            $inputParams += "email="+ regEmail + "&";
            $inputParams += "membership_level_id=3&";

            $.ajax({
                method: "POST",
                url: $apiURL,
                data: $inputParams

            }).done(function( res ) {
                console.log( "Response: " + res );
              }).fail(function( res ) {
                console.log( res );
              });

        });


    });

}(jQuery));
