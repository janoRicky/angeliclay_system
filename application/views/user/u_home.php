
<?php
$template_header;
?>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4" style="margin-top: 12rem;">
				<div class="col-0 col-lg-1"></div>
				<div class="col-12 col-lg-10 content">
					<!-- <?php if ($this->session->flashdata("notice")): ?>
						<?php $alert = $this->session->flashdata("notice"); ?>
						<div class="alert alert-<?=$alert[0]?> alert-dismissible">
							<?=$alert[1]?>
							<button type="button" class="close" data-dismiss="alert">
								&times;
							</button>
						</div>
					<?php endif; ?> -->
					<div class="row mt-2">
						<style type="text/css">
							.feat_container {
								margin-top: -12rem;
							}
							.feat_img {
								border: 0.25rem solid #ffc6dd;
								border-radius: 15%;
								max-height: 25rem;

								box-shadow: 0 0 1.2rem #fff;
							}
						</style>
						<div class="col-12 col-lg-12">
							<div class="row feat_container align-items-center" style="height: 25rem;">
								<div class="col-2 d-sm-none"></div>
								<div class="col-8 col-sm-4 p-2 feat_item item_2">
									<img class="feat_img" src="<?=base_url()?>assets/img/sample1.jpg" style="width: 75%; float: right;">
								</div>
								<div class="col-8 col-sm-4 p-2 feat_item item_3">
									<img class="feat_img" src="<?=base_url()?>assets/img/sample2.jpg" style="width: 100%; float: center;">
								</div>
								<div class="col-8 col-sm-4 p-2 feat_item item_1">
									<img class="feat_img" src="<?=base_url()?>assets/img/sample3.jpg" style="width: 75%; float: left;">
								</div>
								<div class="col-2 d-sm-none"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">Custom Order Types</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5 mb-5">
						<?php foreach ($tbl_types->result_array() as $key => $row): ?>
							<div class="col-0 col-lg-2"></div>
							<div class="col-12 col-lg-8">
								<div class="row align-items-center">
									<?php if ($key % 2 == 0): ?>
										<div class="col-7 marginslim p-2 text-right">
											<span class="font-weight-bold" style="font-size: 20px;"><?=$row["name"]?></span>
											<div class="row mt-4">
												<div class="col-md-12 marginslim ml-2">
													<span class="font-italic"><?=$row["description"]?></span><br>
													<span class="font-weight-bold">PHP <?=$row["price_range"]?></span>
												</div>
											</div>
										</div>
									<?php endif; ?>
									<div class="col-5 marginslim">
										<img class="feat_img img-fluid" src="<?php
										if (!empty($row["img"])) {
											echo base_url(). 'assets/img/featured/type_'. $row["type_id"] .'/'. explode("/", $row["img"])[0];
										} else {
											echo base_url(). "assets/img/no_img.png";
										}
										?>">
									</div>
									<?php if ($key % 2 == 1): ?>
										<div class="col-7 marginslim p-2">
											<span class="font-weight-bold" style="font-size: 20px;"><?=$row["name"]?></span>
											<div class="row mt-4">
												<div class="col-md-12 marginslim ml-2">
													<span class="font-italic"><?=$row["description"]?></span><br>
													<span class="font-weight-bold">PHP <?=$row["price_range"]?></span>
												</div>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-0 col-lg-2"></div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-0 col-lg-1"></div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		var feat_ctr = 1;
		$(window).on("resize", function(e) {
			$(".feat_item").each(function(index, el) {
				$(this).addClass("d-none");
			});
			if ($(window).width() < 568) {
				$(".feat_item.item_" + feat_ctr).removeClass("d-none").find("img").css({width: "100%", "float": "center"});
			} else {
				$(".feat_item").each(function(index, el) {
					$(this).removeClass("d-none");
				});
			}
			console.log($(window).width());
		});
		$(window).trigger("resize");
		setInterval(function() {
			var feat_1 = feat_ctr;
			var feat_2 = feat_ctr + 1;
			var feat_3 = feat_ctr + 2;
			if (feat_2 > $(".feat_item").length) {
				feat_2 = 1;
				feat_3 = 2;
			} else if (feat_3 > $(".feat_item").length) {
				feat_3 = 1;
			}

			$(".feat_item.item_" + feat_1).fadeOut(300, function() {
				if ($(window).width() >= 568) {
					$(this).fadeIn(1000)
					.find("img").css({width: "75%", "float": "left"});
				}
			});
			if ($(window).width() < 568) {
				$(".feat_item.item_" + feat_1).addClass("d-none");
			}
			$(".feat_item.item_" + feat_2).fadeOut(300, function() {
				if ($(window).width() < 568) {
					$(this).removeClass("d-none");
				}
				$(this).fadeIn(1000)
				.find("img").css({width: "100%", "float": "center"});
			});
			$(".feat_item.item_" + feat_3).fadeOut(300, function() {
				if ($(window).width() >= 568) {
					$(this).prependTo(".feat_container").fadeIn(1000)
					.find("img").css({width: "75%", "float": "right"});
				}
			});
			if ($(window).width() < 568) {
				$(".feat_item.item_" + feat_3).addClass("d-none");
			}

			if (feat_ctr >= $(".feat_item").length) {
				feat_ctr = 1;
			} else {
				feat_ctr += 1;
			}
		}, 5000);
	});
</script>
</html>