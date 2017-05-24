<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Create Account</title>
	<link href="css/create_account.css" rel="stylesheet">
		
</head>
<body>
<?php

require_once "database/connect.php";
require_once 'database/db.php';

if($_SERVER['REQUEST_METHOD'] = $_POST) {
	if ($_POST['createPassword'] == $_POST['reEnterPassword']) {
		var_dump($_POST);
		
		$email = $_POST['createEmail'];
		$first_name = $_POST['createFirstName'];
		$last_name = $_POST['createLastname'];
		$password = $_POST['createPassword'];
		$userTable = 'users';
		
		$DB->INSERT("users", [
		"email" => $email,
		"first_name" => $first_name,
		"last_name" => $last_name,
		"password" => $password
		]);
	}else {
		//Error message, reload page with sticky form
	} 
}

?>
<div id="pagewrapper">
	<div id="content">
		<div id="createAccountBlock">
			<h1 id="createAccountHeading">LET'S GET YOU READY TO REVIEW YOUR PEERS</h1>
		</div><!--create account block-->
		<form id="createAccountForm" method="post" action="create_account.php">
			<input type="text" class="createAccountTextBox" id="createEmail" name="createEmail" placeholder="Email" /></br>
			<input type="text" class="createAccountTextBox" id="createFirstName" name="createFirstName" placeholder="First Name" /></br>
			<input type="text" class="createAccountTextBox" id="createLastname" name="createLastname" placeholder="Last Name" /></br>
			<input type="text" class="createAccountTextBox" id="createPassword" name="createPassword" placeholder="Password" /></br>
			<input type="text" class="createAccountTextBox" id="reEnterPassword" name="reEnterPassword" placeholder="Re-Enter Password" /></br>
			<input type="submit" id="submitAccount" name="submit" value="Sign In" />
		</form>
	<div><!--end content-->
</div><!--end pagewrapper-->
</body>
</html>