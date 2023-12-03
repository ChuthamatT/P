<?php
include "config.ini.php";
$curdate=getcurdate();

$sql=" update borrow set rtn_date='$curdate',status=2 where id=$_GET[bid] ";
$result=mysqli_query($con,$sql) or die('Update Error');

mws_message('บันทึกการคืนเรียบร้อย','return.php');
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