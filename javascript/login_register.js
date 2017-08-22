$(function() {
	$('.error').hide();
	$('.register_button').click(function() {

		// hide error messages
		$('.error').hide();
		
		// validate form here
		var username = $("input#username").val();
		if(username == ""){
			$("label#username_error").show();
			$("input#username").focus();

			return false;
		}

		var password = $("input#password").val();
		if(password == ""){
			$("label#password_error").show();
			$("input#password").focus();

			return false;
		}

		var email = $("input#email").val();
		if(email == ""){
			$("label#email_error").show();
			$("input#email").focus();

			return false;
		}

		// process form here
		var dataString = "username=" + username + "&email=" + email + "&password=" + password;
		$.ajax({
			type: "POST",
			url:	"/~buffumw/Geo/php/register.php",
			data: dataString,
			success: function() {	//this function is not getting called on success, why??
				alert(data);
			}
		});
		return false;
	});
});
