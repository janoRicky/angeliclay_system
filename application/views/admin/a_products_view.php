
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
								<h2>View Product #<?=$row_info["product_id"]?></h2>
							</div>
							<div class="col-3">
								<img class="w-100" src="<?php
								if (!empty($row_info["img"])) {
									echo base_url(). 'uploads/product_'. $row_info["product_id"] .'/'. explode("/", $row_info["img"])[0];
								} else {
									echo base_url(). "assets/img/no_img.png";
								}
								?>" style="object-fit: contain; max-height: 500px;">
							</div>
							<div class="col-9">
								<div class="row mt-2">
									<div class="col-6">
										<div class="col-12">
											<label>Name:</label>
										</div>
										<div class="col-12">
											<?=$row_info["name"]?>
										</div>
									</div>
									<div class="col-6">
										<div class="col-12">
											<label>Type:</label>
										</div>
										<div class="col-12">
											<?php
											if ($row_info["type_name"] != NULL) {
												echo $row_info["type_name"];
											} else {
												echo "Deleted Type (Edit Required)";
											}
											?>
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<label>Description:</label>
									</div>
									<div class="col-12">
										<?=$row_info["description"]?>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<label>Date Added:</label>
									</div>
									<div class="col-12">
										<?=date("Y-m-d / H:i:s A", strtotime($row_info["date_added"]))?>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-6">
										<div class="col-12">
											<label>Price:</label>
										</div>
										<div class="col-12">
											<?=$row_info["price"]?>
										</div>
									</div>
									<div class="col-6">
										<div class="col-12">
											<label>Quantity:</label>
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
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
</script>
</html>