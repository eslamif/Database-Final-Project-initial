$(document).ready(

//Register New User
function() {
	$('#register').click(function() {
		//Validate Registration Form user inputs
		if(validateRegForm() == false) {
			alert("Please ensure you completed all fields and that all errors highlighted in red are fixed.");
			return false;
		}
				
		$.post("database.php?action=register", 
		{
			f_name: $('#f_name').val(), 
			l_name: $('#l_name').val(),
			emailAddress: $('#emailAddress').val(),
			userPass: $('#userPass').val(),
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
			emailAddress: $('#emailAddress').val(),
			userPass: $('#userPass').val()
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
	validLastName = false;
	validEmailAddress = false;
	validUserPassword = false;
	
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

//Validate Last Name of Registration Form
function validateLastName() {
		$.post("input_validation.php?action=validate&validate=l_name",
		{l_name: $('#l_name').val()},
		function(httpResponse) {
			if(httpResponse == 'invalid') {
				$('#l_name').css("background-color", "red");
				alert("Your last name is invalid. Please enter a name with 20 or less letters.");
				validLastName = false;
			}
			else {
				$('#l_name').css("background-color", "transparent");
				validLastName = true;
			}
		});
}

//Validate Email of Registration Form
function validateEmailAddress() {
		$.post("input_validation.php?action=validate&validate=emailAddress",
		{emailAddress: $('#emailAddress').val()},
		function(httpResponse) {
			if(httpResponse == 'invalid') {
				$('#emailAddress').css("background-color", "red");
				alert("Your E-mail is invalid. Please enter a proper e-mail address.");
				validEmailAddress = false;
			}
			else {
				$('#emailAddress').css("background-color", "transparent");
				validEmailAddress = true;
			}
		});
}

//Validate Password of Registration Form
function validatePassword() {
		$.post("input_validation.php?action=validate&validate=userPassword",
		{userPass: $('#userPass').val()},
		function(httpResponse) {
			if(httpResponse == 'invalid') {
				$('#userPass').css("background-color", "red");
				alert("Your Password is invalid. Please ensure it's between 6-10 characters.");
				validUserPassword = false;
			}
			else {
				$('#userPass').css("background-color", "transparent");
				validUserPassword = true;
			}
		});	
}

//Confirm all user inputs for the Registration Form are valid
function validateRegForm() {
	if(validFirstName == true && validLastName == true && validEmailAddress == true
		&& validUserPassword == true)
		return true;
	else
		return false;
}

//Unhide Add Quote Form
function unhideAddQuote() {
	$('#newQuoteForm').css("display", "block");		
}
