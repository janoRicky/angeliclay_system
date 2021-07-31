
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
						<div class="row pt-3 pb-1">
							<div class="col-12 col-sm-6 text-left">
								<h2 class="font-weight-bold">Orders (<?=$tbl_orders->num_rows()?>)</h2>
							</div>
							<div class="col-12 col-sm-6 text-right">
								<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_account">New Order</button>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col-12 col-sm-8 col-md-6 col-lg-4 text-center m-auto">
								<div class="card text-center bg-dark text-light p-1">
									<?=form_open(base_url() . "admin/orders", "method='GET'");?>
										<?php $state = (isset($_GET["state"]) ? $_GET["state"] : "ALL"); ?>
										<select id="state_sort" name="state" class="form-control">
											<option value="ALL" <?=($state == "ALL" ? "selected" : "")?>>ALL</option>
											<option value="0" <?=($state == "0" ? "selected" : "")?>><?=$states[0]?></option>
											<option value="1" <?=($state == "1" ? "selected" : "")?>><?=$states[1]?></option>
											<option value="2" <?=($state == "2" ? "selected" : "")?>><?=$states[2]?></option>
											<option value="3" <?=($state == "3" ? "selected" : "")?>><?=$states[3]?></option>
											<option value="4" <?=($state == "4" ? "selected" : "")?>><?=$states[4]?></option>
											<option value="5" <?=($state == "5" ? "selected" : "")?>><?=$states[5]?></option>
										</select>
									<?=form_close()?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table id="table_orders" class="table table-striped table-hover table-responsive-md table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>User</th>
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
													<?php
													$user_info = $this->Model_read->get_user_acc_wid($row["user_id"])->row_array();
													?>
													<?php if ($user_info["email"] == NULL): ?>
														<a href="<?=base_url();?>admin/users_view?id=<?=$row["user_id"]?>">
															<i class="fa fa-eye p-1" aria-hidden="true"></i><?=$user_info["name_last"] .", ". $user_info["name_first"] ." ". $user_info["name_middle"] ." ". $user_info["name_extension"]?> [User #<?=$row["user_id"]?>]
														</a>
													<?php else: ?>
														<a href="<?=base_url();?>admin/users_view?id=<?=$row["user_id"]?>">
															<i class="fa fa-eye p-1" aria-hidden="true"></i><?=$user_info["email"]?> [User #<?=$row["user_id"]?>]
														</a>
													<?php endif; ?>
												</td>
												<td>
													<?=date("Y-m-d / H:i:s A", strtotime($row["date_time"]))?>
												</td>
												<td class="qty">
													<?=$total_qty?>
												</td>
												<td>
													PHP <?=number_format($total_price, 2)?>
												</td>
												<td>
													<?=$states[$row["state"]]?>
												</td>
												<td>
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
		</div>
	</div>
	<!-- bootstrap modals -->
	<div id="modal_new_account" class="modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_create", "method='POST'");?>
					<input id="inp_user_id" type="hidden" name="inp_user_id" required="">
					<div class="modal-header">
						<h4 class="modal-title">New Order</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="inp_user_email">User Email:</label>
							<div class="input-group">
								<input type="text" class="form-control user_email" name="inp_user_email" placeholder="*Email Address" autocomplete="off" data-toggle="dropdown" required="">
								<div class="dropdown-menu dropdown-menu-left email_dropdown w-100"></div>
								<span class="input-group-append">
									<button class="btn btn-secondary btn_no_account" type="button">
										<i class="fa fa-times" aria-hidden="true"></i> No Account
									</button>
								</span>
							</div>
						</div>
						<div class="no_account_details" style="display: none;">
							<div id="no_account" class="alert alert-warning text-center">
								Create New Buyer Record
							</div>
							<div class="form-group w-100">
								<label for="inp_name_last">Last Name:</label>
								<input id="inp_name_last" type="text" class="form-control no_account_last_name required" name="inp_name_last" placeholder="*Last Name" autocomplete="off" data-toggle="dropdown">
								<div class="dropdown-menu dropdown-menu-left no_account_dropdown w-100"></div>
							</div>
							<div class="form-group">
								<label for="inp_name_first">First Name:</label>
								<input id="inp_name_first" type="text" class="form-control required" name="inp_name_first" placeholder="*First Name" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="inp_name_middle">Middle Name:</label>
								<input id="inp_name_middle" type="text" class="form-control" name="inp_name_middle" placeholder="Middle Name" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="inp_name_extension">Name Extension:</label>
								<input id="inp_name_extension" type="text" class="form-control" name="inp_name_extension" placeholder="Name Extension" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="inp_gender">Gender:</label>
								<select id="inp_gender" name="inp_gender" class="form-control required">
									<option value="male" selected="">Male</option>
									<option value="female">Female</option>
									<option value="other">Other</option>
								</select>
							</div>
							<div class="form-group">
								<label for="inp_contact_num">Contact Number:</label>
								<input id="inp_contact_num" type="text" class="form-control required" name="inp_contact_num" placeholder="*Contact #" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label for="inp_description">Description:</label>
							<textarea class="form-control" name="inp_description" placeholder="*Description" style="resize: none;" rows="5" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="inp_date">Date:</label>
							<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d')?>" required="">
						</div>
						<div class="form-group">
							<label for="inp_time">Time:</label>
							<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i')?>" required="">
						</div>
						<div class="form-group">
							<label for="inp_zip_code">Zip Code:</label>
							<input type="text" class="form-control" id="inp_zip_code" name="inp_zip_code" placeholder="*Zip Code" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_country">Country:</label>
							<input type="text" class="form-control" id="inp_country" name="inp_country" placeholder="*Country" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_province">Province:</label>
							<input type="text" class="form-control" id="inp_province" name="inp_province" placeholder="*Province" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_city">City:</label>
							<input type="text" class="form-control" id="inp_city" name="inp_city" placeholder="*City" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_street">Street/Road:</label>
							<input type="text" class="form-control" id="inp_street" name="inp_street" placeholder="*Street/Road" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_address">House Number/Floor/Bldg./etc.:</label>
							<input type="text" class="form-control" id="inp_address" name="inp_address" placeholder="House Number/Floor/Bldg./etc." autocomplete="off">
						</div>
						<div class="form-group">
							<label>Ordered Items:</label>
							<input id="items_no" type="hidden" name="items_no" value="0" required="">
							<table id="table_items" class="table table-striped table-hover table-responsive-md table-bordered">
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
						<div class="form-group border px-3 py-2" style="background-color: #f1f1f1">
							<label>Products:</label>
							<table id="table_products" class="table table-striped table-hover table-responsive-lg table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Img</th>
										<th>Type</th>
										<th>Price</th>
										<th>Qty. (Stock)</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($tbl_products->result_array() as $row): ?>
										<tr id="product_<?=$row["product_id"]?>" class="text-center align-middle" >
											<td class="name">
												<?=$row["name"]?>
											</td>
											<td>
												<img class="img-responsive img_row img_zoomable" src="<?php
												if (!empty($row["img"])) {
													echo base_url(). 'uploads/product_'. $row["product_id"] .'/'. $row["img"];
												} else {
													echo base_url(). "assets/img/no_img.png";
												}
												?>">
											</td>
											<td>
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
						<input type="submit" class="btn btn-primary" value="Add Order" id="add_order">
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
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_orders").DataTable({ "order": [[0, "desc"]] });

		$(document).on("click", ".btn_no_account", function() {
			if ($(this).hasClass("w-100")) {
				$(this).parent().removeClass("w-100");
				$(this).removeClass("w-100");
				$(this).removeClass("btn-primary");
				$(this).addClass("btn-secondary");
				$(this).parent().siblings("input").show();
				$(".user_email").attr("required", true);
				$(this).parents(".input-group").siblings("label").show();
				$(".no_account_details").hide("100");
				$(".no_account_details .required").removeAttr("required");

				$(this).children("i").removeClass("fa-check");
				$(this).children("i").addClass("fa-times");

				if ($(".btn_new_buyer").length) {
					$(".btn_new_buyer").trigger("click");
				}
				$("#inp_user_id").val("");
			} else {
				$(this).parent().addClass("w-100");
				$(this).addClass("w-100");
				$(this).removeClass("btn-secondary");
				$(this).addClass("btn-primary");
				$(this).parent().siblings("input").hide();
				$(".user_email").removeAttr("required");
				$(this).parents(".input-group").siblings("label").hide();
				$(".no_account_details").show("100");
				$(".no_account_details .required").attr("required", true);

				$(this).children("i").removeClass("fa-times");
				$(this).children("i").addClass("fa-check");

				$("#inp_user_id").val("0");
			}
		});
		
		$(document).on("click", ".btn_add_to_items", function() {
			var p_id = $(this).attr("data-id");
			var $item_product = $(".item_product_" + p_id);
			
			if ($item_product.length < 1) {
				var ctr = parseInt($("#items_no").val()) + 1;
				var $product = $("#product_" + p_id);

				if (parseInt($product.children(".qty").html()) > 0) {
					var $description = $("<td>").append($("<input>").attr({
						type: "hidden",
						name: "item_" + ctr + "_id",
						value: $.trim(p_id)
					})).append($product.children(".name").html());
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
				}
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

		$(".user_email").on("keyup", function(e) {
			if ($(this).val().length > 0) {
				if (!$(".email_dropdown").hasClass("show")) {
					$(".user_email").dropdown("toggle");
				}
				$.get("email_search", { dataType: "json", search: $(this).val() })
				.done(function(data) {
					var emails = $.parseJSON(data);
					$(".email_dropdown").html("");
					$.each(emails, function(index, val) {
						$(".email_dropdown").append($("<a>").attr({ class: "dropdown-item email_item", "user-id": index }).html(val));
					});
				});
			} else {
				if ($(".email_dropdown").hasClass("show")) {
					$(".user_email").dropdown("toggle");
				}
			}
		});
		$(document).on("click", ".email_item", function(t) {
			var id = $(this).attr("user-id");
			if ($(this).html().length > 0) {
				$.get("address_get", { dataType: "json", user_id: id })
				.done(function(data) {
					var u_info = $.parseJSON(data);
					$(".user_email").val(u_info["email"]);
					$("#inp_zip_code").val(u_info["zip_code"]);
					$("#inp_country").val(u_info["country"]);
					$("#inp_province").val(u_info["province"]);
					$("#inp_city").val(u_info["city"]);
					$("#inp_street").val(u_info["street"]);
					$("#inp_address").val(u_info["address"]);

					$("#inp_user_id").val(id);
				});
			}
		});

		$(document).on("focus keyup", ".no_account_last_name", function() {
			$.get("name_search", { dataType: "json", search: $(this).val() })
			.done(function(data) {
				var names = $.parseJSON(data);
				$(".no_account_dropdown").html("");
				$.each(names, function(index, val) {
					$(".no_account_dropdown").append($("<a>").attr({ class: "dropdown-item no_account_item", "user-id": index }).html(val));
				});
			});
		});
		$(".no_account_last_name").on("keydown", function(e) {
			if (!$(".no_account_dropdown").hasClass("show")) {
				$(".no_account_last_name").dropdown("toggle");
			}
		});
		$(document).on("click", ".no_account_item", function(t) {
			var id = $(this).attr("user-id");
			if ($(this).html().length > 0) {
				$.get("info_get", { dataType: "json", user_id: id })
				.done(function(data) {
					var u_info = $.parseJSON(data);
					$(".no_account_last_name").val(u_info["name_last"]).attr("disabled", true);
					$("#inp_name_first").val(u_info["name_first"]).attr("disabled", true);
					$("#inp_name_middle").val(u_info["name_middle"]).attr("disabled", true);
					$("#inp_name_extension").val(u_info["name_extension"]).attr("disabled", true);
					$("#inp_gender option[value="+ u_info["gender"] +"]").prop("selected", true);
					$("#inp_gender").attr("disabled", true);
					$("#inp_contact_num").val(u_info["contact_num"]).attr("disabled", true);

					$("#inp_zip_code").val(u_info["zip_code"]);
					$("#inp_country").val(u_info["country"]);
					$("#inp_province").val(u_info["province"]);
					$("#inp_city").val(u_info["city"]);
					$("#inp_street").val(u_info["street"]);
					$("#inp_address").val(u_info["address"]);

					$("#no_account").removeClass("alert-warning");
					$("#no_account").addClass("alert-success");
					$("#no_account").html("Existing Buyer record").append($("<br>")).append($("<button>").attr({
						type: "button",
						class: "btn btn-warning btn-sm btn_new_buyer mt-1"
					}).html("New Buyer"));
					$("#modal_new_account input[required]").trigger("change");
					$("#inp_user_id").val(id);
				});
			}
		});

		$(document).on("click", ".btn_new_buyer", function(t) {
			$(".no_account_last_name").val("").removeAttr("disabled");
			$("#inp_name_first").val("").removeAttr("disabled");
			$("#inp_name_middle").val("").removeAttr("disabled");
			$("#inp_name_extension").val("").removeAttr("disabled");
			$("#inp_gender option[value=male]").prop("selected", true);
			$("#inp_gender").removeAttr("disabled");
			$("#inp_contact_num").val("").removeAttr("disabled");

			$("#no_account").removeClass("alert-success");
			$("#no_account").addClass("alert-warning");
			$("#no_account").html("Create New Buyer Record");
			$("#inp_user_id").val("0");
		});

		$(document).on("change", "#state_sort", function(e) {
			$(this).parent().submit();
		});

		$(document).on("click", "#add_order", function(e) {
			if ($("#items_no").val() < 1 || $("#items_no").val() == null) {
				alert("Missing Ordered Items.");
				e.preventDefault();
			}
		});
	});
</script>
</html>