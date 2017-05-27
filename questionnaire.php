<?php 
require_once "app.php";

$survey;
$reviewee;
$questions;

$prevAnswers = [];

PAGE::checkRequiredParams('survey_id','reviewee_id');

$survey_id = $_GET['survey_id'];
$reviewee_id = $_GET['reviewee_id'];

// checking if the provided IDs are valid. If not we kick to 404;
if ( 	($survey = $QUERY->SURVEY($survey_id)) 
	 && ($QUERY->IS_USER_IN_SURVEY($reviewee_id, $survey_id))
	 && ($QUERY->IS_USER_IN_SURVEY($_SESSION['user_info']['id'], $survey_id)) ) {
	
	$page_title = $survey->name;

} else {
	header("Location: 404.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = validateForm();

	if ($errors) {
		$errorDiv = "<ul class='form-error'>";
		
		foreach ($errors as $error) {
			
			$errorDiv .= "<li>$error</li>";
			
		}
		$errorDiv .= "</ul>";

		foreach ($_POST['questions'] as $key => $question) {
			$prevAnswers[$key]['grade'] = (isset($question['grade'])) ? $question['grade'] : "none";
			$prevAnswers[$key]['answer'] = (isset($question['answer'])) ? $question['answer'] : "";
		}

	} else {
		// submit
	}
}

PAGE::HEADER($page_title);

$reviewee = $QUERY->USER($reviewee_id);
$questions = $QUERY->SURVEY_QUESTIONS($survey_id);
$grading_system = $DB->get_survey_grading_system($survey_id);

?>

<div class="questionnaire page">
	<header class="page-title">
		<h1><?php echo $page_title . " > " . $reviewee->first_name . " " . $reviewee->last_name; ?></h1>
	</header>
	<div class="content">
		<?php if(isset($errorDiv)) echo $errorDiv;?>
		<section>
			<header class="setcion-header">
				<h2 class="section-title">Answer</h2>
				<div class="tools">
					<div class="option">
						<a href="#" class="collapse-all">Collapse All</a>
					</div>
					<div class="option">
						<a href="#" class="expand-all">Expand All</a>
					</div>
				</div>
			</header>
				<?php 
				

				if ($questions) {

				?>
				<form class="questions" action="<?php echo $home_url . str_replace("/teamhub","", $_SERVER['REQUEST_URI']); ?>" method="post">
				<ol>
				<?php
					for ($i=0; $i < count($questions); $i++) { 
						$question = $questions[$i];
						$question_number = $i + 1;
				?>
					<li class="question panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="heading-<?php echo $i; ?>">
					      <h4 class="panel-title">
					        <a class="question-text" role="button" data-toggle="collapse" href="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $i; ?>">
					          <?php echo $question->text; ?>
					        </a>
					      </h4>
					    </div>
					    <div id="collapse-<?php echo $i; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					      <div class="panel-body">
					        <div class="form-group col-xs-12 grade">
								<label>Grade</label>
								<div class="radio-slider">
									<?php 
									$grade_fraction = (1 / count($grading_system)) * 100;

									$grade_counter = 100;
									for ($j=0; $j < count($grading_system); $j++) { 
									?>
							<input type="radio" name="questions[<?php echo $i; ?>][grade]" id="grade-<?php echo $question_number."-".($j+1); ?>" value="<?php echo $grade_counter; ?>" <?php if(isset($prevAnswers[$i]['grade']) && $prevAnswers[$i]['grade'] == $grade_counter) echo 'checked'; ?>><label for="grade-<?php echo $question_number."-".($j+1); ?>"><?php echo $grading_system[$j]; ?></label>
										<?php
										$grade_counter -= $grade_fraction;
									} 

									?>
								</div>
							</div>
							<div class="form-group col-xs-12 answer">
								<label for="answer-<?php echo $question_number; ?>">Explain ... </label>
								<textarea name="questions[<?php echo $i; ?>][answer]" id="answer-<?php echo $question_number; ?>" rows="5"><?php if(isset($prevAnswers[$i]['answer'])) echo $prevAnswers[$i]['answer']; ?></textarea>
							</div>
					      </div>
					    </div>
					  </div>
					</li>

			<?php	}	?>
					</ol>
					<div class="clear-fix"></div>
					<div class="form-group submission">
						<input type="submit" class="button">
					</div>
				</form>
		
		<?php	}	?>
			</section>
			
			<script>
		window.addEventListener('load', function() {
			var collapse_all = $(".collapse-all");
			var expand_all = $(".expand-all");

			collapse_all.click(function() {
				
				var section = $(this).parentsUntil('section').parent();
				
				var panel = section.find('.panel-collapse.collapse.in').collapse('toggle');

			});

			expand_all.click(function() {
				
				var section = $(this).parentsUntil('section').parent();
				
				var panel = section.find('.panel-collapse.collapse:not(.in)').collapse('toggle');

			});
			
		});
	</script>
	</div>
</div>

<?php

PAGE::FOOTER();

function validateForm() {

	$questions = $_POST['questions'];

	$errors = [];

	foreach ($questions as $key => $question) {
		$questions_number = $key + 1;

		$grade = (isset($question['grade'])) ? $question['grade'] : null;
		$answer = trim($question['answer']);

		if (!$grade && strlen($answer) < 1) {
			// If both of them are not provided then we continue with the next iteration

			array_push($errors, "Please answer question " . $questions_number);
			continue;
		}

		if (!$grade) {
			array_push($errors, "Please select a grade for question ". $questions_number);
		} 

		if (strlen($answer) < 1) {
			array_push($errors, "Please provide an explanation for question ". $questions_number);
		}
	}

	return $errors;

}
