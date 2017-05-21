<?php 
/* Creates A New Survey */

require "app.php";

$page_title = "Create Survey";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && sizeof($_POST)) {
	
	$errorDiv = "";

	$survey_name 	= (isset($_POST['survey-name'])) 	? $_POST['survey-name'] 	: null;
	$people 	 	= (isset($_POST['people'])) 		? $_POST['people'] 			: null;
	$grading_system	= $_POST['grading-system'];
	
	$status = "published";

	$user_id = '1';

	if (!$survey_name || !$people) {
		
		$errorDiv = "<p class='form-error' style='color: red'>Error</p>";
	
	} else {

		$DB->INSERT("surveys", [
			'name'	 		=> $survey_name,
			'author' 		=> $user_id,
			'grading_system'=> $grading_system,
			'status' 		=> $status,
		]);

		$last_survey_id = $DB->get_last_id("surveys");

		foreach ($people as $key => $value) {
			$DB->INSERT("survey_participants", [
				'survey_id'	 =>	$last_survey_id,
				'user_id' => $value,
			]);
		}
		
	}
}	

PAGE::HEADER($page_title);

?>	
	<link rel="stylesheet" href="css/awesomplete.css" />
	
	<div class="create-survey page">
		<header class="page-title">
			<h1>Create A Survey</h1>
		</header>
		
		<div class="content">
			<?php if(isset($errorDiv)) echo $errorDiv ?>
			<form id="main-form" method="post">
				<div class="form-group col-sm-6">
				    <label for="survey-name">Survey Name</label>
				    <input value="Surveey" type="text" class="form-control" id="survey-name" name="survey-name" placeholder="Name">
				</div>
				<div class="form-group col-xs-12">
				    <label for="search-participant">Add participants</label>
				    <div class="grey-box col-xs-12 list-box">
					<div class="form-group">
						<label for="search-participant">Search</label>
			    		
			    		<input type="text" class="form-control text-box awesomplete" id="search-participant" placeholder="Student Name" list='mylist'>
			    		
			    		<datalist id="mylist">
			    			<?php 

			    				$users = $QUERY->USERS();

			    				foreach ($users as $user) {
			    					if ($user->id != $_SESSION['user_info']['id']) {
			    						
								?>
										<option value="<?php echo $user->id; ?>"><?php echo $user->first_name . " " . $user->last_name; ?></option>
			    				<?php	
			    					}
			    				}
			    			 ?>
						</datalist>

			    	</div>
			    	<div class="display-names list-container">
			    		<p class='list-item chip'> Matt <a href='#' class='delete'>x</a>
			    		<input type='hidden' name="people[]" value="matt@email.com"	aria-hidden='true'>
			    		</p>
			    	</div>
			    </div>
				</div>
				<div class="form-group col-xs-12 grading-system">
					<label>Grading System</label>
					<div class="radio-slider">
						<input type="radio" name="grading-system" id="percentage-option" value="" checked><label for="percentage-option">Percentage</label>
						<input type="radio" name="grading-system" id="letter-option" value="1"><label for="letter-option">Letter</label>
					</div>
				</div>
				<div class="form-group col-xs-12 questions">
					<label>Questions</label>
					<div class="col-xs-12 grey-box">
						<div id="questions-container">
							<div class="single-question row">
								<textarea id="question-1" name="questions[]">Question</textarea>
								<label class="question-label" for="question-1">Q1:</label>
							</div>
						</div>
						<a class="button" id="add_question">+</a>
					</div>
				</div>
				<div class="clear-fix"></div>
				<div class="form-group submission">
					<input type="submit" class="button">
				</div>
			</form>
		</div>
	</div>
	<script src="js/create_survey.js"></script>


<?php PAGE::FOOTER(); ?>