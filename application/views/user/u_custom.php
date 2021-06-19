
<?php
$template_header;
?>

<style>
	.img_box {
		cursor: pointer;
		margin: auto;
	}
	.img_change {
		position: absolute;
		top: 0;
		left: 0;

		background-color: rgba(0,0,0,0.8);
		color: #fff;
		font-weight: bold;
	}
	.img_preview {
		object-fit: contain;
		min-height: 10rem;
		max-height: 12rem;
		border: 1px solid #000;
	}
	.img_remove {
		position: absolute;
		top: 0;
		right: 0;
		color: red !important;
	}
</style>
<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<span>
			<h1 class="m-0" style="padding-top: 60px;">Order Custom</h1>
		</span>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mt-md-0 mt-sm-4 p-5">
				<?=form_open(base_url() . "place_custom_order", "method='POST' enctype='multipart/form-data'")?>
					<div class="row mt-2">
						<h5 class="font-weight-bold m-2 p-0">Description: </h5>
						<textarea class="w-100" rows="5" style="resize: none;" name="inp_description" placeholder="e.g. Based on [character]" maxlength="2040"></textarea>
					</div>
					<div class="row mt-2">
						<div class="col-6">
							<h5 class="font-weight-bold m-2 p-0">Type: </h5>
							<select class="w-100" name="inp_type_id">
								<?php foreach ($types as $key => $val): ?>
									<option value="<?=$key?>"><?=$val?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-6">
							<h5 class="font-weight-bold m-2 p-0">Size: </h5>
							<input class="w-100" type="text" name="inp_size" placeholder="e.g. 12cm">
						</div>
					</div>
					<div class="row mt-2">
						<div class="container">
							<input id="img_count" type="hidden" name="inp_img_count" value="0">
							<h5 class="font-weight-bold m-2 p-0">Image Reference/s: </h5>
							<div class="img_container row">
								<div class="col-3 img_box mb-3">
									<input type="file" class="d-none img_input no_img" name="inp_img_1">
									<img class="w-100 img_preview" src="<?=base_url()?>assets/img/no_img.png">
									<div class="img_change w-100 h-100 p-3 text-center d-none">
										Change Image
									</div>
									<a class="img_remove">
										<i class="fa fa-times" aria-hidden="true"></i>
									</a>
									<input type="hidden" class="img_check" name="inp_img_1_check">
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<input class="btn btn-outline-dark btn-block font-weight-bold" type="submit" name="submit"  value="Place Order">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<footer style="background-color: white; height: auto;">
		<div class="row mx-5 py-4">
			<div class=" col">
				<h6 class="mb-2">Links</h6>
				<ul class="nav flex-column">
					<li><a class="text-dark" href="#">FAQs</a></li>
					<li><a class="text-dark" href="#">About Us</a></li>
					<li><a class="text-dark" href="#">Contact Us</a></li>
					<li><a class="text-dark" href="#">Terms of Service</a></li>
					<li><a class="text-dark" href="#">Privacy Policy</a></li>
				</ul>
			</div>
			<div class="col">
				<h6>Our Location</h6>
			</div>
			<div class="col">
				<h6>Follow us on</h6>
				<ul class="nav">
					<li><a href="#">
						<i class="fa fa-facebook-official bg dark" aria-hidden="true"></i></a></li>
					<li><a href="#">
						<i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</footer>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("mouseenter", ".img_box", function() {
			$(this).children(".img_change").removeClass("d-none");
		}).on("mouseleave", ".img_box", function() {
			$(this).children(".img_change").addClass("d-none");
		})
		$(document).on("click", ".img_change", function() {
			$(this).prev().prev().trigger("click");
		});
		
		$(document).on("change", ".img_input", function(t) {
			if (t.target.files && t.target.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(t.target.files[0]);
				reader.onload = function(e) {
					$(t.target).next().attr("src", e.target.result);
				};
				// add new imgbox
				if ($(".img_box").length < 10 && $(t.target).hasClass("no_img")) {
					$(t.target).removeClass("no_img");

					$(".img_container").append($("<div>").attr({
						class: "col-3 img_box mb-3"
					}).append($("<input>").attr({
						type: "file",
						class: "d-none img_input no_img",
						name: "inp_img_" + ($(".img_box").length + 1)
					})).append($("<img>").attr({
						class: "w-100 img_preview",
						src: "<?=base_url()?>assets/img/no_img.png"
					})).append($("<div>").attr({
						class: "img_change w-100 h-100 p-3 text-center d-none"
					}).html("Change Image")).append($("<a>").attr({
						class: "img_remove"
					}).append($("<i>").attr({ class: "fa fa-times", "aria-hidden": "true" }))).append($("<input>").attr({
						type: "hidden",
						class: "img_check",
						name: "inp_img_" + ($(".img_box").length + 1) + "_check"
					})));
					
					$("#img_count").val($(".img_box").length);
				}
			}
		});

		$(document).on("click", ".img_remove", function(t) {
			$(this).siblings(".img_preview").attr("src", "<?=base_url()?>assets/img/no_img.png");
			$(this).siblings(".img_input").val("");
		});
	});
</script>
</html>