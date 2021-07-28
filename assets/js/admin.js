
$(document).ready(function () {
	$(document).on("click", "#sidebar_toggle, #sidebar_out", function() {
		$("#sidebar, #sidebar_out").fadeToggle(100);
	});

	$(document).on("click", ".img_zoomable", function() {
		$("body").append($("<div>").attr({
			class: "img_zoom"
		}).append($("<img>").attr({
			src: $(this).attr("src")
		})));
	});
	$(document).on("click", ".img_zoom", function() {
		$(".img_zoom").fadeOut(200, function() {
			$(".img_zoom").remove()
		});;
	});
});