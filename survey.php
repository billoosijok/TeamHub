<?php 

require_once "app.php";

$survey;

if ($_GET['id']) {
	
	$survey_id = $_GET['id'];

	if ($survey = $QUERY->SURVEY($survey_id)) {
		$page_title = $survey->name;

		if ($survey->author == $_SESSION['user_info']['id']) {
		
			require_once "survey_admin.php";
		
		} else {
		
			require_once "survey_user.php";
		
		}

	} else {
		header("Location: 404.php");
	}

} else { header("Location: 404.php"); }



?>
	