
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
					<div class="col-6 text-left">
						<h2>Products (<?=$tbl_products->num_rows()?>)</h2>
					</div>
					<div class="col-6 text-right">
						<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_product">New Product</button>
					</div>
					<div class="col-12">
						<table id="table_products" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Description</th>
									<th>Type</th>
									<th>Price</th>
									<th>Qty.</th>
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
											<?=$row["price"]?>
										</td>
										<td>
											<?=$row["qty"]?>
										</td>
										<td>
											<a href="<?=base_url();?>admin/products_view?id=<?=$row['product_id']?>">
												<button class="btn btn-primary mb-1">View</button>
											</a><br>
											<a href="<?=base_url();?>admin/products_edit?id=<?=$row['product_id']?>">
												<button class="btn btn-primary mb-1">Edit</button>
											</a><br>
											<button class="btn btn-primary btn_delete" data-toggle="modal" data-target="#modal_delete_product" data-id="<?=$row['product_id']?>">Delete</button>
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
	<!-- bootstrap modals -->
	<div id="modal_new_product" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_create", "method='POST'")?>
					<div class="modal-header">
						<h4 class="modal-title">New Product</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Description:</label>
							<input type="text" class="form-control" name="inp_description" placeholder="Description" autocomplete="off">
						</div>
						<div class="form-group">
							<label>Type:</label>
							<select name="inp_type_id" class="form-control">
								<?php foreach ($tbl_types as $key => $val): ?>
									<option value="<?=$key?>"><?=$val?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Price:</label>
							<input type="number" class="form-control" name="inp_price" placeholder="Price" autocomplete="off" step="0.000001">
						</div>
						<div class="form-group">
							<label>Quantity:</label>
							<input type="number" class="form-control" name="inp_qty" placeholder="Quantity" autocomplete="off">
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
				<?=form_close();?>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view("admin/template/a_t_scripts"); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_products").DataTable();
	});
</script>
</html>