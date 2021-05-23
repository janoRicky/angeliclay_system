
<?php
$template_header;
?>

<body>
	<div class="wrapper h-100">
		<?php $this->load->view("admin/template/a_t_sidebar"); ?>
		<div class="content text-center">
			<?php $this->load->view("admin/template/a_t_navbar", $nav) ?>
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
				<div class="row">
					<div class="col-12 text-left">
						<h2>View User #<?=$row_info["user_id"]?></h2>
					</div>
					<div class="col-12">
						<div class="row mt-2">
							<div class="col-12">
								<h5>Full Name:</h5>
							</div>
							<div class="col-12">
								<?=$row_info["name"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Gender:</h5>
							</div>
							<div class="col-12">
								<?=$row_info["gender"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Email:</h5>
							</div>
							<div class="col-12">
								<?=$row_info["email"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Contact #:</h5>
							</div>
							<div class="col-12">
								<?=$row_info["contact_num"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Address:</h5>
							</div>
							<div class="col-12">
								<?=$row_info["address"]?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view("admin/template/a_t_scripts"); ?>
<script type="text/javascript">
	
</script>
</html>