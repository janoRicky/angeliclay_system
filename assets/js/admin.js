
$(document).ready(function () {
	$(document).on("click", "#sidebar-toggle", function() {
		// if ($("#sidebar").css("display") == "none") {
		// 	$("#sidebar").show("slide", { direction: "left"}, 1000);
		// } else {
		// 	$("#sidebar").hide("slide", { direction: "right"}, 1000);
		// }
		$("#sidebar").toggle("fast");
	});
});