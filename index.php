<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("config.php");?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Homesick.nz | </title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="CSS/style.css" />
	</head>

	<body>
		<div class="heading container-fluid">
			<a href="/index.php"><h1>Homesick.nz</h1></a>
		</div>
		<div class="container">
			<div class="row">
				<div class="sidebar col-sm-2 col-sm-push-8"><?php include("sidebar.php");?></div>
				<div class="login col-sm-2 col-sm-push-8"><?php include("login.php");?></div>
  				<div class="col-sm-8 col-sm-pull-8">.col-sm-6</div>
			</div>
		</div>
		<div class="footer container-fluid">
			<div class="row">
				<div class="footer-widget col-sm-6">Made By</div>
				<div class="footer-widget col-sm-6">Copyright and licensing</div>
			</div>
		</div>
	</body>
</html>