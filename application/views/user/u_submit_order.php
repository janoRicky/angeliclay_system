
<?php
$template_header;
?>

<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<span>
			<h1 class="m-0" style="padding-top: 60px;">Place Order</h1>
		</span>
		<div class="row mt-5">
			<div class="col-3"></div> 
			<div class="col-6">
				<?=form_open(base_url() . "place_order", "method='POST'")?>
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
							<img class="w-100" src="<?=base_url()?>assets/img/no_img.png">
						</div>
					</div>
					<div class="row mt-2">
						<h2>Address</h2>
					</div>
					<div class="row mt-2">
						<div class="col-3">
							<h5 class="font-weight-normal m-0 p-0">Zip Code: </h5>
						</div>
						<div class="col-9">
							<input type="text" name="inp_zip_code" placeholder="Zip Code" value="<?=$account_details['zip_code']?>" autocomplete="off">
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-3">
							<h5 class="font-weight-normal m-0 p-0">Country: </h5>
						</div>
						<div class="col-9">
							<input type="text" name="inp_country" placeholder="Country" value="<?=$account_details['country']?>" autocomplete="off">
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-3">
							<h5 class="font-weight-normal m-0 p-0">Province: </h5>
						</div>
						<div class="col-9">
							<input type="text" name="inp_province" placeholder="Province" value="<?=$account_details['province']?>" autocomplete="off">
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-3">
							<h5 class="font-weight-normal m-0 p-0">City: </h5>
						</div>
						<div class="col-9">
							<input type="text" name="inp_city" placeholder="City" value="<?=$account_details['city']?>" autocomplete="off">
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-3">
							<h5 class="font-weight-normal m-0 p-0">Street/Road: </h5>
						</div>
						<div class="col-9">
							<input type="text" name="inp_street" placeholder="Street/Road" value="<?=$account_details['street']?>" autocomplete="off">
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-3">
							<h5 class="font-weight-normal m-0 p-0">House Number/Floor/Bldg./etc.: </h5>
						</div>
						<div class="col-9">
							<input type="text" name="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$account_details['address']?>" autocomplete="off">
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-12">
							<input type="submit" value="Place Order">
						</div>
					</div>
				<?=form_close()?>
			</div>
			<div class="col-3"></div>
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
				<h6>Account</h6>
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
</html>