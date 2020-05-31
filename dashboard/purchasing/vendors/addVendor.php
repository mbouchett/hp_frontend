<?php
//addVendor.php 2018/01
// Add a vendor to the system
date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
}
$message=$_REQUEST['message'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Vendor</title>
</head>
<body>
<form action="processAddVendor.php" method="POST" >
<hr size="12" noshade="noshade"/>
<table>
    <tr >
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit" /></td>
        <td class="dashcell"><input class="dashbut" value="Exit" onclick="parent.location='../'" type="button"></td>
    </tr>
</table>

<?php if($message){?>
<br />
<table class="menu">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>

<table>
    <tr>
        <td>Vendor Name: <input name="v[1]" size="35" /></td>
        <td align="right"></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td>Address Line 1:<input name="v[2]" size="35" /></td>
        <td align="right">Representative: <input name="v[6]" size="35" /></td>
    </tr>
    <tr>
        <td>Address Line 2:<input name="v[3]" size="35" /></td>
        <td align="right">Fax Number:<input name="v[7]" size="35" /></td>
    </tr>
    <tr>
        <td>Address Line 3:<input name="v[4]" size="35" /></td>
        <td align="right">Voice Number:<input name="v[8]" size="35" /> </td>
    </tr>
    <tr>
        <td >Email Address :<input name="v[5]" size="35" /></td>
        <td align="right">Price Multiplier:<input name="v[11]" size="35" value="2.4" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2">Ship Method 1: <input name="v[9]" size="92" value="Please Call With Quote" /></td>
    </tr>
    <tr>
        <td colspan="2">Ship Method 2: <input name="v[10]" size="92" value="Cancel 30 Days After Ship Date - No Backorders Without Prior Approval" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2">Note: <input name="v[12]" size="105" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>
<table>
    <tr >
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit" /></td>
        <td class="dashcell"><input class="dashbut" value="Exit" onclick="parent.location='../'" type="button"></td>
    </tr>
</table>
</form>
</body>

</html>