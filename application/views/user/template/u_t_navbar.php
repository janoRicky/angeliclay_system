<div class="container-fluid navbar_">
	<div class="row p-4">
		<div class="col-12 text-center">
			<a class="nav_title" href="home">
				<h1>AngeliClay</h1>
			</a>
		</div>
	</div>
	<div class="row p-3 mt-2 nav_link_bar">
		<nav class="col-12">
			<ul class="nav justify-content-center">
				<li class="nav-item px-4">
					<a class="nav-link nav_link <?=(uri_string() == 'home' ? 'active' : '')?>" href="home">
						<i class="fa fa-home" aria-hidden="true"></i> Home
					</a>
				</li>
				<li class="nav-item px-4">
					<a class="nav-link nav_link <?=(uri_string() == 'products' ? 'active' : '')?>" href="products">
						<i class="fa fa-shopping-bag" aria-hidden="true"></i> Products
					</a>
				</li>
				<li class="nav-item px-4">
					<a class="nav-link nav_link <?=(uri_string() == 'cart' ? 'active' : '')?>" href="cart">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart (<?=($this->session->has_userdata("cart") ? count($this->session->userdata("cart")) : "0")?>)
					</a>
				</li>
				<?php if ($this->session->userdata("user_in")): ?>
					<li class="nav-item px-4">
						<a class="nav-link nav_link dropdown-toggle <?=(uri_string() == 'account' || uri_string() == 'my_orders' ? 'active' : '')?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-circle" aria-hidden="true" style="color: lime;"></i> <?=$this->session->userdata("user_name")?>
						</a>
						<div class="dropdown-menu dropdown_menu dropdown-menu-right">
							<a class="dropdown-item" href="account">
								<i class="fa fa-user" aria-hidden="true"></i> My Account
							</a>
							<a class="dropdown-item" href="my_orders">
								<i class="fa fa-list" aria-hidden="true"></i> My Orders
							</a>
							<a class="dropdown-item" href="customer_support">
								<i class="fa fa-envelope" aria-hidden="true"></i> Customer Support Chat
							</a>
							<a class="dropdown-item" href="logout">
								<i class="fa fa-sign-out" aria-hidden="true"></i> Log-Out
							</a>
						</div>
					</li>
				<?php else: ?>
					<li class="nav-item px-4">
						<a class="nav-link nav_link" href="login">
							<i class="fa fa-sign-in" aria-hidden="true"></i> Log-In
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</nav>
	</div>
	<div class="row">
		<div class="col-12" style="padding: 0 !important;">
			<style type="text/css">
				.awning {
					height: 5rem;
					background-position: center;
					background-image: url("<?=base_url()?>assets/img/pink_awning.png");
					background-repeat: repeat-x;

					background-size: contain;
				}
			</style>
			<div class="awning"></div>
		</div>
	</div>
</div>

<?php if ($this->session->flashdata("notice")): ?>
	<?php $alert = $this->session->flashdata("notice"); ?>
	<div class="notice n_all row alert alert-<?=$alert[0]?>" data-dismiss="alert">
		<div class="text-center w-100">
			<?=$this->session->flashdata("notice")[1]?>
		</div>
	</div>
<?php endif; ?>

<script type="text/javascript">
	setTimeout(function() {
		$(".notice").fadeOut(3000, function() {
			$(this).remove();
		});
	}, 30000);
</script>
