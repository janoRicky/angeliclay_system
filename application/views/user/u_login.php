
<?php
$template_header;
?>

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
								<h5 class="font-weight-bold">Log-In</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-md-3"></div>
						<div class="col-10 col-md-6 text-center">
							<?=form_open(base_url() . "login_verify", "method='POST'")?>
								<div class="form-group">
									<h5 class="font-weight-bold" for="inp_email">Email:</h5>
									<input type="email" class="form-control" name="inp_email" placeholder="Email Address">
								</div>
								<div class="form-group">
									<h5 class="font-weight-bold" for="inp_password">Password:</h5>
									<input type="password" class="form-control" name="inp_password" placeholder="Password">
								</div>
								<input type="submit" class="btn btn-primary" value="Log-In">
							<?=form_close()?>
						</div>
						<div class="col-1 col-md-3"></div>
					</div>
					<div class="row mt-5">
						<div class="col-12 text-center">
							Don't have an account? <a href="register">Register</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>