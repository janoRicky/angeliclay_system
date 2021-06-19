
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
						<h2>Users (<?=$tbl_users->num_rows()?>)</h2>
					</div>
					<div class="col-6 text-right">
						<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_account">New User</button>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<table id="table_users" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Gender</th>
									<th>Email</th>
									<th>Contact #</th>
									<th>Address</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($tbl_users->result_array() as $row): ?>
									<tr class="text-center align-middle">
										<td>
											<?=$row["user_id"]?>
										</td>
										<td>
											<?=$row["name"]?>
										</td>
										<td>
											<?=$row["gender"]?>
										</td>
										<td>
											<?=$row["email"]?>
										</td>
										<td>
											<?=$row["contact_num"]?>
										</td>
										<td>
											<?=$row["address"]?>
										</td>
										<td>
											<a class="action_button" href="<?=base_url();?>admin/users_view?id=<?=$row['user_id']?>">
												<i class="fa fa-eye p-1" aria-hidden="true"></i>
											</a>
											<a class="action_button" href="<?=base_url();?>admin/users_edit?id=<?=$row['user_id']?>">
												<i class="fa fa-pencil p-1" aria-hidden="true"></i>
											</a>
											<i class="fa fa-trash p-1 btn_delete action_button" data-toggle="modal" data-target="#modal_delete_user" data-id="<?=$row['user_id']?>" aria-hidden="true"></i>
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
	<div id="modal_new_account" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/user_create", "method='POST'");?>
					<div class="modal-header">
						<h4 class="modal-title">New Account</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="inp_name">Name:</label>
							<input type="text" class="form-control" name="inp_name" placeholder="Name" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_gender">Gender:</label>
							<select name="inp_gender" class="form-control">
								<option value="male" selected="">Male</option>
								<option value="female">Female</option>
								<option value="other">Other</option>
							</select>
						</div>
						<div class="form-group">
							<label for="inp_email">Email:</label>
							<input type="email" class="form-control" name="inp_email" placeholder="Email Address" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_contact_num">Contact Number:</label>
							<input type="text" class="form-control" name="inp_contact_num" placeholder="Contact #" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_address">Address:</label>
							<input type="text" class="form-control" name="inp_address" placeholder="Address" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_password">Password:</label>
							<input type="password" class="form-control" name="inp_password" placeholder="Password" autocomplete="off">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Account">
					</div>
				<?=form_close();?>
			</div>
		</div>
	</div>
	<div id="modal_delete_user" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/user_delete", "method='POST'");?>
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
						<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
						<input type="submit" class="btn btn-primary" value="Yes">
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

		$("#table_users").DataTable();
	});
</script>
</html>