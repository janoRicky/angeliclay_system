
$(document).ready(function () {
	$(document).on("click", "#sidebar_toggle, #sidebar_out", function() {
		$("#sidebar, #sidebar_out").fadeToggle(100);
	});
});