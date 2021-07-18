<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>
		<?php
		if ($title != NULL) {
			echo $title;
		}
		?>
	</title>
	<!-- ICONS LIBRARY -->
	<link rel="stylesheet" href="<?=base_url()?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bootstrap-4.00-dist/css/bootstrap.min.css">
	<!-- DATATABLES -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/datatables.min.css">
	<!-- CUSTOM STYLE -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/u_style.css">

	<style type="text/css">
		.banner {
			background-position: center;
			background-image: url("<?=base_url()?>assets/img/pink_stripes.png");
			background-repeat: repeat-x;

			background-size: contain;
		}
	</style>


	<?php $this->load->view('user/template/u_t_scripts'); // include the scripts from the view folder ?>

	<?php date_default_timezone_set('Asia/Manila'); ?>
</head>