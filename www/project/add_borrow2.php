<?php
include "config.ini.php";
include "cke_date_func.php";
$curdate=getcurdate();
$bdate=toexdate($_POST["bdate"]);

$sql=" insert into borrow  value(null,'$bdate','$_POST[btime]','$_POST[detail]','$_POST[bname]','$_POST[note]',1,'0000-00-00','$curdate') ";
$result=mysqli_query($con,$sql) or die('Insert Error');

$sql2=" select max(id) as mid from borrow ";
$result2=mysqli_query($con,$sql2);
$rs2=mysqli_fetch_array($result2);

$sql3=" update borrow_detail set status=2 where bid=$rs2[mid] ";
$result3=mysqli_query($con,$sql3) or die('Update Error');

mws_message('เพิ่มข้อมูลการยืมเรียบร้อย','borrow.php');
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