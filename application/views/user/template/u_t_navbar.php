<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg justify-content-end py-0 px-md-4 px-sm-4">
	<div class="flex-wrap mx-5">
		<ul class="navbar-nav">
			<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="home">
				<small>Home</small></a></li>
			<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="products">
				<small>Products</small></a></li>
			<!-- <li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="">
				<small>Orders</small></a></li> -->
			<?php if ($this->session->userdata("user_in")): ?>
				<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="account">
					<small>Account</small></a></li>
				<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="logout">
					<small>Logout</small></a></li>
			<?php else: ?>
				<li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="login">
					<small>Log-In</small></a></li>
			<?php endif; ?>
			<!-- <li class="nav-item px-2"><a class="nav-link text-uppercase py-0" href="test"> -->
				<!-- <small>TEST</small></a></li> -->
		</ul>
	</div>
</nav>
<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg pl-lg-5 pl-md-5 pl-sm-0 py-0">
	<div class="navbar-header pr-3">
		<a class="navbar-brand m-0" href="#">
			<img src="<?=base_url()?>assets/img/angeliclay_logo.png">
		</a>
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
	<a href="cart">
		<i class="fa fa-shopping-cart fa-lg nav-icon p-3" aria-hidden="true"></i>
		<?php
			if ($this->session->has_userdata("cart")) {
				echo count($this->session->userdata("cart"));
			} else {
				echo "0";
			}
		?>
	</a>
</nav>