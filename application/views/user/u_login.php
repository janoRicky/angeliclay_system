
<?php
$template_header;
?>

<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<span>
			<h1 class="m-0" style="padding-top: 60px;">Log-In</h1>
		</span>
		<div class="row mt-5">
			<div class="col-4"><!-- this serves as margin --></div> 
			<div class="col-4">
				<div class="card text-center mt-5">
					<div class="card-header">
						<h3>LOG-IN</h3>
					</div>
					<div class="card-body">
						<?php if ($this->session->flashdata("user_alert")): ?>
							<?php $alert = $this->session->flashdata("user_alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="close" data-dismiss="alert">
									&times;
								</button>
							</div>
						<?php endif; ?>
						<?=form_open(base_url() . "login_verify", "method='POST'")?>
							<div class="form-group">
								<label for="inp_email">Email:</label>
								<input type="email" class="form-control" name="inp_email" placeholder="Email Address">
							</div>
							<div class="form-group">
								<label for="inp_password">Password:</label>
								<input type="password" class="form-control" name="inp_password" placeholder="Password">
							</div>
							<input type="submit" class="btn btn-primary" value="Log-In">
						<?=form_close()?>
					</div>
				</div>
				<a href="register">Register</a>
			</div>
			<div class="col-4"></div>
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