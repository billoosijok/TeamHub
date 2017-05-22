<?php 

require_once "inc/page_parts.php";
require_once "database/connect.php";

$_SESSION['user_info'] = [

	'id' => 2,
	'first_name' => 'John',
	'last_name' => 'Smith',
	'email' => 'john@email.com',

];