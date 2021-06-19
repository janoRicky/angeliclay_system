
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
						<h2>View Custom Order #<?=$row_info["order_id"]?></h2>
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
								<h5>Custom Item:</h5>
							</div>
						</div>
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
								<?=$product_info["type_name"]?>
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
								<?=$order_item_info["qty"]?>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<h5>Price:</h5>
							</div>
							<div class="col-12">
								<?=$order_item_info["price"]?>
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
<script type="text/javascript">

</script>
</html>