<?php
	
	//Definition for later
	$error = "";

	//See if user loggin out
	if(isset($_POST['logout']))
	{
		$_SESSION = array();
		header("Location:".$_SERVER['REQUEST_URI']);
	}

	//See if user logging in
	if(isset($_POST['login']))
	{
		$username = mysqli_real_escape_string($link, $_POST['login']['username']);
		$password = mysqli_real_escape_string($link, $_POST['login']['password']);
		$query = "SELECT * FROM tbl_users WHERE user_name='$username'";
		$result = mysqli_query($link, $query);
		//Check if registering or logging in
		if(isset($_POST['submit']))
		{//Logging in
			
			if(mysqli_num_rows($result))
			{
				$row = mysqli_fetch_assoc($result);
				if(password_verify($password, $row['user_password']))
				{
					//Woo login
					$_SESSION['user']['username'] = $row['user_name'];
					$_SESSION['user']['id'] = $row['user_id'];
					$_SESSION['user']['role'] = $row['user_role'];
					$_SESSION['user']['view'] = $row['user_role'];
				}
				else
				{
					//Password doesn't match up
					$error="Incorrect password";
				}
			}
			else
			{
				//No username found in db
				$error="Unknown username";
			}
		}
		elseif(isset($_POST['register']))
		{//registering
			if ($_POST['login']['password'] === $_POST['login']['confirm'])
			{
				if(!mysqli_num_rows($result))
				{
					$hashed = password_hash($password, PASSWORD_DEFAULT);
					$query = "INSERT INTO tbl_users (user_name, user_password) VALUES ('$username', '$hashed')";
					mysqli_query($link, $query);
					$error = "Now please log in";
				}
				else
				{//username already exists in db
					$error = "That username is already chosen";
				}
			}
			else
			{//Password doesn't match
				$error = "Passwords don't match";
			}
		}
		//Refresh the page dude
		header("Location:".$_SERVER['REQUEST_URI']);
	}
	//Check if logged in
	if(isset($_SESSION['user']))
	{//Logged in
		
		//Check if we're uploading, now that we know we're logged in
		if(isset($_POST['upload']))
		{
			$title = mysqli_real_escape_string($link, $_POST['upload']['title']);
			$credit = mysqli_real_escape_string($link, $_POST['upload']['credit']);
			if($title == "" or $credit == "" or $_FILES['photo']['tmp_name'] == "")
			{
				$error = "All fields are required";
			}
			else
			{
				//Apply the image file!!!
				$imgName = $_FILES['photo']['name'];
				$tmpName = $_FILES['photo']['tmp_name'];
				$ext = strrchr($imgName, ".");
				$newName = md5(rand()*time()).$ext;
				$imgPath = IMG_DIR . $newName;
				createThumbnail($tmpName, $imgPath, THUMBNAIL_WIDTH);
				
				$user_id = mysqli_real_escape_string($link, $_SESSION['user']['id']);
				
				$query = "INSERT INTO tbl_img (img_title, img_credit, img_temp_name, img_user_id) VALUES ('$title','$credit','$newName','$user_id')";
				mysqli_query($link, $query);
				$error = "Your image has been uploaded and is awaiting approval";
				
			}
			
		}
		//Check for admin redirects required
		//Check if we're changing views
		if($_SESSION['user']['role'] == '9')
		{
			if(isset($_POST['view_user']))
			{
				$_SESSION['user']['view'] = '1';
				header("Location:".$_SERVER['REQUEST_URI']);
			}
			elseif(isset($_POST['view_admin']))
			{
				$_SESSION['user']['view'] = '9';
				header("Location:".$_SERVER['REQUEST_URI']);
			}
			
		}
		
		
		
		//Display User panel
?>
		<div class="bar-title"><h2>User Panel</h2></div>
		<div class="bar-info">Hi, <?=$_SESSION['user']['username'];?>!</div>
		<!--<a href="manage"><div class="bar-item">Manage your uploaded items</div></a>-->
		<div class="bar-info">Upload an image</div>
		<form action="<?=$_SERVER["REQUEST_URI"];?>" method="post" enctype="multipart/form-data" autocomplete="off">
			<table>
				<tr>
					<td>Title:</td>
					<td><input type="text" name="upload[title]" /></td>
				</tr>
				<tr>
					<td>Upload:</td>
					<td><input type="file" name="photo" /></td>
				</tr>
				<tr>
					<td>Credit:</td>
					<td><input type="text" name="upload[credit]" /></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" name="upload[submit]" value="Upload" /></td>
				</tr>
				<tr>
					<td colspan="2"><div class="error-message"><?=$error?></div></td>
				</tr>
				<tr></tr>
				<tr><td><input type="submit" name="logout" value="Log Out"</td></tr>
			</table>
		</form>
<?php
			if($_SESSION['user']['role'] == '9')
			{
?>
				<div class="bar-title"><h2>Admin Panel</h2></div>
				<a href="dashboard"><div class="bar-item admin-link">Photo Dashboard</div></a>
				<form action="<?=$_SERVER["REQUEST_URI"];?>" method="post">
					<?php
			 		if($_SESSION['user']['view'] == '9')
					{
?>
					<input type="submit" name="view_user" value="View as User"/>
<?php
					}
			 		elseif ($_SESSION['user']['view'] == '1')
					{
?>
						<input type="submit" name="view_admin" value="View as Admin"/>
<?php
					}
?>
				</form>
<?php	
			}
?>
		
<?php
	}
	else
	{ //Not logged in
?>
		<div class="bar-title"><h2>Login</h2></div>
		<form action="<?=$_SERVER["REQUEST_URI"];?>" method="post" autocomplete="off">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="login[username]" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="login[password]" /></td>
				</tr>
				<tr>
					<td><div class="error-message"><?=$error?></div></td>
					<td><input type="submit" name="submit" value="Login"/></td>
				</tr>
				<tr>
					<td colspan="2"><div class="register">If you wish to become a member of this site, please re-enter your password:</div></td>
				</tr>
				<tr>
					<td colspan="2"><input type="password" name="login[confirm]"/></td>
				</tr>
				<tr>
					<td colspan="2"><input class="" type="submit" name="register" value="Register"/></td>
				</tr>
			</table>
		</form>
<?php
	}
?>

