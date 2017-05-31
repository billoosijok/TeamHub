window.addEventListener('load', function() {
 Analyzer();
});

function Analyzer() {

	// Getting all the textareas
	var textareas = document.getElementsByClassName('analyze');
	console.log(textareas);
	for (var i = 0; i < textareas.length; i++) {
		let textarea = textareas[i];	
		let checkerButton = document.createElement('div');
		checkerButton.setAttribute('class', 'analze-button');

		textarea.parentElement.appendChild(checkerButton);

		setUpCheckerButton(checkerButton);

	}
}

function setUpCheckerButton(button, options) {
	
	options = options || {};

	let buttonCss = button.style

	buttonCss.height = options.height || '50px';
	buttonCss.width = options.width || '50px';
	buttonCss.backgroundColor = options.backgroundColor || 'green';
	buttonCss.position = options.position || 'absolute';
	buttonCss.bottom = options.bottom || '0px';

	if (button.parentElement.style.position == 'static') {
		button.parentElement.style.position = 'relative';
	}
}