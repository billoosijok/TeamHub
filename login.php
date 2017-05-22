<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Login</title>
		
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

