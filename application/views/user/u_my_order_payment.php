
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
<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<span>
			<h1 class="m-0" style="padding-top: 60px;">Order #<?=$order_id?></h1>
		</span>
		<div class="row mt-5">
			<div class="col-12">
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Date/Time: </h5>
					</div>
					<div class="col-9">
						<?=date("Y-m-d / H:i:s A", strtotime($my_order["date_time"]))?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Full Address: </h5>
					</div>
					<div class="col-9">
						<?=$my_order["zip_code"] ." / ". $my_order["country"] ." / ". $my_order["province"] ." / ". $my_order["city"] ." / ". $my_order["street"] ." / ". $my_order["address"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Order State: </h5>
					</div>
					<div class="col-9">
						<?=$states[$my_order["state"]]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12 text-center">
						<h3>Custom Product Details</h3>
					</div>
				</div>
				<?php
				$order_item = $order_items->row_array();
				$product_info = $this->Model_read->get_product_custom_wid($order_item["product_id"])->row_array();
				?>
				<div class="row mt-2">
					<div class="col-3">
						<h5>Custom Description:</h5>
					</div>
					<div class="col-9">
						<?=$product_info["description"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5>Type:</h5>
					</div>
					<div class="col-9">
						<?=$types[$product_info["type_id"]]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5>Size:</h5>
					</div>
					<div class="col-9">
						<?=$product_info["size"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<h5>Reference Images:</h5>
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
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5>Qty:</h5>
					</div>
					<div class="col-9">
						<?=$order_item["qty"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5>Price:</h5>
					</div>
					<div class="col-9">
						<?=$order_item["price"]?>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<?=form_open(base_url() . "payment", "method='POST' enctype='multipart/form-data'")?>
				<input type="hidden" name="inp_order_id" value="<?=$order_id?>">
				<div class="row mt-2">
					<h2>Payment Method</h2>
				</div>
				<div class="row mt-2">
					<div class="col-9">
						<select class="w-100" name="inp_payment_method">
							<option value="gcash">GCash</option>
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<span>(Send Payment to GCash # 0999999999)</span>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Ref No: </h5>
					</div>
					<div class="col-9">
						<input type="text" name="inp_ref_no" placeholder="Ref No" autocomplete="off">
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Proof of Payment (Img / Screenshot): </h5>
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
					<div class="col-12">
						<input type="submit" value="Submit Payment">
					</div>
				</div>
			<?=form_close()?>
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