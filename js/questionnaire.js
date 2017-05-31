
window.addEventListener('load', function() {
	init();
});

function init() {
	// UI
	var collapse_all = $(".collapse-all");
	var expand_all = $(".expand-all");
	
	ativateCollapsablesToggles(collapse_all, expand_all);

}
function ativateCollapsablesToggles(collapse_all, expand_all) {
		
	collapse_all.click(function() {
		var section = $(this).parentsUntil('section').parent();
		var panel = section.find('.panel-collapse.collapse.in').collapse('toggle');
	});

	expand_all.click(function() {
		var section = $(this).parentsUntil('section').parent();
		var panel = section.find('.panel-collapse.collapse:not(.in)').collapse('toggle');
	});
}
