
$(document).ready(function () {
	$(document).on("click", "#sidebar_toggle, #sidebar_out", function() {
		$("#sidebar, #sidebar_out").fadeToggle(100);
	});

	$(document).on("click", ".product_img", function() {
		$("body").append($("<div>").attr({
			class: "img_zoom"
		}).append($("<img>").attr({
			src: $(this).attr("src")
		})));
	});
	$(document).on("click", ".img_zoom", function() {
		$(".img_zoom").remove();
	});
});