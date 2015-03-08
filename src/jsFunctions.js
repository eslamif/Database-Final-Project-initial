$(document).ready(

//Register New User
function() {
	$('#register').click(function() {
		$.post("phpFunctions.php?action=register", 
		{
			f_name: $('#f_name').val(), 
			l_name: $('#l_name').val(),
			e_mail: $('#e_mail').val(),
			password: $('#password').val(),
			dob: $('#dob').val()
		}, 
			function(httpResponse) {
				$('#regConfirmation').text(httpResponse);
			});
	}); 
} 

); //end $(document).ready

function unhideRegForm() {
	$('#registerForm').css("display", "block");
}

