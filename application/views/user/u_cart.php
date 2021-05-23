
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
					<?php

					foreach ($cart as $key => $val) {
						if ($val != NULL) {
							echo $val[0] . " / amt: " . $val[1] . "<a class='remove_item' href='" . base_url() . "remove_from_cart?id=" . $val[0] . "'>del</a><br>";
						}
					}

					?>
				</div>

			</div>
		</div>
	</div>
</body>
<?php $this->load->view("user/template/u_t_scripts"); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$(".remove_item").on('click', function(event) {
			if (!confirm("remove item?")) {
				event.preventDefault();
			}
		});
    });
</script>
</html>