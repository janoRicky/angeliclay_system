
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
				<!-- <div class="row">
					<div class="col-6 ml-auto">
						<div class="card text-center bg-dark text-light p-2">
							
						</div>
					</div>
				</div> -->
				<div class="row mb-3">
					<div class="col-4 text-left">
						<h2>Orders (<?=$tbl_orders->num_rows()?>)</h2>
					</div>
					<div class="col-4 text-center">
						<div class="card text-center bg-dark text-light p-1">
							<?=form_open(base_url() . "admin/orders", "method='GET'");?>
								<?php $state = (isset($_GET["state"]) ? $_GET["state"] : "ALL"); ?>
								<select id="state_sort" name="state" class="form-control">
									<option value="ALL" <?=($state == "ALL" ? "selected" : "")?>>ALL</option>
									<option value="0" <?=($state == "0" ? "selected" : "")?>>PENDING</option>
									<option value="1" <?=($state == "1" ? "selected" : "")?>>ACCEPTED / WAITING FOR PAYMENT</option>
									<option value="2" <?=($state == "2" ? "selected" : "")?>>IN PROGRESS</option>
									<option value="3" <?=($state == "3" ? "selected" : "")?>>SHIPPED</option>
									<option value="4" <?=($state == "4" ? "selected" : "")?>>RECEIVED</option>
									<option value="5" <?=($state == "5" ? "selected" : "")?>>CANCELLED</option>
								</select>
							<?=form_close()?>
						</div>
					</div>
					<div class="col-4 text-right">
						<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_account">New Order</button>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<table id="table_orders" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>User ID</th>
									<th>Date / Time</th>
									<th>Ordered Qty.</th>
									<th>Ordered Price</th>
									<th>State</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($tbl_orders->result_array() as $row): ?>
									<?php
									$total_qty = 0;
									$total_price = 0;
									foreach ($this->Model_read->get_order_items_qty_price_worder_id($row["order_id"])->result_array() as $item) {
										$total_qty += $item["qty"];
										$total_price += $item["qty"] * $item["price"];
									}
									?>
									<tr class="text-center align-middle">
										<td>
											<?=$row["order_id"]?>
										</td>
										<td>
											<?=$this->Model_read->get_user_acc_wid($row["user_id"])->row_array()["email"]?>
										</td>
										<td>
											<?=$row["date"]." / ".date("h:i A", strtotime($row["time"]))?>
										</td>
										<td>
											<?=$total_qty?>
										</td>
										<td>
											<?=$total_price?>
										</td>
										<td>
											<?=$states[$row["state"]]?>
										</td>
										<td>
											<button class="btn btn-primary btn-sm btn_state" data-toggle="modal" data-target="#modal_state_order" data-id="<?=$row['order_id']?>">State</button>
											<a class="action_button" href="<?=base_url()?>admin/orders_view?id=<?=$row['order_id']?>">
												<i class="fa fa-eye p-1" aria-hidden="true"></i>
											</a>
											<a class="action_button" href="<?=base_url();?>admin/orders_edit?id=<?=$row['order_id']?>">
												<i class="fa fa-pencil p-1" aria-hidden="true"></i>
											</a>
											<i class="fa fa-trash p-1 btn_delete action_button" data-toggle="modal" data-target="#modal_delete_order" data-id="<?=$row['order_id']?>" aria-hidden="true"></i>
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
	<!-- bootstrap modals -->
	<div id="modal_new_account" class="modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_create", "method='POST'");?>
					<div class="modal-header">
						<h4 class="modal-title">New Order</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="inp_user_email">User Email:</label>
							<input id="user_email" type="text" class="form-control" name="inp_user_email" placeholder="Email Address" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_description">Description:</label>
							<input type="text" class="form-control" name="inp_description" placeholder="Description" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_date">Date:</label>
							<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d')?>">
						</div>
						<div class="form-group">
							<label for="inp_time">Time:</label>
							<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i')?>">
						</div>
						<div class="form-group">
							<label for="inp_zip_code">Zip Code:</label>
							<input type="text" class="form-control" name="inp_zip_code" placeholder="Zip Code" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_country">Country:</label>
							<input type="text" class="form-control" name="inp_country" placeholder="Country" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_province">Province:</label>
							<input type="text" class="form-control" name="inp_province" placeholder="Province" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_city">City:</label>
							<input type="text" class="form-control" name="inp_city" placeholder="City" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_street">Street/Road:</label>
							<input type="text" class="form-control" name="inp_street" placeholder="Street/Road" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_address">House Number/Floor/Bldg./etc.:</label>
							<input type="text" class="form-control" name="inp_address" placeholder="House Number/Floor/Bldg./etc." autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_time">Ordered Items:</label>
							<input id="items_no" type="hidden" name="items_no" value="0">
							<table id="table_items" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Item</th>
										<th>Qty.</th>
										<th>Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr id="total_info">
										<td>Total</td>
										<td id="total_qty">0</td>
										<td id="total_price">0.00</td>
										<td>
											<button id="btn_remove_all" type="button" class="btn btn-sm btn-primary">Remove All</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="form-group">
							<label for="inp_time">Products:</label>
							<table id="table_products" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Description</th>
										<th>Type</th>
										<th>Price</th>
										<th>Qty. (Stock)</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($tbl_products->result_array() as $row): ?>
										<tr id="product_<?=$row["product_id"]?>" class="text-center align-middle" >
											<td>
												<?=$row["product_id"]?>
											</td>
											<td class="description">
												<?=$row["description"]?>
											</td>
											<td class="type">
												<?php
												if (isset($tbl_types[$row["type_id"]])) {
													echo $tbl_types[$row["type_id"]];
												} else {
													echo "Deleted Type (Edit Required)";
												}
												?>
											</td>
											<td class="price">
												<?=$row["price"]?>
											</td>
											<td class="qty">
												<?=$row["qty"]?>
											</td>
											<td>
												<button class="btn btn-sm btn-primary btn_add_to_items" type="button" data-id="<?=$row['product_id']?>">Add</button>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Order">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_order" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_delete", "method='POST'");?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Order</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Order #<span id="delete_id"></span>?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
						<input type="submit" class="btn btn-primary" value="Yes">
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
								<option value="0">PENDING</option>
								<option value="1">ACCEPTED / WAITING FOR PAYMENT</option>
								<option value="2">IN PROGRESS</option>
								<option value="3">SHIPPED</option>
								<option value="4">RECEIVED</option>
								<option value="5">CANCELLED</option>
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
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_state").on("click", function() {
			$("#state_inp_id").val($(this).data("id"));
		});
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_orders").DataTable();

		$(".btn_add_to_items").on("click", function() {
			var p_id = $(this).attr("data-id");
			var $item_product = $(".item_product_" + p_id);
			
			if ($item_product.length < 1) {
				var ctr = parseInt($("#items_no").val()) + 1;
				var $product = $("#product_" + p_id);

				var $description = $("<td>").append($("<input>").attr({
					type: "hidden",
					name: "item_" + ctr + "_id",
					value: $.trim(p_id)
				})).append($product.children(".type").html() + "/" + $product.children(".description").html());
				var $qty = $("<td>").append($("<input>").attr({
					class: "item_qty",
					type: "number",
					name: "item_" + ctr + "_qty",
					min: "1",
					value: "1",
					max: $.trim($product.children(".qty").html())
				}));
				var $price = $("<td>").append($("<input>").attr({
					type: "hidden",
					name: "item_" + ctr + "_price",
					value: $.trim($product.children(".price").html())
				})).append($("<span>")).attr("class", "item_price");
				var $action = $("<td>").append($("<button>").attr({
					type: "button",
					class: "btn btn-sm btn-primary btn_remove_item"
				}).html("Remove"));

				$("#total_info").before($("<tr>")
					.append($description)
					.append($qty)
					.append($price)
					.append($action).attr({
						id: "item_" + ctr,
						class: "item_product_" + p_id + " order_row"
					}));

				$("#items_no").val(ctr);
				$(".item_product_" + p_id).find(".item_qty").trigger("change");
			} else {
				var item_qty = $item_product.find(".item_qty");
				if (item_qty.val() < parseInt(item_qty.attr("max"))) {
					item_qty.val(parseInt(item_qty.val()) + 1);
					$(item_qty).trigger("change");
				}
			}
		});

		function total() {
			var total_qty = 0;
			var total_price = 0;
			if ($(".order_row").length > 0) {
				$(".item_qty").each(function(index, el) {
					total_qty += parseInt($(this).val());
				});
				$(".item_price > span").each(function(index, el) {
					total_price += parseFloat($(this).html());
				});
			}
			$("#total_qty").html(total_qty);
			$("#total_price").html(total_price.toFixed(2));
		}
		$(document).on("click", ".btn_remove_item", function() {
			$(this).parents("tr").remove();

			if ($(".order_row").length > 0) {
				var $item_qty = $(this).parents("tr").find(".item_qty");
				$(".item_qty").trigger("change");
			} else {
				$("#items_no").val(0);
				total();
			}
		});
		$(document).on("click", "#btn_remove_all", function() {
			$(".order_row").each(function(index, el) {
				$(el).remove();
			});
			
			$("#items_no").val(0);
			total();
		});

		$(document).on("change", ".item_qty", function(e) {
			var $item_price = $(e.target).parents("tr").children(".item_price");
			$item_price.children("span").html(parseFloat($(e.target).val() * $item_price.children("input").val()).toFixed(2));
			total();
		});

		$("#table_products").DataTable();


		// $("#user_email").on("keyup", function(e) {
		// 	if ($(this).val().length > 0) {
		// 		$.get('email_search', { search: $(this).val() })
		// 		.done(function(data) {
		// 			console.log(JSON.parse(data));
		// 		});
		// 	}
		// });

		$(document).on("change", "#state_sort", function(e) {
			$(this).parent().submit();
		});
	});
</script>
</html>