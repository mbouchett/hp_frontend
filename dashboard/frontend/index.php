<?php
	//dashboard/frontend/index.php 2018/01
	// Front End Editor
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Homeport Front End Editor</title>
</head>
<body>
Front End Editor<br>
<hr>
<a href="editFeature.php">Edit Feature</a><br>
<a href="editSubFeature.php">Edit Sub Feature</a><br>
<a href="../">Exit</a><br>
</body>
</html>