<?php
setcookie("c_name", '', time() - 3600, "/"); // 86400 = 1 day
setcookie("c_ID", '', time() - 3600, "/"); // 86400 = 1 day
header('Location: ../');
die;
?>