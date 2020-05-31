<?php
$order = $_POST['order'];

header("Location: ../dashboard/purchasing/orders/repViewOrder.php?order_ID=$order");
die;

?>