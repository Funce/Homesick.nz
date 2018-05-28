<div class="bar-title"><h2>Categories</h2></div>
<?php
	if(isset($_SESSION['user']))
	{
		if($_SESSION['user']['view'] == '9')
		{
			//LOGIC for adding and editing and removing stuff
			if(isset($_POST['add-category']))
			{
				$cat_name = mysqli_real_escape_string($link, $_POST['add-category']);
				$query = "INSERT INTO tbl_category (cat_name) VALUES ('$cat_name')";
				mysqli_query($link, $query);
			}	
?>
<?php
			$query = "SELECT * FROM tbl_category";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result))
			{
				while ($row = mysqli_fetch_assoc($result))
				{
?>
					<a href="<?=$_SERVER["SCRIPT_NAME"];?>?catid=<?=$row['cat_id'];?>"><div class="sidebar-item"><?=$row['cat_name'];?></div></a>
<?php	
				}
			}
			?>
			<form action="<?=$_SERVER["REQUEST_URI"];?>" method="post">
				<table style="margin: auto">
					<tr>
						<td><input type="text" name="add-category" /></td>
						<td><input type="image" name="submit" src="img/plus.png" style="width:25px;"/></td>
					</tr>
				</table>
			</form>
<?php	}
	}
	else{
		$query = "SELECT * FROM tbl_category";
		$result = mysqli_query($link, $query);
		if(mysqli_num_rows($result))
		{
			while ($row = mysqli_fetch_assoc($result))
			{
?>
				<a href="<?=$_SERVER["SCRIPT_NAME"];?>?catid=<?=$row['cat_id'];?>"><div class="sidebar-item"><?=$row['cat_name'];?></div></a>
<?php	
			}
		}
	}
?>