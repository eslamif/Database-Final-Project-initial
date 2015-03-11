<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

//Validate access is via POST REQUEST and from index.php
$method = $_SERVER['REQUEST_METHOD'];
if(strtolower($method) != 'post' || !isset($_GET['action']) || $_GET['action'] != 'validate') {
	echo "You may not access this page directly. Please go back to the 
	<a href=http://localhost/myhost-exemple/Final%20Project/src/index.php>Login</a> page";
}

//Validate First Name
if(isset($_GET['validate']) && $_GET['validate'] == 'f_name') {
	$f_name = $_POST['f_name'];
	if(validateName($f_name) == 0)
		echo "invalid";	
	else if(validateName($f_name) == 1)
		echo "valid";
}



/*------------------- PHP FUNCTION DEFINITIONS -------------------*/
//Validate Name
function validateName($name) {
	if (!preg_match('/[^A-Za-z]+/', $name) && strlen($name) <= 20)
		return 1;	//name is valid
	else
		return 0;
}
?>
