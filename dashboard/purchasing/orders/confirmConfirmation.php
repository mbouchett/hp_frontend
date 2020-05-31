<?php
date_default_timezone_set('America/New_York');
$order_ID = $_REQUEST['order_ID'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Order Receipt Confirmation</title>
</head>

<body>
<br /><br />
<h1>Thank You! <br />Homeport Purchase #<?= $order_ID ?> Receipt Confirmed :)</h1>

</body>

</html>