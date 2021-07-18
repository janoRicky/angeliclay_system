
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
							<div class="col-6 text-left">
								<h2>Types (<?=$tbl_types->num_rows()?>)</h2>
							</div>
							<div class="col-6 text-right">
								<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_type">New Type</button>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table id="table_types" class="table table-striped table-hover table-responsive-md table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Img</th>
											<th>Name</th>
											<th>Price Range</th>
											<th>Featured</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_types->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?=$row["type_id"]?>
												</td>
												<td>
            									    <img class="img-responsive product_img" src="<?php
                									if (!empty($row["img"])) {
                										echo base_url(). 'assets/img/featured/type_'. $row["type_id"] .'/'. explode("/", $row["img"])[0];
                									} else {
                										echo base_url(). "assets/img/no_img.png";
                									}
                									?>">
												</td>
												<td>
													<?=$row["name"]?>
												</td>
												<td>
													<?=$row["price_range"]?>
												</td>
												<td>
													<?=($row["featured"] == 1 ? "YES" : "NO")?>
												</td>
												<td>
													<button class="btn btn-primary btn-sm btn_featured" data-toggle="modal" data-target="#modal_featured" data-id="<?=$row['type_id']?>">Feature</button>
													<a class="action_button" href="<?=base_url()?>admin/types_view?id=<?=$row['type_id']?>">
														<i class="fa fa-eye p-1" aria-hidden="true"></i>
													</a>
													<a class="action_button" href="<?=base_url()?>admin/types_edit?id=<?=$row['type_id']?>">
														<i class="fa fa-pencil p-1" aria-hidden="true"></i>
													</a>
													<i class="fa fa-trash p-1 btn_delete action_button" data-toggle="modal" data-target="#modal_delete_type" data-id="<?=$row['type_id']?>" aria-hidden="true"></i>
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
	<!-- bootstrap modals -->
	<div id="modal_new_type" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/type_create", "method='POST' enctype='multipart/form-data'")?>
					<div class="modal-header">
						<h4 class="modal-title">New Type</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Image:</label>
							<input id="type_image" type="file" name="inp_img">
							<img class="w-100" id="image_preview" src="<?=base_url()?>assets/img/no_img.png" height="150" style="object-fit: contain;">
						</div>
						<div class="form-group">
							<label>Type Name:</label>
							<input type="text" class="form-control" name="inp_name" placeholder="Type Name" autocomplete="off">
						</div>
						<div class="form-group">
							<label>Description:</label>
							<textarea class="form-control" name="inp_description" placeholder="Description"style="resize: none;"></textarea>
						</div>
						<div class="form-group">
							<label>Price Range:</label>
							<input type="text" class="form-control" name="inp_price_range" placeholder="Price Range" autocomplete="off">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Type">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_type" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/type_delete", "method='POST'")?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Type</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Type #<span id="delete_id"></span>?
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
				<?=form_open(base_url() . "admin/type_update_featured", "method='POST'");?>
					<input id="featured_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Feature Type</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-warning" name="inp_submit" value="Unfeature">
						<input type="submit" class="btn btn-primary" name="inp_submit" value="Feature">
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
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_types").DataTable();

		$(document).on("change", "#type_image", function() {
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