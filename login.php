<?php 
	require 'inc/process_login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	$jqueryLink = "js/jquery-2.2.3.min.js";
	$cssLink = "css/style.css";
?>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=1, user-scalable=no">
	
	<link rel="stylesheet" type="text/css" href="<?php echo $cssLink; ?>">
	<script src="<?php echo $jqueryLink ?>"></script>
	<script src="js/validate_login.js"></script>
	
</head>
<body class="login-page">
<div id="pagewrapper">
	<div id="welcome">Login</div>
	<div id="login">
		<form method="post" action="">
			<input type="text" name="login_id" id="loginIdField" placeholder="Email" />
			<input type="password" name="password" id="passwordField" placeholder="Password" />
			<p id="status"><?php if(isset($error)){echo $error;}else{echo "&nbsp;";} ?></p>
			<input type="submit" name="login" value="Log in" />
		</form>
	</div>
</div>
</body>
</html>

