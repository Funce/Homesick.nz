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
					<table>
						<tr>
							<th>Image</th>
							<th>Title</th>
							<th>Credit</th>
							<th>Uploader</th>
							<th>Category</th>
							<th>Actions</th>
						</tr>
<?php
						$rowsPerPage = 20;
						$query = "SELECT img_id, img_temp_name, img_title, img_credit, user_name FROM tbl_img JOIN tbl_users ON (user_id=img_user_id) WHERE img_status!='1' AND img_cat_id IS NULL";
						$pagingLink = getPagingLink($query, $rowsPerPage, "");
						$result = mysqli_query($link, getPagingQuery($query, $rowsPerPage));
						if(mysqli_num_rows($result))
						{
							while($row = mysqli_fetch_assoc($result))
							{
?>								<tr>
									<input type="hidden" name="img_id" value="<?=$row['img_id'];?>" />
									<td class="thumbnail"><img style="width: 70px;" src="img/<?=$row['img_temp_name'];?>" /></td>
									<td><?=$row['img_title'];?></td>
									<td><?=$row['img_credit'];?></td>
									<td><?=$row['user_name'];?></td>
									<td><select>
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
										</select></td>
								</tr>
<?php
							}
						}
?>
					</table>
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