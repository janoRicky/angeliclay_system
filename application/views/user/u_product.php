
<?php
$template_header;
?>

<body>
	<div class="wrapper h-100 w-100">
		<div class="container-fluid w-100">
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
					<?php

					$current_qty = $product_details["qty"];
					if (isset($_SESSION["cart"])) {
						$cart = $_SESSION["cart"];
						$item_key = array_search($product_details["product_id"], array_column($cart, 0));
						if ($item_key !== FALSE) {
							$current_qty = $product_details["qty"] - $cart[$item_key][1];
						}
					}

					echo $product_details["description"] . "<br>";
					echo $type . "<br>";
					echo "Quantity Available: " . $current_qty;
					?>
				</div>
				<div class="col-12">
					<?=form_open(base_url() . "to_cart", "method='GET'")?>
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
<script type="text/javascript">
	$(document).ready(function () {

    });
</script>
</html>