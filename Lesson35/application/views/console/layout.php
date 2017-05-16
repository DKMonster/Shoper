<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<title><?=$title;?></title>
		<base href="<?=base_url();?>">
		<link rel="stylesheet" href="assets/dist/semantic.min.css">
		<link rel="stylesheet" href="assets/css/console_index.css">

		<!-- ********* JS Important ********* -->
		<!-- [if lt IE 9]>
		<script type="text/javascript" src="assets/js/vendor/jquery-1.11.0.min.js"></script>
		<! [endif] -->
		<!-- [if gte IE 9]><!-->
		<script type="text/javascript" src="assets/js/vendor/jquery-2.1.1.min.js"></script>
		<!--[endif]-->
		<script type="text/javascript" src="assets/js/vendor/jquery-ui-1.9.2.custom.min.js"></script>
		<script type="text/javascript" src="assets/js/vendor/modernizr-2.6.2.min.js"></script>
	</head>
	<body>
		<div class="wrapper-content">
			<?php include('header.php'); ?>
			<?php include('menu.php'); ?>
			<?php include($page); ?>
		</div>
		
		<!-- ********* JS Plugin ********* -->
		<script type="text/javascript" src="assets/dist/semantic.min.js"></script>

		<script>
			$(document).ready(function() {
				
			});
		</script>
	</body>
</html>