<?php
//csEdit.php 2018/01
// Main Customer Service Interface
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../index.php');
	die;
}

$today = date('Y-m-d');

$username=$_SESSION['username'];
$emp=strtoupper(substr($username,0,2));
$cust_ID=$_REQUEST['cust_ID'];
@$flag=$_REQUEST['flag'];
@$message = $_REQUEST['message'];
@$mcm = $_REQUEST['mcm'];
@$layaway = $_REQUEST['layaway'];
$MC_Total = 0;

//Open Customer Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `customers` WHERE `cust_ID` = '.$cust_ID;
$result = mysqli_query($db, $sql);
if(!$result){
	echo "Customer Database Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$cust=mysqli_fetch_assoc($result);

// load customer items into array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `cust_items` 
		  WHERE `cust_items`.`cust_ID` = '.$cust['cust_ID'];
$result = mysqli_query($db, $sql);
if(!$result){
	echo "cust_item Database Error!<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$itemcount=mysqli_num_rows($result);
mysqli_close($db); 
//Store the Results To A Local Array
for($i=0; $i<$itemcount; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
}
// get vendors
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `vendor_ID`,`vendor_name` FROM `vendors` ORDER BY `vendor_name`";
$result = mysqli_query($db, $sql);
$vendorcount=mysqli_num_rows($result);
mysqli_close($db); 
for($i=0; $i<$vendorcount; $i++){
	$vendors[$i] = mysqli_fetch_assoc($result);
}

// get departments
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `dept_ID`,`dept_name` FROM `departments` ORDER BY `dept_name`";
$result = mysqli_query($db, $sql);
$deptcount=mysqli_num_rows($result);
mysqli_close($db); 
for($i=0; $i<$deptcount; $i++){
	$depts[$i] = mysqli_fetch_assoc($result);
}

//Open Merchandise Credit Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `MC_Items` WHERE `cust_ID`='.$cust_ID ;
$result = mysqli_query($db, $sql);
$MC_results=mysqli_num_rows($result);
mysqli_close($db);
for($i=0; $i<$MC_results; $i++){
    $MC[$i]=mysqli_fetch_assoc($result);
}
@$MCcount=count($MC);

unset($bc);
if($MCcount > 0) $bc="; background-color: #00FF33";

//Open Layaway Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `layaway` WHERE `cust_ID`='.$cust_ID ;
$result = mysqli_query($db, $sql);
$laycount=mysqli_num_rows($result);
mysqli_close($db);
for($i=0; $i<$laycount; $i++){
    $lay[$i]=mysqli_fetch_assoc($result);
}
if($laycount>0) $lc="; background-color: #00FF33";

// set the color of the customer text based on flagged or no
$flagged = "customer";
if($cust['cust_flag']) $flagged = "flagged"; 
?>
<!DOCTYPE html>
<html>
	<meta charset="utf-8" />
	<title>Customer Service: <?= $cust['cust_name'] ?></title>
	<link href="css/csEdit.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/csEdit.js"></script>
</head>
<body>
<div onclick=" pop_clear()" id="screen" class="blackout"></div>
<!-- =========================== title =========================== -->
<div class="title">Customer Service</div>
<hr size="12" noshade="noshade" width="1200"/>

<!-- ====================== Customer Info ======================= -->
<form action="processCsEdit.php" method="POST" >
<table width="1200">
	<tr>
		<td class="<?= $flagged ?>">Name</td>
		<td class="<?= $flagged ?>" 
			 title="<?= $cust['cust_employee'] ?>'s Customer since: <?= $cust['cust_addDate'] ?>"  
			 ondblclick="parent.location='processFlagCustomer.php?cust_ID=<?= $cust['cust_ID'] ?>'">
        	 <input class="cust" type="text" name="cust_name" value="<?= $cust['cust_name'] ?>">
		</td>
		<td rowspan="5" >
			<textarea name="cust_note" rows="6" cols="100"><?= $cust['cust_note'] ?></textarea><br />
		</td>
	</tr>
	<tr class="<?= $flagged ?>"><td>Phone</td><td><input class="cust" type="text" name="cust_phone" value="<?= $cust['cust_phone'] ?>"></td></tr>
	<tr class="<?= $flagged ?>"><td>Addr 1</td><td><input class="cust" type="text" name="cust_addr01" value="<?= $cust['cust_addr01'] ?>"></td></td></tr>
	<tr class="<?= $flagged ?>"><td>Addr 2</td><td><input class="cust" type="text" name="cust_addr02" value="<?= $cust['cust_addr02'] ?>"></td></td></tr>
	<tr class="<?= $flagged ?>"><td>Email</td><td><input class="cust" type="text" name="cust_email" value="<?= $cust['cust_email'] ?>"></td></td></tr>
	<tr><td colspan="2"><?php if($message){ ?><div class="message" ><?= $message ?></div><?php } ?></td></tr>
	<tr>
		<!-- ====================== Status Message ======================= -->		
		
		<td class="submit" colspan="3">
			<input value="Save Changes" type="submit"/>
			<input value="Email Notice" type="button" onclick="popMail(<?= $cust_ID ?>)"/>
			<input id="mcbut" style="<?= $bc ?>" value="MerchCredit" type="button" onclick="pop()"/>
			<input style="<?= $lc ?>" value="Layaway" type="button" onclick="pop2()"/>
		</td>
	</tr>    
	<tr><td colspan="3"><hr /></td></tr>
</table>

<!-- ========================= CS Items ========================= -->
<table class="wantlist" align="center" style="font-family: Arial">
	<tr><td>PU</td><td>Tag</td><td>PIF</td><td>Qty</td><td>Price</td><td>Sku</td><td>Description</td><td>Cat</td><td>Vendor</td><td>PIF</td>
		<td class="smtxt">PO/REF</td><td class="smtxt">Location</td><td class="smtxt">Contacted</td><td class="smtxt">Picked Up</td>
	</tr>
	<?php for($i=0; $i<$itemcount; $i++) { 
	// determine the background color based on status
	$bgcolor = "#FFFF99";
	if($items[$i]['order_ID']) $bgcolor = "#FFCCFF";
	if($items[$i]['ci_location']) $bgcolor = "#99FF99";
	if($items[$i]['ci_datecontacted']) $bgcolor = "#33CCCC";
	if($items[$i]['ci_datepickedup']) $bgcolor = "#CC9933";
	unset($pifflag);
	// determine if PIF is possible
	if(empty($items[$i]['ci_pif']) || $items[$i]['ci_pif'] =='x-xxxxxx' || !empty($items[$i]['ci_datepickedup'])) $pifflag = 'disabled="disabled"';
	?>
	<tr bgcolor="<?= $bgcolor ?>">
		<td>
			<input type="button" value="PU" onclick="return pickup(<?= $items[$i]['ci_ID'] ?>)">
			<input type="hidden" name="ci_ID[<?= $i ?>]" value="<?= $items[$i]['ci_ID'] ?>">
		</td>
		<td><input title="Click Here To Print A Hold Tag" type="checkbox" name="ci_tagged[<?= $i ?>]" /></td>
		<td><input <?= $pifflag ?> title="Click Here To add to PIF" type="checkbox" name="painInFull[<?= $i ?>]" /></td>
		<td><input class="qty" type="text" title="Zero To Delete" name="ci_qty[<?= $i ?>]" value="<?= $items[$i]['ci_qty'] ?>" /></td>
      <td><input class="price" type="text" name="ci_price[<?= $i ?>]" value="<?= $items[$i]['ci_price'] ?>" /></td>
		<td><input class="sku" type="text" name="ci_sku[<?= $i ?>]" value="<?= $items[$i]['ci_sku'] ?>" /></td>
		<td title="Date Added: <?= $items[$i]['ci_dateadded'] ?>"><input class="desc" type="text" name="ci_desc[<?= $i ?>]" value="<?= $items[$i]['ci_desc'] ?>"></td>
		<td>
			<select class="cat" name="dept_ID[<?= $i ?>]">
				<?php for($ii = 0; $ii < $deptcount; $ii++) { 
							$sel = "";
							if($items[$i]['dept_ID'] == $depts[$ii]['dept_ID']) $sel = "selected=\"selected\"";
				?>
				<option value="<?= $depts[$ii]['dept_ID'] ?>" <?= $sel ?>><?= $depts[$ii]['dept_name'] ?></option>
				<?php } ?>
			</select>			
		</td>		
		<td>
			<select class="vendor" name="vendor_ID[<?= $i ?>]">
				<?php for($ii = 0; $ii < $vendorcount; $ii++) { 
							$sel = "";
							if($items[$i]['vendor_ID'] == $vendors[$ii]['vendor_ID']) $sel = "selected=\"selected\"";
				?>
				<option value="<?= $vendors[$ii]['vendor_ID'] ?>" <?= $sel ?>><?= $vendors[$ii]['vendor_name'] ?></option>
				<?php } ?>
			</select>			
		</td>			
		<td><input class="pif" type="text" name="ci_pif[<?= $i ?>]" value='<?= $items[$i]['ci_pif'] ?>'></td>	
		<td title="<?= $items[$i]['ci_dateordered'] ?>"><input class="pif" type="text" name="order_ID[<?= $i ?>]" value='<?= $items[$i]['order_ID'] ?>'></td>
		<td title="<?= $items[$i]['ci_dateheld'] ?>"><input class="pif" type="text" name="ci_location[<?= $i ?>]" value='<?= $items[$i]['ci_location'] ?>'></td>
		<td><input onfocus="iDate(this, '<?= $today ?>')" placeholder="yyyy-mm-dd" class="pif" type="text" name="ci_datecontacted[<?= $i ?>]" value='<?= $items[$i]['ci_datecontacted'] ?>'></td>
		<td><input onfocus="iDate(this, '<?= $today ?>')" placeholder="yyyy-mm-dd" class="pif" type="text" name="ci_datepickedup[<?= $i ?>]" value='<?= $items[$i]['ci_datepickedup'] ?>'></td>
	</tr>
	<?php } ?>
</table>
<input type="hidden" name="cust_ID" value="<?= $cust_ID ?>" />
</form>

<hr size="12" noshade="noshade" width="1200"/>
<!-- ========================= Add Item ========================= -->
<form action="processCsAddItem.php" method="post">
<table>
	<tr>
		<td><input placeholder="qty" class="qty" type="text" name="qty"></td>
		<td><input placeholder="price" class="price" type="text" name="price"></td>
		<td><input placeholder="sku" class="sku" type="text" name="sku"></td>
		<td><input placeholder="Description" class="desc" type="text" name="desc"></td>
		<td>
			<select class="cat" name="dept_ID">
				<?php for($ii = 0; $ii < $deptcount; $ii++) { 
							$sel = "";
							if($items[$i]['dept_ID'] == $depts[$ii]['dept_ID']) $sel = "selected=\"selected\"";
				?>
				<option value="<?= $depts[$ii]['dept_ID'] ?>" <?= $sel ?>><?= $depts[$ii]['dept_name'] ?></option>
				<?php } ?>
			</select>			
		</td>		
		<td>
			<select class="vendor" name="vendor_ID">
				<?php for($ii = 0; $ii < $vendorcount; $ii++) { 
							$sel = "";
							if($items[$i]['vendor_ID'] == $vendors[$ii]['vendor_ID']) $sel = "selected=\"selected\"";
				?>
				<option value="<?= $vendors[$ii]['vendor_ID'] ?>" <?= $sel ?>><?= $vendors[$ii]['vendor_name'] ?></option>
				<?php } ?>
			</select>			
		</td>
		<td><input type="submit" value="Add Item"></td>	
	</tr>
</table>
<input type="hidden" name="cust_ID" value="<?= $cust_ID ?>" />
</form>

<hr size="12" noshade="noshade" width="1200"/>
<!-- =========================== menu =========================== -->
<table>
	<tr >
		<td><input value="Change Customer" onclick="parent.location='csSearch.php'" type="button"></td>
		<td><input value="Exit" onclick="parent.location='csMenu.php'" type="button"></td>
	</tr>
</table>

<hr size="12" noshade="noshade" width="1200"/>
<!-- ========================== Legend ========================== -->
<table>
    <tr >
        <td bgcolor="#FFFF99">&nbsp;&nbsp;&nbsp;Recently Added&nbsp;&nbsp;&nbsp;</td>
        <td bgcolor="#FFCCFF">&nbsp;&nbsp;&nbsp;Placed On Order&nbsp;&nbsp;&nbsp;</td>
        <td bgcolor="#99FF99">&nbsp;&nbsp;&nbsp;Placed On Hold&nbsp;&nbsp;&nbsp;</td>
        <td bgcolor="#33CCCC">&nbsp;&nbsp;&nbsp;Customer Contacted&nbsp;&nbsp;&nbsp;</td>
        <td bgcolor="#CC9933">&nbsp;&nbsp;&nbsp;Picked Up&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>

<hr size="12" noshade="noshade" width="1200"/>
<!-- ************************************** This Is The Merchandise Credit Part ******************************************-->
<div id="pop" class="popup" >
<div id="prtstuff">
    <div class="mc_header">Merchandise Credit For: <?= $cust['cust_name'] ?> - <?= date("m/d/Y") ?><hr /></div>
      <form action="processAddMC.php" method="post" >
<?php if($MCcount > 0){ ?>
       <div id="mc_table">
       <table align="center">
       <tr style="font-size: 10px; font-weight: bold;">
            <td>Category</td><td>Quantity</td><td>Description</td><td>Emp</td><td>Price</td><td>Extention</td><td>Date</td><td></td>
       </tr>
<?php
    $MC_Total = 0;
    for($i=0; $i<$MCcount; $i++){
    $MC_Total = $MC_Total+($MC[$i]['mc_price']*$MC[$i]['mc_status']*$MC[$i]['mc_qty']);
    if($MC[$i]['mc_status'] == 1) {
        $lc="#C8FF75";
    }else{
        $lc="#FF9999";
    }
    round($MC_Total,3);
    $c_price = $MC[$i]['mc_price'] * $MC[$i]['mc_status'];
    $c_ext = $c_price * $MC[$i]['mc_qty'];
?>
          <tr bgcolor="<?= $lc ?>">
              <td><?= $MC[$i]['dept_ID'] ?></td>
              <td><?= $MC[$i]['mc_qty'] ?></td>
              <td><?= $MC[$i]['mc_desc'] ?></td>
              <td><?= $MC[$i]['mc_employee'] ?></td>
              <td class="number"><?= number_format($c_price,2) ?></td>
              <td class="number"><?= number_format($c_ext,2) ?></td>
              <td><?= $MC[$i]['mc_date'] ?></td>
              <td onclick="delmc('<?= $MC[$i]['mc_ID'] ?>', '<?= number_format($c_ext,2) ?>', '<?= $cust_ID ?>');" class="linked" bgcolor="#CCFFFF" >-</td>
          </tr>
<?php } ?>
       </table>
       </div>
       <hr width="70%" />
       <table align="center">
            <tr><td style="font-size: 26px; font-weight: bold; font-family: Arial">Balance Of Merchandise Credit $<?= number_format($MC_Total,2) ?></td></tr>
       </table>
<?php }else{ ?>
       <br /><h2>No Active Merchandise Credit for <?= $cust['cust_name'] ?></h2><br />
<?php } ?>

</div>

      <table id="input" align="center">
          <tr><td>Cat</td><td>Qty</td><td>Description</td><td>Price</td><td>Employee</td><td title="Returned/Redeemed">Ret/Red</td></tr>
          <tr>
              <td><input id="cat" size="2" name="dept_ID" maxlength="4" /></td>
              <td><input id="qty" size="2" name="qty" maxlength="4" /></td>
              <td><input id="desc" size="40" name="desc" value="" /></td>
              <td><input id="price" style=" text-align: right" size="7" name="price" value="" /></td>
              <td><input size="10" name="emp" maxlength="20" value="<?= $emp ?>" /></td>
              <td >
                  <input title="Returned" type="radio" name="ret" value="1" />
                  <input title="Redeemed" type="radio" name="ret" value="-1" />
              </td>
              <td><input style="font-weight: bold" value="Save" type="submit" /></td>
              <td><input style="font-weight: bold" value="Print" type="button" onclick="prt()" /></td>
          </tr>
      </table>
      <input type="hidden" name="cust_ID" value="<?= $cust_ID ?>" />
      </form>
    </div>
<?php if($mcm){ ?> <script> pop(); </script> <?php } ?>
<!-- ************************************** This Is The Layaway Part ******************************************-->
<div id="pop2" class="popup" >
  <div id="prtstuff">
    <div class="mc_header">
        <form action="processAddLay.php" method="post">
          Layaways For: <?= $cust['cust_name'] ?> - <?= date("m/d/Y") ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="hidden" name="cust_ID" value="<?= $cust_ID ?>" />
          <input type="submit" name="AddLayaway" value="Add Layaway" />
        </form>
        <hr />
    </div>
<?php if($laycount > 0){ ?>
     <div id="lay_table">
       <table class="lay" align="center">
         <tr style="font-size: 24px; font-weight: bold; font-family: Arial">
           <td>Layaway #</td><td>Date Iniated</td><td>Date Completed</td><td>Del</td>
         </tr>

<?php
    for($i=0; $i<$laycount; $i++){
    unset($sty);
    if(substr($lay[$i]['lay_datecomp'],0,3) != "Due") $sty = "style = \"background-color: #CCCCCC \"";
?>
          <tr <?= $sty ?> >
              <td class="clickrow" onclick="laypop('<?= $lay[$i]['layaway_ID'] ?>')" ><?= $lay[$i]['layaway_ID'] ?></td>
              <td class="clickrow" onclick="laypop('<?= $lay[$i]['layaway_ID'] ?>')"><?= $lay[$i]['lay_dateint'] ?></td>
              <td class="clickrow" onclick="laypop('<?= $lay[$i]['layaway_ID'] ?>')"><?= $lay[$i]['lay_datecomp'] ?></td>

<?php if(substr($lay[$i]['lay_datecomp'],0,12) == "Due: Nothing") { ?>
              <td class="delrow" style="text-align: center; font-weight: Bold;" width="20">
                  <a style=" text-decoration: none" href="processDelLayaway.php?layaway_ID=<?= $lay[$i]['layaway_ID'] ?>&cust_ID=<?= $cust_ID ?>">-</a>
              </td>
<?php }else { ?>
              <td></td>
<?php } ?>
          </tr>
<?php } ?>
       </table>
     </div>
<?php }else{ ?>
    <br /><h2>No Active Layaway for <?= $cust['cust_name'] ?></h2><br />
<?php } ?>
  </div>
</div>
<?php if($layaway){ ?>
<script type="text/javascript">
pop2();
</script>
<?php } ?>
<?php if($MC_Total<0.01){ ?>
    <script type="text/javascript"> zerobal(<?= $MCcount ?>); </script>
<?php } ?>
</body>
</html>