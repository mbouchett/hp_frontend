<?php
//vendorEdit.php 2018/01
// Vendor Data Edit Workspace
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
  	
$vendor_ID = $_POST['vendor_ID'];
if(!$vendor_ID) $vendor_ID = $_REQUEST['vendor_ID'];
if(!$vendor_ID) $vendor_ID = 516;

$message=$_REQUEST['message'];

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$vendor_ID;//Create The Search Query
$result = mysqli_query($db, $sql);          //Initiate The Query
mysqli_close($db);                          //Close The Connection

if($result) {
	$vendor = mysqli_fetch_assoc($result);//Get The Record
}else{
	echo "Vendor Not Found";
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="SHORTCUT ICON" href="images/4923-48x48x32.png"/>
	<title>Vendor Edit</title>
	<link href="css/style01.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="processVendorEdit.php" method="POST" >
<hr size="12" noshade="noshade"/>
<table>
    <tr >
        <td><input value="Edit Items" onclick="parent.location='items.php?vendor_ID=<?= $vendor_ID ?>'" type="button"></td>
        <td><input value="Change Vendor" onclick="parent.location='vendorSelect.php?direction=Edit'" type="button"></td>
        <td><input value="Cancel Changes" onclick="window.history.back();" type="button"></td>
        <td><input value="Save Changes" type="submit"/></td>
        <td><input value="Exit" onclick="parent.location='../'" type="button"></td>
    </tr>
</table>

<?php if($message){?><br /><?=$messSize?><?php unset($message);}?>

<table>
    <tr >
        <td colspan="2">
        		<h1>
        			<?= $vendor['vendor_ID'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        			<input name="v[1]" size="40" value="<?= $vendor['vendor_name'] ?>" />
                    <?php if($vendor['vendor_group'] == 0){ ?>
        			Count Group:<input name="v[14]" size="5" value="<?= $vendor['vendor_group'] ?>" />
                    <?php }else{ ?>
                    Count Group: <?= $vendor['vendor_group'] ?>
                    <input type="hidden" name="v[14]" value="<?= $vendor['vendor_group'] ?>">
                    <?php } ?>
        		</h1>        		
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr class="vendor">
        <td>Address Line 1:<input name="v[2]" size="40" value="<?= $vendor['vendor_addr1'] ?>" /></td>
        <td>Representative: <input name="v[6]" size="40" value="<?= $vendor['vendor_rep'] ?>" /></td>
    </tr>
    <tr>
        <td>Address Line 2:<input name="v[3]" size="40" value="<?= $vendor['vendor_addr2'] ?>" /></td>
        <td>Fax Number:<input name="v[7]" size="40" value="<?= $vendor['vendor_fax'] ?>" /></td>
    </tr>
    <tr>
        <td>Address Line 3:<input name="v[4]" size="40" value="<?= $vendor['vendor_addr3'] ?>" /></td>
        <td>Voice Number:<input name="v[8]" size="40" value="<?= $vendor['vendor_voice'] ?>" /></td>
    </tr>
    <tr>
        <td >Email Address :<input name="v[5]" size="40" value="<?= $vendor['vendor_email'] ?>" /></td>
        <td>Price Multiplier:<input name="v[11]" size="40" value="<?= $vendor['vendor_multi'] ?>" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2">Ship Method 1: <input name="v[9]" size="92" value="<?= $vendor['vendor_ship1'] ?>" /></td>
    </tr>
    <tr>
        <td colspan="2">Ship Method 2: <input name="v[10]" size="92" value="<?= $vendor['vendor_ship2'] ?>" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2">
            Note: <input name="v[12]" size="105" value="<?= $vendor['vendor_note'] ?>" />
            <?php
                 $checked = "";
                 if($vendor['vendor_hti'] == 1) $checked = 'checked="checked"'
            ?>
            HTI<input name="v[13]" type="checkbox" <?= $checked ?>  />
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>

<table>
    <tr >
        <td><input value="Edit Items" onclick="parent.location='items.php?vendor_ID=<?= $vendor_ID ?>'" type="button"></td>
        <td><input value="Change Vendor" onclick="parent.location='vendorSelect.php?direction=Edit'" type="button"></td>
        <td><input value="Cancel Changes" onclick="window.history.back();" type="button"></td>
        <td><input value="Save Changes" type="submit"/></td>
        <td><input value="Exit" onclick="parent.location='../'" type="button"></td>
    </tr>
</table>
<input type="hidden" name="vendor_ID" value="<?= $vendor['vendor_ID'] ?>" />
</form>

</body>
</html>