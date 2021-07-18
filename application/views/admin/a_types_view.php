
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
						<div class="row">
							<div class="col-12 text-left">
								<h2>View Type #<?=$row_info["type_id"]?></h2>
							</div>
							<div class="col-12">
								<div class="row mt-2">
									<div class="col-0 col-sm-2 col-md-3 col-lg-4"></div>
									<div class="col-12 col-sm-8 col-md-6 col-lg-4">
									    <img class="img-responsive product_img" src="<?php
    									if (!empty($row_info["img"])) {
    										echo base_url(). 'assets/img/featured/type_'. $row_info["type_id"] .'/'. explode("/", $row_info["img"])[0];
    									} else {
    										echo base_url(). "assets/img/no_img.png";
    									}
    									?>">
									</div>
									<div class="col-0 col-sm-2 col-md-3 col-lg-4"></div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<h5>Type Name:</h5>
									</div>
									<div class="col-12">
										<?=$row_info["name"]?>
									</div>
								</div>
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
										<h5>Price Range:</h5>
									</div>
									<div class="col-12">
										<?=$row_info["price_range"]?>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<h5>Featured:</h5>
									</div>
									<div class="col-12">
										<?=($row_info["featured"] == 1 ? "YES" : "NO")?>
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