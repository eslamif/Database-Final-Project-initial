$(document).ready(

//Register New User
function() {
	$('#register').click(function() {
		$.post("phpFunctions.php?action=register", 
		{
			f_name: $('#f_name').val(), 
			l_name: $('#l_name').val(),
			email: $('#email').val(),
			pass: $('#pass').val(),
			dob: $('#dob').val()
		}, 
			function(httpResponse) {
				$('#regConfirmation').text(httpResponse);
			});
	}); 
}




); //end $(document).ready

function unhideRegForm() {
	$('#loginForm').css("display", "block");
}