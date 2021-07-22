
<?php
$template_header;
?>

<body>
	<div class="wrapper h-100">
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view("admin/template/a_t_sidebar"); ?>
				<?php $this->load->view("admin/template/a_t_navbar", $nav); ?>
				<div class="col-12 text-center">
					<div class="container-fluid p-5">
						<?php if ($this->session->flashdata("alert")): ?>
							<?php $alert = $this->session->flashdata("alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="close" data-dismiss="alert">
									&times;
								</button>
							</div>
						<?php endif; ?>
						<div class="row view_container">
							<div class="col-12 text-left">
								<h2>View User #<?=$row_info["user_id"]?></h2>
							</div>
							<div class="col-12">
								<div class="row mt-2">
									<div class="col-12 col-md-6">
										<label>Email:</label><br>
										<?=$row_info["email"]?>
									</div>
									<div class="col-12 col-md-6">
										<label>Full Name:</label><br>
										<?=$row_info["name_last"] .", ". $row_info["name_first"] ." ". $row_info["name_middle"] ." ". $row_info["name_extension"]?>
									</div>
									<div class="col-12 col-md-6">
										<label>Gender:</label><br>
										<?=$row_info["gender"]?>
									</div>
									<div class="col-12 col-md-6">
										<label>Contact #:</label><br>
										<?=$row_info["contact_num"]?>
									</div>
									<div class="col-12">
										<label>Full Address:</label><br>
										<?=$row_info["zip_code"] ." / ". $row_info["country"] ." / ". $row_info["province"] ." / ". $row_info["city"] ." / ". $row_info["street"] ." / ". $row_info["address"]?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
</script>
</html>