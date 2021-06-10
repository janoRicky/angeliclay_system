<?php
$template_header; // loads in the header of the page obtained from views/admin/template
?>

<body>
	<!-- 
		bootstrap classes:
			container - required to use basic bootstrap grid
			row - required as a container for columns
			col-0 - refers to the size of the object, minimum size is 1 (col-1), max is 12
				- ex: col-6 is 50% width, col-12 is 100% width, etc.

			card - required for the card container template
			card-header - header for card
			card-body - content
			card-footer - footer

			form-group - used for form items
			form-control - class for inputs

			btn - button class
			btn-primary - blue colored button

			m-0 - margin (maximum is 5), use mt/mb/ml/mr for top/bottom/left/right margins 
				- ex: m-3, mt-5, ml-5
			p-0 - padding, same rules as margin, use pt/pb/pl/pr
				- ex: p-3, pt-5, pl-5
	 -->
	<div class="wrapper">
		<div class="row">
			<div class="col-4"><!-- this serves as margin --></div> 
			<div class="col-4">
				<div class="card text-center mt-5">
					<div class="card-header">
						<h3>LOG-IN</h3>
					</div>
					<div class="card-body">
						<?php if ($this->session->flashdata("login_alert")): ?>
							<?php $alert = $this->session->flashdata("login_alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="close" data-dismiss="alert">
									&times;
								</button>
							</div>
						<?php endif; ?>
						<?=form_open(base_url() . "admin/login", "method='POST'")?>
							<div class="form-group">
								<label for="inp_email">Email:</label>
								<input type="email" class="form-control" name="inp_email" placeholder="Email Address">
							</div>
							<div class="form-group">
								<label for="inp_password">Password:</label>
								<input type="password" class="form-control" name="inp_password" placeholder="Password">
							</div>
							<input type="submit" class="btn btn-primary" value="Log-In">
						<?=form_close()?>
					</div>
				</div>
			</div>
			<div class="col-4"></div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () { // function runs on document ready
		
	});
</script>
</html>