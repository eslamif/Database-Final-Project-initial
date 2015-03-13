$(document).ready(

//Register New User
function() {
	$('#register').click(function() {
		//Validate Registration Form user inputs
		if(validateRegForm() == false) {
			alert("Please fix the inputs highlighted in red");
			return false;
		}
		
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
},

//Login Existing User
function() {
	$('#login').click(function() {
		$.post("database.php?action=login", 
		{
			e_mail: $('#e_mail').val(),
			password: $('#password').val()
		}, 
			function(httpResponse) {
				//Redirect to Member's Page
				if(httpResponse == "member_exists") {
					window.location = "http://localhost/myhost-exemple/Final%20Project/src/members.php";
				}
			});
	}); 
}

); //end $(document).ready




//Unhide Registration Form
function unhideRegForm() {
	//Set all registration form inputs as invalid
	validFirstName = false;
	
	//Unhide Registration Form
	$('#registerForm').css("display", "block");
}

//Validate First Name of Registration Form
function validateFirstName() {
		$.post("input_validation.php?action=validate&validate=f_name",
		{f_name: $('#f_name').val()},
		function(httpResponse) {
			if(httpResponse == 'invalid') {
				$('#f_name').css("background-color", "red");
				alert("Your first name is invalid. Please enter a name with 20 or less letters.");
				validFirstName = false;
			}
			else {
				$('#f_name').css("background-color", "transparent");
				validFirstName = true;
			}
		});
}

//Validate Registration Form user inputs
function validateRegForm() {
	if(validFirstName == false)
		return false;
}
