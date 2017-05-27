<?php 
require_once "app.php";

$survey;
$reviewee;
$questions;

PAGE::checkRequiredParams('survey_id','reviewee_id');

$survey_id = $_GET['survey_id'];
$reviewee_id = $_GET['reviewee_id'];

// checking if the provided IDs are valid. If not we kick to 404;
if ( 	($survey = $QUERY->SURVEY($survey_id)) 
	 && ($QUERY->IS_USER_IN_SURVEY($reviewee_id, $survey_id)) ) {
	
	$page_title = $survey->name;

} else {
	header("Location: 404.php");
}


PAGE::HEADER($page_title);

$reviewee = $QUERY->USER($reviewee_id);
$questions = $QUERY->SURVEY_QUESTIONS($survey_id);

?>

<div class="questionnaire page">
	<header class="page-title">
		<h1><?php echo $page_title . " > " . $reviewee->first_name . " " . $reviewee->last_name; ?></h1>
	</header>
	<div class="content">
		
		<form class="questions">
			
			<?php 

			foreach ($questions as $question) {
				?>

				<h3 class="single-question"><?php echo $question->text ?></h3>

				<?php	
			}

			 ?>
		</form>
	</div>
</div>

<?php

PAGE::FOOTER();
