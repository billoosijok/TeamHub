<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Login</title>
	<link href="css/login.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">
		
</head>
<body class="login-page">
<?php
	
?>
<div id="pagewrapper">
	<div id="content">
	
	<div id="topSquare">
	
		<h1 id="mainTitle">TEAMHUB</h1>
		<h2 id="subTitle">Peer To Peer Review</h2>		
	</div><!-- end topSquare -->
	<!--<div id="welcome">Login</div>-->
		<div id="login">
			<form method="post" action="">
				<input type="text" name="login_id" id="loginIdField" placeholder="Email" />
				</br>
				<input type="password" name="password" id="passwordField" placeholder="Password" />
				<p id="status"><?php if(isset($error)){echo $error;}else{echo "&nbsp;";} ?></p>
				<input type="submit" id="loginButton" name="login" value="sign in" />
				<a href="create_account.php" id="createAccountLink">CREATE ACCOUNT</a>
			</form>
		</div><!-- End login -->
	</div><!-- End content -->
</div><!-- End pagewrapper -->
</body>
</html>

