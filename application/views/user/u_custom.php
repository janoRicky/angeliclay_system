
<?php
$template_header;
?>

<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<span>
			<h1 class="m-0" style="padding-top: 60px;">Order Custom</h1>
		</span>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 mt-md-0 mt-sm-4 p-5">
				<?=form_open(base_url() . "#", "method='GET'")?>
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
						<h5 class="font-weight-bold m-2 p-0">Image Reference/s: </h5>
						<div class="col-12 row">
							<div class="col-3">
								<img class="img-fluid img-thumbnail" src="<?=base_url(). "assets/img/no_img.png"?>">
							</div>
							<div class="col-3">
								<img class="img-fluid img-thumbnail" src="<?=base_url(). "assets/img/no_img.png"?>">
							</div>
							<div class="col-3">
								<img class="img-fluid img-thumbnail" src="<?=base_url(). "assets/img/no_img.png"?>">
							</div>
							<div class="col-3">
								<img class="img-fluid img-thumbnail" src="<?=base_url(). "assets/img/no_img.png"?>">
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
</html>