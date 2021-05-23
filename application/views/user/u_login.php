
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

				<div class="col-12">
					<a href="home">HOME</a>
					<a href="products">PRODUCTS</a>
					<a href="cart">CART</a>
					<a href="login">LOGIN</a>
					<a href="test">test</a>
				</div>

				<div class="col-12">
					<?=form_open(base_url() . "user_login", "method='POST'")?>
						<input type="number" name="amount" value="1" min="1" max="<?=$current_qty?>">
						<input type="hidden" name="id" value="<?=$product_details['product_id']?>">
						<input class="btn btn-primary mb-1" type="submit" name="submit" value="Buy Now">
						<input class="btn btn-primary mb-1" type="submit" name="submit" value="Add to Cart">
					<?=form_close()?>
				</div>

			</div>
		</div>
	</div>
</body>
<?php $this->load->view("user/template/u_t_scripts"); ?>
</html>