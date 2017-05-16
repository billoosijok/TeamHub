<?php
session_start();

if(true or isset($_SESSION['user_info'])) { 
	
	header("Location: home.php");

} else { 
	
	header("Location: login.php");
	
}