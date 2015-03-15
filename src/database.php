<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

//Validate access is via POST REQUEST and from index.php
$method = $_SERVER['REQUEST_METHOD'];
if(strtolower($method) != 'post' || !isset($_GET['action']) || ($_GET['action'] != 'register' &&
	$_GET['action'] != 'login')) {
	echo "You may not access this page directly. Please go back to the 
	<a href=http://localhost/myhost-exemple/Final%20Project/src/index.php>Login</a> page";
}

//Register New User
if(isset($_GET['action']) && $_GET['action'] == 'register') {
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$e_mail = $_POST['emailAddress'];
	$password = $_POST['userPass'];	
	$dob = $_POST['dob'];
			
	//Connect to MySQL
	$mysqli = connectToSql();
	
	//Confirm user does not already exist (key = email)
	
	
	//Save New User to Database & Start Session
	if(setSqlNewUser($_POST, $mysqli)) {
		session_start();
		session($_POST);
		echo "user_registered";
	}
}

//Login Existing User
if(isset($_GET['action']) && $_GET['action'] == 'login') {
	$inputEmail = $_POST['memberEmail'];
	$inputPass = $_POST['memberPass'];		
		
	//Connect to MySQL
	$mysqli = connectToSql();

	//Validate if user exists in database
	$DbUserAndPass = getUserAndPassword($mysqli);		//Get all users & passwords from database
	$jsonStr = json_encode($DbUserAndPass);				//encode to JSON string
	
	if(isEmailInDb($DbUserAndPass, $inputEmail) == true)	//Validate Email		
		echo "member_exists";

	

}

//Add New Quote
if(isset($_GET['action']) && $_GET['action'] == 'add_quote') {
	$quote_title = $_POST['quote_title'];
	$quote = $_POST['quote'];
	$quote_topic = $_POST['quote_topic'];
			
	//Connect to MySQL
	$mysqli = connectToSql();
	
	//Save New User to Database & Start Session
	if(setSqlNewUser($_POST, $mysqli)) {
		session_start();
		session($_POST);
		echo "quote_added";
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
	$e_mail = $http['emailAddress'];
	$pass = $http['userPass'];
	$dob = $http['dob'];
	
	//Prepared Statement - prepare
	if (!($stmt = $mysqli->prepare("INSERT INTO users(f_name, l_name, email, password, dob) VALUES (?, ?, ?, ?, ?)"))) {
		 //echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		 echo "An error occurred while communicating with the database server. Please try again later.";
		 return false;
	}	
	
	//Prepared Statement - bind and execute 
	if (!$stmt->bind_param('sssss', $f_name, $l_name, $e_mail, $pass, $dob)) {
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

//Confirm User Exists in Database
function getUserAndPassword($mysqli) {
	$e_mail = NULL;
	$password = NULL;
	
	//Prepared Statement - prepare
	if (!($stmt = $mysqli->prepare("SELECT email, password FROM users"))) {
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		echo "An error occurred while communicating with the database server. Please try again later."; 
	}
	
	//Prepared Statement - execute
	if (!$stmt->execute()) {
		//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "An error occurred while communicating with the database server. Please try again later.";
	}

	//Bind results
	if (!$stmt->bind_result($e_mail, $password)) {
	    //echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		echo "An error occurred while communicating with the database server. Please try again later.";
	}
	
	//Store result in array
	$arrOuter = array();
	$arrInner = array();
	while($stmt->fetch()) {
		$arrInner = [$e_mail, $password];
		array_push($arrOuter, $arrInner);		
	}
	
	$stmt->close();	
	return $arrOuter;
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

function isEmailInDb($DbUserAndPass, $inputEmail) {
	foreach($DbUserAndPass as $dbEmail) {
		if($dbEmail[0] == $inputEmail)
			return true;
	}
	return false;
}

?>