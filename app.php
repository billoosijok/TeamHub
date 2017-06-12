<?php 

require_once "inc/page_parts.php";
require_once "database/connect.php";

$home_url = "http://localhost/teamhub";

include "dummy_users.php";

$_SESSION['user_info'] = $john;