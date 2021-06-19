
<?php
$template_header;
?>

<body>
	<div class="wrapper h-100">
		<?php $this->load->view("admin/template/a_t_sidebar"); ?>
		<div class="content text-center">
			<?php $this->load->view("admin/template/a_t_navbar", $nav) ?>
			<div class="container-fluid p-5">
				<!-- bootstrap alerts, shows when there are messages -->
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
					<div class="col-12">
						<h2 class="p-3">Welcome <?=$this->session->userdata("admin_name")?>!</h2>
					</div>
					<div class="col-3">
						<a href="accounts">
							<div class="card text-center bg-dark text-light p-3">
								ADMINS (<?=$this->db->count_all("admin_accounts")?>)
							</div>
						</a>
					</div>
					<div class="col-3">
						<a href="products">
							<div class="card text-center bg-dark text-light p-3">
								PRODUCTS (<?=$this->db->count_all("products")?>)
							</div>
						</a>
					</div>
					<div class="col-3">
						<a href="types">
							<div class="card text-center bg-dark text-light p-3">
								PRODUCT TYPES (<?=$this->db->count_all("types")?>)
							</div>
						</a>
					</div>
					<div class="col-3">
						<a href="orders">
							<div class="card text-center bg-dark text-light p-3">
								ORDERS (<?=$this->db->count_all("orders")?>)
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view("admin/template/a_t_scripts"); ?>
<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>
</html>