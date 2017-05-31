<?php 
$home_url = "http://localhost/teamhub";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php if(isset($page_title)) { echo $page_title; } else { echo "TeamHub"; } ?></title>
	<?php require_once "inc/css_depends.html" ?>
</head>
<body>
<header class="main">
	<h2>TeamHub</h2>
</header>

<aside class="main col-xs-12 col-sm-3">
		
	<div class="profile slide-down">
		<p class="placeholder slide-down-title person-title"><?php echo $_SESSION['user_info']['first_name'] ?></p>
		<ul>
			<li>Logout</li>
		</ul>
	</div>
	<section class="nav-panel">
		<div class="panel-content">
			<ul>
				<?php create_nav_item("Home", "home.php") ?>
			</ul>
		</div>
	</section>
	<section class="nav-panel">
		<h3 class="panel-title">Surveys Joined</h3>
		
		<div class="panel-content">	
			<?php 
				$surveys_joined = $QUERY->SURVEYS_JOINED($_SESSION['user_info']['id']); 

				if ($surveys_joined) {
			?>
			<ul>
				<?php
					foreach ($surveys_joined as $survey) {
						create_nav_item($survey->name, "$home_url/survey.php?id=" . $survey->id);
					}
				?>
			</ul>

			<?php

			} else {
				echo "<p class=\"no-surveys\">No Surveys Joined</p>";
			}	

			?>
		</div>
	</section>
	<section class="nav-panel">
		<h3 class="panel-title">Surveys Created <a href="create_survey.php" class="create-survey" title="Create a new survey">+</a></h3>

		<div class="panel-content">
			
			<?php 
			
			$surveys_created = $QUERY->SURVEYS_CREATED($_SESSION['user_info']['id']);

			if ($surveys_created) {

			?>
		<ul>
				<?php
				
				foreach ($surveys_created as $survey) {
					create_nav_item($survey->name, "$home_url/survey.php?id=" . $survey->id);
				}

				?>
		</ul>
			<?php
			
			} else {
				echo "<p class=\"no-surveys\">No Surveys Created</p>";
			}
			
			?>
		</div>
	</section>
</aside>

<main class="main col-xs-12 col-sm-9">

<?php 

function create_nav_item($text, $link) {
	
	$html_class = "";
	
	$pageUrl = $_SERVER['REQUEST_URI'];

	// If the link passed was the same as the request link
	// then this is the current page, so we set the class 
	// to 'active'
	if (basename($pageUrl) == basename($link)) {
		$html_class = "active";
	}

	echo "<li><a href='$link' class='$html_class'>$text</a></li>\n";
}