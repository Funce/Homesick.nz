<?php
	include $_SERVER['DOCUMENT_ROOT']."/library/image-creation.php";
	include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
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
			<a href="/"><h1>Homesick.nz</h1></a>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="white col-sm-6 col-sm-push-6">
					<div class="row">
						<div class="sidebar col-sm-5"><?php include("sidebar.php");?></div>
						<div class="login col-sm-7"><?php include("login.php");?></div>
					</div>
				</div>
  				<div class="col-sm-6 col-sm-pull-6">col-sm-8</div>
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