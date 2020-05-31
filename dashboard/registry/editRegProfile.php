<?php
//editRegProfile.php 2018/06
// Edit Registry Profile
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
$regnum=$_REQUEST['regnum'];
$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` WHERE `reg_ID` = \''.trim($regnum).'\' ' ;
$result = mysqli_query($db, $sql);
mysqli_close($db);

if($result) $reg=mysqli_fetch_assoc($result);

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `reg_items` 
        LEFT JOIN `items` USING(`item_ID`)
		  WHERE `reg_ID` = \''.trim($regnum).'\' ' ;
$result = mysqli_query($db, $sql);
$riCount=mysqli_num_rows($result);
mysqli_close($db);
for($i = 0; $i < $riCount; $i++){
	$ri[$i] = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=stripslashes($reg['reg_partner1F'])?> & <?=stripslashes($reg['reg_partner2F'])?> Change Registry Profile</title>
	<script type="text/javascript" src="../webtools/date/datetimepicker_css.js"></script>
	<?php include 'popstyle.php'; ?>
</head>
<body>
<br />
<table align="center" width="400">
<tr><td><div align="center" style=" font-family: Arial; font-size: 20px">Change Registry Profile</div></td></tr>
<tr><td align="center"><?=stripslashes($reg['reg_partner1F'])?> & <?=stripslashes($reg['reg_partner2F'])?></td></tr>
</table>
<br />
<form action="processEditRegProfile.php" method="post">
<table align="center">
    <tr><td align="left">Partner 1:</td><td>First*</td><td><input name="rN[0]" type="text" value="<?=stripslashes($reg['reg_partner1F'])?>" /></td>
   		<td>Last*</td><td><input name="rN[1]" type="text" value="<?=stripslashes($reg['reg_partner1L'])?>" /></td>
    </tr>
    <tr><td align="left">Partner 2:</td><td>First*</td><td><input name="rN[2]" type="text" value="<?=stripslashes($reg['reg_partner2F'])?>" /></td>
   		<td>Last*</td><td><input name="rN[3]" type="text" value="<?=stripslashes($reg['reg_partner2L'])?>" /></td>
    </tr>
</table>
<table align="center">
	 <tr><td colspan="5"><hr /></td></tr>
	 <tr>
         <td><div style="color:#<?=$alertColor?>">Event Date*</div></td><td><div style="color:#<?=$alertColor?>">Main Phone*</div></td>
         <td>Alternate Phone</td><td><div style="color:#<?=$alertColor?>">Main Email*</div></td><td>Alternate Email</td>
     </tr>
     <tr>
		<td><input name="rN[4]" placeholder="yyyy-mm-dd" type="date" value="<?=stripslashes($reg['reg_event_date'])?>" size="10" id="demo1" /></td><td><input name="rN[5]" type="text" value="<?=stripslashes($reg['reg_phone01'])?>" /></td>
        <td><input name="rN[6]" type="text" value="<?=stripslashes($reg['reg_phone02'])?>" /></td><td><input name="rN[7]" type="text" value="<?=stripslashes($reg['reg_email01'])?>" /></td>
        <td><input name="rN[8]" type="text" value="<?=stripslashes($reg['reg_email02'])?>" /></td>
    </tr>
    <tr><td colspan="5"><hr /></td></tr>
</table>
<table align="center">
	<tr>
    	<td colspan="2">Address Pre-Event</td><td colspan="2">Address Post-Event <small>(if different)</small></td>
    </tr>
	<tr>
    	<td rowspan="2">Street Address</td>
        <td align="center"><input size="37" name="rN[9]" type="text" value="<?=stripslashes($reg['reg_addr01'])?>" /></td>
        <td rowspan="2">Street Address</td>
        <td align="center"><input size="37" name="rN[17]" type="text" value="<?=stripslashes($reg['reg_postaddr01'])?>" /></td>
    </tr>
	<tr>
    	<td align="center"><input size="37" name="rN[10]" type="text" value="<?=stripslashes($reg['reg_addr02'])?>" /></td>
        <td align="center"><input size="37" name="rN[18]" type="text" value="<?=stripslashes($reg['reg_postaddr02'])?>" /></td>
    </tr>
	<tr>
    	<td>City, State, Zip</td>
        <td align="center"><input size="37" name="rN[11]" type="text" value="<?=stripslashes($reg['reg_addr03'])?>" /></td>
        <td>City, State, Zip</td><td align="center"><input size="37" name="rN[19]" type="text" value="<?=stripslashes($reg['reg_postaddr03'])?>" /></td>
    </tr>
        <tr><td colspan="4"><hr /></td></tr>
</table>
<table align="center">
	<tr>
    	<td>Contact Name:</td><td><input size="37" name="rN[12]" type="text" value="<?=stripslashes($reg['reg_contact'])?>" /></td>
        <td>Relation To You:</td><td><input size="37" name="rN[13]" type="text" value="<?=stripslashes($reg['reg_relation'])?>" /></td>
    </tr>
	<tr>
    	<td>Contact Phone:</td><td><input size="37" name="rN[14]" type="text" value="<?=stripslashes($reg['reg_cphone01'])?>" /></td>
        <td>Alternate Phone</td><td><input size="37" name="rN[15]" type="text" value="<?=stripslashes($reg['reg_cphone02'])?>" /></td>
    </tr>
	<tr>
    	<td colspan="2" align="right">Contact Email:</td>
        <td align="left" colspan="2"><input size="37" name="rN[16]" type="text" value="<?=stripslashes($reg['reg_cemail'])?>" /></td>
    </tr>
    <tr><td colspan="4"><hr /></td></tr>
</table>
<table width="700" align="center">
<?php if($riCount > 0){ ?>
  <tr>
      <td>Picture</td><td>Description</td><td>Price</td><td align="center">Wanted</td><td align="center">Received</td>
  </tr>
    <?php for($i = 0; $i < $riCount; $i++){ ?>
        <tr>
            <td>
                <a class="thumbnail" href="#thumb"><img border="0" height="25" src="<?=resolve($ri[$i]['item_pic'])?>">
                    <span><img src="<?=resolve($ri[$i]['item_pic'])?>" /><b><?=$ri[$i]['item_desc']?></b></span>
                </a>
            </td>
            <td><?=stripslashes($ri[$i]['item_desc'])?></td>
            <td><?=stripslashes($ri[$i]['ri_price'])?></td>
            <td align="center"><?=stripslashes($ri[$i]['ri_qty'])?></td>
            <td align="center"><?=stripslashes($ri[$i]['ri_sold'])?></td>
        </tr>
        <tr><td height="1" bgcolor="#BBBBBB" colspan="6"></td></tr>
    <?php }
}else { ?>
    <tr>
        <td><input type="checkbox" name="delete" />
            If you Check Here and Save the changes The Registry Will Be Unrecoverable
            <hr />
        </td>
    </tr>
    <?php } ?>
</table>
<table align="center">
    <tr>
        <td align="center">
            <input type="submit" name="" value="Save Changes" />
        </td>
        <td align="center">
            <input value="Return To Registry Manager" onclick="parent.location='index.php'" type="button">
        </td>
    </tr>
</table>
<input type="hidden" name="regnum" value="<?=$regnum?>" />
</form>
<br />
<?php if($message){?>
<table align="center" border="4" >
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>

</body>

</html>