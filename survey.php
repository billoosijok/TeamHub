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

PAGE::HEADER($page_title);

?>
		
	<div class="view-survey page">
		<header class="page-title">
			<h1><?php echo $survey->name; ?></h1>
		</header>
		<div class="content">
				
				<section>
					<header class="setcion-header">
						<h2 class="section-title">Survey Participants</h2>
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
				
				$participants = $QUERY->SURVEY_PARTICIPANTS($survey->id);

				if ($participants) {

				?>
				<ul>
				<?php
					for ($i=0; $i < count($participants); $i++) { 
						$participant = $participants[$i];

				?>
					<li class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="heading-<?php echo $i; ?>">
					      <h4 class="panel-title">
					        <a role="button" data-toggle="collapse" href="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $i; ?>">
					          <?php echo $participant->first_name . " " . $participant->last_name; ?>
					        </a>
					      </h4>
					    </div>
					    <div id="collapse-<?php echo $i; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					      <div class="panel-body">
					        <ul class="other-particpants">
								<?php 
									for ($j=0; $j < count($participants); $j++) { 
										$other_participant = $participants[$j];

										// Making sure that we only show the other participants. Aka the ones 
										// without the same id as the current one.
										if ($other_participant->id != $participant->id) {

											$questionairre_status = $QUERY->QUESTIONAIRRE_STATUS($survey->id, $participant->id, $other_participant->id);

											switch ($questionairre_status) {
												case 'published':
													$status = "Submitted";
													break;
												
												case 'flagged':
													$status = "Waiting for answer review";
													break;

												default:
													$status = "Not yet submitted";
													break;
											}

											if ($status === "Submitted") {
												?>
												<li><a href="#"><?php echo $other_participant->first_name . " " . $other_participant->last_name ?><span class="status submitted"><?php echo $status; ?></span></a></li>
												<?php
											} else { 
												?>
												<li><?php echo $other_participant->first_name . " " . $other_participant->last_name ?><span class="status"><?php echo $status; ?></span></li>
									<?php	}

										?>

											

									<?php }
									}
								 ?>
					        </ul>
					      </div>
					    </div>
					  </div>
					</li>


			<?php	}	?>
				</ul>
		
		<?php	}	?>
			</section>
			
		</div>
	</div>
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

<?php

PAGE::FOOTER();
