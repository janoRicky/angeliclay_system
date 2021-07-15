
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
								<h2>Update Type #<?=$row_info["type_id"]?></h2>
							</div>
							<div class="col-12">
								<?=form_open(base_url() . "admin/type_update", "method='POST' enctype='multipart/form-data'"); ?>
									<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info["type_id"]?>">
									<div class="form-group">
										<?php $images = explode("/", $row_info["img"]); ?>
										<label>Image:</label>
										<input id="type_image" type="file" name="inp_img">
										<img class="w-100" id="image_preview" src="<?php
										if (!empty($row_info["img"])) {
											echo base_url(). 'assets/img/featured/type_'. $row_info["type_id"] .'/'. explode("/", $row_info["img"])[0];
										} else {
											echo base_url(). "assets/img/no_img.png";
										}
										?>" height="300" style="object-fit: contain;">
									</div>
									<div class="form-group">
										<label for="inp_type">Type Name:</label>
										<input type="text" class="form-control" name="inp_name" placeholder="Type Name" value="<?=$row_info['name']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_type">Description:</label>
										<textarea class="form-control" name="inp_description" placeholder="Description"style="resize: none;"><?=$row_info['description']?></textarea>
									</div>
									<div class="form-group">
										<label for="inp_type">Price Range:</label>
										<input type="text" class="form-control" name="inp_price_range" placeholder="Price Range" value="<?=$row_info['price_range']?>" autocomplete="off">
									</div>
									<input type="submit" class="btn btn-primary" value="Update">
								<?=form_close(); ?>
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
	$(document).ready(function () {

		$("#type_image").change(function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#image_preview").attr("src", e.target.result);
				};
			}
		});

	});
</script>
</html>