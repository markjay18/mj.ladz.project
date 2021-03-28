<?php 
/* date_default_timezone_set("Asia/Manila"); */
$conn = mysql_connect("127.0.0.1","root","adminkey") or die(mysql_error());
mysql_select_db('portfolio', $conn) or die(mysql_error());

ini_set('max_execution_time', 3600);

?>
