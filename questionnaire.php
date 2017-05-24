<?php 

require_once "app.php";

$survey;

$required_params = [
	'id'	=> 'integer',
	'result'
];

if ($_GET['id']) {
	
	$survey_id = $_GET['id'];

	if ($survey = $QUERY->SURVEY($survey_id)) {
		$page_title = $survey->name;

		if ($survey->author == $_SESSION['user_info']['id']) {
		
			$page_to_load = "_survey_admin.php";
		
		} else {
		
			$page_to_load = "_survey_user.php";
		
		}

	} else {
		header("Location: 404.php");
	}

} else { header("Location: 404.php"); }


$page_title = $survey->name;

PAGE::HEADER($page_title);

	

PAGE::FOOTER();