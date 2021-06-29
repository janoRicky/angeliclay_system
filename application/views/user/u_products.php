
<?php
$template_header;
?>

<style>
	.product-inline-block {
		background: #ededed;
		padding: 15px;
		margin: 10px 0;
		min-height: 165px;
	}

	.marginslim {
		padding-left: 7px;
		padding-right: 7px;
	}
</style>

<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<?=form_open(base_url() . "products", "method='GET'")?>
			<div class="row mt-5 pt-5">
				<div class="col-5">
					<input id="search_value" class="w-100" type="text" name="search" value="<?=$this->input->get("search")?>">
				</div>
				<div class="col-4">
					<select id="search_type" class="w-100" name="type">
						<option value="">All</option>
						<?php foreach ($types as $key => $val): ?>
							<option value="<?=$key?>" <?=($this->input->get("type") == $key ? "selected" : "")?>><?=$val?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-1">
					<button type="button" onclick="$('#search_type').val(''); $('#search_value').val('');">X</button>
				</div>
				<div class="col-2">
					<input class="w-100" type="submit" value="Search" onclick="$('#page').val(0);">
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-sm-12">
					<a href="<?=base_url()?>custom" class="text-dark">
						<div class="product-inline-block text-center p-5">
							<span class="font-weight-bold"><h2>Place Custom Order</h2></span>
						</div>
					</a>
				</div>
			</div>
			<div class="row mt-5">
				<?php foreach ($tbl_products->result_array() as $row): ?>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<a href="<?=base_url()?>product?id=<?=$row['product_id']?>" class="text-dark">
							<div class="product-inline-block">
								<div class="row">
									<div class="col-md-5 col-sm-5 col-xs-5 marginslim">
										<img class="img-fluid" src="<?php
										if (!empty($row["img"])) {
											echo base_url(). 'uploads/product_'. $row["product_id"] .'/'. explode("/", $row["img"])[0];
										} else {
											echo base_url(). "assets/img/no_img.png";
										}
										?>">
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6 marginslim p-2">
										<span class="font-weight-bold" style="font-size: 20px;"><?=$row["name"]?></span>
										<div class="row mt-4">
											<div class="col-md-12 marginslim ml-2">
												<span class="font-italic"><?=$row["description"]?></span><br>
												<span class="font-weight-bold">PHP <?=number_format($row["price"], 2)?></span>
												<?php if ($row["qty"] < 1): ?>
													<span class="font-weight-bold"><h5>SOLD OUT</h5></span>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="row mt-5 pt-5">
				<div class="col-12 text-center">
					<input id="page" type="hidden" name="page" value="<?=$page_no?>">
					<input type="submit" value="PREV" onclick="$('#page').val(<?=$page_no - 1?>);" <?=($page_no < 1 ? "disabled" : NULL)?>>
					<input type="submit" value="NEXT" onclick="$('#page').val(<?=$page_no + 1?>);" <?=($page_limit ? "disabled" : NULL)?>>
				</div>
			</div>
		<?=form_close()?>
	</div>
	<footer style="background-color: white; height: auto;">
		<div class="row mx-5 py-4">
			<div class=" col">
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
					<li>
						<a href="#">
							<i class="fa fa-facebook-official bg dark" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-facebook-official" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</footer>
</body>
</html>