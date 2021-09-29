
<?php
$template_header;
?>

<style>
	.img_change {
		position: absolute;
		top: 0;
		left: 0;

		background-color: rgba(0,0,0,0.8);
		color: #fff;
		font-weight: bold;

		cursor: pointer;
	}
	.img_preview {
		object-fit: contain;
		min-height: 10rem;
		max-height: 12rem;
		border: 1px solid #000;
	}
	.adtl_payment_row {
		cursor: pointer;
	}
</style>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content py-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Additional Payment/s &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-10">
							<div class="row mt-2">
								<div class="col-5">
									<table class="table table-center table-hover table-responsive-lg table-bordered">
										<thead>
											<tr>
												<th>Description</th>
												<th>Amount</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php if ($order_payments->num_rows() < 1): ?>
												<tr>
													<td class="text-center font-weight-bold" colspan="3">[ EMPTY ]</td>
												</tr>
											<?php else: ?>
												<?php foreach ($order_payments->result_array() as $key => $row): ?>
													<?php if ($key == 0) { $payment_id = $row["payment_id"]; $payment_desc = $row["description"]; } ?>
													<tr class="adtl_payment_row <?=($key == 0 ? 'bg-secondary text-light' : '')?>" data-id="<?=$row["payment_id"]?>">
														<td class="desc"><?=$row["description"]?></td>
														<td>PHP <?=number_format($row["amount"], 2)?></td>
														<td>
															<?php if ($row["status"] == "0"): ?>
																<b class="text-danger">UNPAID</b>
															<?php else: ?>
																<b class="text-success">PAID</b>
															<?php endif; ?>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
								<div class="col-7">
									<?php if (!isset($payment_id)): ?>
										<div class="row">
											<div class="col-12 text-center font-weight-bold text-success">
												[ NO PAYMENTS TO BE MADE ]
											</div>
										</div>
									<?php else: ?>
										<?=form_open(base_url() . "payment", "method='POST' enctype='multipart/form-data'")?>
											<input type="hidden" name="inp_order_id" value="<?=$order_id?>" required="">
											<input type="hidden" name="inp_payment_id" id="inp_payment_id" value="<?=$payment_id?>" required="">
											<div class="row mt-2">
												<h4 class="font-weight-bold">Payment for [ <span class="payment_desc text-success"><?=$payment_desc?></span> ]: </h4>
											</div>
											<div class="row mt-2">
												<span>(Send Payment to GCash # 0999999999)</span>
											</div>
											<div class="row mt-2">
												<div class="col-4 col-md-3">
													<h5 class="font-weight-bold">Ref No: </h5>
												</div>
												<div class="col-8 col-md-9">
													<input class="form-control" type="text" name="inp_ref_no" placeholder="*Ref No" autocomplete="off" required="">
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-4 col-md-3">
													<h5 class="font-weight-bold">Proof of Payment (Img / Screenshot): </h5>
												</div>
												<div class="col-8 col-md-9">
													<div class="img_u_box">
														<div class="img_u_change item_img p-3 text-center d-none">
															Change Image [REQUIRED]
														</div>
														<input class="d-none img_input" id="product_image" type="file" name="inp_img" required="">
														<img class="item_img img_u_preview" id="image_preview" src="<?=base_url()?>assets/img/no_img.png">
													</div>
												</div>
											</div>
											<hr>
											<div class="row mt-4 mb-3">
												<div class="col-12 text-center">
													<button class="button b_p b_lg" type="submit">
														<i class="fa fa-money" aria-hidden="true"></i> Submit Payment
													</button>
												</div>
											</div>
										<?=form_close()?>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-1"></div>
					</div>
				</div>
				<div class="col-0 col-sm-1"></div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("mouseenter", ".img_u_box", function() {
			var img_prev = $(this).children("#image_preview");
			var img_change = $(this).children(".img_u_change");
			img_change.removeClass("d-none");
			img_change.css({
				top: img_prev.position.top,
				left: img_prev.position.left,
				width: img_prev.outerWidth(),
				height: img_prev.outerHeight()
			});
		}).on("mouseleave", ".img_u_box", function() {
			$(this).children(".img_u_change").addClass("d-none");
		});
		$(document).on("click", ".img_u_change", function() {
			$(this).siblings(".img_input").trigger("click");
		});

		$(document).on("change", "#product_image", function(t) {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#image_preview").attr("src", e.target.result);
					$(t.target).siblings(".img_u_change").addClass("d-none");
				};
			}
		});

		$(document).on("click", ".adtl_payment_row", function(event) {
			$(".adtl_payment_row").removeClass("bg-secondary text-light");
			$(this).addClass("bg-secondary text-light");

			$("#inp_payment_id").val($(this).data("id"));
			$(".payment_desc").fadeOut(0).text($(this).children(".desc").html()).fadeIn(500);
		});
	});

</script>
</html>