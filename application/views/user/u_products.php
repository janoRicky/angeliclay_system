
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
					<a href="">
						<button class="btn btn-primary mb-1">Order Custom Product</button>
					</a>
				</div>

				<div class="col-12">
					<?php foreach ($tbl_products->result_array() as $row): ?>
						<a href="<?=base_url();?>product?id=<?=$row['product_id']?>">
							<tr class="text-center align-middle">
								<td>
									<?=$row["description"]?>
								</td>
									<td>
										PHP <?=$row["price"]?>
									</td>
								</a>
								<!-- <td>
									<a href="">
										<button class="btn btn-primary mb-1">Buy</button>
									</a>
									<a href="">
										<button class="btn btn-primary mb-1">Add to Cart</button>
									</a>
								</td> -->
							</tr>
						</a><br>
					<?php endforeach; ?>
				</div>

			</div>
		</div>
	</div>
</body>
<?php $this->load->view("user/template/u_t_scripts"); ?>
</html>