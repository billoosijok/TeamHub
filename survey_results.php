<?php require_once "app.php";

$survey;

if ($_GET['id']) {
	
	$survey_id = $_GET['id'];

	if ($survey = $QUERY->SURVEY($survey_id)) {
		// Do nothing
	} else {
		header("Location: 404.php");
	}

} else { header("Location: 404.php"); }
	
PAGE::HEADER($survey->name." - Results"); ?>

	<div class="survey-resutl page">
		<header class="page-title">
			<h1><?php echo $survey->name . " > " . " Result"; ?></h1>
		</header>	
	</div>

<?php PAGE::FOOTER(); ?>