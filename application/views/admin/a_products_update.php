
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
						<h2>Update Product #<?=$row_info["product_id"]?></h2>
					</div>
					<div class="col-12">
						<?=form_open(base_url() . "admin/product_update", "method='POST' enctype='multipart/form-data'")?>
							<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info['product_id']?>">
							<div class="form-group">
								<?php $images = explode("/", $row_info["img"]); ?>
								<label>Image:</label>
								<input id="product_image" type="file" name="inp_img">
								<img class="w-100" id="image_preview" src="<?php
								if (!empty($row_info["img"])) {
									echo base_url(). 'uploads/product_'. $row_info["product_id"] .'/'. explode("/", $row_info["img"])[0];
								} else {
									echo base_url(). "assets/img/no_img.png";
								}
								?>" height="300" style="object-fit: contain;">
							</div>
							<div class="form-group">
								<label>Name:</label>
								<input type="text" class="form-control" name="inp_name" placeholder="Name" value="<?=$row_info['name']?>" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Description:</label>
								<input type="text" class="form-control" name="inp_description" placeholder="Description" value="<?=$row_info['description']?>" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Type:</label>
								<select name="inp_type_id" class="form-control">
									<?php foreach ($tbl_types as $key => $val): ?>
										<option value="<?=$key?>" <?=($row_info["type_id"] == $key ? "selected" : "")?>><?=$val?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Price:</label>
								<input type="number" class="form-control" name="inp_price" placeholder="Price" value="<?=$row_info['price']?>" autocomplete="off" step="0.000001">
							</div>
							<div class="form-group">
								<label>Quantity:</label>
								<input type="number" class="form-control" name="inp_qty" placeholder="Quantity" value="<?=$row_info['qty']?>" autocomplete="off">
							</div>
							<input type="submit" class="btn btn-primary" value="Update">
						<?=form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view("admin/template/a_t_scripts"); ?>
<script type="text/javascript">
	$(document).ready(function () {

		$("#product_image").change(function() {
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