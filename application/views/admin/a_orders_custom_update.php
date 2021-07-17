
<?php
$template_header;
?>

<style>
	.img_remove {
		position: absolute;
		top: 0;
		right: 0;
		color: #ff0000 !important;
		cursor: pointer;
		padding: 1rem;
	}
	.img_remove:hover {
		color: #ffc0c0 !important;
	}
</style>
<body>
	<div class="wrapper h-100">
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view("admin/template/a_t_sidebar"); ?>
				<?php $this->load->view("admin/template/a_t_navbar", $nav); ?>
				<div class="col-12 text-center">
					<div class="container-fluid p-5">
						<?php if ($this->session->flashdata("alert")): ?>
							<?php $alert = $this->session->flashdata("alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="close" data-dismiss="alert">
									&times;
								</button>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-12 text-left">
								<h2>Update Custom Order #<?=$row_info["order_id"]?></h2>
							</div>
							<div class="col-12">
								<?=form_open(base_url() . "admin/order_custom_update", "method='POST' enctype='multipart/form-data'")?>
									<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
									<div class="form-group">
										<label for="inp_user_email">User Email:</label>
										<input id="user_email" type="text" class="form-control" name="inp_user_email" placeholder="Email Address" autocomplete="off" value="<?=$this->Model_read->get_user_acc_wid($row_info["user_id"])->row_array()["email"]?>" data-toggle="dropdown">
										<div class="dropdown-menu dropdown-menu-left email_dropdown"></div>
									</div>
									<div class="form-group">
										<label for="inp_description">Description:</label>
										<input type="text" class="form-control" name="inp_description" placeholder="Description" autocomplete="off" value="<?=$row_info['description']?>">
									</div>
									<div class="form-group">
										<label for="inp_date">Date:</label>
										<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d', strtotime($row_info['date_time']))?>">
									</div>
									<div class="form-group">
										<label for="inp_time">Time:</label>
										<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i', strtotime($row_info['date_time']))?>">
									</div>
									<div class="form-group">
										<label for="inp_zip_code">Zip Code:</label>
										<input type="text" class="form-control" name="inp_zip_code" id="inp_zip_code" placeholder="Zip Code" value="<?=$row_info['zip_code']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_country">Country:</label>
										<input type="text" class="form-control" name="inp_country" id="inp_country" placeholder="Country" value="<?=$row_info['country']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_province">Province:</label>
										<input type="text" class="form-control" name="inp_province" id="inp_province" placeholder="Province" value="<?=$row_info['province']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_city">City:</label>
										<input type="text" class="form-control" name="inp_city" id="inp_city" placeholder="City" value="<?=$row_info['city']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_street">Street/Road:</label>
										<input type="text" class="form-control" name="inp_street" id="inp_street" placeholder="Street/Road" value="<?=$row_info['street']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_address">House Number/Floor/Bldg./etc.:</label>
										<input type="text" class="form-control" name="inp_address" id="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$row_info['address']?>" autocomplete="off">
									</div>

									<input type="hidden" name="inp_product_id" value="<?=$product_info['custom_id']?>">
									<div class="form-group">
										<label for="inp_custom_description">Custom Description:</label>
										<textarea class="form-control" rows="5" style="resize: none;" name="inp_custom_description" maxlength="2040"><?=$product_info["description"]?></textarea>
									</div>
									<div class="form-group">
										<label for="inp_type_id">Type:</label>
										<select class="form-control" name="inp_type_id">
											<?php foreach ($tbl_types as $key => $val): ?>
												<option value="<?=$key?>" <?=($product_info["type_id"] == $key ? "selected" : "")?>><?=$val?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label for="inp_size">Size:</label>
										<input type="text" class="form-control" name="inp_size" value="<?=$product_info['size']?>">
									</div>
									<div class="form-group container">
										<label for="inp_img">Images:</label>
										<div class="img_container row">
											<?php
											$imgs = explode("/", $product_info["img"]);
											$ctr = 0;
											?>
											<?php foreach ($imgs as $src): ?>
												<?php if ($src != NULL): ?>
													<?php $ctr++; ?>
													<div class="col-6 col-md-4 img_box mb-3">
														<div class="img_u_box">
															<input type="file" class="d-none img_input" name="inp_img_<?=$ctr?>">
															<img class="item_img img_preview" src="<?=base_url(). 'uploads/custom_'. $product_info["custom_id"] .'/'. $src?>">
															<div class="img_u_change item_img p-3 text-center d-none">
																Change Image
															</div>
															<a class="img_remove">
																<i class="fa fa-times fa-lg" aria-hidden="true"></i>
															</a>
															<input type="hidden" class="img_check" name="inp_img_<?=$ctr?>_check">
														</div>
													</div>
												<?php endif; ?>
											<?php endforeach; ?>
											<?php if ($ctr < 10): ?>
												<div class="col-6 col-md-4 img_box mb-3">
													<div class="img_u_box">
														<input type="file" class="d-none img_input no_img" name="inp_img_<?=$ctr+1?>">
														<img class="item_img img_preview" src="<?=base_url()?>assets/img/no_img.png">
														<div class="img_u_change item_img p-3 text-center d-none">
															Change Image
														</div>
														<a class="img_remove">
															<i class="fa fa-times fa-lg" aria-hidden="true"></i>
														</a>
														<input type="hidden" class="img_check" name="inp_img_<?=$ctr+1?>_check">
													</div>
												</div>
											<?php endif; ?>
										</div>
										<input type="hidden" id="img_count" name="inp_img_count" value="<?=$ctr?>">
									</div>
									<div class="form-group">
										<label for="inp_qty">Ordered Qty:</label>
										<input type="number" class="form-control" name="inp_qty" value="<?=$order_item_info['qty']?>">
									</div>
									<div class="form-group">
										<label for="inp_price">Unit Price:</label>
										<input type="number" class="form-control" name="inp_price" step="0.000001"value="<?=$order_item_info['price']?>">
									</div>
									<input type="submit" class="btn btn-primary" value="Update">
								<?=form_close()?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("mouseenter", ".img_box", function() {
			var img_prev = $(this).children().children(".img_preview");
			var img_change = $(this).children().children(".img_u_change");
			img_change.removeClass("d-none");
			img_change.css({
				top: img_prev.position.top,
				left: img_prev.position.left,
				width: img_prev.outerWidth(),
				height: img_prev.outerHeight()
			});
		}).on("mouseleave", ".img_box", function() {
			$(this).children().children(".img_u_change").addClass("d-none");
		});
		$(document).on("click", ".img_u_change", function() {
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
					$(this).children().children(".img_input").attr("name", "inp_img_" + (index + 1));
				});

				// add new imgbox
				if ($(".img_box").length < 10 && $(t.target).hasClass("no_img")) {
					$(t.target).removeClass("no_img");

					$(".img_container").append($("<div>").attr({
						class: "col-6 col-md-4 img_box mb-3"
					}).append($("<div>").attr({
						class: "img_u_box"
					}).append($("<input>").attr({
						type: "file",
						class: "d-none img_input no_img",
						name: "inp_img_" + ($(".img_box").length + 1)
					})).append($("<img>").attr({
						class: "item_img img_preview",
						src: "<?=base_url()?>assets/img/no_img.png"
					})).append($("<div>").attr({
						class: "img_u_change item_img p-3 text-center d-none"
					}).html("Change Image")).append($("<a>").attr({
						class: "img_remove"
					}).append($("<i>").attr({ class: "fa fa-times fa-lg", "aria-hidden": "true" })))));
					
					$("#img_count").val($(".img_box").length);
				}
			}
		});

		$(document).on("click", ".img_remove", function(t) {
			if ($(".img_box").length > 1 && !$(this).siblings(".img_input").hasClass("no_img")) {
				$(this).parent().parent().remove();
			}
			$(".img_box").each(function(index, el) {
				$(this).children().children(".img_input").attr("name", "inp_img_" + (index + 1));
			});
		});

		$("#user_email").on("keyup", function(e) {
			if ($(this).val().length > 0) {
				if (!$(".email_dropdown").hasClass("show")) {
					$("#user_email").dropdown("toggle");
				}
				$.get("email_search", { dataType: "json", search: $(this).val() })
				.done(function(data) {
					var emails = $.parseJSON(data);
					$(".email_dropdown").html("");
					$.each(emails, function(index, val) {
						$(".email_dropdown").append($("<a>").attr({ class: "dropdown-item email_item" }).html(val));
					});
				});
			} else {
				if ($(".email_dropdown").hasClass("show")) {
					$("#user_email").dropdown("toggle");
				}
			}
		});
		$(document).on("click", ".email_item", function(t) {
			if ($(this).html().length > 0) {
				$.get("address_get", { dataType: "json", email: $(this).html() })
				.done(function(data) {
					var address = $.parseJSON(data);
					$("#inp_zip_code").val(address["zip_code"]);
					$("#inp_country").val(address["country"]);
					$("#inp_province").val(address["province"]);
					$("#inp_city").val(address["city"]);
					$("#inp_street").val(address["street"]);
					$("#inp_address").val(address["address"]);
				});
			}
		});
	});
</script>
</html>