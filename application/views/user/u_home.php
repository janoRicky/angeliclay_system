
<?php
$template_header;
?>

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
		<?php if ($this->session->has_userdata("user_name")): ?>
			<div class="row mt-5 pt-5">
				<div class="col-sm-12">
					<div class="text-center">
						<span class="font-weight-bold">
							<h2>Welcome <?=$this->session->userdata("user_name")?>!</h2>
						</span>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="row mt-5">
			<div class="col-sm-4 p-2">
				<img class="w-100" src="<?=base_url()?>assets/img/sample1.jpg">
			</div>
			<div class="col-sm-4 border border-dark p-2">
				<img class="w-100" src="<?=base_url()?>assets/img/sample2.jpg">
			</div>
			<div class="col-sm-4 border border-dark p-2">
				<img class="w-100" src="<?=base_url()?>assets/img/sample3.jpg">
			</div>
		</div>
		<div class="row mt-5 p-4" style="border: 1px solid #000;">
			<div class="col-2"></div>
			<div class="col-8">
				<?php foreach ($tbl_types->result_array() as $key => $row): ?>
					<div class="row mb-4">
						<?php if ($key % 2 == 0): ?>
							<div class="col-md-6 col-sm-6 col-xs-6 marginslim p-2 text-right">
								<span class="font-weight-bold" style="font-size: 20px;"><?=$row["name"]?></span>
								<div class="row mt-4">
									<div class="col-md-12 marginslim ml-2">
										<span class="font-italic"><?=$row["description"]?></span><br>
										<span class="font-weight-bold">PHP <?=$row["price_range"]?></span>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="col-md-5 col-sm-5 col-xs-5 marginslim">
							<img class="img-fluid" src="<?php
							if (!empty($row["img"])) {
								echo base_url(). 'assets/img/featured/type_'. $row["type_id"] .'/'. explode("/", $row["img"])[0];
							} else {
								echo base_url(). "assets/img/no_img.png";
							}
							?>">
						</div>
						<?php if ($key % 2 == 1): ?>
							<div class="col-md-6 col-sm-6 col-xs-6 marginslim p-2">
								<span class="font-weight-bold" style="font-size: 20px;"><?=$row["name"]?></span>
								<div class="row mt-4">
									<div class="col-md-12 marginslim ml-2">
										<span class="font-italic"><?=$row["description"]?></span><br>
										<span class="font-weight-bold">PHP <?=$row["price_range"]?></span>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="col-2"></div>
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
</html>