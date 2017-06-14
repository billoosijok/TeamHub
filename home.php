<?php require_once "app.php"; ?>

<?php PAGE::HEADER("TeamHub"); ?>

	<div class="homepage">
		<header class="page-title">
			<h1>Welcome,</h1>
			<h3>please review your dashboard</h3>
		</header>
		<div class="container-fluid">
			<div class="row">
				<div class="col-s-1 col-md-3">
				<div class="dashHead">Start Here</div>
					<div class="homeFeedSH">
						<?php
							$surveys_joined = $QUERY->SURVEYS_JOINED($_USER->id);
							
							foreach($surveys_joined as $survey) {
								if ($survey->status != "approved") {
									$status = $QUERY->QUESTIONNAIRE_STATUS($survey->id, $_USER->id, "*");
									
									if($status == "flagged") {
										echo "<a href='$home_url/survey.php?id=".$survey->id."'>". $survey->name ."</a><hr/>";
									}
								}
							}
						?>
					</div>
				</div>
				<div class="col-s-1 col-md-3">
				<div class="dashHead">View Results</div>
					<div class="homeFeedVR">
						<?php
								$surveys_joined = $QUERY->SURVEYS_JOINED($_USER->id);

								foreach($surveys_joined as $survey) {

									if($survey->status == "approved") {
										echo "<a href='$home_url/survey.php?id=".$survey->id."'>". $survey->name ."</a><hr/>";
									}
								}
							?>
					</div>
				</div>
				
				<div class="col-s-1 col-md-3">
				<div class="dashHead">Surveys to Review</div>
					<div class="homeFeed">
						<?php
									$surveys_joined = $QUERY->SURVEYS_JOINED($_USER->id);

									foreach($surveys_joined as $survey) {
										$status = $QUERY->QUESTIONNAIRE_STATUS($survey->id, $_USER->id, "*");

										if($status == "") {
											echo "<a href='$home_url/survey.php?id=".$survey->id."'>". $survey->name ."</a><hr/>";
										}
									}
								?>
					
					</div>
				</div>	
				
				<div class="col-s-1 col-md-3">
				<div class="dashHead">Surveys to Approve</div>
				<div class="homeFeed">
				
					<?php
									$surveys_created = $QUERY->SURVEYS_CREATED($_USER->id);

									foreach($surveys_created as $survey) {
										$status = $QUERY->QUESTIONNAIRE_STATUS($survey->id, $_USER->id, "*");

										if($status == "submitted") {
											echo "<a href='$home_url/survey.php?id=".$survey->id."'>". $survey->name ."<hr/></a>";
										}
									}
								?>
					
				
				
				
				</div>
				</div>
				
				
				
				
			</div>

			
		</div>
	</div>

<?php PAGE::FOOTER(); ?>