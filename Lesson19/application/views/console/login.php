<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<title><?=$title;?></title>
		<base href="<?=base_url();?>">
		<link rel="stylesheet" href="assets/dist/semantic.min.css">
		<link rel="stylesheet" href="assets/css/console_login.css">

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
			<div class="ui middle aligned center aligned grid">
				<div class="column wc-form">
					<h2 class="ui teal header wc-header">
						<div class="content">
							Shoper Console
						</div>
					</h2>
					<form class="ui large form" method="post">
						<div class="ui stacked segment">
							<input type="hidden" name="rule" value="login">
							<div class="field">
								<div class="ui left icon input">
									<i class="icon user"></i>
									<input type="text" name="email" placeholder="E-mail Address">
								</div>
							</div>
							<div class="field">
								<div class="ui left icon input">
									<i class="icon lock"></i>
									<input type="password" name="password" placeholder="Password">
								</div>
							</div>
							<button class="ui fluid blue button" type="submit">Login</button>
						</div>
					</form>
					<?php if(isset($error)) { ?>
					<div class="ui bottom attached warning message">
						<i class="icon warning"></i>
						<?=$error; ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		
		<!-- ********* JS Plugin ********* -->
		<script type="text/javascript" src="assets/dist/semantic.min.js"></script>

		<script>
			$(document).ready(function() {
				
			});
		</script>
	</body>
</html>