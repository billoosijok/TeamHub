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
		
		$email = $_POST['createEmail'];
		$first_name = $_POST['createFirstName'];
		$last_name = $_POST['createLastName'];
		$password = $_POST['createPassword'];
		$userTable = 'users';
		
		$DB->INSERT("users", [
		"email" => $email,
		"first_name" => $first_name,
		"last_name" => $last_name,
		"password" => $password
		]);
		
		header('Location: home.php');
		
		/* if($DB->affected_rows == 1){
			header('Location: home.php');    
		} */
		
	}else {
		//echo "<h2>Please fill out the form completely</h2>";
		
	} 
}

?>
<div id="pagewrapper">
	<div id="content">
		<div id="createAccountBlock">
			<h1 id="createAccountHeading">LET'S GET YOU READY TO REVIEW YOUR PEERS</h1>
		</div><!--create account block-->
		<form id="createAccountForm" method="post" action="create_account.php">
			<input type="text" class="createAccountTextBox" id="createEmail" name="createEmail" placeholder="Email" value="<?php if(isset($_POST['createEmail'])) echo $_POST['createEmail'];?>"/></br>
			<input type="text" class="createAccountTextBox" id="createFirstName" name="createFirstName" placeholder="First Name" value="<?php if(isset($_POST['createFirstName'])) echo $_POST['createFirstName'];?>"/></br>
			<input type="text" class="createAccountTextBox" id="createLastName" name="createLastName" placeholder="Last Name" value="<?php if(isset($_POST['createLastName'])) echo $_POST['createLastName'];?>"/></br>
			<input type="password" class="createAccountTextBox" id="createPassword" name="createPassword" placeholder="Password" /></br>
			<input type="password" class="createAccountTextBox" id="reEnterPassword" name="reEnterPassword" placeholder="Re-Enter Password" /></br>
			<input type="submit" id="submitAccount" name="submit" value="create"/>
			
		</form>
	<div><!--end content-->
</div><!--end pagewrapper-->
</body>
</html>