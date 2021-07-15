<!-- <nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg justify-content-end py-0 px-md-4 px-sm-4">
	<div class="flex-wrap mx-5">
		<ul class="navbar-nav">
			<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="home">
				<small>Home</small></a></li>
			<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="products">
				<small>Products</small></a></li>
			<?php if ($this->session->userdata("user_in")): ?>
				<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="account">
					<small>Account</small></a></li>
				<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="logout">
					<small>Logout</small></a></li>
			<?php else: ?>
				<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="login">
					<small>Log-In</small></a></li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg pl-lg-5 pl-md-5 pl-sm-0 py-0">
	<div class="navbar-header pr-3">
		<h4 class="navbar-text">AngeliClay</h4>
	</div>
	<div class="col-lg-8">
		<form class="input-group input-group-sm" action="">
		   <input type="text" class="form-control" placeholder="Search" aria-label="Search" name="search">
		   <div class="input-group-btn mr-sm-2">
				<button class="btn btn-light btn-outline-secondary btn-sm my-0 my-sm-0 " type="submit">
			   		<i class="fa fa-search" aria-hidden="true" style="color: white"></i>
				</button>
		   </div>
		</form>
	</div>
</nav> -->

<div class="container-fluid navbar_">
	<div class="row p-4">
		<div class="col-12 text-center">
			<span class="nav_title">AngeliClay</span>
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
							<a class="dropdown-item" href="account"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
							<a class="dropdown-item" href="my_orders"><i class="fa fa-list" aria-hidden="true"></i> My Orders</a>
							<a class="dropdown-item" href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
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
			<div class="awning">
				
			</div>
		</div>
	</div>
</div>
