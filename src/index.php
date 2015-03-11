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
	<title>Wiki Quote</title>
</head>

<body>
	<h2>Quote Wiki</h2>
	<h3>Life Lessons Frozen in Time</h3>
	
	<!-- Member Login -->
	<form id="currentMembers">
	<legend>Members</legend>
		<ul>
			<li>
				<label>Email:</label>
				<input id="e_mail" type="text" name="e_mail"> 
			</li>
			
			<li>
				<label>Password:</label>
				<input id="password" type="password" name="password"> 
			</li>		
		</ul>
		<input id="login" type="button" value="Login"> 
	</form>
	</br>
		
	<!-- Register New Account -->		
	<div id="newUser">
		<input id="createAccount" type="button" value="Create New Account" onClick="unhideRegForm()">	

		<div id="registerForm" style="display: none;">	
			<form id="newMembers">
			<legend>Please complete the following</legend>
				<ul>
					<li>
						<label>First Name:</label>
						<input id="f_name" type="text" name="f_name" onblur="validateFirstName()"> 
						<label>(20 or less characters)</label>
					</li>
					
					<li>
						<label>Last Name:</label>
						<input id="l_name" type="text" name="l_name"> 
						<label>(20 or less characters)</label>
					</li>		
					
					<li>
						<label>Email:</label>
						<input id="e_mail" type="text" name="e_mail"> 
					</li>
					
					<li>
						<label>Password:</label>
						<input id="password" type="password" name="password"> 
					</li>		
					
					<li>
						<label>DOB:</label>
						<input id="dob" type="date" name="dob"> 
					</li>						
				</ul>
				<input id="register" type="button" value="Register"> 
			</form>
		</div>
	</div>
	
	<script type="text/javascript" src="http://localhost/myhost-exemple/Final%20Project/src/jquery.js"></script>	
	<script type="text/javascript" src="http://localhost/myhost-exemple/Final%20Project/src/jsFunctions.js"></script>
</body>
</html>