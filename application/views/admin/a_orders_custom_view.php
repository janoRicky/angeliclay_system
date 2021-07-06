
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
						<h2>View Custom Order #<?=$row_info["order_id"]?></h2>
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
								<h5>Order Description:</h5>
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
								<h3>Custom Product Details:</h3>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Custom Product Page:</h5>
							</div>
							<?php if ($product_info["product_id"] != NULL): ?>
								<div class="col-12">
									<a href="<?=base_url();?>admin/products_view?id=<?=$product_info['product_id']?>">
										<i class="fa fa-eye p-1" aria-hidden="true"> Product #<?=$product_info['product_id']?></i>
									</a>
								</div>
							<?php endif; ?>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Custom Description:</h5>
							</div>
							<div class="col-12">
								<?=$product_info["description"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Type:</h5>
							</div>
							<div class="col-12">
								<?php
								if (isset($tbl_types[$product_info["type_id"]])) {
									echo $tbl_types[$product_info["type_id"]];
								} else {
									echo "Deleted Type (Edit Required)";
								}
								?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Size:</h5>
							</div>
							<div class="col-12">
								<?=$product_info["size"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Reference Images:</h5>
							</div>
							<?php $imgs = explode("/", $product_info["img"]); ?>
							<?php foreach ($imgs as $src): ?>
								<?php if ($src != NULL): ?>
									<div class="col-3 pb-3 mx-auto">
										<img class="img_preview" src="
										<?=base_url(). 'uploads/custom_'. $product_info["custom_id"] .'/'. $src?>">
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Qty:</h5>
							</div>
							<div class="col-12">
								<?=$order_item_info["qty"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Price:</h5>
							</div>
							<div class="col-12">
								<?=$order_item_info["price"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Payments:</h5>
							</div>
							<div class="col-12">
								<table id="table_payments" class="table table-striped table-bordered">
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
												<td><?=date("Y-m-d / H:i:s A", strtotime($row_info["date_time"]))?></td>
												<td><?=$row["description"]?></td>
												<td><?=$row["amount"]?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
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
	<div id="modal_state_order" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_update_state_custom", "method='POST' enctype='multipart/form-data'");?>
					<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
					<input type="hidden" name="inp_custom_id" value="<?=$product_info['custom_id']?>">
					<div class="modal-header">
						<h4 class="modal-title">Change State</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>State:</label>
							<select id="state_change" class="form-control" name="inp_state">
								<?php foreach ($states as $key => $val): ?>
									<option value="<?=$key?>" <?=($row_info["state"] == $key ? "selected" : "")?>><?=$val?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="state_waiting d-none">
							<div class="form-group">
								<label>Quantity:</label>
								<input type="number" class="form-control" name="inp_qty_pw" placeholder="Quantity" autocomplete="off" value="<?=$order_item_info['qty']?>">
							</div>
							<div class="form-group">
								<label>Price:</label>
								<input type="number" class="form-control" name="inp_price_pw" placeholder="Price" autocomplete="off" step="0.000001" value="<?=$order_item_info['price']?>">
							</div>
						</div>
						<?php if ($product_info["product_id"] == NULL): ?>
							<div class="state_shipped d-none">
								<div class="form-group">
									<div class="form-group">
										<label>Image:</label>
										<input id="product_image" type="file" name="inp_img">
										<img class="w-100" id="image_preview" src="<?=base_url()?>assets/img/no_img.png" height="150" style="object-fit: contain;">
									</div>
									<div class="form-group">
										<label>Name:</label>
										<input type="text" class="form-control" name="inp_name" placeholder="Name" autocomplete="off">
									</div>
									<div class="form-group">
										<label>Description:</label>
										<input type="text" class="form-control" name="inp_description" placeholder="Description" autocomplete="off">
									</div>
									<div class="form-group">
										<label>Type:</label>
										<select name="inp_type_id" class="form-control">
											<?php foreach ($tbl_types as $key => $val): ?>
												<option value="<?=$key?>"><?=$val?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Price:</label>
										<input type="number" class="form-control" name="inp_price_ps" placeholder="Price" autocomplete="off" step="0.000001" value="<?=$order_item_info['price']?>">
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="state_cancelled d-none">
							<div class="form-group text-center">
								<h4 class="text-danger">
									Order state cannot be reverted once it is cancelled.
								</h4>
							</div>
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
<script type="text/javascript">
	$(document).ready(function () {
		$("#table_payments").DataTable();

		$(".btn_state").on("click", function() {
			$("#state_change").trigger("change");
		});

		$(document).on("change", "#state_change", function(e) {
			$(".state_waiting").addClass("d-none");
			$(".state_shipped").addClass("d-none");
			$(".state_cancelled").addClass("d-none");
			if ($(this).val() == "1") {
				$(".state_waiting").removeClass("d-none");
			} else if ($(this).val() == "3") {
				$(".state_shipped").removeClass("d-none");
			} else if ($(this).val() == "5") {
				$(".state_cancelled").removeClass("d-none");
			}
		});

		$(document).on("change", "#product_image", function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#image_preview").attr("src", e.target.result);
				};
			}
		});
	});
</script>
</html>