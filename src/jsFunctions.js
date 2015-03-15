$(document).ready(



//Add New Quote
function() {
	$('#addQuote').click(function() {
		//Validate newQuoteForm Form user inputs
		if(validateQuoteForm() == false) {
			alert("Please ensure you completed all fields and that all errors highlighted in red are fixed.");
			return false;
		}
				
		$.post("database.php?action=add_quote", 
		{
			quote_title: $('#quote_title').val(), 
			quote: $('#quote').val(),
			quote_topic: $('#quote_topic').val()
		}, 
			function(httpResponse) {
				//$('#regConfirmation').text(httpResponse);

				//Redirect New Member to Member's Page
				if(httpResponse == "quote_added") {
					alert("Your quoted was added successfully");
					window.location = "http://localhost/myhost-exemple/Final%20Project/src/members.php";
				}
			}); 
	}); 
}

); //end $(document).ready

//Login Existing User
function loginMember() {
	$.post("database.php?action=login", 
	{
		memberEmail: $('#memberEmail').val(),
		memberPass: $('#memberPass').val()
	}, 
		function(httpResponse) {
			if(httpResponse == "member_exists")
				//Redirect to Member's Page
				window.location = "http://localhost/myhost-exemple/Final%20Project/src/members.php";
			else
				alert("The email and password don't match an existing account. Please try again or register a new account");
		});
}

//Register New User
function registerUser() {
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
}

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

//Validate First Name 
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

//Validate Last Name 
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

//Unhide newQuoteForm
function unhideAddQuote() {
	//Set all Add Quote form inputs as invalid
	validQuoteTitle = false;
	validQuote = false;
	validQuoteTopic = false;
	
	$('#newQuoteForm').css("display", "block");		
}

//validate quoteTitle of newQuoteForm
function validateQuoteTitle() {
	var titleLength = $('#quote_title').val().length;
	if(titleLength < 4 || titleLength > 20) {
		$('#quote_title').css("background-color", "red");
		alert("Please enter a title between 4-20 characters.");
		validQuoteTitle = false;
	}
	else if(titleLength >= 4 && titleLength <= 20) {
		$('#quote_title').css("background-color", "transparent");
		validQuoteTitle = true;
	}
}

//Validate quote of newQuoteForm
function validateQuote() {
	var quote = $('#quote').val().length;
	if(quote < 8 || quote > 100) {
		$('#quote').css("background-color", "red");
		alert("Please enter a quote between 8-100 characters.");
		validQuote = false;
	}
	else if(quote >= 8 && quote <= 100) {
		$('#quote').css("background-color", "transparent");
		validQuote = true;
	}	
}

//validate quote_topic of newQuoteForm
function validateQuoteTopic() {
	var topicLength = $('#quote_topic').val().length;
	if(topicLength < 4 || topicLength > 20) {
		$('#quote_topic').css("background-color", "red");
		alert("Please enter a topic between 4-20 characters.");
		validQuoteTopic = false;
	}
	else if(topicLength >= 4 && topicLength <= 20) {
		$('#quote_topic').css("background-color", "transparent");
		validQuoteTopic = true;
	}
}

//Confirm all user inputs for the newQuoteForm are valid
function validateQuoteForm() {
	if(validQuoteTitle == true && validQuote == true && validQuoteTopic == true)
		return true;
	else
		return false;
}

//Unhide newFriend Form
function unhideAddFriend() {
	//Set all registration form inputs as invalid
	validFriendFirstName = false;
	validFriendLastName = false;
	validFriendEmailAddress = false;
	
	//Unhide Registration Form
	$('#newFriend').css("display", "block");	
}