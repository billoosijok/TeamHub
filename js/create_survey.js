window.addEventListener('load', function() {
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
		list.addItem(event.text.label, event.text.value, "people");
		event.target.value = "";
	});
});