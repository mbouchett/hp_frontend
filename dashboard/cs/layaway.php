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

$alert = $_REQUEST['alert'];
$layaway_ID = $_REQUEST['layaway_ID'];
$date = date('Y/m/d');

//==================== Get Layaway Info ====================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `layaway` WHERE `layaway_ID`='.$layaway_ID;
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Get Layaway Info Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$lay=mysqli_fetch_assoc($result);

//==================== Get Customer Info ====================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `customers` WHERE `cust_ID`='.$lay['cust_ID'];
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Get Customer Info Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
$cust=mysqli_fetch_assoc($result);

//================== Get layaway item info ==================
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `layItems` WHERE `layaway_ID`='.$layaway_ID;
$result = mysqli_query($db, $sql);
$layItemCount=mysqli_num_rows($result);
if(!$result) {
	echo "Get Layaway Item Info Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);
if($layItemCount){
    for($i = 0; $i < $layItemCount; $i++){
        $layItem[$i]=mysqli_fetch_assoc($result);
        $totalLay = $totalLay + ($layItem[$i]['li_qty']*$layItem[$i]['li_price']);
    }
}
$preTax = number_format($totalLay,2);
$tax1 = number_format($totalLay *.06,2);
$tax2 = number_format($totalLay *.01,2);
$totalLay = $totalLay * 1.07;
$grandTot = number_format($totalLay,2);

//Get layaway Payments info
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `layPayment` WHERE `layaway_ID`='.$layaway_ID ;
    $result = mysqli_query($db, $sql);
    $layPayCount=mysqli_num_rows($result); 
mysqli_close($db);
if($layPayCount){
    for($i=0; $i<$layPayCount; $i++){
        $layPay[$i]=mysqli_fetch_assoc($result);
        $totalLay = $totalLay - $layPay[$i]['lp_amount'];
    }
}

//Update Master Layaway
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
    $sql = "UPDATE `".$db_db."`.`layaway` SET `datecomp` = 'Due: Nothing Added Yet' WHERE `recno` = '".$recno."';";
    if($layItemCount > 0 ) $sql = "UPDATE `".$db_db."`.`layaway` SET `lay_datecomp` = 'Due: ".number_format($totalLay,2)."' WHERE `layaway_ID` = '".$layaway_ID."';";
    if($layItemCount > 0 && $totalLay < 0.01) $sql = "UPDATE `".$db_db."`.`layaway` SET `lay_datecomp` = '".$date."' WHERE `layaway_ID` = '".$layaway_ID."';";
    $result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Layaway #<?= $layaway_ID ?></title>
	<link href="css/layaway.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/layawayPRT.css" rel="stylesheet" type="text/css" media="print" />
	<script type="text/javascript" src="js/layaway.js"></script>
</head>
<body>
<div onclick=" pop_clear()" id="screen" class="blackout"></div>
<div id="layhead">
    <img alt="Homeport" src="images/hplogosm.png" />
    <div class="laynum">Layaway #<?= $layaway_ID ?><br /><?= $lay['lay_dateint'] ?></div><br />
</div>
    <ul class="unList">
        <li onclick="popAdd()">Add Item</li>
        <li onclick="popPay()">Make Payment</li>
    </ul>
    <span style="font-weight: bold">Balance With Tax: <?= number_format(round($totalLay,2),2) ?></span>
<div class="layname">
    <?= $cust['cust_name'] ?> - v.<?= $cust['cust_phone'] ?><br />

</div>
<?php if(!$layItemCount) {?> <!-- Do This If No Items Have Been Added To The Layaway -->
<div class="lays">
    <h1>No Layaway Items Added Yet</h1>
</div>
<?php }else{ ?>
<div class="lays">
Items:
<table>
    <tr class="tHead"><td>Dept</td><td>Description</td><td style="padding: 0px 5px;">Qty</td><td>Price</td><td style="padding: 0px 5px;">Amount</td><td>Del</td></tr>
<?php for($i=0; $i<$layItemCount; $i++){ ?>
    <tr>
        <td><?= $layItem[$i]['dept_ID'] ?></td>
        <td width="320"><?= $layItem[$i]['li_desc'] ?></td>
        <td ><?= $layItem[$i]['li_qty'] ?></td>
        <td class="money"><?= number_format($layItem[$i]['li_price'],2) ?></td>
        <td class="money"><?= number_format($layItem[$i]['li_qty']*$layItem[$i]['li_price'],2) ?></td>
        <td style="text-align: center; font-weight: Bold;" width="20">
            <a href="processDelLayItem.php?li_ID=<?= $layItem[$i]['li_ID'] ?>&layaway_ID=<?= $layaway_ID ?>">-</a>
        </td>
    </tr>
<?php } ?>
</table>
</div>
<?php }

if(!$layPayCount) {?> <!-- Do This If No Payments Have Been Made -->
<div class="pays">
    <h1>No Payments Made Yet</h1>
</div>
<?php } else{ ?>
<div class="pays">
Payments:
<table>
    <tr class="tHead"><td>Date</td><td>Transaction</td><td>Type</td><td>Amount</td><td>Employee</td><td>Del</td></tr>
<?php for($i=0; $i<$layPayCount; $i++){ ?>
    <tr>
        <td><?= $layPay[$i]['lp_date'] ?></td>
        <td><?= $layPay[$i]['lp_trans'] ?></td>
        <td><?= $layPay[$i]['lp_payType'] ?></td>
        <td class="money"><?= number_format($layPay[$i]['lp_amount'],2) ?></td>
        <td><?= $layPay[$i]['lp_employee'] ?></td>
        <td style="text-align: center; font-weight: Bold;" width="20">
            <a href="processDelLayPay.php?lp_ID=<?= $layPay[$i]['lp_ID'] ?>&layaway_ID=<?= $layaway_ID ?>">-</a>
        </td>
    </tr>
<?php } ?>
</table>
</div>
<?php } ?>
<!-- ======================= This Part Adds Layaway Items ======================= -->
<div id="addLayItem" >
    <br />
    <form action="processAddLayItem.php" method="post">
    <table>
        <tr><td>Dept</td><td>Description</td><td>Qty</td><td>Price</td></tr>
        <tr>
            <td><input id="laydep" size="2" name="dept_ID" /><input type="hidden" name="layaway_ID" value="<?= $layaway_ID ?>" /></td>
            <td><input id="laydesc" name="li_desc" /></td>
            <td><input id="layqty" name="li_qty" /></td>
            <td><input id="layprice" name="li_price" /></td>
        </tr>
        <tr><td colspan="4"><input style="width: 150px" type="submit" name="" value="Add Item" /></td></tr>
    </table>
    </form>
</div>

<div id="addLayPay" >
    <br />
    <form action="processAddLayPay.php" method="post">
    <table>
        <tr><td>Date</td><td>Trans#</td><td>Pay Type</td><td>Amount</td><td>Employee</td></tr>
        <tr>
            <td><input id="pay_date" title="YYYY/MM/DD" name="date" value="<?= $date ?>" /></td>
            <td><input id="paytrans" name="lp_trans" /><input type="hidden" name="layaway_ID" value="<?= $layaway_ID ?>" /></td>
            <td>
                <select id="pay_type" name="payType" size="1">
                    <option  selected="selected" value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Check">Check</option>
                    <option value="Gift Card">Gift Card</option>
                    <option value="Other">Other</option>
                </select>
            </td>
            <td><input id="pay_amount" onkeyup="ringIn()" onblur="ringIn()" name="lp_amount" /></td>
            <td><input id="pay_employee" name="lp_employee" /></td>
        </tr>
        <tr><td colspan="4"><input style="width: 150px" type="submit" name="" value="Add Payment" /> <h3 id="ring" >0.00</h3></td></tr>
    </table>
    </form>
</div>
<?php if($alert == 1) echo "<div id=\"alert\" >Please Fill All Fileds</div>" ?>
<?php if($layItemCount > 0 && $totalLay < 0.01){ ?>
<div id="paid"><img alt="Paid In Full" src="design/paid.png" /></div>
<?php } ?>
<div id="receipt">
    <table>
        <tr><td>Merch Total&nbsp;&nbsp;&nbsp;</td><td class="money"><?= $preTax ?></td></tr>
        <tr><td>Tax 1</td><td class="money"><?= $tax1 ?></td></tr>
        <tr><td>Tax 2</td><td class="money"><?= $tax2 ?></td></tr>
        <tr style="font-weight: bold; border-top: solid thin #CCFFFF"><td>Total</td><td class="money"><?= $grandTot ?></td></tr>
    </table>
</div>
</body>
</html>