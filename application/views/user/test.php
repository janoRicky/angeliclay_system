
<?php
$template_header;
?>

<body>
	<div class="wrapper h-100">
		<div class="container-fluid">
			<div class="row">
				<style type="text/css">
					a {
						margin: 0 1rem;
					}
				</style>
				<a href="home">HOME</a>
				<a href="products">PRODUCTS</a>
				<a href="cart">CART</a>
				<a href="login">LOGIN</a>
				<a href="test">test</a>

				<?php session_destroy(); ?>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view("user/template/u_t_scripts"); ?>
</html>