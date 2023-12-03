<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "config.ini.php";

$sql=" delete from procurment where id=$_GET[id_del] ";
$result=mysqli_query($con,$sql) or die('Delete Error');

mws_goto('procurment.php');
?>