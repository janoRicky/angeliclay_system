
<?php
$template_header;
?>

<body class="" style="background-color: rgba(241, 182, 171, 1);">
	<?php $this->load->view("user/template/u_t_navbar"); ?>
	<div class="container px-5 rounded pb-5" style="background-color: rgba(220, 138, 107, 0.40);">
		<span>
			<h1 class="m-0" style="padding-top: 60px;">My Orders</h1>
		</span>
		<div class="row mt-5">
			<div class="col-10">
				<div class="row mt-2">
					<table class="table">
						<thead>
							<tr>
								<th>Date / Time</th>
								<th>Description</th>
								<th>State</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($user_orders->result_array() as $row): ?>
								<tr class="text-center align-middle">
									<td>
										<?=$row["date"]." / ".date("h:i A", strtotime($row["time"]))?>
									</td>
									<td>
										<?=$row["description"]?>
									</td>
									<td>
										<?=$row["state"]?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-2">
				<a href="account_details">Update Account Details</a><br><br>
				<a href="user_orders">Orders List</a>
			</div>
		</div>
	</div>
	<footer style="background-color: white; height: auto;">
		<div class="row mx-5 py-4">
			<div class="col">
				<h6 class="mb-2">Links</h6>
					<ul class="nav flex-column">
						<li><a class="text-dark" href="#">FAQs</a></li>
						<li><a class="text-dark" href="#">About Us</a></li>
						<li><a class="text-dark" href="#">Contact Us</a></li>
						<li><a class="text-dark" href="#">Terms of Service</a></li>
						<li><a class="text-dark" href="#">Privacy Policy</a></li>
					</ul>
			</div>
			<div class="col">
				<h6>Our Location</h6>
			</div>
			<div class="col">
				<h6>Follow us on</h6>
				<ul class="nav">
					<li><a href="#">
						<i class="fa fa-facebook-official bg dark" aria-hidden="true"></i></a></li>
					<li><a href="#">
						<i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</footer>
</body>
</html>