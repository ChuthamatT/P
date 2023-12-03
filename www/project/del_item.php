<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "config.ini.php";

$sql=" delete from buy_detail where id=$_GET[id_del] ";
$result=mysqli_query($con,$sql) or die('Delete Error');

echo " <script language='javascript'> ";
echo " parent.frame1.location='item.php?bid=$_GET[bid]'; ";
echo "</script>";
?>