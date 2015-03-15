<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">	
	<title>Wiki Quote</title>
</head>

<body>
	<h2>Quote Wiki</h2>
	<h3>Life Lessons Frozen in Time</h3>
	
	<!-- Member Login -->
	<div>
		<form id="currentMembers">
		<fieldset>
		<legend>Members</legend>
			<ul>
				<li>
					<label>Email:</label>
					<input id="memberEmail" type="text" name="memberEmail"> 
				</li>
				
				<li>
					<label>Password:</label>
					<input id="memberPass" type="password" name="memberPass"> 
				</li>		
			</ul>
			<input id="memberLogin" type="button" value="Login" onClick="loginMember()"> 
		</fieldset>
		</form>
	</div>
	</br>
		
	<!-- Register New Account -->		
	<div id="newUser">
		<input id="createAccount" type="button" value="Create New Account" onClick="unhideRegForm()">	
		</br>
		</br>
		<div id="registerForm" style="display: none;">	
			<form id="newMembers">
			<fieldset>
			<legend>Register New Account</legend>
				</br>
				<label>Please complete the following</label>
				<ul>
					<li>
						<label>First Name:</label>
						<input id="f_name" type="text" name="f_name" onblur="validateFirstName()"> 
						<label>(20 or less letters)</label>
					</li>
					
					<li>
						<label>Last Name:</label>
						<input id="l_name" type="text" name="l_name" onblur="validateLastName()"> 
						<label>(20 or less letters)</label>
					</li>		
					
					<li>
						<label>Email:</label>
						<input id="emailAddress" type="text" name="emailAddress" onblur="validateEmailAddress()">
					</li>
					
					<li>
						<label>Password:</label>
						<input id="userPass" type="password" name="userPass" onblur="validatePassword()"> 
					</li>		
					
					<li>
						<label>DOB:</label>
						<input id="dob" type="date" name="dob"> 
					</li>						
				</ul>
				<input id="register" type="button" value="Register"> 
			</fieldset>
			</form>
		</div>
	</div>
	
	<script type="text/javascript" src="http://localhost/myhost-exemple/Final%20Project/src/jquery.js"></script>	
	<script type="text/javascript" src="http://localhost/myhost-exemple/Final%20Project/src/jsFunctions.js"></script>
</body>
</html>