
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
						<h2>View Order #<?=$row_info["order_id"]?></h2>
					</div>
					<div class="col-12">
						<div class="row mt-2">
							<div class="col-12">
								<h5>User Email:</h5>
							</div>
							<div class="col-12">
								<?=$this->model_read->get_user_acc_wid($row_info["user_id"])->row_array()["email"]?>
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
								<?=$row_info["date"]." / ".date("h:i A", strtotime($row_info["time"]))?>
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
								<table id="table_items" class="table table-striped table-bordered">
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
												<td><?=$this->model_read->get_product_wid($row["product_id"])->row_array()["name"]?></td>
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
								<h5>Order State:</h5>
							</div>
							<div class="col-12">
								<?=$states[$row_info["state"]]?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="<?=base_url()?>assets/js/sum().js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		var tbl_items = $("#table_items").DataTable();

		// $("#total_qty").html(tbl_items.column(1).data().sum());
		// $("#total_price").html(tbl_items.column(3).data().sum());
	});
</script>
</html>