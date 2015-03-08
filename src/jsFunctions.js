$(document).ready(

//Register user
function() {
	$('#register').click(function() {
		$.post("phpFunctions.php", {}, 
			function(regResponse) {
				$('#regConfirmation').text(regResponse);
			});
	}); 
}




); 

function unhideRegForm() {
	$('#loginForm').css("display", "block");
}