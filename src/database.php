<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

//Validate access is via POST REQUEST and from index.php
$method = $_SERVER['REQUEST_METHOD'];
if(strtolower($method) != 'post' || !isset($_GET['action']) || $_GET['action'] != 'register') {
	echo "You may not access this page directly. Please go back to the 
	<a href=http://localhost/myhost-exemple/Final%20Project/src/index.php>Login</a> page";
}

//Register New User
if(isset($_GET['action']) && $_GET['action'] == 'register') {
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$e_mail = $_POST['e_mail'];
	$password = $_POST['password'];	
	$dob = $_POST['dob'];
	
	//Validate User Input
		
		
		
	//Connect to MySQL
	$mysqli = connectToSql();
	
	//Save New User to Database & Start Session
	if(setSqlNewUser($_POST, $mysqli)) {
		session_start();
		session($_POST);
		echo "user_registered";
	}
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
		 return false;
	}	
	
	//Prepared Statement - bind and execute 
	if (!$stmt->bind_param('sssss', $f_name, $l_name, $email, $pass, $dob)) {
		//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "An error occurred while communicating with the database server. Please try again later.";
		return false;
	}	
	
	if (!$stmt->execute()) {
		//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "An error occurred while communicating with the database server. Please try again later.";
		return false;
	}
	
	$stmt->close();		//close statement
	return true;
}

//Track Session
function session($http) {
	//Start and End session

	if(isset($http['action']) && $http['action'] == 'end') {
		//End session
		$_SESSION = array();
		session_destroy();
		
		//Redirect user
		$redirect = "http://localhost/myhost-exemple/Final%20Project/src/index.php";
		header("Location: {$redirect}", true);
		die();			
	}
	
	//Set username and user status as logged in
	if(session_status() == PHP_SESSION_ACTIVE && !isset($_SESSION['loggedIn'])) {
		if(isset($http['f_name'])) {
			$_SESSION['f_name'] = $http['f_name'];
		}
		
		//Set user status as logged in
		if(!isset($_SESSION['loggedIn'])) {
			$_SESSION['loggedIn'] = true;
		}	
	}
}
?>