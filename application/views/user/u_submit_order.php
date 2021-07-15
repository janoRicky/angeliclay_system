
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
								<h5 class="font-weight-bold">Place Order</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-md-2"></div> 
						<div class="col-10 col-md-8">
							<?=form_open(base_url() . "place_order", "method='POST' enctype='multipart/form-data'")?>
								<div class="row mt-2">
									<div class="col-6 pull-right">
										<h3 class="font-weight-bold text-right">Grand Total: </h3>
									</div>
									<div class="col-6 pull-left">
										<h3 class="text-left">PHP <?=number_format($grand_total, 2)?></h3>
									</div>
								</div>
								<div class="row mt-2">
									<h2 class="font-weight-bold">Payment Method</h2>
								</div>
								<div class="row mt-2">
									<span>(Send Payment to GCash # 0999999999)</span>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">Ref No: </h5>
									</div>
									<div class="col-9">
										<input class="form-control" type="text" name="inp_ref_no" placeholder="Ref No" autocomplete="off">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">Proof of Payment (Img / Screenshot): </h5>
									</div>
									<div class="col-9">
										<div class="img_box">
											<div class="img_change w-100 h-100 p-3 text-center d-none">
												Change Image
											</div>
											<input class="d-none img_input" id="product_image" type="file" name="inp_img">
											<img class="w-100" id="image_preview" src="<?=base_url()?>assets/img/no_img.png" height="150" style="object-fit: contain;">
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<h2 class="font-weight-bold">Address</h2>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">Zip Code: </h5>
									</div>
									<div class="col-9">
										<input class="form-control" type="text" name="inp_zip_code" placeholder="Zip Code" value="<?=$account_details['zip_code']?>" autocomplete="off">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">Country: </h5>
									</div>
									<div class="col-9">
										<input class="form-control" type="text" name="inp_country" placeholder="Country" value="<?=$account_details['country']?>" autocomplete="off">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">Province: </h5>
									</div>
									<div class="col-9">
										<input class="form-control" type="text" name="inp_province" placeholder="Province" value="<?=$account_details['province']?>" autocomplete="off">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">City: </h5>
									</div>
									<div class="col-9">
										<input class="form-control" type="text" name="inp_city" placeholder="City" value="<?=$account_details['city']?>" autocomplete="off">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">Street/Road: </h5>
									</div>
									<div class="col-9">
										<input class="form-control" type="text" name="inp_street" placeholder="Street/Road" value="<?=$account_details['street']?>" autocomplete="off">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-3">
										<h5 class="font-weight-bold">House Number/Floor/Bldg./etc.: </h5>
									</div>
									<div class="col-9">
										<input class="form-control" type="text" name="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$account_details['address']?>" autocomplete="off">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<input class="form-control" type="submit" value="Place Order">
									</div>
								</div>
							<?=form_close()?>
						</div>
						<div class="col-1 col-md-2"></div>
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