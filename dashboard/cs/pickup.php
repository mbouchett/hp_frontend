<?php
//pickup.php 2018/01
// Schedule pickup
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

$pu_ID = $_POST['pu_ID'];
if(!$pu_ID) $pu_ID = $_REQUEST['pu_ID'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `pickups` WHERE `pu_ID` = '".$pu_ID."'";
$result = mysqli_query($db, $sql); // create the query object
$pickup=mysqli_fetch_assoc($result);
mysqli_close($db);

?>
<!DOCTYPE HTML>

<html>

<head>
  <title>PickUp</title>
  <style type="text/css">
    table {
      width: 90%;
      font-size: xx-large;
    }
    input {
      width: 80%;
      font-size: x-large;
    }
    td {
      border: solid #484848 thin;
    }

  </style>
</head>

<body>
    <table>
        <tr>
            <td>When</td><td><?= $pickup['pu_when'] ?></td>
        </tr>
        <tr>
            <td>Type</td><td><?= $pickup['pu_location'] ?></td>
        </tr>
        <tr>
            <td>Customer</td><td><?= $pickup['pu_cust_name'] ?></td>
        </tr>
        <tr>
            <td>Company</td><td><?= $pickup['pu_vendor_name'] ?></td>
        </tr>
        <tr>
            <td>SKU</td><td><?= $pickup['pu_sku'] ?></td>
        </tr>
        <tr>
            <?php if(substr($pickup['pu_desc'],0,8) == "display:"){ ?>
            <td>Description</td><td><img src="../warehouse/display/images/<?= substr($pickup['pu_desc'],9) ?>" alt="<?= $pickup['pu_desc'] ?>" /></td>
            <?php }else { ?>
            <td>Description</td><td><?= $pickup['pu_desc'] ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td>Message</td><td><?= $pickup['pu_message'] ?></td>
        </tr>
        <tr>
            <?php if($pickup['pu_confirmed'] == 0){ ?>
            <td colspan="2"><input onclick="parent.location='ackPickup.php?pu_ID=<?= $pickup['pu_ID'] ?>'" name="confirm" type="button" value="Acknowledge"></td>
            <?php }else{ ?>
            <td colspan="2">CONFIRMED</td>
            <?php } ?>
        </tr>
    </table>
</body>

</html>