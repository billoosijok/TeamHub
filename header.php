<?php 
require_once "inc/page_parts.php";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bob | Home</title>
	<?php require_once "inc/css_depends.html" ?>
</head>
<body>
<header class="main">
	<h2>TeamHub</h2>
</header>

<aside class="main col-xs-12 col-sm-3">
		
	<div class="profile slide-down">
		<p class="placeholder slide-down-title person-title">**John**</p>
		<ul>
			<li>Logout</li>
		</ul>
	</div>
	<section class="nav-panel">
		<ul>
			<?php create_nav_item("Home", "home.php") ?>
			<!-- <li class=""><a href="home.php">Home</a></li> -->
		</ul>
	</section>
	<section class="nav-panel">
		<h3>Surveys Joined</h3>
		<ul>
			<?php create_nav_item("**Survey One**", "#") ?>
			<?php create_nav_item("**Survey Two**", "#") ?>
			<?php create_nav_item("**Survey Three**", "#") ?>
		</ul>
	</section>
	<section class="nav-panel">
		<h3>Surveys Created <a href="create_survey.php" class="create-survey" title="Create a new survey">+</a></h3>
		<ul>
			<?php create_nav_item("**Survey Four**", "#") ?>
			<?php create_nav_item("**Survey Five**", "#") ?>
		</ul>
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
	if (basename($pageUrl) == $link) {
		$html_class = "active";
	}

	echo "<li><a href='$link' class='$html_class'>$text</a></li>\n";
}