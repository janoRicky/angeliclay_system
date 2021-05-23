
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
						<h2>View Product #<?=$row_info["product_id"]?></h2>
					</div>
					<div class="col-12">
						<div class="row mt-2">
							<div class="col-12">
								<h5>Description:</h5>
							</div>
							<div class="col-12">
								<?=$row_info["description"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Type:</h5>
							</div>
							<div class="col-12">
								<?php
								if (isset($tbl_types[$row_info["type_id"]])) {
									echo $tbl_types[$row_info["type_id"]];
								} else {
									echo "Deleted Type (Edit Required)";
								}
								?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Price:</h5>
							</div>
							<div class="col-12">
								<?=$row_info["price"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Quantity:</h5>
							</div>
							<div class="col-12">
								<?=$row_info["qty"]?>
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