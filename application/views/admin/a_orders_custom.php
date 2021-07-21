
<?php
$template_header;
?>

<style>
	.img_remove {
		position: absolute;
		top: 0;
		right: 0;
		color: #ff0000 !important;
		cursor: pointer;
		padding: 1rem;
	}
	.img_remove:hover {
		color: #ffc0c0 !important;
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
						<div class="row mb-3">
							<div class="col-4 text-left">
								<h2>Custom Orders (<?=$tbl_orders_custom->num_rows()?>)</h2>
							</div>
							<div class="col-4 text-center">
								<div class="card text-center bg-dark text-light p-1">
									<?=form_open(base_url() . "admin/orders_custom", "method='GET'");?>
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
								<button class="btn btn-primary" data-toggle="modal" data-target="#modal_new_account">New Custom Order</button>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<table id="table_orders" class="table table-striped table-hover table-responsive-md table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>User ID</th>
											<th>Description</th>
											<th>Date / Time</th>
											<th>State</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_orders_custom->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?=$row["order_id"]?>
												</td>
												<td>
													<?=$this->Model_read->get_user_acc_wid($row["user_id"])->row_array()["email"]?>
												</td>
												<td>
													<?=$row["description"]?>
												</td>
												<td>
													<?=date("Y-m-d / H:i:s A", strtotime($row["date_time"]))?>
												</td>
												<td>
													<?=$states[$row["state"]]?>
												</td>
												<td>
													<a class="action_button" href="<?=base_url()?>admin/orders_custom_view?id=<?=$row['order_id']?>">
														<i class="fa fa-eye p-1" aria-hidden="true"></i>
													</a>
													<a class="action_button" href="<?=base_url();?>admin/orders_custom_edit?id=<?=$row['order_id']?>">
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
				<?=form_open(base_url() . "admin/order_custom_create", "method='POST' enctype='multipart/form-data'");?>
					<div class="modal-header">
						<h4 class="modal-title">New Custom Order</h4>
						<button type="button" class="close" data-dismiss="modal">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="inp_user_email">User Email:</label>
							<input id="user_email" type="text" class="form-control" name="inp_user_email" placeholder="Email Address" autocomplete="off" data-toggle="dropdown" required="">
							<div class="dropdown-menu dropdown-menu-left email_dropdown"></div>
						</div>
						<div class="form-group">
							<label for="inp_description">Description:</label>
							<textarea class="form-control" name="inp_description" placeholder="Description"style="resize: none;" rows="5" required=""></textarea>
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
							<input type="text" class="form-control" id="inp_zip_code" name="inp_zip_code" placeholder="Zip Code" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_country">Country:</label>
							<input type="text" class="form-control" id="inp_country" name="inp_country" placeholder="Country" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_province">Province:</label>
							<input type="text" class="form-control" id="inp_province" name="inp_province" placeholder="Province" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_city">City:</label>
							<input type="text" class="form-control" id="inp_city" name="inp_city" placeholder="City" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_street">Street/Road:</label>
							<input type="text" class="form-control" id="inp_street" name="inp_street" placeholder="Street/Road" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_address">House Number/Floor/Bldg./etc.:</label>
							<input type="text" class="form-control" id="inp_address" name="inp_address" placeholder="House Number/Floor/Bldg./etc." autocomplete="off">
						</div>
						<h4 class="pt-3">Custom Product Details</h4>
						<div class="form-group">
							<label for="inp_custom_description">Custom Description:</label>
							<textarea class="form-control" rows="5" style="resize: none;" name="inp_custom_description" maxlength="2040" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="inp_type_id">Type:</label>
							<select class="form-control" name="inp_type_id" required="">
								<?php foreach ($tbl_types as $key => $val): ?>
									<option value="<?=$key?>"><?=$val?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="inp_size">Size:</label>
							<input type="text" class="form-control" name="inp_size" required="">
						</div>
						<div class="form-group container">
							<input id="img_count" type="hidden" name="inp_img_count" value="0" required="">
							<label for="inp_img">Images:</label>
							<div class="img_container row">
								<div class="col-6 col-md-4 img_box mb-3">
									<div class="img_u_box">
										<input type="file" class="d-none img_input no_img" name="inp_img_1">
										<img class="item_img img_preview" src="<?=base_url()?>assets/img/no_img.png">
										<div class="img_u_change item_img p-3 text-center d-none">
											Change Image
										</div>
										<a class="img_remove">
											<i class="fa fa-times fa-lg" aria-hidden="true"></i>
										</a>
										<input type="hidden" class="img_check" name="inp_img_1_check">
									</div>
								</div>
							</div>
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
				<?=form_open(base_url() . "admin/orders_custom_delete", "method='POST'");?>
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

		$("#table_orders").DataTable();


		$(document).on("mouseenter", ".img_box", function() {
			var img_prev = $(this).children().children(".img_preview");
			var img_change = $(this).children().children(".img_u_change");
			img_change.removeClass("d-none");
			img_change.css({
				top: img_prev.position.top,
				left: img_prev.position.left,
				width: img_prev.outerWidth(),
				height: img_prev.outerHeight()
			});
		}).on("mouseleave", ".img_box", function() {
			$(this).children().children(".img_u_change").addClass("d-none");
		});
		$(document).on("click", ".img_u_change", function() {
			$(this).siblings(".img_input").trigger("click");
		});

		$(document).on("change", ".img_input", function(t) {
			if (t.target.files && t.target.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(t.target.files[0]);
				reader.onload = function(e) {
					$(t.target).siblings(".img_preview").attr("src", e.target.result);
				};

				$(".img_box").each(function(index, el) {
					$(this).children().children(".img_input").attr("name", "inp_img_" + (index + 1));
				});

				// add new imgbox
				if ($(".img_box").length < 10 && $(t.target).hasClass("no_img")) {
					$(t.target).removeClass("no_img");

					$(".img_container").append($("<div>").attr({
						class: "col-6 col-md-4 img_box mb-3"
					}).append($("<div>").attr({
						class: "img_u_box"
					}).append($("<input>").attr({
						type: "file",
						class: "d-none img_input no_img",
						name: "inp_img_" + ($(".img_box").length + 1)
					})).append($("<img>").attr({
						class: "item_img img_preview",
						src: "<?=base_url()?>assets/img/no_img.png"
					})).append($("<div>").attr({
						class: "img_u_change item_img p-3 text-center d-none"
					}).html("Change Image")).append($("<a>").attr({
						class: "img_remove"
					}).append($("<i>").attr({ class: "fa fa-times fa-lg", "aria-hidden": "true" })))));
					
					$("#img_count").val($(".img_box").length);
				}
			}
		});

		$(document).on("click", ".img_remove", function(t) {
			if ($(".img_box").length > 1 && !$(this).siblings(".img_input").hasClass("no_img")) {
				$(this).parent().parent().remove();
			}
			$(".img_box").each(function(index, el) {
				$(this).children().children(".img_input").attr("name", "inp_img_" + (index + 1));
			});
		});

		$("#user_email").on("keyup", function(e) {
			if ($(this).val().length > 0) {
				if (!$(".email_dropdown").hasClass("show")) {
					$("#user_email").dropdown("toggle");
				}
				$.get("email_search", { dataType: "json", search: $(this).val() })
				.done(function(data) {
					var emails = $.parseJSON(data);
					$(".email_dropdown").html("");
					$.each(emails, function(index, val) {
						$(".email_dropdown").append($("<a>").attr({ class: "dropdown-item email_item" }).html(val));
					});
				});
			} else {
				if ($(".email_dropdown").hasClass("show")) {
					$("#user_email").dropdown("toggle");
				}
			}
		});
		$(document).on("click", ".email_item", function(t) {
		    var email = $(this).html();
			if ($(this).html().length > 0) {
				$.get("address_get", { dataType: "json", email: email })
				.done(function(data) {
				    $("#user_email").val(email);
					var address = $.parseJSON(data);
					$("#inp_zip_code").val(address["zip_code"]);
					$("#inp_country").val(address["country"]);
					$("#inp_province").val(address["province"]);
					$("#inp_city").val(address["city"]);
					$("#inp_street").val(address["street"]);
					$("#inp_address").val(address["address"]);
				});
			}
		});
		
		$(document).on("change", "#state_sort", function(e) {
			$(this).parent().submit();
		});
	});
</script>
</html>