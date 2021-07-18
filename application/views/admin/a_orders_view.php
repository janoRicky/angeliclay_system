
<?php
$template_header;
?>

<style>
	.img_preview {
		object-fit: contain;
		min-height: 10rem;
		max-height: 12rem;
		border: 1px solid #000;
	}
</style>
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
							<div class="col-12 text-left">
								<h2>View Order #<?=$row_info["order_id"]?></h2>
							</div>
							<div class="col-12">
								<div class="row mt-2">
									<div class="col-12">
										<h5>User Email:</h5>
									</div>
									<div class="col-12">
										<?=$this->Model_read->get_user_acc_wid($row_info["user_id"])->row_array()["email"]?>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<h5>Description:</h5>
									</div>
									<div class="col-12">
										<?=$row_info["description"]?>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<h5>Date / Time:</h5>
									</div>
									<div class="col-12">
										<?=date("Y-m-d / H:i:s A", strtotime($row_info["date_time"]))?>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<h5>Full Address:</h5>
									</div>
									<div class="col-12">
										<?=$row_info["zip_code"] ." / ". $row_info["country"] ." / ". $row_info["province"] ." / ". $row_info["city"] ." / ". $row_info["street"] ." / ". $row_info["address"]?>
									</div>
								</div>

								<div class="row mt-2">
									<div class="col-12">
										<h5>Ordered Items:</h5>
									</div>
									<div class="col-12">
										<table id="table_items" class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>Item</th>
													<th>Qty.</th>
													<th>Unit Price</th>
													<th>Total Price</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $total_qty = 0; $total_price = 0; ?>
												<?php foreach ($tbl_order_items->result_array() as $row): ?>
													<tr>
														<td><?=$this->Model_read->get_product_wid($row["product_id"])->row_array()["name"]?></td>
														<td><?=$row["qty"]?></td>
														<?php $total_qty += $row["qty"]; ?>
														<td><?=$row["price"]?></td>
														<td class="total_price"><?=$row["qty"] * $row["price"]?></td>
														<?php $total_price += $row["qty"] * $row["price"]; ?>
														<td>
															<a href="<?=base_url();?>admin/products_view?id=<?=$row['product_id']?>">
																<button class="btn btn-sm btn-primary mb-1">View</button>
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
											<tr id="total_info">
												<td>Total</td>
												<td id="total_qty"><?=$total_qty?></td>
												<td></td>
												<td id="total_price"><?=$total_price?></td>
												<td></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<h5>Payments:</h5>
									</div>
									<div class="col-12">
										<table id="table_payments" class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Img</th>
													<th>Date / Time</th>
													<th>Description</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
												<?php $total_payment = 0; ?>
												<?php foreach ($tbl_payments->result_array() as $row): ?>
													<tr>
														<td><?=$row["payment_id"]?></td>
														<td>
															<?php if($row["img"] != NULL): ?>
																<img class="img_preview" src="<?php
																if (!empty($row["img"])) {
																	echo base_url(). 'uploads/users/user_'. $row_info["user_id"] .'/payments/order_'. $row_info["order_id"] .'/'. $row["img"];
																} else {
																	echo base_url(). "assets/img/no_img.png";
																}
																?>">
															<?php endif; ?>
														</td>
														<td><?=$row["date_time"]?></td>
														<td><?=$row["description"]?></td>
														<td><?=$row["amount"]?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12 text-center">
										<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_payment" data-id="<?=$row_info['order_id']?>">
											Add Payment
										</button>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<h5>Order State:</h5>
									</div>
									<div class="col-12">
										<?=$states[$row_info["state"]]?>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-12 text-center">
										<button class="btn btn-primary btn-lg btn_state" data-toggle="modal" data-target="#modal_state_order" data-id="<?=$row_info['order_id']?>">State</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="modal_payment" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_add_payment", "method='POST' enctype='multipart/form-data'");?>
					<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
					<div class="modal-header">
						<h4 class="modal-title">Add Payment</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="form-group">
								<label>Description:</label>
								<textarea class="form-control" rows="3" style="resize: none;" name="inp_description" maxlength="128"></textarea>
							</div>
							<div class="form-group">
								<label>Proof of Purchase / Screenshot:</label>
								<input id="proof_image" type="file" name="inp_img_proof">
								<img class="w-100" id="proof_preview" src="<?=base_url()?>assets/img/no_img.png" height="150" style="object-fit: contain;">
							</div>
							<div class="form-group">
								<label>Date:</label>
								<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d')?>">
							</div>
							<div class="form-group">
								<label>Time:</label>
								<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i')?>">
							</div>
							<div class="form-group">
								<label>Amount:</label>
								<input type="number" class="form-control" name="inp_amount" placeholder="Price" autocomplete="off" step="0.000001">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="payment_submit" value="Submit Payment for Order">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_state_order" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_update_state", "method='POST'");?>
					<input id="state_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Change State</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>State:</label>
							<select name="inp_state" class="form-control">
								<?php foreach ($states as $key => $val): ?>
									<option value="<?=$key?>"><?=$val?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Update State">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="<?=base_url()?>assets/js/sum().js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#table_items").DataTable();
		$("#table_payments").DataTable();

		$(".btn_state").on("click", function() {
			$("#state_inp_id").val($(this).data("id"));
		});
		
		$(document).on("change", "#proof_image", function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#proof_preview").attr("src", e.target.result);
				};
			}
		});
	});
</script>
</html>