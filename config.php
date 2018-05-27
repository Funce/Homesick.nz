<?php
	$address = "localhost";
	$username = "root";
	$password = "";
	$db_name = "homesick_nz";
	$link = mysqli_connect($address, $username, $password, $db_name);
	if (!$link)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
?>