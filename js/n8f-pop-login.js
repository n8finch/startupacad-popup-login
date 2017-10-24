(function($) {

    //Prep all the keys and functions to disable scroll with the modal opens
    //http://output.jsbin.com/xatidu/4/
    var keys = { 37: 1, 38: 1, 39: 1, 40: 1 };
	var shoulLockPopup = ajax_login_object.lockpopup;

	if ( 'yes' === shoulLockPopup ) {
		shoulLockPopup = true;
	} else {
		shoulLockPopup = false;
	}

    function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault)
            e.preventDefault();
        e.returnValue = false;
    }

    function preventDefaultForScrollKeys(e) {
        if (keys[e.keyCode]) {
            preventDefault(e);
            return false;
        }
    }

    function disableScroll() {
        if (window.addEventListener) // older FF
            window.addEventListener('DOMMouseScroll', preventDefault, false);
        window.onwheel = preventDefault; // modern standard
        window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
        window.ontouchmove = preventDefault; // mobile
        document.onkeydown = preventDefaultForScrollKeys;
    }

    function enableScroll() {
        if (window.removeEventListener)
            window.removeEventListener('DOMMouseScroll', preventDefault, false);
        window.onmousewheel = document.onmousewheel = null;
        window.onwheel = null;
        window.ontouchmove = null;
        document.onkeydown = null;
    }


    $(function() {
        $("#n8f-popup-login-message").tabs();
    });


    //Get Window Screen Width

    var screenWidth, screenHeight, dialogWidth, dialogHeight, isDesktop;

    screenWidth = window.screen.width;
    screenHeight = window.screen.height;

    if ( screenWidth < 500 ) {
        dialogWidth = screenWidth * .95;
        dialogHeight = screenHeight * .95;
    } else {
        dialogWidth = 600;
        dialogHeight = 550;
        isDesktop = true;
    }

    setTimeout(function(){
      $(function() {
          $("#n8f-popup-login-message").dialog({
              title: 'Welcome to Startup Academy!',
              draggable: !shoulLockPopup,
              modal: true,
			  height: dialogHeight,
              width: dialogWidth,
              closeOnEscape: !shoulLockPopup,
              open: function() {
                if(isDesktop && shoulLockPopup) {
                  disableScroll();
			  	}
              }
          });

      });
    }, 2000);





    $(document).ready(function() {

		//Toggle tabs from below
		$('.popup-main-content #login-link').on('click', function(e) {
			e.preventDefault();
			$('li#tabs-2').trigger('click');
		});

        //Register the visitor

        $("#popup-submit-register").on('click', function(event) {
            event.preventDefault();
            var regEmail = $('#popup-email-register').val();
            console.log('Value: ' + regEmail);

            var $apiURL, $inputParams;

            // $apiURL = 'https://www.startupacademy.org/wp-content/plugins/membermouse/api/request.php?q=/createMember';
            $apiURL = ajax_login_object.redirecturl;

			console.log('$apiURL: ' + $apiURL );

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
                    console.log(resData);

                    $('#tabs-1 p.status').text('Getting you registered and logged in.');
                    $('form#login #username').val(resData.username);
                    $('form#login #password').val(resData.password);
                    $('form#login').trigger("submit");
                    debugger;
                }
            }).fail(function(res) {
                console.log('Failed request');
            });

        });



        var loginUser = function(username, password) {
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

                        console.log('user logged in automatically');

                    }
                }
            });
            e.preventDefault();
        };

		// Perform AJAX login on form submit
        $('form#login').on('submit', function(e) {
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

                        console.log('user logged in automatically');
                    }
                }
            });
            e.preventDefault();
        });


		//Show message on modals if they shouldn't be locked.
		if(!shoulLockPopup) {
			$(window).on('click', function() {
				setTimeout(function() {
					$('#press-esc-to-close').remove();
					$('.ui-dialog-titlebar').next().prepend('<p id="press-esc-to-close" style="text-align: right; font-size: 14px;">Press Esc to close...</p>');
				}, 3000);

			});

		}



    });//end document.ready function

}(jQuery));
