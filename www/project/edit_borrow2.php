<?php
include "config.ini.php";
$bdate=toexdate($_POST["bdate"]);

$sql=" update borrow set b_date='$bdate',b_time='$_POST[btime]',detail='$_POST[detail]',b_name='$_POST[bname]' ";
$sql.=" ,note='$_POST[note]' where id=$_POST[id_edit] ";
$reuslt=mysqli_query($con,$sql) or die('Update Error');

mws_message('แก้ไขข้อมูลเรียบร้อย','borrow.php');
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