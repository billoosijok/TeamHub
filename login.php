<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Login</title>
	<link href="css/login.css" rel="stylesheet">
		
</head>
<body class="login-page">
<?php

	//Begin the session
	if(!isset($_SESSION)) { 
		session_start(); 
	}

	require_once "database/connect.php";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		//Define variables
		$email = $_POST['login_id'];
		$password = $_POST['password'];
		$errorDiv = "";
	
		//Check for errors
		$errors = checkFormErrors();

		//Append errors onto $errorDiv
		if($errors) {
			$errorDiv = "<ul class='form-error'>";
		
			foreach ($errors as $error) {
				$errorDiv .= "<li>$error</li>";
			}

			$errorDiv .= "</ul>";
		
		}else{
			
			//Create sql string with placeholders
			$sql = "SELECT * FROM users WHERE email= :login_id AND password= :pass";
			
			//prepare sql in the database
			$statement = $DB->prepare($sql);

			//Bind parameters
			$statement->bindParam(":login_id", $email);
			$statement->bindParam(":pass", $password);

			//Execute query 
			$statement->execute();
			
			//Check to see if the query was successful
			if($row = $statement->fetchObject()) {
				
				//Assign user info to the session
				$_SESSION['user_info'] = $row;
				
				header("Location: index.php");
				
			}else{
				$loginError = "<p>Name and password do not match</p>";
			}
			//Insert code for incorrect password
		}
	}
	
	function checkFormErrors() {

		$errors = [];

		if (!isset($_POST['login_id']) || $_POST['login_id'] == "") {
	
			array_push($errors, "Please enter an email address");
	
		}

		if (!isset($_POST['password']) || $_POST['password'] == "") {
	
			array_push($errors, "Please enter a password");
	
		}

		return $errors;
	} 
	
?>

<div id="pagewrapper">
	<div id="content">
	
	<div id="topSquare">
	
		<h1 id="mainTitle">TEAMHUB</h1>
		<h2 id="subTitle">Peer To Peer Review</h2>		
	</div><!-- end topSquare -->
	
		<div id="login">
			<form method="post" action="login.php">
				<p id="status"><?php if(isset($errorDiv)) echo $errorDiv;?></p>
				<p id="loginError"><?php if(isset($loginError)) echo $loginError;?></p>
				
				<input type="text" name="login_id" id="loginIdField" value="<?php if(isset($_POST['login_id'])) echo $_POST['login_id'];?>" placeholder="Email" />
				</br>
				<input type="password" name="password" id="passwordField" placeholder="Password" />
				<input type="submit" id="loginButton" name="login" value="sign in" />
				<a href="create_account.php" id="createAccountLink">CREATE ACCOUNT</a>
			</form>
			
			
		</div><!-- End login -->
	</div><!-- End content -->
</div><!-- End pagewrapper -->
</body>
</html>

