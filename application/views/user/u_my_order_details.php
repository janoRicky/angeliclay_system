
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
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-lg-1"></div>
				<div class="col-12 col-lg-10 content pt-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">My Orders</h5>
							</div>
						</div>
					</div>
					<div class="row my-3">
						<div class="col-1 col-md-2">
							<a class="scroll left" onclick="$('.nav_order').scrollLeft($('.nav_order').scrollLeft() - 100);">
								<i class="fa fa-caret-left p-1" aria-hidden="true"></i>
							</a>
						</div>
						<class class="col-10 col-md-8 nav_order justify-content-center">
							<a href="my_orders">ALL (<?=array_sum($order_state_counts)?>)</a>
							<a href="my_orders?state=0"><?=$states[0]?> (<?=$order_state_counts["0"]?>)</a>
							<a href="my_orders?state=1"><?=$states[1]?> (<?=$order_state_counts["1"]?>)</a>
							<a href="my_orders?state=2"><?=$states[2]?> (<?=$order_state_counts["2"]?>)</a>
							<a href="my_orders?state=3"><?=$states[3]?> (<?=$order_state_counts["3"]?>)</a>
							<a href="my_orders?state=4"><?=$states[4]?> (<?=$order_state_counts["4"]?>)</a>
							<a href="my_orders?state=5"><?=$states[5]?> (<?=$order_state_counts["5"]?>)</a>
						</class>
						<div class="col-1 col-md-2">
							<a class="scroll right" onclick="$('.nav_order').scrollLeft($('.nav_order').scrollLeft() + 100);">
								<i class="fa fa-caret-right p-1" aria-hidden="true"></i>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-1"></div>
						<div class="col-10 p-4">
							<div class="row">
								<div class="col-3">
									<h5 class="font-weight-bold m-0 p-0">Full Address: </h5>
								</div>
								<div class="col-9">
									<?=$my_order["zip_code"] ." / ". $my_order["country"] ." / ". $my_order["province"] ." / ". $my_order["city"] ." / ". $my_order["street"] ." / ". $my_order["address"]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold m-0 p-0">Order State: </h5>
								</div>
								<div class="col-9">
									<?=$states[$my_order["state"]]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold m-0 p-0">Order Item/s: </h5>
								</div>
								<div class="col-9">
									<?php if ($type == "CUSTOM"): ?>
										<?php
										$order_item = $order_items->row_array();
										$product_info = $this->Model_read->get_product_custom_wid($order_item["product_id"])->row_array();
										?>
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
												<?=$types[$product_info["type_id"]]?>
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
										<?php if ($my_order["state"] > 0): ?>
											<div class="row mt-2">
												<div class="col-12">
													<h5>Qty:</h5>
												</div>
												<div class="col-12">
													<?=$order_item["qty"]?>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-12">
													<h5>Price:</h5>
												</div>
												<div class="col-12">
													<?=$order_item["price"]?>
												</div>
											</div>
										<?php endif; ?>
									<?php else: ?>
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Item</th>
													<th>Qty.</th>
													<th>Unit Price</th>
													<th>Total Price</th>
												</tr>
											</thead>
											<tbody>
												<?php $total_qty = 0; $total_price = 0; ?>
												<?php foreach ($order_items->result_array() as $row): ?>
													<tr>
														<td><?=$this->Model_read->get_product_wid($row["product_id"])->row_array()["name"]?></td>
														<td><?=$row["qty"]?></td>
														<?php $total_qty += $row["qty"]; ?>
														<td><?=$row["price"]?></td>
														<td><?=$row["qty"] * $row["price"]?></td>
														<?php $total_price += $row["qty"] * $row["price"]; ?>
														<td>
															<a href="<?=base_url();?>product?id=<?=$row['product_id']?>">
																<button class="btn btn-sm btn-primary">View</button>
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
											<tr>
												<td>Total</td>
												<td><?=$total_qty?></td>
												<td></td>
												<td><?=$total_price?></td>
												<td></td>
											</tr>
										</table>
									<?php endif; ?>
								</div>
							</div>
							<?php if ($order_payments->num_rows() > 0): ?>
								<div class="row mt-2">
									<h3>Payments</h3>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Img</th>
													<th>Date / Time</th>
													<?php if ($my_order["state"] > 1): ?>
														<th>Description</th>
														<th>Amount</th>
													<?php endif; ?>
												</tr>
											</thead>
											<tbody>
												<?php $total_payment = 0; ?>
												<?php foreach ($order_payments->result_array() as $row): ?>
													<tr>
														<td><?=$row["payment_id"]?></td>
														<td>
															<?php if($row["img"] != NULL): ?>
																<img class="img_preview" src="<?php
																if (!empty($row["img"])) {
																	echo base_url(). 'uploads/users/user_'. $user_id .'/payments/order_'. $order_id .'/'. $row["img"];
																} else {
																	echo base_url(). "assets/img/no_img.png";
																}
																?>">
															<?php endif; ?>
														</td>
														<td><?=date("Y-m-d / H:i:s A", strtotime($my_order["date_time"]))?></td>
														<?php if ($my_order["state"] > 1): ?>
															<td><?=$row["description"]?></td>
															<td><?=$row["amount"]?></td>
															<?php $total_payment += $row["amount"]; ?>
														<?php endif; ?>
													</tr>
												<?php endforeach; ?>
											</tbody>
											<?php if ($my_order["state"] > 1): ?>
												<tr>
													<td>Total</td>
													<td></td>
													<td></td>
													<td></td>
													<td><?=$total_payment?></td>
												</tr>
											<?php endif; ?>
										</table>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-1"></div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>