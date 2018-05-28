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

	//Set up root directory for img sources
	define('IMG_DIR', str_replace(DIRECTORY_SEPARATOR, '/', __DIR__).'/img/');
	define('ROOT_DIRECTORY', "http://" . $_SERVER['SERVER_NAME']);

	//width for the images creation
	define('THUMBNAIL_WIDTH', 400);
	session_start();
?>