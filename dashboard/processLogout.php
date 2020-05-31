<?php
	//processLogout.php 2018/01
	// Destroys session variables
	session_start();
	session_destroy();
	header('location: index.php');
	die;
?>
