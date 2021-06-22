
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
<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<span>
			<h1 class="m-0" style="padding-top: 60px;">My Orders</h1>
		</span>
		<div class="row mt-5">
			<div class="col-9">
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Date/Time: </h5>
					</div>
					<div class="col-9">
						<?=$my_order["date"]." / ".date("h:i A", strtotime($my_order["time"]))?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Full Address: </h5>
					</div>
					<div class="col-9">
						<?=$my_order["zip_code"] ." / ". $my_order["country"] ." / ". $my_order["province"] ." / ". $my_order["city"] ." / ". $my_order["street"] ." / ". $my_order["address"]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Order State: </h5>
					</div>
					<div class="col-9">
						<?=$states[$my_order["state"]]?>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-3">
						<h5 class="font-weight-normal m-0 p-0">Order Item/s: </h5>
					</div>
					<div class="col-9">
						<?php if ($type == "CUSTOM"): ?>
							<?php
							$order_item = $order_items->row_array();
							$product_info = $this->model_read->get_product_custom_wid($order_item["product_id"])->row_array();
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
						<?php else: ?>
							<table id="table_items" class="table table-striped table-bordered">
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
											<td><?=$this->model_read->get_product_wid($row["product_id"])->row_array()["name"]?></td>
											<td><?=$row["qty"]?></td>
											<?php $total_qty += $row["qty"]; ?>
											<td><?=$row["price"]?></td>
											<td class="total_price"><?=$row["qty"] * $row["price"]?></td>
											<?php $total_price += $row["qty"] * $row["price"]; ?>
											<td>
												<a href="<?=base_url();?>product?id=<?=$row['product_id']?>">
													<button class="btn btn-sm btn-primary">View</button>
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
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-3">
				<h3>My Orders</h3>
				<a class="btn btn-primary mt-1" href="my_orders">ALL</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=0">PENDING</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=1">ACCEPTED / WAITING FOR PAYMENT</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=2">IN PROGRESS</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=3">SHIPPED</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=4">RECEIVED</a><br>
				<a class="btn btn-primary mt-1" href="my_orders?state=5">CANCELLED</a><br>
			</div>
		</div>
	</div>
	<footer style="background-color: white; height: auto;">
		<div class="row mx-5 py-4">
			<div class="col">
				<h6 class="mb-2">Links</h6>
					<ul class="nav flex-column">
						<li><a class="text-dark" href="#">FAQs</a></li>
						<li><a class="text-dark" href="#">About Us</a></li>
						<li><a class="text-dark" href="#">Contact Us</a></li>
						<li><a class="text-dark" href="#">Terms of Service</a></li>
						<li><a class="text-dark" href="#">Privacy Policy</a></li>
					</ul>
			</div>
			<div class="col">
				<h6>Our Location</h6>
			</div>
			<div class="col">
				<h6>Follow us on</h6>
				<ul class="nav">
					<li><a href="#">
						<i class="fa fa-facebook-official bg dark" aria-hidden="true"></i></a></li>
					<li><a href="#">
						<i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</footer>
</body>
</html>