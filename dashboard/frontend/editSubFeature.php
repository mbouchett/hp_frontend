<?php
	//dashboard/frontend/editSubFeature.php 2019/01
	// Edit the 4 sub features
	
	include "/home/homeportonline/crc/2018.php";
	include "/home/homeportonline/crc/functions/f_resolve.php";
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
  	$f1[0] = $_REQUEST['f1'];
  	$f1[1] = $_REQUEST['f2'];
  	$f1[2] = $_REQUEST['f3'];
	$f1[3] = $_REQUEST['f4'];
	
	$alert = $_REQUEST['alert'];  	
  	
	// load features
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * 
			  FROM `sub_feature` 
			  ORDER BY `sf_start` DESC 
			  LIMIT 50';
	$result = mysqli_query($db, $sql);
	
	$featureCount = 0;
	if($result) $featureCount = mysqli_num_rows($result);
	mysqli_close($db); 
	
	for($i=0; $i<$featureCount; $i++){
		$feature[$i] = mysqli_fetch_assoc($result);
	}  	
	$firstDate = date('Y-m-d', strtotime("+1 day", strtotime($feature[0]['sf_end'])));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Homeport Edit Sub-Feature</title>
	<link href="css/editSubFeature.css" rel="stylesheet" type="text/css" />
</head>
<body>
	Edit Sub-Feature<br>
	<hr>
	<!-- Status Message -->
	<?php if($alert){?><?=$alert?><hr><?php  }?>
	Add A Sub-Feature Group:
	<?php if($f1[0]) { ?>
	<form action="processEditSubFeature.php" method="post">
	<table>
		<tr>
			<td><img height="300" src="http://www.rockingbones.site/homeportonline/feature/<?= $f1[0] ?>" alt="Error!"></td>	
			<td><img height="300" src="http://www.rockingbones.site/homeportonline/feature/<?= $f1[1] ?>" alt="Error!"></td>
			<td><img height="300" src="http://www.rockingbones.site/homeportonline/feature/<?= $f1[2] ?>" alt="Error!"></td>
			<td><img height="300" src="http://www.rockingbones.site/homeportonline/feature/<?= $f1[3] ?>" alt="Error!"></td>	
		</tr>		
		<tr>
			<td>Link: <input type="text" name="link[0]"></td>
			<td>Link: <input type="text" name="link[1]"></td>
			<td>Link: <input type="text" name="link[2]"></td>
			<td>Link: <input type="text" name="link[3]"></td>		
		</tr>
		<tr>
			<td>	Start -><input size="6" type="date" min="<?= $firstDate ?>" name="start"></td>
			<td>End --><input size="6" type="date" min="<?= $firstDate ?>" name="end"></td>	
			<td colspan="2"><input type="submit" value="Save Feature"></td>	
		</tr>
	</table>
	<input type="hidden" name="f1[0]" value="<?= $f1[0] ?>">
	<input type="hidden" name="f1[1]" value="<?= $f1[1] ?>">
	<input type="hidden" name="f1[2]" value="<?= $f1[2] ?>">
	<input type="hidden" name="f1[3]" value="<?= $f1[3] ?>">
	</form>
	<?php }else { ?>
	<form action="<?= $imageLocation ?>savefeature.php" method="post" enctype="multipart/form-data">	
	*All 4 Files Are Required... Please Use square files(pref: 500x500)
	<table>
		<tr>
			<td>File 1: <input type="file" name="filename[]"></td>
			<td>File 2: <input type="file" name="filename[]"></td>
			<td>File 3: <input type="file" name="filename[]"></td>
			<td>File 4: <input type="file" name="filename[]"></td>
		</tr>		
		<tr><td colspan="4"><input type="submit" value="Uplode files"></td></tr>
	</table>	
	</form>
	<?php } ?>
	<hr>
	<?php if($featureCount > 0) { ?>
	<table>		
		<?php for($i = 0; $i < $featureCount; $i++) { ?>
		<tr>
			<td>Starts: <?= $feature[$i]['sf_start'] ?></td>
			<td class="pic">			
         <a class="thumbnail" href="#thumb">
         <img style="max-height: 75px; max-width: 75px" border="0" 
         	src="http://www.rockingbones.site/homeportonline/feature/<?= $feature[$i]['sf_f1'] ?>" />
         <span>
         	<img src="http://www.rockingbones.site/homeportonline/feature/<?= $feature[$i]['sf_f1'] ?>"/>
         </span>
         </a>
			</td>
			<td class="pic">			
         <a class="thumbnail" href="#thumb">
         <img style="max-height: 75px; max-width: 75px" border="0" 
         	src="http://www.rockingbones.site/homeportonline/feature/<?= $feature[$i]['sf_f2'] ?>" />
         <span>
         	<img src="http://www.rockingbones.site/homeportonline/feature/<?= $feature[$i]['sf_f2'] ?>"/>
         </span>
         </a>
			</td>				
			<td class="pic">			
         <a class="thumbnail" href="#thumb">
         <img style="max-height: 75px; max-width: 75px" border="0" 
         	src="http://www.rockingbones.site/homeportonline/feature/<?= $feature[$i]['sf_f3'] ?>" />
         <span>
         	<img src="http://www.rockingbones.site/homeportonline/feature/<?= $feature[$i]['sf_f3'] ?>"/>
         </span>
         </a>
			</td>				
			<td class="pic">			
         <a class="thumbnail" href="#thumb">
         <img style="max-height: 75px; max-width: 75px" border="0" 
         	src="http://www.rockingbones.site/homeportonline/feature/<?= $feature[$i]['sf_f4'] ?>" />
         <span>
         	<img src="http://www.rockingbones.site/homeportonline/feature/<?= $feature[$i]['sf_f4'] ?>"/>
         </span>
         </a>
			</td>	
			<td>Ends: <?= $feature[$i]['sf_end'] ?></td>			
		</tr>
		<?php } ?>
	</table>
	<?php } ?>
	<a href="index.php" ><-Return</a>
</body>
</html>