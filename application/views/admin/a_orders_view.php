
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
						<div class="row">
							<div class="col-12 col-sm-6 text-left">
								<h2>View Order #<?=$row_info["order_id"]?></h2>
							</div>
							<div class="col-12 col-sm-6 text-right">
								<a class="btn btn-primary" href="<?=base_url();?>admin/orders_edit?id=<?=$row_info['order_id']?>">
									<i class="fa fa-pencil p-1" aria-hidden="true"></i> Update
								</a>
							</div>
						</div>
						<div class="row view_container">
							<div class="col-12">
								<div class="row mt-2">
									<div class="col-12">
										<?php
										$user_info = $this->Model_read->get_user_acc_wid($row_info["user_id"])->row_array();
										?>
										<?php if ($user_info["email"] == NULL): ?>
											<label>No Account:</label><br>
											<a href="<?=base_url();?>admin/users_view?id=<?=$row_info["user_id"]?>">
												<i class="fa fa-eye p-1" aria-hidden="true"></i><?=$user_info["name_last"] .", ". $user_info["name_first"] ." ". $user_info["name_middle"] ." ". $user_info["name_extension"]?> [User #<?=$row_info["user_id"]?>]
											</a>
										<?php else: ?>
											<label>User Email:</label><br>
											<a href="<?=base_url();?>admin/users_view?id=<?=$row_info["user_id"]?>">
												<i class="fa fa-eye p-1" aria-hidden="true"></i><?=$user_info["email"]?> [User #<?=$row_info["user_id"]?>]
											</a>
										<?php endif; ?>
									</div>
									<div class="col-12">
										<label>Description:</label><br>
										<?=$row_info["description"]?>
									</div>
									<div class="col-12">
										<label>Date / Time:</label><br>
										<?=date("Y-m-d / H:i:s A", strtotime($row_info["date_time"]))?>
									</div>
									<div class="col-12">
										<label>Full Address:</label><br>
										<?=$row_info["zip_code"] ." / ". $row_info["country"] ." / ". $row_info["province"] ." / ". $row_info["city"] ." / ". $row_info["street"] ." / ". $row_info["address"]?>
									</div>

									<div class="col-12">
										<label>Ordered Items:</label>
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
												<?php if ($tbl_order_items->num_rows() < 1): ?>
													<tr>
														<td colspan="5" class="font-weight-bold">[ EMPTY ]</td>
													</tr>
												<?php else: ?>
													<?php foreach ($tbl_order_items->result_array() as $row): ?>
														<tr>
															<td>
																<a href="<?=base_url();?>admin/products_view?id=<?=$row["product_id"]?>">
																	<i class="fa fa-eye p-1" aria-hidden="true"></i> <?=$this->Model_read->get_product_wid($row["product_id"])->row_array()["name"]?>
																</a>
															</td>
															<td><?=$row["qty"]?></td>
															<?php $total_qty += $row["qty"]; ?>
															<td>
																PHP <?=number_format($row["price"], 2)?>
															</td>
															<td class="total_price">
																PHP <?=number_format($row["qty"] * $row["price"], 2)?>
															</td>
															<?php $total_price += $row["qty"] * $row["price"]; ?>
															<td>
																<a href="<?=base_url();?>admin/products_view?id=<?=$row['product_id']?>">
																	<button class="btn btn-sm btn-primary mb-1">View</button>
																</a>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											</tbody>
											<tr>
												<td class="font-weight-bold">Total</td>
												<td id="total_qty">
													<?=$total_qty?>
												</td>
												<td></td>
												<td id="total_price">
													PHP <?=number_format($total_price, 2)?>
												</td>
												<td></td>
											</tr>
										</table>
									</div>
									<div class="col-12">
										<label>Payments:</label>
										<table id="table_payments" class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Img</th>
													<th>Date / Time</th>
													<th>Description</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $total_payment = 0; ?>
												<?php if ($tbl_payments->num_rows() < 1): ?>
													<tr>
														<td colspan="6" class="font-weight-bold">[ EMPTY ]</td>
													</tr>
												<?php else: ?>
													<?php foreach ($tbl_payments->result_array() as $row): ?>
														<tr>
															<td class="id"><?=$row["payment_id"]?></td>
															<td>
																<?php if($row["img"] != NULL): ?>
																	<img class="img-responsive img_row img_zoomable" src="<?php
																	if (!empty($row["img"])) {
																		echo base_url(). 'uploads/users/user_'. $row_info["user_id"] .'/payments/order_'. $row_info["order_id"] .'/'. $row["img"];
																	} else {
																		echo base_url(). "assets/img/no_img.png";
																	}
																	?>">
																<?php endif; ?>
															</td>
															<td class="date_time"><?=$row["date_time"]?></td>
															<td class="description"><?=$row["description"]?></td>
															<?php $total_payment += $row["amount"]; ?>
															<td class="amount">
																PHP <span><?=number_format($row["amount"], 2)?></span>
															</td>
															<td>
																<button class="btn btn-primary btn-sm btn_update_payment my-2" data-toggle="modal" data-target="#modal_payment_update" data-id="<?=$row['payment_id']?>">
																	Update
																</button>
															</td>
														</tr>
													<?php endforeach; ?>
													<tr>
														<td class="font-weight-bold">Total</td>
														<td></td>
														<td></td>
														<td></td>
														<td>
															PHP <?=number_format($total_payment, 2)?>
														</td>
														<td></td>
													</tr>
												<?php endif; ?>
											</tbody>
										</table>
										<button class="btn btn-primary btn-lg my-2" data-toggle="modal" data-target="#modal_payment" data-id="<?=$row_info['order_id']?>">
											Add Payment
										</button>
									</div>
									<div class="col-12">
										<label>Unpaid Payments:</label>
										<table class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Description</th>
													<th>Amount To Be Paid</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($tbl_payments_unpaid->num_rows() < 1): ?>
													<tr>
														<td colspan="4" class="font-weight-bold">[ EMPTY ]</td>
													</tr>
												<?php else: ?>
													<?php foreach ($tbl_payments_unpaid->result_array() as $row): ?>
														<tr>
															<td class="id"><?=$row["payment_id"]?></td>
															<td class="description"><?=$row["description"]?></td>
															<td class="amount">
																PHP <span><?=number_format($row["amount"], 2)?></span>
															</td>
															<td>
																<i class="fa fa-trash p-1 btn_delete_payment action_button" data-toggle="modal" data-target="#modal_delete_payment_tbp" data-id="<?=$row['payment_id']?>" aria-hidden="true"></i>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											</tbody>
										</table>
										<button class="btn btn-primary btn-lg my-2" data-toggle="modal" data-target="#modal_payment_tbp" data-id="<?=$row_info['order_id']?>">
											Add Payment To Be Paid
										</button>
									</div>
									<div class="col-12">
										<label>Order State:</label><br>
										<?=$states[$row_info["state"]]?><br>
										<button class="btn btn-primary btn-lg btn_state my-2" data-toggle="modal" data-target="#modal_state_order" data-id="<?=$row_info['order_id']?>">State</button>
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
							<label>Payment Description:</label>
							<textarea class="form-control" rows="3" style="resize: none;" name="inp_description" maxlength="128" placeholder="Description"></textarea>
						</div>
						<div class="form-group text-center">
							<label>Proof of Purchase / Screenshot:</label>
							<input class="form-control mb-1" id="proof_image" type="file" name="inp_img_proof">
							<img class="img_view img_zoomable" id="proof_preview" src="<?=base_url()?>assets/img/no_img.png">
						</div>
						<div class="form-group">
							<label>Date:</label>
							<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d')?>" required="">
						</div>
						<div class="form-group">
							<label>Time:</label>
							<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i')?>" required="">
						</div>
						<div class="form-group">
							<label>Amount:</label>
							<input type="number" class="form-control" name="inp_amount" placeholder="*Price" autocomplete="off" required="" step="0.000001">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="payment_submit" value="Submit Payment for Order">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_payment_update" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_update_payment", "method='POST' enctype='multipart/form-data'");?>
					<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
					<input class="payment_u_id" type="hidden" name="inp_payment_id">
					<div class="modal-header">
						<h4 class="modal-title">Update Payment</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Payment Description:</label>
							<textarea class="form-control payment_u_description" rows="3" style="resize: none;" name="inp_description" maxlength="128" placeholder="Description"></textarea>
						</div>
						<div class="form-group">
							<label>Date:</label>
							<input type="date" class="form-control payment_u_date" name="inp_date" autocomplete="off" value="<?=date('Y-m-d')?>" required="">
						</div>
						<div class="form-group">
							<label>Time:</label>
							<input type="time" class="form-control payment_u_time" name="inp_time" autocomplete="off" value="<?=date('H:i')?>" required="">
						</div>
						<div class="form-group">
							<label>Amount:</label>
							<input type="number" class="form-control payment_u_amount" name="inp_amount" placeholder="*Amount" autocomplete="off" required="" step="0.000001">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="payment_submit" value="Update Payment for Order">
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
									<option value="<?=$key?>" <?=($row_info["state"] == $key ? "selected" : "")?>><?=$val?></option>
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
	<div id="modal_delete_payment_tbp" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/payment_delete", "method='POST'");?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Order</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Payment (TBP) #<span id="delete_id"></span>?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
						<input type="submit" class="btn btn-primary" value="Yes">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_payment_tbp" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_add_payment_tbp", "method='POST' enctype='multipart/form-data'");?>
					<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
					<div class="modal-header">
						<h4 class="modal-title">Add Payment</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Payment Description:</label>
							<textarea class="form-control" rows="3" style="resize: none;" name="inp_description" maxlength="128" placeholder="Description"></textarea>
						</div>
						<div class="form-group">
							<label>Amount:</label>
							<input type="number" class="form-control" name="inp_amount" placeholder="*Price" autocomplete="off" required="" step="0.000001">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="payment_submit" value="Submit Payment for Order">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="<?=base_url()?>assets/js/sum().js"></script>
<script type="text/javascript">
	$(document).ready(function () {

		$(".btn_delete_payment").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

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

		$(document).on("click", ".btn_update_payment", function() {
			var cell = $(this).parent();
			$(".payment_u_id").val(cell.siblings(".id").html());
			$(".payment_u_description").val(cell.siblings(".description").html());
			var date_time = cell.siblings(".date_time").html().split(" ");
			$(".payment_u_date").val(date_time[0]);
			var time = date_time[1].split(":");
			$(".payment_u_time").val(time[0] +":"+ time[1] +":00");
			$(".payment_u_amount").val(cell.siblings(".amount").children("span").html());
		});
	});
</script>
</html>