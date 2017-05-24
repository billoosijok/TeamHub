<?php require_once "app.php";

$survey;
$questions;
$answers;

if ($_GET['id'] && $_GET['result']) {
	
	$survey_id = $_GET['id'];

	if ($survey = $QUERY->SURVEY($survey_id)) {

		$survey = $survey;
		$questions = $QUERY->SURVEY_QUESTIONS($survey->id);
		


	} else {
		header("Location: 404.php");
	}

} else { header("Location: 404.php"); }
	
PAGE::HEADER($survey->name." - Results"); ?>

	<div class="survey-resutl page">
		<header class="page-title">
			<h1><?php echo $survey->name . " > " . "Result"; ?></h1>
		</header>	
	</div>
	<div class="content">
		
	</div>

<?php PAGE::FOOTER(); ?>