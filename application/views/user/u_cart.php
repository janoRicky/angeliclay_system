
<?php
$template_header;
?>

<style>
	.product-inline-block {
		background: #ededed;
		padding: 15px;
		margin: 10px 0;
		min-height: 165px;
	}

	.marginslim {
		padding-left: 7px;
		padding-right: 7px;
	}
	.item_img {
		border: 0.25rem solid #ffc6dd;
		border-radius: 10%;

		box-shadow: 0 0 1.2rem #fff;
		width: 100%;
	}
</style>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4">
				<div class="col-0 col-lg-1"></div>
				<div class="col-12 col-lg-10 content pt-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Cart</h5>
							</div>
						</div>
					</div>
					<div class="row my-5 pb-3">
						<div class="col-1"></div>
						<div class="col-10">
							<div class="row">
								<div class="col-12 col-md-7 px-5">
									<?php
									$grand_total = 0;
									?>
									<?php foreach ($cart as $key => $val):?>
										<?php if ($val != NULL):?>
											<?php

											$item_info = $this->Model_read->get_product_wid_user($key)->row_array();

											$price = $val * $item_info["price"];
											$grand_total += ($price);

											?>
											<div class="row align-items-center item mb-4">
												<div class="col-6">
													<a href="<?=base_url()?>product?id=<?=$item_info['product_id']?>" class="text-dark">
														<img class="img-responsive item_img" src="<?php
														if (!empty($item_info["img"])) {
															echo base_url(). 'uploads/product_'. $item_info["product_id"] .'/'. explode("/", $item_info["img"])[0];
														} else {
															echo base_url(). "assets/img/no_img.png";
														}
														?>">
													</a>
												</div>
												<div class="col-6">
													<div class="row">
														<div class="col-12">
															<h4 class="font-weight-bold"><?=$item_info["name"]?></h4>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<h5 class="font-weight-light"><?=$item_info["description"]?></h5>
														</div>
													</div>
													<div class="row">
														<div class="col-4">
															<h6 class="font-weight-bold">Qty:</h6>
														</div>
														<div class="col-8">
															<h6><?=$val?></h6>
														</div>
													</div>
													<div class="row">
														<div class="col-1"></div>
														<div class="col-10 text-center">
															<h5 class="font-weight-bold price">
																PHP <?=number_format($price, 2)?>
															</h5>
														</div>
														<div class="col-1"></div>
													</div>
													<div class="row">
														<div class="col-1 col-md-3"></div>
														<div class="col-10 col-md-6 text-center">
															<a class="remove_item" href="<?=base_url()?>remove_from_cart?id=<?=$key?>">
																<button class="btn btn-danger">Remove</button>
															</a>
														</div>
														<div class="col-1 col-md-3"></div>
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
								<div class="col-12 col-md-5 px-5">
									<div class="row align-items-center p-4" style="border: 0.4rem solid #ffc6dd; border-radius: 3rem; border-width: 0 0.4rem">
										<div class="col-12 text-center">
											<h5 class="font-weight-bold">Grand Total:</h5>
										</div>
										<div class="col-12 p-3 price text-center">
											<h4 class="font-weight-bold">PHP <?=number_format($grand_total, 2)?></h4>
										</div>
										<div class="col-12 text-center">
											<a class="btn btn-primary" <?=(count($cart) > 0 ? "href='submit_order?grand_total=". $grand_total ."'" : "")?>>
												Place Order
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-1"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer style="background-color: white; height: auto;">
		<div class="row mx-5 py-4">
			<div class="col">
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
		$(".remove_item").on('click', function(event) {
			if (!confirm("remove item?")) {
				event.preventDefault();
			}
		});
    });
</script>
</html>