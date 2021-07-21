
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
					<div class="col-12-fluid p-5">
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
								<h2>Accounts (<?=$tbl_accounts->num_rows()?>)</h2>
							</div>
							<div class="col-6 text-right">
								<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_account">New Account</button>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table id="table_accounts" class="table table-striped table-hover table-responsive-sm table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_accounts->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?=$row["admin_id"]?>
												</td>
												<td>
													<?=$row["name"]?>
												</td>
												<td>
													<?=$row["email"]?>
												</td>
												<td>
													<a class="action_button" href="<?=base_url();?>admin/accounts_view?id=<?=$row['admin_id']?>">
														<i class="fa fa-eye p-1" aria-hidden="true"></i>
													</a>
													<a class="action_button" href="<?=base_url();?>admin/accounts_edit?id=<?=$row['admin_id']?>">
														<i class="fa fa-pencil p-1" aria-hidden="true"></i>
													</a>
													<i class="fa fa-trash p-1 btn_delete action_button" data-toggle="modal" data-target="#modal_delete_account" data-id="<?=$row['admin_id']?>" aria-hidden="true"></i>
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
	<div id="modal_new_account" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/acc_create", "method='POST'");?>
					<div class="modal-header">
						<h4 class="modal-title">New Account</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name:</label>
							<input type="text" class="form-control" name="inp_name" placeholder="Name" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Email:</label>
							<input type="email" class="form-control" name="inp_email" placeholder="Email Address" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Password:</label>
							<input type="password" class="form-control" name="inp_password" placeholder="Password" autocomplete="off" required="">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Account">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_account" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/acc_delete", "method='POST'");?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Account</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Account #<span id="delete_id"></span>?
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
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_accounts").DataTable();
	});
</script>
</html>