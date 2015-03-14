<?php
//Enable error detection
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

//Validate user is logged in
session_start();
	
if(!isset($_SESSION['loggedIn'])) {
	echo "You must log in first. Please click 
	<a href=http://localhost/myhost-exemple/Final%20Project/src/index.php>here</a> to log in.";	
}
else if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
	displayMembersPage();
}


/*------------------- PHP FUNCTION DEFINITIONS -------------------*/
	function displayMembersPage() {
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
	
	<!-- Greet Member via AJAX -->
	<div id="greetMember"> 
		<?php echo "Welcome " . ucfirst($_SESSION['f_name']) . "!"; ?>
	</div>	
	
	<section id="actionMenu">
	<div id="quotesMenu">
		<ul>
			<h3>Quotes</h3>
			<li><input type='button' value='Add Quote' onClick='unhideAddQuote()';></li>
			<li><input type='button' value='View Latest Quote by You'></li>
			<li><input type='button' value='View All Quotes by You'></li>			
			<li><input type='button' value='View Latest Quote by Friends'></li>
			<li><input type='button' value='View All Quotes by Friends'></li>
		</ul>
	</div>
	
	<div id="friendsMenu">
		<ul>
			<h3>Friends</h3>
			<li><input type='button' value='View Friends List'></li>
			<li><input type='button' value='Add Friend'></li>
			<li><input type='button' value='Remove Friend'></li>
		</ul>
	</div>	
	</section>
	
	<!-- Add New Quote -->
	<div id="newQuoteForm" style="display: none;">	
		<form id="newQuote">
		</br>
		<legend>Please complete the following</legend>
			<ul>
				<li>
					<label>Title:</label>
					<input id="quote_title" type="text" name="quote_title" onblur="validateQuoteTitle()"> 
					<label>(4-20 characters)</label>
				</li>
				
				<li>
					<label>Quote:</label>
					<textarea id="quote" rows="4" cols="50" name="quote" form="newQuote"
					placeholder="Enter Quote..." onblur="validateQuote()"></textarea>
					<label>(8-100 characters)</label>
				</li>	

				<li>
					<label>Topic:</label>
					<input id="quote_topic" type="text" name="quote_topic" onblur="validateQuoteTopic()"
					placeholder="What topic to file under?">
					<label>(4-20 characters)</label>
					<input type="button" value="View Your Existing Topics">
				</li>
				
				<li>
					<input type="button" value="Add Quote">
				</li>
			</ul>	
		</form>
	</div>
	
	<script type="text/javascript" src="http://localhost/myhost-exemple/Final%20Project/src/jquery.js"></script>	
	<script type="text/javascript" src="http://localhost/myhost-exemple/Final%20Project/src/jsFunctions.js"></script>	
</body>
</html>

<?php
};	//function displayMembersPage()


?>
