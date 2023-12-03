<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "config.ini.php";

$sql=" delete from sup_type where id=$_GET[id_del] ";
$result=mysqli_query($con,$sql) or die('Delete error');

mws_goto('sup_type.php');
?>