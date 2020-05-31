<?php
//dashEditRegItems.php 2018/05
// Vendor Catalog Edit Workspace
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
$blast=$_REQUEST['blast'];

//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` WHERE `reg_ID` = \''.trim($regnum).'\' ' ;
$result = mysqli_query($db, $sql);
if($result) $num_results=mysqli_num_rows($result);
mysqli_close($db);

//load the result into an associative array
if($result){
	$reg=mysqli_fetch_assoc($result);
	// load couples registry
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `reg_items` 
			  LEFT JOIN `items` USING(`item_ID`)
			  WHERE `reg_ID`='.$reg['reg_ID'] ;
	$result = mysqli_query($db, $sql);
	$riCount=mysqli_num_rows($result);
	mysqli_close($db);

	for($i=0; $i<$riCount; $i++){
	    $ri[$i] = mysqli_fetch_assoc($result);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?=$reg[reg_partner1L]?> & <?=$reg[reg_partner2L]?> Manage Your Registry</title>

<script type="text/javascript">
function setFocus()
{
     document.getElementById("start").focus();
}
</script>
<?php include 'popstyle.php'; ?>
</head>

<body onload="setFocus()">

<br />
<table align="center" width="400">
<tr><td><div align="center" style=" font-family: Arial; font-size: 20px">Dashboard Registry Manager</div></td></tr>
<tr><td align="center"><?=$reg[reg_partner1L]?> & <?=$reg[reg_partner2L]?> &nbsp;&nbsp;&nbsp;&nbsp;: <?=$reg[reg_email01]?> :</td></tr>
</table>
<form action="processAddRegistryItem.php" method="post">
<table width="700" align="center">
  <tr bgcolor="#00CCCC">
      <td align="center"><b>The Suspects:</b>
      <?=$reg[reg_partner1F]?> <?=$reg[reg_partner1L]?> &
      <?=$reg[reg_partner2F]?> <?=$reg[reg_partner2L]?>
      <b>The Big Day: <?=$reg[reg_event_date]?></b>
      </td>
  </tr>
  <tr>
      <td>Record#:<input id="start" name="sku" /> Quantity:<input name="qty" size="2" /><input type="submit" name="" value="Add Item To Registry" /></td>
  </tr>
  <tr>
      <td><hr /></td>
  </tr>
</table>
<input type="hidden" name="regnum" value="<?=$reg[reg_ID]?>" />
</form>
<?php if($message){?>
<table align="center" border="4" >
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php } ?>
<form action="processEditRegItems.php" method="POST">
<table width="700" align="center">
  <tr>
      <td>Picture</td>
      <td>Description</td>
      <td>Price</td>
      <td align="center">Want</td>
      <td align="center">Got</td>
      <td align="center">Purchased By- hold/ship/take</td>
      <td align="center">Item</td>
      <td onclick="parent.location='editRegItems.php?regnum=<?= $regnum ?>&blast=yes'" align="center">Remove</td>
  </tr>
  <tr>
      <td colspan="6"><hr /></td>
  </tr>
  <?php if($riCount > 0){
        $total=0;
      for($i=0; $i<$riCount; $i++){
        $total = $total + ($ri[$i]['ri_qty']*$ri[$i]['ri_price']);
         ?>
        <tr>
        <td>
            <a class="thumbnail" href="#thumb">
                <img style=" max-height: 25px; max-width: 25px" border="0"  src="<?=resolve($ri[$i]['item_pic'])?>">
                <span><img src="<?=resolve($ri[$i]['item_pic'])?>" /><b><?=$ri[$i]['ri_desc']?></b></span>
            </a>
        </td>
        <td><input size="40" name="desc[<?=$i?>]" value="<?=$ri[$i]['ri_desc']?>" />
            <input type="hidden" name="recno[<?= $i ?>]" value="<?=$ri[$i]['ri_ID']?>" />
        </td>
        <td><input size="3" name="price[<?=$i?>]" value="<?=$ri[$i]['ri_price']?>" /></td>
        <td align="center"><input size="2" name="adjQty[<?=$i?>]" value="<?=$ri[$i]['ri_qty']?>" /></td>
        <td align="center"><input name="recd[<?=$i?>]" size="2" value="<?=$ri[$i]['ri_sold']?>" /></td>
        <td align="center"><input name="hold[<?=$i?>]" size="30" value="<?=$ri[$i]['ri_on_hold']?>" /></td>
        <td align="center"><input name="item[<?=$i?>]" size="6" value="<?=$ri[$i]['item_ID']?>" /></td>
        <td title="Checking Here Will Delete The Item From Your Registry" align="center">
        <?php if(!$item[$i]['ri_sold'] && $blast=="yes") {?>
        <input type="checkbox" name="deleteMe[<?=$i?>]" />
        <?php } ?>
        <input name="sku[<?=$i?>]" type="hidden" value="<?=$ri[$i]['item_sku']?>" />
        <input name="regNum[<?=$i?>]" type="hidden" value="<?=$ri[$i]['reg_ID']?>" />
        </td>
        </tr>
        <tr><td height="1" bgcolor="#BBBBBB" colspan="6"></td></tr>
  <?php }
  }else { ?>
    <tr>
      <td colspan="6" align="center">You Probably Want To Get Started Adding Items To your Registry Right Now!</td>
    </tr>

  <?php } ?>
    <tr>
      <td ></td><td align="right">Total Registry Value $</td><td><?= number_format($total,2) ?></td>
    </tr>
</table>
<br />
<div align="center">
<input type="submit" value="Save Changes" /><input value="Return To Registry Manager" onclick="parent.location='index.php'" type="button"></div>
</form>
<br />
<?php if($message){?>
<table align="center" border="4" >
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message); }?>
 </body>
</html>