<?php 

require_once "inc/page_parts.php";
require_once "database/connect.php";

$_SESSION['user_info'] = [

	'user_id' => 1,
	'first_name' => 'Bruce',
	'last_name' => 'Elgort',
	'email' => 'belgort@email.com',
];