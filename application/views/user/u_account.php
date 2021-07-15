
<?php
$template_header;
?>

<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-lg-1"></div>
				<div class="col-12 col-lg-10 content pt-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Account Details <a href="account_details"><i class="fa fa-pencil p-1" aria-hidden="true"></i></a></h5>
							</div>
						</div>
					</div>
					<div class="row my-5">
						<div class="col-1 col-md-3"></div>
						<div class="col-10 col-md-6">
							<div class="row mt-2">
								<div class="col-4">
									<h5 class="font-weight-bold">Full Name: </h5>
								</div>
								<div class="col-8">
									<?=$account_details["name_last"] .", ". $account_details["name_first"] ." ". $account_details["name_middle"] ." ". $account_details["name_extension"]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4">
									<h5 class="font-weight-bold">Email: </h5>
								</div>
								<div class="col-8">
									<?=$account_details["email"]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4">
									<h5 class="font-weight-bold">Gender: </h5>
								</div>
								<div class="col-8">
									<?=$account_details["gender"]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4">
									<h5 class="font-weight-bold">Address: </h5>
								</div>
								<div class="col-8">
									<?=$account_details["zip_code"] ." / ". $account_details["country"] ." / ". $account_details["province"] ." / ". $account_details["city"] ." / ". $account_details["street"] ." / ". $account_details["address"]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4">
									<h5 class="font-weight-bold">Contact Num: </h5>
								</div>
								<div class="col-8">
									<?=$account_details["contact_num"]?>
								</div>
							</div>
						</div>
						<div class="col-1 col-md-3"></div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>