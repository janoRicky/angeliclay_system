
<?php
$template_header;
?>

<style>
	.img_change {
		position: absolute;
		top: 0;
		left: 0;

		background-color: rgba(0,0,0,0.8);
		color: #fff;
		font-weight: bold;

		cursor: pointer;
	}
	.img_preview {
		object-fit: contain;
		min-height: 10rem;
		max-height: 12rem;
		border: 1px solid #000;
	}
</style>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-lg-1"></div>
				<div class="col-12 col-lg-10 content py-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Custom Order Payment</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-10">
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Date/Time: </h5>
								</div>
								<div class="col-9">
									<?=date("Y-m-d / H:i:s A", strtotime($my_order["date_time"]))?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Full Address: </h5>
								</div>
								<div class="col-9">
									<?=$my_order["zip_code"] ." / ". $my_order["country"] ." / ". $my_order["province"] ." / ". $my_order["city"] ." / ". $my_order["street"] ." / ". $my_order["address"]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Order State: </h5>
								</div>
								<div class="col-9">
									<?=$states[$my_order["state"]]?>
								</div>
							</div>
						</div>
						<div class="col-1"></div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Custom Order Details</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-10">
							<?php
							$order_item = $order_items->row_array();
							$product_info = $this->Model_read->get_product_custom_wid($order_item["product_id"])->row_array();
							?>
							<div class="row mt-2">
								<div class="col-12">
									<h5 class="font-weight-bold">Custom Description:</h5>
								</div>
								<div class="col-12" style="
									border: 0.5rem solid #dc8a6b;
									border-width: 0 0.5rem;
									border-radius: 3rem;">
									<?=$product_info["description"]?>
								</div>
								<div class="col-3 col-md-2">
									<h5 class="font-weight-bold">Type:</h5>
								</div>
								<div class="col-9 col-md-4">
									<?=$types[$product_info["type_id"]]?>
								</div>
								<div class="col-3 col-md-2">
									<h5 class="font-weight-bold">Size:</h5>
								</div>
								<div class="col-9 col-md-4">
									<?=$product_info["size"]?>
								</div>
								<div class="col-12">
									<h5 class="font-weight-bold">Reference Images:</h5>
								</div>
								<div class="row mt-1">
									<?php $imgs = explode("/", $product_info["img"]); ?>
									<?php foreach ($imgs as $src): ?>
										<?php if ($src != NULL): ?>
											<div class="col-3 pb-3 mx-auto">
												<img class="img_preview" src="
												<?=base_url(). 'uploads/custom_'. $product_info["custom_id"] .'/'. $src?>">
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
								<div class="col-3 col-md-2">
									<h5 class="font-weight-bold">Qty:</h5>
								</div>
								<div class="col-9 col-md-4">
									<?=$order_item["qty"]?>
								</div>
								<div class="col-3 col-md-2">
									<h5 class="font-weight-bold">Price:</h5>
								</div>
								<div class="col-9 col-md-4">
									<?=$order_item["price"]?>
								</div>
							</div>
						</div>
						<div class="col-1"></div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Payment Details</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-10">
							<?=form_open(base_url() . "payment", "method='POST' enctype='multipart/form-data'")?>
								<input type="hidden" name="inp_order_id" value="<?=$order_id?>">
								<!-- <div class="row mt-2">
									<div class="col-9">
										<select class="form-control" name="inp_payment_method">
											<option value="gcash">GCash</option>
										</select>
									</div>
								</div> -->
								<div class="row mt-2">
									<span>(Send Payment to GCash # 0999999999)</span>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">Ref No: </h5>
									</div>
									<div class="col-9">
										<input type="text" name="inp_ref_no" placeholder="Ref No" autocomplete="off">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">Proof of Payment (Img / Screenshot): </h5>
									</div>
									<div class="col-9">
										<div class="img_box">
											<div class="img_change form-control h-100 p-3 text-center d-none">
												Change Image
											</div>
											<input class="d-none img_input" id="product_image" type="file" name="inp_img">
											<img class="form-control" id="image_preview" src="<?=base_url()?>assets/img/no_img.png" height="150" style="object-fit: contain;">
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<input class="form-control" type="submit" value="Submit Payment">
									</div>
								</div>
							<?=form_close()?>
						<div class="col-1"></div>
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

		$(document).on("change", "#product_image", function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#image_preview").attr("src", e.target.result);
				};
			}
		});
	});
</script>
</html>