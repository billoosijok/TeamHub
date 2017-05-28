<?php 

require_once "inc/page_parts.php";
require_once "database/connect.php";

$home_url = "http://localhost/teamhub";

$john = [
	'id' => 2,
	'first_name' => 'John',
	'last_name' => 'Smith',
	'email' => 'john@email.com',
];

$bruce = [
	'id' 		=> 1,
	'first_name' => 'Bruce',
	'last_name' => 'Elgort',
	'email'	 	=> 'bruce@email.com',
];

$_SESSION['user_info'] = $john;