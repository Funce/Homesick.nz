<?php
	session_start();
	//Find out which thing to display
	if(isset($_SESSION['user']))
	{
?>
		<div class="bar-title"><h2>User Control Panel</h2></div>
<?php
	}
	else
	{
?>
		<div class="bar-title"><h2>Login</h2></div>
		<form action="<?=$_SERVER["REQUEST_URI"];?>">
			Username:
			<input type="text" name="login[username]" />
			Password:
			<input type="password" name="login[password]" />
			<div class="error-message"></div>
			<input type="submit" name="submit" value="Login"/>
			<div class="register">If you wish to become a member of this site, please re-enter your password:</div>
			<input type="password" name="login[confirm]"/>
			<input class="" type="submit" name="register" value="Register"/>
		</form>
<?php
	}
?>

