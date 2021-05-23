
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
						<h2>Types (<?=$tbl_types->num_rows()?>)</h2>
					</div>
					<div class="col-6 text-right">
						<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_type">New Type</button>
					</div>
					<div class="col-12">
						<table id="table_types" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Type</th>
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
											<?=$row["type"]?>
										</td>
										<td>
											<a href="<?=base_url()?>admin/types_view?id=<?=$row['type_id']?>">
												<button class="btn btn-primary mb-1">View</button>
											</a><br>
											<a href="<?=base_url()?>admin/types_edit?id=<?=$row['type_id']?>">
												<button class="btn btn-primary mb-1">Edit</button>
											</a><br>
											<button class="btn btn-primary btn_delete" data-toggle="modal" data-target="#modal_delete_type" data-id="<?=$row['type_id']?>">Delete</button>
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
	<div id="modal_new_type" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/type_create", "method='POST'")?>
					<div class="modal-header">
						<h4 class="modal-title">New Type</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Type:</label>
							<input type="text" class="form-control" name="inp_type" placeholder="Type" autocomplete="off">
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
</body>
<?php $this->load->view("admin/template/a_t_scripts"); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_types").DataTable();
	});
</script>
</html>