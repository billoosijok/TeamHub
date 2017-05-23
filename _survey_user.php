<?php /* Displays Survey information to the users joined the survey */ ?>

<div class="view-survey page">
		<header class="page-title">
			<h1><?php echo $survey->name; ?></h1>
		</header>
		<div class="content">
				<section>
					<header class="setcion-header">
						<h2 class="section-title">People To Review</h2>
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

				if ($participants) { ?>
					<ul>
					<?php
					for ($j=0; $j < count($participants); $j++) { 
						$participant = $participants[$j];

						// Making sure that we only show the other participants. Aka the ones 
						// without the same id as the current one.
						if ($participant->id != $_SESSION['user_info']['id']) {

							$questionairre_status = $QUERY->QUESTIONAIRRE_STATUS($survey->id, $_SESSION['user_info']['id'], $participant->id);

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
					?>
						<li class="panel-group">
						  <div class="panel panel-default">
						    <div class="panel-heading">
						      <h4 class="panel-title">
								<?php if ($status === "Submitted") {
							?>
								<?php echo $participant->first_name . " " . $participant->last_name ?><span class="status"><?php echo $status; ?></span>
							<?php } else { ?>
						      	<?php  ?>
						        <a role="button" data-toggle="collapse" href="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $i; ?>">
						          <?php echo $participant->first_name . " " . $participant->last_name; ?><span class="status"><?php echo $status; ?></span>
						        </a>
						      </h4>
						    </div>
						  </div>
						</li>	
					<?php	}
						}
					}
				}
						?>
				</ul>
		</section>
		</div>
	</div>