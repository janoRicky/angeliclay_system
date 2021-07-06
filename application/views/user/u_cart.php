
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
</style>

<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<?php if ($this->session->flashdata("notice")): ?>
			<?php $alert = $this->session->flashdata("notice"); ?>
			<div class="alert alert-<?=$alert[0]?> alert-dismissible">
				<?=$alert[1]?>
				<button type="button" class="close" data-dismiss="alert">
					&times;
				</button>
			</div>
		<?php endif; ?>
		<span>
			<h1 class="m-0" style="padding-top: 60px;">Cart</h1>
		</span>
		<div class="row mt-5">
			<div class="col-sm-8">
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
						<div class="product-inline-block">
							<div class="row">
								<div class="col-md-5 col-sm-5 col-xs-5 marginslim">
									<a href="<?=base_url()?>product?id=<?=$item_info['product_id']?>" class="text-dark">
										<img class="img-fluid" src="<?php
										if (!empty($item_info["img"])) {
											echo base_url(). 'uploads/product_'. $item_info["product_id"] .'/'. explode("/", $item_info["img"])[0];
										} else {
											echo base_url(). "assets/img/no_img.png";
										}
										?>">
									</a>
								</div>
								<div class="col-md-7 col-sm-7 col-xs-7 marginslim p-2">
									<span class="font-weight-bold" style="font-size: 20px;"><?=$item_info["name"]?></span><br>
									<span class="font-italic"><?=$types[$item_info["type_id"]]?></span>
									<div class="row mt-4">
										<div class="col-md-12 marginslim ml-2">
											<span class="font-weight-bold">Qty: </span>
											<span><?=$val?></span>
										</div>
										<div class="col-md-12 marginslim ml-2">
											<span class="font-weight-bold">Price: </span>
											<span class="font-weight-bold">PHP <?=number_format($price, 2)?></span>
										</div>
										<div class="col-md-12 marginslim ml-2">
											<a class="remove_item" href="<?=base_url()?>remove_from_cart?id=<?=$key?>">
												<button class="btn btn-danger">Remove</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="col-sm-4">
				<div class="product-inline-block">
					<div class="p-3">
						<div class="row">
							<span class="font-weight-bold">Grand Total: PHP <?=number_format($grand_total, 2)?></span>
						</div>
						<div class="row">
							<a class="btn btn-primary" <?=(count($cart) > 0 ? "href='submit_order?grand_total=". $grand_total ."'" : "")?>>
								Place Order
							</a>
						</div>
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