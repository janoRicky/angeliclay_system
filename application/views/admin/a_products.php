
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
					<div class="container-fluid p-2 py-5 p-sm-5">
						<?php if ($this->session->flashdata("alert")): ?>
							<?php $alert = $this->session->flashdata("alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="close" data-dismiss="alert">
									&times;
								</button>
							</div>
						<?php endif; ?>
						<div class="row py-3">
							<div class="col-12 col-sm-6 text-left">
								<h2 class="font-weight-bold">Products (<?=$tbl_products->num_rows()?>)</h2>
							</div>
							<div class="col-12 col-sm-6 text-right">
								<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_product">New Product</button>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table id="table_products" class="table table-striped table-hover table-responsive-md table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Img</th>
											<th>Name</th>
											<th>Description</th>
											<th>Type</th>
											<th>Qty.</th>
											<th>Visible</th>
											<th>Featured</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_products->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?=$row["product_id"]?>
												</td>
												<td>
													<img class="img-responsive img_row img_zoomable" src="<?php
													if (!empty($row["img"])) {
														echo base_url(). 'uploads/products/product_'. $row["product_id"] .'/'. $row["img"];
													} else {
														echo base_url(). "assets/img/no_img.png";
													}
													?>">
												</td>
												<td>
													<?=$row["name"]?>
												</td>
												<td>
													<?=$row["description"]?>
												</td>
												<td>
													<?php
													if (isset($tbl_types[$row["type_id"]])) {
														echo $tbl_types[$row["type_id"]];
													} else {
														echo "Deleted Type (Edit Required)";
													}
													?>
												</td>
												<td>
													<?=$row["qty"]?>
												</td>
												<td>
													<?=($row["visibility"] == 1 ? "YES" : "NO")?>
												</td>
												<td>
													<?=($row["featured"] != NULL ? $row["featured"] : "NO")?>
												</td>
												<td>
													<button class="btn btn-primary btn-sm btn_featured" data-toggle="modal" data-target="#modal_featured" data-id="<?=$row['product_id']?>">Feature</button><br>
													<button class="btn btn-primary btn-sm mt-1 btn_visibility" data-toggle="modal" data-target="#modal_visibility" data-id="<?=$row['product_id']?>">Visibility</button><br>
													<a class="action_button" href="<?=base_url();?>admin/products_view?id=<?=$row['product_id']?>">
														<i class="fa fa-eye p-1" aria-hidden="true"></i>
													</a>
													<a class="action_button" href="<?=base_url();?>admin/products_edit?id=<?=$row['product_id']?>">
														<i class="fa fa-pencil p-1" aria-hidden="true"></i>
													</a>
													<i class="fa fa-trash p-1 btn_delete action_button" data-toggle="modal" data-target="#modal_delete_product" data-id="<?=$row['product_id']?>" aria-hidden="true"></i>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	</div>
	<!-- bootstrap modals -->
	<div id="modal_new_product" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_create", "method='POST' enctype='multipart/form-data'")?>
					<div class="modal-header">
						<h4 class="modal-title">New Product</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group text-center">
							<label>Image:</label>
							<input class="form-control mb-1" id="product_image" type="file" name="inp_img">
							<img class="img_view img_zoomable" id="image_preview" src="<?=base_url()?>assets/img/no_img.png">
						</div>
						<div class="form-group">
							<label>Name:</label>
							<input type="text" class="form-control" name="inp_name" placeholder="*Name" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Description:</label>
							<input type="text" class="form-control" name="inp_description" placeholder="*Description" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Type:</label>
							<select name="inp_type_id" class="form-control" required="">
								<?php foreach ($tbl_types as $key => $val): ?>
									<option value="<?=$key?>"><?=$val?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Price:</label>
							<input type="number" class="form-control" name="inp_price" placeholder="*Price" autocomplete="off" required="" step="0.000001">
						</div>
						<div class="form-group">
							<label>Quantity:</label>
							<input type="number" class="form-control" name="inp_qty" placeholder="*Quantity" autocomplete="off" required="">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Product">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_product" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_delete", "method='POST'");?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Product</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Product #<span id="delete_id"></span>?
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Yes">
						<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_featured" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_update_featured", "method='POST'");?>
					<input id="featured_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Feature Product</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Featured:</label>
							<select name="inp_featured_no" class="form-control" required="">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Feature">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_visibility" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_update_visibility", "method='POST'");?>
					<input id="visibility_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Set Visibility</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-warning" name="inp_submit" value="Set to Invisible">
						<input type="submit" class="btn btn-primary" name="inp_submit" value="Set to Visible">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_featured").on("click", function() {
			$("#featured_inp_id").val($(this).data("id"));
		});
		$(".btn_visibility").on("click", function() {
			$("#visibility_inp_id").val($(this).data("id"));
		});
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_products").DataTable({ "order": [[0, "desc"]] });


		$(document).on("change", "#product_image", function() {
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