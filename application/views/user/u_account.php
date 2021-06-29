
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
		<div class="row">
			<span>
				<h4 class="m-0" style="padding-top: 60px;">
					Account Details <a href="account_details"><i class="fa fa-pencil p-1" aria-hidden="true"></i></a>
				</h4>
			</span>
		</div>
		<div class="row mt-5">
			<div class="col-9">
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Full Name: </h5>
					</div>
					<div class="col-9">
						<?=$account_details["name_last"] .", ". $account_details["name_first"] ." ". $account_details["name_middle"] ." ". $account_details["name_extension"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Email: </h5>
					</div>
					<div class="col-9">
						<?=$account_details["email"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Gender: </h5>
					</div>
					<div class="col-9">
						<?=$account_details["gender"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Address: </h5>
					</div>
					<div class="col-9">
						<?=$account_details["zip_code"] ." / ". $account_details["country"] ." / ". $account_details["province"] ." / ". $account_details["city"] ." / ". $account_details["street"] ." / ". $account_details["address"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Contact Num: </h5>
					</div>
					<div class="col-9">
						<?=$account_details["contact_num"]?>
					</div>
				</div>
			</div>
			<div class="col-3">
				<h3>My Orders</h3>
				<a class="btn btn-primary mt-1" href="my_orders">ALL (<?=array_sum($order_state_counts)?>)</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=0">PENDING (<?=$order_state_counts["0"]?>)</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=1">ACCEPTED / WAITING FOR PAYMENT (<?=$order_state_counts["1"]?>)</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=2">IN PROGRESS (<?=$order_state_counts["2"]?>)</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=3">SHIPPED (<?=$order_state_counts["3"]?>)</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=4">RECEIVED (<?=$order_state_counts["4"]?>)</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=5">CANCELLED (<?=$order_state_counts["5"]?>)</a><br>
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
</html>