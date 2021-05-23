
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
						<h2>Update User #<?=$row_info["user_id"]?></h2>
					</div>
					<div class="col-12">
						<?=form_open(base_url() . "admin/user_update", "method='POST'"); ?>
							<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$id?>">
							<div class="form-group">
								<label for="inp_name">Name:</label>
								<input type="text" class="form-control" name="inp_name" placeholder="Name" value="<?=$row_info['name']?>" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="inp_gender">Gender:</label>
								<select name="inp_gender" class="form-control">
									<option value="male" <?=($row_info['gender'] == "male" ? "selected" : "")?>>Male</option>
									<option value="female"<?=($row_info['gender'] == "female" ? "selected" : "")?>>Female</option>
									<option value="other"<?=($row_info['gender'] == "other" ? "selected" : "")?>>Other</option>
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
	
</script>
</html>