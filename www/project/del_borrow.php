<?php
include "config.ini.php";

$sql=" delete from borrow where b_id=$_GET[id_del] ";
$result=mysqli_query($con,$sql) or die('Delete Error');

$sql2=" delete from borrow_detail where brw_id=$_GET[id_del] ";
$result2=mysqli_query($con,$sql2) or die('Delete Error2');
$lnkp = $_GET['stt_p'];
mws_goto("borrow.php?stt_p=$lnkp");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>