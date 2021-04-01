
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
						<h2>Update Account #<?=$id?></h2>
					</div>
					<div class="col-12">
						<?=form_open(base_url() . "admin/acc_update", "method='POST'"); ?>
							<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$id?>">
							<div class="form-group">
								<label for="inp_name">Name:</label>
								<input type="text" class="form-control" name="inp_name" placeholder="Name" value="<?=$account_info['name']?>" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="inp_email">Email:</label>
								<input type="email" class="form-control" name="inp_email" placeholder="Email Address" value="<?=$account_info['email']?>" autocomplete="off">
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
	$(document).ready(function () {
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});
	});
</script>
</html>