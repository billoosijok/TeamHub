<?php 

/* Creates A New Survey */

require "header.php";
?>	
	<link rel="stylesheet" href="css/awesomplete.css" />
	<style>
		
	</style>
	<div class="create-survey-page">
		<header class="page-title">
			<h1>Create A Survey</h1>
		</header>
		<div class="content">
			<form>
				<div class="form-group col-sm-6">
				    <label for="survey-name">Survey Name</label>
				    <input type="text" class="form-control" id="survey-name" placeholder="Name">
				</div>
				<div class="form-group col-xs-12">
				    <label for="search-participant">Add participants</label>
				    <div class="grey-box col-xs-12 list-box">
					<div class="form-group">
						<label for="search-participant">Search</label>
			    		
			    		<input type="text" class="form-control text-box awesomplete" id="search-participant" placeholder="Student Name" list='mylist'>
			    		
			    		<datalist id="mylist">
							<option value="matt@email.com">Matt Lehr</option>
							<option value="chris@email.com">Chris Mcguire</option>
							<option value="belal@email.com">Belal Sejouk</option>
						</datalist>

			    	</div>
			    	<div class="display-names list-container">
			    		
			    	</div>
			    </div>
				</div>
				<div class="form-group col-xs-12 grading-system">
					<label>Grading System</label>
					<div class="radio-slider">
						<input type="radio" name="grade" id="percentage-option" checked><label for="percentage-option">Percentage</label>
						<input type="radio" name="grade" id="letter-option"><label for="letter-option">Letter</label>
					</div>
				</div>

				<div class="form-group col-xs-12 questions">
					<label>Questions</label>
					
				</div>

			</form>
		</div>
	</div>
	<script src="js/create_survey.js"></script>
<?php
require_once "footer.php"; ?>