
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
						<h2>Update Order #<?=$row_info["order_id"]?></h2>
					</div>
					<div class="col-12">
						<?=form_open(base_url() . "admin/order_update", "method='POST'"); ?>
							<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
							<div class="form-group">
								<label for="inp_user_email">User Email:</label>
								<input type="text" class="form-control" name="inp_user_email" placeholder="Email Address" autocomplete="off" value="<?=$this->model_read->get_user_acc_wid($row_info["user_id"])->row_array()["email"]?>">
							</div>
							<div class="form-group">
								<label for="inp_description">Description:</label>
								<input type="text" class="form-control" name="inp_description" placeholder="Description" autocomplete="off" value="<?=$row_info['description']?>">
							</div>
							<div class="form-group">
								<label for="inp_date">Date:</label>
								<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d', strtotime($row_info['date']))?>">
							</div>
							<div class="form-group">
								<label for="inp_time">Time:</label>
								<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i', strtotime($row_info['time']))?>">
							</div>
		<div class="form-group">
			<label for="inp_time">Ordered Items:</label>
			<input id="items_no" type="hidden" name="items_no" value="<?=$tbl_order_items->num_rows()?>">
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
					<?php foreach ($tbl_order_items->result_array() as $key => $row): ?>

						<!-- <tr id="item_1" class="item_product_5 order_row">
							<td>
								Figurine/test
							</td>
							<td>
								<input class="item_qty" type="number" name="item_1_qty" min="1" value="1" max="32">
							</td>
							<td class="item_price">
								<input type="hidden" name="item_1_price" value="346">
								<span>346.00</span>
							</td>
							<td>
								<button type="button" class="btn btn-sm btn-primary btn_remove_item">Remove</button>
							</td>
						</tr> -->

						<tr class="order_row">
							<?php
							$product = $this->model_read->get_product_wid($row["product_id"])->row_array();
							?>
							<td>
								<input type="hidden" name="item_<?=$key + 1?>_id" value="<?=$row["product_id"]?>">
								<?=$tbl_types[$product["type_id"]]. "/" .$product["description"]?>
							</td>
							<td>
								<input class="item_qty" type="number" name="item_<?=$key + 1?>_qty" min="1" value="<?=$row["qty"]?>" max="<?=$product["qty"] + $row["qty"]?>">
							</td>
							<td class="item_price">
								<input type="hidden" name="item_<?=$key + 1?>_price" value="<?=$row["price"]?>">
								<span><?=$row["price"] * $row["qty"]?></span>
							</td>
							<td>
								<button type="button" class="btn btn-sm btn-primary btn_remove_item">Remove</button>
							</td>
						</tr>
					<?php endforeach; ?>
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
	$(document).ready(function () {

		total();

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
	});
</script>
</html>