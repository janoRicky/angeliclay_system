
<?php
$template_header;
?>
<style type="text/css">
	.message_send {
		border-radius: 10rem;
	}
</style>
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
						<div class="row view_container">
							<div class="col-12 text-left">
								<h2>Message User #<?=$row_info["user_id"]?> <?=($row_info["email"] == NULL ? "[NO ACCOUNT]" : "")?></h2>
							</div>
							<div class="col-12 col-sm-10 mx-auto">
								<div class="row mt-2">
									<div class="col-12 col-sm-7">
										<?php foreach ($tbl_messages->result_array() as $row): ?>
											<?php if ($row["type"] == "0"): ?>
												<div class="row m-1">
													<div class="bg-primary mr-auto px-3 py-2 text-left" style="color: #fff; border-radius: 1.5rem; word-break: break-word; max-width: 90%;">
														<?=$row["message"]?>
													</div>
												</div>
											<?php else: ?>
												<div class="row m-1">
													<div class="bg-secondary ml-auto px-3 py-2 text-right" style="color: #fff; border-radius: 1.5rem; word-break: break-word; max-width: 90%;">
														<?=$row["message"]?>
													</div>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
									<div class="col-12 col-sm-5">
										<?=form_open(base_url() . "admin/message_send", "method='POST'"); ?>
											<input type="text" name="inp_user_id" value="2">
											<select name="inp_to">
												<option value="0">To Admin</option>
												<option value="1">To User</option>
											</select>
											<textarea class="form-control" name="inp_message" placeholder="Your message here..." style="resize: none;" required=""></textarea>
											<button class="btn pull-right font-weight-bold px-2 py-1" type="submit">
												Send <i class="fa fa-caret-right fa-lg" aria-hidden="true"></i>
											</button>
										<?=form_close(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {

	});
</script>
</html>