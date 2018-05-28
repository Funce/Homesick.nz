<?php
	include $_SERVER['DOCUMENT_ROOT']."/library/image-creation.php";
	include $_SERVER['DOCUMENT_ROOT']."/library/pagination.php";
	include "config.php";
	if(!isset($_SESSION['user']))
	{
		header("Location:index.php");
	}

	if($_SESSION['user']['view'] != "9")
	{
		header("Location:index.php");
	}
	
	//Check if denied
	if(isset($_POST['deny_x']))
	{
		$img_id = mysqli_real_escape_string($link, $_POST['img_id']);
		$query = "UPDATE tbl_img SET img_status = '1' WHERE img_id = '$img_id'";
		mysqli_query($link, $query);
	}
	elseif(isset($_POST['approve_x']))
	{//Check if its been approved
		if($_POST['category'] != "0")
		{//Check if they've selected a category
			$img_id = mysqli_real_escape_string($link, $_POST['img_id']);
			$img_cat_id = mysqli_real_escape_string($link, $_POST['category']);
			$query = "UPDATE tbl_img SET img_status = '0', img_cat_id = $img_cat_id WHERE img_id = '$img_id'";
			mysqli_query($link, $query);
		}
	}
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
			<div class="white row">
				<div class="col-sm-6 col-sm-push-6">
					<div class="row">
						<div class="sidebar col-sm-5"><?php include("sidebar.php");?></div>
						<div class="login col-sm-7"><?php include("login.php");?></div>
					</div>
				</div>
  				<div class="col-sm-6 col-sm-pull-6">
					<div><h2>Photos to be approved</h2></div>
					<div class="table">
						<div class="tr" style="font-weight: bold;">
							<span class="td">Image</span>
							<span class="td">Title</span>
							<span class="td">Credit</span>
							<span class="td">Uploader</span>
							<span class="td">Category</span>
							<span class="td">Actions</span>
						</div>
<?php
						$query = "SELECT img_id, img_temp_name, img_title, img_credit, user_name FROM tbl_img JOIN tbl_users ON (user_id=img_user_id) WHERE img_status!='1' AND img_cat_id IS NULL";
						$result = mysqli_query($link, $query);
						if(mysqli_num_rows($result))
						{
							while($row = mysqli_fetch_assoc($result))
							{
?>
								<form class="tr" action="<?=$_SERVER["REQUEST_URI"];?>" method="post">
								
									
										<input type="hidden" name="img_id" value="<?=$row['img_id'];?>" />
										<span class="td"><img style="width: 70px;" src="img/<?=$row['img_temp_name'];?>" /></span>
										<span class="td"><?=$row['img_title'];?></span>
										<span class="td"><?=$row['img_credit'];?></span>
										<span class="td"><?=$row['user_name'];?></span>
										<span class="td"><select name="category">
											<option value='0'>Select or Decline</option>
<?php
											$query = "SELECT * FROM tbl_category";
											$interest = mysqli_query($link, $query);
											if(mysqli_num_rows($interest))
											{
												while($cats = mysqli_fetch_assoc($interest))
												{
?>
													<option value=<?=$cats['cat_id'];?>><?=$cats['cat_name'];?></option>
<?php		
												}
											}
								 ?>
											</select></span>
										<span class="td"><input style="width: 20px;" type="image" src="/img/check.png" name="approve" />
														 <input style="width: 20px;" type="image" src="/img/cross.png" name="deny" /></span>
									
						
								</form>
<?php
							}
						}
?>
					</div>
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