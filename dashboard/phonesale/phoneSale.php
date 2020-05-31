<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
  echo 'No Authorization'.$username;
  exit;
}

$date=date('m/d/Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="images/paid.ico">
<title>Phone Sale (a)</title>
</head>
<body>
	<img height="30" border="0" src="../../images/compass.png" />
	<div style="font-family: Arial; font-size: 24px; color: #CC0000; display: inline;">Phone Sale</div>
<form >
<table width="600" border="0" cellpadding="8">
	<tr bgcolor="#CCCCCC">
        <td>Employee:</td>
        <td width="75"><input name="a[0]" size="12" type="text" /></td>
        <td><input name="a[1]" size="8" type="text" value="<?=$date?>" /></td>
	</tr>
</table>

<table width="600" border="0" cellpadding="1">
    <tr bgcolor="#CCCCCC"><td>Customer Name: </td><td><input name="a[2]" size="35" type="text" /></td></tr>
    <tr bgcolor="#CCCCCC"><td>Customer Phone: </td><td><input name="a[3]" size="35" type="text" /></td></tr>
	<tr><td colspan="2" align="center"><hr /></td></tr>
</table>

<table width="600" border="0" cellpadding="1">
    <tr><td colspan="2"><b>Billing Address:</b></td></tr>
	<tr bgcolor="#CCCCCC"><td>Street:</td><td><input name="a[4]" size="35" type="text" /></td></tr>
	<tr bgcolor="#CCCCCC"><td>City/State:</td><td><input name="a[5]" size="35" type="text" /></td></tr>
	<tr bgcolor="#CCCCCC"><td>*Zip:</td><td><input name="a[6]" size="35" type="text" /></td></tr>

    <tr><td colspan="2"><b>Shipping Address:</b></td></tr>
	<tr bgcolor="#CCCCCC"><td>Street:</td><td><input name="a[4]" size="35" type="text" /></td></tr>
	<tr bgcolor="#CCCCCC"><td>City/State:</td><td><input name="a[5]" size="35" type="text" /></td></tr>
	<tr bgcolor="#CCCCCC"><td>*Zip:</td><td><input name="a[6]" size="35" type="text" /></td></tr>
	
    <tr bgcolor="#CCCCCC"><td colspan="2"><b>Payment Method:</b></td></tr>
	<tr bgcolor="#CCCCCC"><td>Card Type:</td><td><input name="a[10]" size="35" type="text" /></td></tr>    
    <tr bgcolor="#CCCCCC"><td>Card Number:</td><td><input name="a[11]" size="35" type="text" /></td></tr>
    <tr bgcolor="#CCCCCC"><td>Expiration Date:</td><td><input name="a[12]" size="35" type="text" /></td></tr>
    <tr bgcolor="#CCCCCC"><td>CVV #:</td><td><input name="a[13]" size="35" type="text" /></td></tr>

    <tr><td colspan="2"><b>Merchandise Description:</b></td></tr>
	<tr bgcolor="#CCCCCC">
        <td>Items & Retails:</td>
        <td><textarea name="a[14]" rows="4" cols="75"></textarea></td>
	</tr>
	
    <tr><td colspan="2"><b>Transaction Details:</b></td></tr>
	<tr bgcolor="#CCCCCC"><td>Reg & Trans #:</td><td><input name="a[15]" size="35" type="text" /></td></tr>
    <tr bgcolor="#CCCCCC"><td>Total with Tax:</td><td><input name="a[16]" size="35" type="text" /></td></tr>
    <tr bgcolor="#CCCCCC"><td>Shipping Charge:</td><td><input name="a[17]" size="35" type="text" /></td></tr>
    <tr bgcolor="#CCCCCC"><td>Total On Card:</td><td><input name="a[18]" size="35" type="text" /></td></tr>
    <tr bgcolor="#CCCCCC"><td>Paid In Amount:</td><td><input name="a[19]" size="35" type="text" /></td></tr>
    
    <tr><td colspan="2"><b>Note To Include:</b></td></tr>
	<tr bgcolor="#CCCCCC">
        <td align="center" colspan="2">
            <textarea name="a[20]" rows="4" cols="75"></textarea>
        </td>
	</tr>
    <tr><td colspan="2" align="center" bgcolor="#000000"><div style="font-family: Arial; font-size: 18px; color: #FFFFFF">Telephone Sale</div></td></tr>
</table>

<div align="center">
<INPUT value="Print This Form" TYPE="button" onClick="window.print()"> <INPUT TYPE=RESET> <input value="Return To Menu" onclick="parent.location='../dashboard.php'" type="button"></div>
</form>
</body>
</html>