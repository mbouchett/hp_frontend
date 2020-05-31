<?php
//depts.php 2018/01
// Vendor Catalog Edit Workspace
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
@$sort = $_REQUEST['sort'];
@$message = $_REQUEST['message'];

$sql = 'SELECT * FROM `departments` LEFT JOIN `areas` USING (`area_ID`) ORDER BY `dept_name`';
if($sort == 'd') $sql = 'SELECT * FROM `departments` LEFT JOIN `areas` USING (`area_ID`) ORDER BY `dept_ID`';
if($sort == 'b') $sql = 'SELECT * FROM `departments` LEFT JOIN `areas` USING (`area_ID`) ORDER BY `dept_belongs_to`, `dept_name`';
if($sort == 'f') $sql = 'SELECT * FROM `departments` LEFT JOIN `areas` USING (`area_ID`) ORDER BY `area_ID`, `dept_name`';

// Load Departments
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$result = mysqli_query($db, $sql);
$depCount=mysqli_num_rows($result);
mysqli_close($db); 
for($i = 0;$i < $depCount; $i++) {
	$depts[$i]=mysqli_fetch_assoc($result);
}

// Load areas 
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `areas`";
$result = mysqli_query($db, $sql);
$areaCount=mysqli_num_rows($result);
mysqli_close($db); 
for($i = 0;$i < $areaCount; $i++) {
	$area[$i]=mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Homeport Departments</title>
<link href="css/depts.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="title">Edit Departments</div>
	<?php if($message) { ?>
	<?= $message ?>
	<?php } ?>
	<form action="processDepts.php" method="post">
		<div class="buttons">
			<input type="submit" value="Save Changes">
			<input class="dashbut" value="Exit" onclick="parent.location='../'" type="button">
		</div>
		<table>
		<tr>
			<td><a href="depts.php?sort=d">Dept ID</a></td>
			<td><a href="depts.php?sort=n">Dept Name</a></td>
			<td><a href="depts.php?sort=b">Belongs To</a></td>
			<td><a href="depts.php?sort=f">Floor</a></td>
		</tr>		
		<?php for($i = 0; $i <$depCount; $i++) { ?>
		<tr>
			<td onclick="parent.location='deptListing.php?dept_ID=<?= $depts[$i]['dept_ID'] ?>'"><input type="hidden" name="dept_ID[<?= $i ?>]" value="<?= $depts[$i]['dept_ID'] ?>"><?= $depts[$i]['dept_ID'] ?></td>
			<td><input type="text" name="dept_name[<?= $i ?>]" value="<?= $depts[$i]['dept_name'] ?>"></td>
			<td><input style="width: 50px;" type="text" name="dept_belongs_to[<?= $i ?>]" value="<?= $depts[$i]['dept_belongs_to'] ?>"></td>
			<td>
				<select name="dept_area[<?= $i ?>]">
					<?php for($ii = 0; $ii < $areaCount; $ii++) {
					$selected = "";
					if($area[$ii]['area_name'] == $depts[$i]['area_name']) $selected = "selected=\"selected\"";
					?>
					<option <?= $selected ?> value="<?= $area[$ii]['area_ID'] ?>"><?= $area[$ii]['area_name'] ?></option>
					<?php } ?><?= $area[$ii]['area_name'] ?>
				</select>
			</td>
		</tr>
		<?php } ?>
		</table>	
		<input type="hidden" name="sort" value="<?= $sort ?>">
		<div class="buttons">
			<input type="submit" value="Save Changes">
			<input class="dashbut" value="Exit" onclick="parent.location='../'" type="button">
		</div>
    <hr>
	</form>
    <form action="processAddDept.php" method="post">
        <table>
            <tr>
                <td>Department Name</td>
                <td>Belongs To</td>
                <td>Floor</td>
                <td></td>
            </tr>
            <tr>
                <td><input name="dept_name"></td>
                <td><input name="dept_belongs_to"></td>
    			<td>
    				<select name="dept_area">
    					<?php for($ii = 0; $ii < $areaCount; $ii++) {
    					$selected = "";
    					if($area[$ii]['area_name'] == $depts[$i]['area_name']) $selected = "selected=\"selected\"";
    					?>
    					<option <?= $selected ?> value="<?= $area[$ii]['area_ID'] ?>"><?= $area[$ii]['area_name'] ?></option>
    					<?php } ?><?= $area[$ii]['area_name'] ?>
    				</select>
    			</td>
                <td><input name="" type="submit" value="Add Department"></td>
            </tr>
        </table>
    </form>
    <hr>
</body>
</html>