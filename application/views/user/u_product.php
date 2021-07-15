
<?php
$template_header;
?>
<style type="text/css">
	.item_img {
		border: 0.35rem solid #ffc6dd;
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
								<h5 class="font-weight-bold">Product Details</h5>
							</div>
						</div>
					</div>
					<div class="row m-5">
						<div class="col-6">
							<img class="img-responsive item_img" src="<?php
							if (!empty($product_details["img"])) {
								echo base_url(). 'uploads/product_'. $product_details["product_id"] .'/'. explode("/", $product_details["img"])[0];
							} else {
								echo base_url(). "assets/img/no_img.png";
							}
							?>">
						</div>
						<div class="col-6">
							<?php
							$current_qty = $product_details["qty"];
							if ($this->session->has_userdata("cart")) {
								$cart = $this->session->userdata("cart");
								$item_key = array_search($product_details["product_id"], array_column($cart, 0));
								if ($item_key !== FALSE) {
									$current_qty = $product_details["qty"] - $cart[$item_key][1];
								}
							}
							?>
							<div class="row mt-4">
								<div class="col-12">
									<h2 class="font-weight-bold"><?=$product_details["name"]?></h2>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h4 class="font-weight-light"><?=$product_details["description"]?></h4>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-4">
									<h5 class="font-weight-bold">Type:</h5>
								</div>
								<div class="col-8">
									<h5><?=$type?></h5>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-4">
									<h5 class="font-weight-bold">Available:</h5>
								</div>
								<div class="col-8">
									<h5><?=$current_qty?></h5>
								</div>
							</div>
							<div class="row mt-4 mb-2">
								<div class="col-1 col-md-3"></div>
								<div class="col-10 col-md-6 text-center">
									<h3 class="font-weight-bold price">
										PHP <?=number_format($product_details["price"], 2)?>
									</h3>
								</div>
								<div class="col-1 col-md-3"></div>
							</div>
							<?=form_open(base_url() . "to_cart", "method='GET'")?>
								<input type="hidden" name="id" value="<?=$product_details['product_id']?>">
								<div class="row">
									<div class="col-12 col-md-3 text-center">
										<h5 class="font-weight-normal m-0 p-0">Qty:</h5>
									</div>
									<div class="col-12 col-md-9">
										<input class="form-control" type="number" name="amount" value="0" min="0" max="<?=$current_qty?>">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-6">
										<input class="btn btn-outline-dark btn-block font-weight-bold" type="submit" name="submit" value="Add to Cart">
									</div>
									<div class="col-6">
										<input class="btn btn-outline-danger btn-block font-weight-bold" type="submit" name="submit" value="Buy Now">
									</div>
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
</html>