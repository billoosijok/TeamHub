<?php 

require_once "app.php";

$page_title;
$survey;

if ($_GET['id']) {
	
	$survey_id = $_GET['id'];

	if ($survey = $QUERY->SURVEY($survey_id)) {
		$page_title = $survey->name;

	} else {
		header("Location: 404.php");
	}

} else { header("Location: 404.php"); }

PAGE::HEADER($survey->name);

?>
		
	<div class="view-survey page">
		<header class="page-title">
			<h1><?php echo $survey->name; ?></h1>
		</header>
		<div class="content">

			<ul>
				
				<?php 
				
				$participants = $QUERY->SURVEY_PARTICIPANTS($survey->id);

				foreach ($participants as $participant) {
					echo $participant->first_name;
				}

				 ?>
			</ul>
		</div>
	</div>

<?php

PAGE::FOOTER();
