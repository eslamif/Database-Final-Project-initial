$(document).ready(

//Register New User
function() {
	$('#register').click(function() {
		$.post("database.php?action=register", 
		{
			f_name: $('#f_name').val(), 
			l_name: $('#l_name').val(),
			e_mail: $('#e_mail').val(),
			password: $('#password').val(),
			dob: $('#dob').val()
		}, 
			function(httpResponse) {
				//$('#regConfirmation').text(httpResponse);

				//Redirect New Member to Member's Page
				if(httpResponse == "user_registered") {
					window.location = "http://localhost/myhost-exemple/Final%20Project/src/members.php";
				}
			});
	}); 
} 

); //end $(document).ready

function unhideRegForm() {
	$('#registerForm').css("display", "block");
}

