<?php
	include $_SERVER['DOCUMENT_ROOT']."/library/image-creation.php";
	include "library/pagination.php";
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
		<script src="JavaScript/script.js"></script>
	</head>

	<body>
		<div class="heading container-fluid">
			<a href="/"><h1>Homesick.nz</h1></a>
		</div>
		<div id="meatModal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-body">
					<img src="" id="meatModalImg" width="100%">
				  </div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="white row">
				<div class=" col-sm-6 col-sm-push-6">
					<div class="row">
						<div class="sidebar col-sm-5"><?php include("sidebar.php");?></div>
						<div class="login col-sm-7"><?php include("login.php");?></div>
					</div>
				</div>
  				<div class="col-sm-6 col-sm-pull-6">
					<?php
					$rowsPerPage = 12;
					$query = "SELECT * FROM tbl_img JOIN tbl_users ON (img_user_id=user_id) WHERE img_status = '0'";
					$get_key = "";
					if(isset($_GET['catid']))
					{
						$cat_id = mysqli_real_escape_string($link, $_GET['catid']);
						$query = "SELECT * FROM tbl_img JOIN tbl_users ON (img_user_id=user_id) WHERE img_status = '0' AND img_cat_id='$cat_id'";
						$get_key = "catid=$cat_id";
					}
					$paging_link = getPagingLink($query, $rowsPerPage, $get_key);
					$result = mysqli_query($link, getPagingQuery($query, $rowsPerPage));
					if(mysqli_num_rows($result))
					{
						while($row=mysqli_fetch_array($result))
						{
?>
							<div class="col-sm-4">
								<div class="thumbnail main-item">
									<a href="#" class="meat" data-img="/img/<?=$row['img_temp_name'];?>"><img id="<?=$row['img_id'];?>" src="/img/<?=$row['img_temp_name'];?>" alt="<?=$row['img_title'];?>" class="img-fluid"></a>
								</div>
								<?=$row['img_title'];?> &nbsp; <?=$row['img_credit'];?><br>
								Uploaded by <?=$row['user_name'];?>
							</div>
<?php
						}
					}
					echo $paging_link;
					?>
				</div>
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