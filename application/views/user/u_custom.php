
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
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-lg-1"></div>
				<div class="col-12 col-lg-10 content pt-4 pb-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h3 class="font-weight-bold">Custom Product Details</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<?=form_open(base_url() . "place_custom_order", "method='POST' enctype='multipart/form-data'")?>
							<div class="row">
								<div class="col-1"></div>
								<div class="col-10">
									<div class="row mt-2">
										<div class="col-12">
											<h5 class="font-weight-bold m-2 p-0">Description: </h5>
										</div>
										<div class="col-12">
											<textarea class="form-control" rows="5" style="resize: none;" name="inp_description" placeholder="e.g. based on [character], 2 pieces/copies, etc." maxlength="2040"></textarea>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-12 col-md-6">
											<h5 class="font-weight-bold">Type: </h5>
											<select class="form-control" name="inp_type_id">
												<?php foreach ($types as $key => $val): ?>
													<option value="<?=$key?>"><?=$val?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-12 col-md-6">
											<h5 class="font-weight-bold">Size: </h5>
											<input class="form-control" type="text" name="inp_size" placeholder="e.g. 12cm">
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-12">
											<input id="img_count" type="hidden" name="inp_img_count" value="0">
											<h5 class="font-weight-bold">Image Reference/s: </h5>
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
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4 mb-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h3 class="font-weight-bold">Shipping Details</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="row">
								<div class="col-1"></div>
								<div class="col-10">
									<div class="row mt-2 align-items-center">
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">Zip Code: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_zip_code" placeholder="Zip Code" value="<?=$account_details['zip_code']?>" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">Country: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_country" placeholder="Country" value="<?=$account_details['country']?>" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">Province: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_province" placeholder="Province" value="<?=$account_details['province']?>" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">City: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_city" placeholder="City" value="<?=$account_details['city']?>" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">Street/Road: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_street" placeholder="Street/Road" value="<?=$account_details['street']?>" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">House Number/Floor/Bldg./etc.: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$account_details['address']?>" autocomplete="off">
										</div>
										<div class="col-12">
											<input class="form-control" type="submit" class="btn btn-success" value="Place Order">
										</div>
									</div>
								</div>
								<div class="col-1"></div>
							</div>
							<?=form_close()?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("mouseenter", ".img_box", function() {
			$(this).children(".img_change").removeClass("d-none");
		}).on("mouseleave", ".img_box", function() {
			$(this).children(".img_change").addClass("d-none");
		});
		$(document).on("click", ".img_change", function() {
			$(this).siblings(".img_input").trigger("click");
		});
		
		$(document).on("change", ".img_input", function(t) {
			if (t.target.files && t.target.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(t.target.files[0]);
				reader.onload = function(e) {
					$(t.target).siblings(".img_preview").attr("src", e.target.result);
				};

				$(".img_box").each(function(index, el) {
					$(this).children(".img_input").attr("name", "inp_img_" + (index + 1));
				});

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
					}).append($("<i>").attr({ class: "fa fa-times", "aria-hidden": "true" }))));
					
					$("#img_count").val($(".img_box").length);
				}
			}
		});

		$(document).on("click", ".img_remove", function(t) {
			if ($(".img_box").length > 1 && !$(this).siblings(".img_input").hasClass("no_img")) {
				$(this).parent().remove();
			}
			$(".img_box").each(function(index, el) {
				$(this).children(".img_input").attr("name", "inp_img_" + (index + 1));
			});
		});

		$("#custom_order_details").hide();
		$("#btn_show_order_details").on("click", function(e) {
			$("#custom_product_details").hide("fast");
			$("#custom_order_details").show("fast");
		});
		$("#btn_show_product_details").on("click", function(e) {
			$("#custom_order_details").hide("fast");
			$("#custom_product_details").show("fast");
		});
	});
</script>
</html>