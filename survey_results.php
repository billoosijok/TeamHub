<?php require_once "app.php";

$survey;
$questions;
$answers;

if ($_GET['id']) {
	
	$survey_id = $_GET['id'];

	if ($QUERY->SURVEY($survey_id)) {

		$survey = $QUERY->SURVEY($survey_id);

		if ($survey->status == "approved") {
			
			$questions = $QUERY->SURVEY_QUESTIONS($survey->id);
			$answers = $QUERY->ANSWERS($survey_id, "*", $_USER->id);
			
		} else {
			header("Location: 404.php");
		}
		


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
		<!-- Page Content goes here -->
	</div>

<?php PAGE::FOOTER(); ?>