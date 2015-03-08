$(document).ready(

//Register user
function() {
	$('#register').click(function() {
		$.post("phpFunctions.php?action=register", 
		{
			f_name: $('#f_name').val(), 
			l_name: $('#l_name').val(),
			email: $('#email').val(),
			pass: $('#pass').val()
		}, 
			function(regResponse) {
				$('#regConfirmation').text(regResponse);
			});
	}); 
}




); 

function unhideRegForm() {
	$('#loginForm').css("display", "block");
}