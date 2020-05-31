<?php
//processAddVendor.php 2018/01
// Chooses which vendor's items to look at
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

@$message=$_REQUEST['message'];
$vendor_ID=$_REQUEST['vendor_ID'];
@$edit = $_REQUEST['edit']; 

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$vendor_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db);

if($result) {
	$vendor = mysqli_fetch_assoc($result);
}else{
	echo "Vendor Not Found";
	die;
}

?>
<!DOCTYPE html>

<html>

<head>
  <title>Vendor Edit: <?= $vendor['vendor_name'] ?></title>
</head>
<body>
<br />
<form action="processEditVendor.php" method="POST" >
<hr size="12" noshade="noshade"/>

<!-- Menu -->
<table>
    <tr >
        <td class="dashcell"><input class="dashbut" value="Edit Items" onclick="parent.location='../items.php?vendor_ID=<?= $vendor_ID ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Change Vendor" onclick="parent.location='../vendorSelect.php?direction=Edit'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Cancel" onclick="parent.location='editVendor.php?vendor_ID=<?= $vendor_ID ?>'" type="button"></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit"/></td>
        <td class="dashcell"><input class="dashbut" value="Exit" onclick="parent.location='../'" type="button"></td>
    </tr>
</table>

<?php if($message){?>
<br />
<table class="count" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php 
	unset($message);
}
	$status = (!$edit) ? 'disabled' : '';	
?>

<table>
    <tr>
        <td colspan="2">
        		<h1>
        			<input name="v[1]" size="40" value="<?= $vendor['vendor_name'] ?>" />
        			Count Group: <input name="v[14]" value="<?= $vendor['vendor_group'] ?>" <?= $status ?>>
        		<?php if($status == 'disabled') { ?> <input type="hidden" name="v[14]" value="<?= $vendor['vendor_group'] ?>"> <?php }?>
        		</h1> 
        		Counted By:<input name="v[15]" size="7" value="<?= $vendor['vendor_counter'] ?>"  <?= $status ?>/>   
        		<?php if($status == 'disabled') { ?> <input type="hidden" name="v[15]" value="<?= $vendor['vendor_counter'] ?>"> <?php }?>  
        		Modified by Rep: <?= $vendor['vendor_tredit'] ?>  		
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td>Address Line 1:<input name="v[2]" size="40" value="<?= $vendor['vendor_addr1'] ?>" /></td>
        <td align="right">Representative: <input name="v[6]" size="40" value="<?= $vendor['vendor_rep'] ?>" /></td>
    </tr>
    <tr>
        <td>Address Line 2:<input name="v[3]" size="40" value="<?= $vendor['vendor_addr2'] ?>" /></td>
        <td align="right">Fax Number:<input name="v[7]" size="40" value="<?= $vendor['vendor_fax'] ?>" /></td>
    </tr>
    <tr>
        <td>Address Line 3:<input name="v[4]" size="40" value="<?= $vendor['vendor_addr3'] ?>" /></td>
        <td align="right">Voice Number:<input name="v[8]" size="40" value="<?= $vendor['vendor_voice'] ?>" /></td>
    </tr>
    <tr>
        <td >Email Address :<input name="v[5]" size="40" value="<?= $vendor['vendor_email'] ?>" /></td>
        <td align="right">Price Multiplier:<input name="v[11]" size="40" value="<?= $vendor['vendor_multi'] ?>" /></td>
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
            <span ondblclick="parent.location='editVendor.php?vendor_ID=<?= $vendor_ID ?>&edit=1'">Note:</span> <input name="v[12]" size="105" value="<?= $vendor['vendor_note'] ?>" />
            <?php
                 $checked = "";
                 if($vendor['vendor_hti'] == 1) $checked = 'checked="checked"'
            ?>
            HTI<input name="v[13]" type="checkbox" <?= $checked ?>  />
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>

<!-- Menu -->
<table>
    <tr >
        <td class="dashcell"><input class="dashbut" value="Edit Items" onclick="parent.location='../items.php?vendor_ID=<?= $vendor_ID ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Change Vendor" onclick="parent.location='../vendorSelect.php?direction=Edit'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Cancel" onclick="parent.location='editVendor.php?vendor_ID=<?= $vendor_ID ?>'" type="button"></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit"/></td>
        <td class="dashcell"><input class="dashbut" value="Exit" onclick="parent.location='../'" type="button"></td>
    </tr>
</table>

<input type="hidden" name="vendor_ID" value="<?= $vendor['vendor_ID'] ?>" />
</form>
</body>

</html>