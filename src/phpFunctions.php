<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

//Validate Access via POST REQUEST ONLY
$method = $_SERVER['REQUEST_METHOD'];
if(strtolower($method) != 'post') {
	echo "You may not access this page directly. Please go back to the 
	<a href=http://localhost/myhost-exemple/Final%20Project/src/>Login</a> page";
}

//Register New User
if(isset($_GET['action']) && $_GET['action'] == 'register') {
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$e_mail = $_POST['e_mail'];
	$password = $_POST['password'];	
	$dob = $_POST['dob'];
	
	//Connect to MySQL
	$mysqli = connectToSql();
	
	//Save New User to Database
	setSqlNewUser($_POST, $mysqli);
	
	//echo $f_name;
	echo "hi";
}






/*------------------- PHP FUNCTION DEFINITIONS -------------------*/
//Connect to mySQL
function connectToSql() {
	//Database access info
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "quote_wiki";
	
	//Connect to MySQL Server
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($mysqli->connect_errno) {
		echo "An error occurred while connecting to the database server. Please try again later.";
		//echo $mysqli->connect_errno . " $mysqli->connect_errno.";
	}
	return $mysqli;
}	

//Register New Users in Database
function setSqlNewUser($http, $mysqli) {
	//Variables to set
	$f_name = $http['f_name'];
	$l_name = $http['l_name'];
	$email = $http['e_mail'];
	$pass = $http['password'];
	$dob = $http['dob'];
	
	//Prepared Statement - prepare
	if (!($stmt = $mysqli->prepare("INSERT INTO users(f_name, l_name, email, password, dob) VALUES (?, ?, ?, ?, ?)"))) {
		 //echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		 echo "An error occurred while communicating with the database server. Please try again later.";
	}	
	
	//Prepared Statement - bind and execute 
	if (!$stmt->bind_param('sssss', $f_name, $l_name, $email, $pass, $dob)) {
		//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "An error occurred while communicating with the database server. Please try again later.";
	}	
	
	if (!$stmt->execute()) {
		//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "An error occurred while communicating with the database server. Please try again later.";
	}
	
	$stmt->close();		//close statement
}
?>