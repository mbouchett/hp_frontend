<?php
//addCustomer.php 2018/01
// Display the customer service menu
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}
  	
$today=date('Y-m-d');
$message=$_REQUEST['message'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Add Customer</title>
	<style type="text/css">
		td {
			border-style: solid;
			border-width: 1px;
			padding: 5px;
			width: 150px;	
		}
	</style>
<script type="text/javascript">
function setFocus()
{
     document.getElementById("start").focus();
}
</script>
</head>
<body onload="setFocus()">
Add Customer
<form action="processAddCustomer.php" method="POST" >
<hr size="12" noshade="noshade"/>
<table>
    <tr >
        <td><input value="Save Changes" type="submit" /></td>
        <td><input value="Exit" onclick="parent.location='csMenu.php'" type="button"></td>
    </tr>
</table>

<?php if($message){?>
<br />
<table align="center" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php }?>

<table>
    <tr><td colspan="4"><hr /></td></tr>
    <tr>
        <td >Date:</td><td align="right"><input readonly="readonly" name="c[0]" size="35" value="<?= $today ?>" /></td>
        <td >Employee: </td><td align="right"><input name="c[1]" size="35" value="<?=strtoupper(substr($username,0,2)) ?>" /></td>
    </tr>
    <tr><td colspan="4"><hr /></td></tr>
    <tr>
        <td >Cust Name:</td><td align="right"><input id="start" name="c[2]" size="35" /></td>
        <td >Phone Number: </td><td align="right"><input name="c[3]" size="35" /></td>
    </tr>
    <tr>
        <td >Addr Line 1:</td><td align="right"><input id="start" name="c[4]" size="35" /></td>
        <td align="center" rowspan="3" >Note: </td><td rowspan="3" align="right"><textarea name="c[7]" rows="3" cols="32"></textarea></td>
    </tr>
    <tr><td >Addr Line 2:</td><td align="right"><input id="start" name="c[5]" size="35" /></td></tr>
    <tr><td >Email:</td><td align="right"><input id="start" name="c[6]" size="35" /></td></tr>
    <tr><td colspan="4"><hr /></td></tr>
</table>
</form>
</body>

</html>