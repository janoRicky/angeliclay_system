
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
					<?=form_open(base_url() . "register_account", "method='POST'")?>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Register</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-md-3"></div> 
						<div class="col-10 col-md-6">
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Last Name: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_name_last" placeholder="Last Name" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">First Name: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_name_first" placeholder="First Name" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Middle Name: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_name_middle" placeholder="Middle Name" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Name Extension: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_name_extension" placeholder="e.g. Jr., Sr., etc." autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Update Account Info</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-md-3"></div> 
						<div class="col-10 col-md-6">
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Email: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="email" name="inp_email" placeholder="Email Address" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Password: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="password" name="inp_password" placeholder="Password" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Gender: </h5>
								</div>
								<div class="col-9">
									<select class="form-control" name="inp_gender">
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Update Address Info</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-md-3"></div> 
						<div class="col-10 col-md-6">
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Zip Code: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_zip_code" placeholder="Zip Code" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Country: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_country" placeholder="Country" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Province: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_province" placeholder="Province" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">City: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_city" placeholder="City" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Street/Road: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_street" placeholder="Street/Road" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">House Number/Floor/Bldg./etc.: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_address" placeholder="Address" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Update Contact Info</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-md-3"></div> 
							<div class="col-10 col-md-6">
								<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Contact Num: </h5>
								</div>
								<div class="col-9">
									<input class="form-control" type="text" name="inp_contact_num" placeholder="Contact #" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-1 col-md-3"></div> 
						<div class="col-12 text-center"><input class="btn btn-primary" type="submit" value="Register"></div> 
					</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>