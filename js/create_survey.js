window.addEventListener('load', function() {

	initAutoComplete();
	initQuestionsBox();
	initFormValidationRules();

});

function initAutoComplete() {
	var container = $('.list-box');

	var outlets = {
		container : container,
		text_box : container.find('.text-box'),
		list_container : container.find('.list-container'),
		add_item_text : "No one selected"
	}

	var list = new InteractiveList(outlets);

	var input = $(".awesomplete");

	input[0].addEventListener('awesomplete-selectcomplete', function(event) {
		/* Act on the event */
		event.preventDefault();

		event.target.value = "";
		
		list.addItem(event.text.label, event.text.value, "people");
		
	});
}

function initQuestionsBox() {
	var questions_container = $("#questions-container");
	var addButton = $('#add_question');

	var question_counter = 2;

	addButton.on('mouseup', function(event) {
		event.preventDefault();

		var single_question_template = '<div class="single-question row"> 									 \
			<textarea id="question-'+question_counter+'" name="questions[]"></textarea> 					 \
			<label class="question-label" for="question-'+question_counter+'">Q'+question_counter+':</label></div>'; 

		var single_question = $(single_question_template);

		questions_container.append(single_question);

		question_counter++;
	});	
}

function initFormValidationRules() {
	var form = $("#main-form");

	var survey_name_field = form.find("#survey-name");
	var questions_container = form.find("#questions-container");

	// form.submit(function(event) {
	// 	event.preventDefault();

	// 	if ($.trim(survey_name_field.value).length < 1) {
	// 		survey_name_field.after("<div class='error col-xs-6'>Error</div>")
	// 	} else {
	// 		$(this).submit();
	// 	}

	// });

	function formIsValid() {
		
		if ($.trim(survey_name_field.value).length < 1) {
			survey_name_field.after("<div class='error col-xs-6'>Error</div>")
		}

	}
}