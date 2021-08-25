
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
						<div class="row py-3">
							<div class="col-12 text-left">
								<h2 class="font-weight-bold">Messages (<?=$tbl_messages->num_rows()?>)</h2>
							</div>
						</div>
						
						<div class="row">
							<div class="col-12">
								<table id="table_messages" class="table table-striped table-hover table-responsive-md table-bordered">
									<thead>
										<tr>
											<th>User Email</th>
											<th>Latest Message</th>
											<th>Time</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_messages->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?php
													$user_info = $this->Model_read->get_user_acc_wid($row["user_id"])->row_array();
													?>
													<?=$user_info["email"]?>
												</td>
												<td class="text-white <?=($row['admin_id'] == NULL ? 'bg-primary' : 'bg-secondary')?>">
													<?=substr($row["message"], 0, 50) . (strlen($row["message"]) > 50 ? "..." : "")?>
												</td>
												<td>
													<?php
													$dateDiff = strtotime(date('Y-m-d H:i:s')) - strtotime($row['date_time']);
													$days = $dateDiff / (60 * 60 * 24);
													$hours = $dateDiff / (60 * 60);
													$minutes = $dateDiff / 60;
													if ($days > 1) {
														$timePassed = floor($days) . 'd';
													}
													elseif ($hours > 1) {
														$timePassed = floor($hours) . 'h';
													}
													elseif ($minutes > 1) {
														$timePassed = floor($minutes) . 'm';
													} else {
														$timePassed = $dateDiff . 's';
													}
													?>
													<?=$timePassed?> ago
												</td>
												<td>
													<a href="messaging_view?id=<?=$row["user_id"]?>">
														<i class="fa fa-eye p-1" aria-hidden="true"></i>
													</a>
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
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$("#table_messages").DataTable();
	});
</script>
</html>