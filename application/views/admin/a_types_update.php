
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
						<h2>Update Type #<?=$row_info["type_id"]?></h2>
					</div>
					<div class="col-12">
						<?=form_open(base_url() . "admin/type_update", "method='POST'"); ?>
							<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$id?>">
							<div class="form-group">
								<label for="inp_type">Type:</label>
								<input type="text" class="form-control" name="inp_type" placeholder="Type" value="<?=$row_info['type']?>" autocomplete="off">
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