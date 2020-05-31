<!doctype html>
<?php
	//dashboard.php 2018/01
	// dashboard
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
    $pageset = 1;
?>
<html>
<head>
<meta charset="utf-8">
<title>Fill List</title>
<link rel="stylesheet" href="css/fillList.css" type="text/css" />
    <link href="../icons/all.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php if($pageset== 0 ) { ?>
    <div class="optionMenu">
        <a class="optionBtn" href="index.php">Exit to Purchasing Dashboard <i class="fas fa-external-link-alt"></i></a>
    </div>
    <div class="title">Click each item as you fill it to remove it from this list</div>
    <div class="items">
        <a href=""><img src="../images/old_subfeature1.jpg" alt="pic"></a>
        <a href=""><img src="../images/old_subfeature2.jpg" alt="pic"></a>
        <a href=""><img src="../images/old_subfeature3.jpg" alt="pic"></a>
        <a href=""><img src="../images/old_subfeature4.jpg" alt="pic"></a>
        <a href=""><img src="../images/subfeature1.jpg" alt="pic"></a>
        <a href=""><img src="../images/subfeature2.jpg" alt="pic"></a>
        <a href=""><img src="../images/subfeature3.jpg" alt="pic"></a>
        <a href=""><img src="../images/subfeature4.jpg" alt="pic"></a>
    </div>
<?php } else { ?>
    <div class="optionMenu">
        <a class="optionBtn" href="index.php">Exit to Purchasing Dashboard <i class="fas fa-external-link-alt"></i></a>
    </div>
    <div class="title">Coming Soon!</div>
<?php } ?> 

</body>
</html>