<?php
include "config.ini.php";

$sql=" select * from user_info where id=$_POST[id_edit] and password='$_POST[oldpass]' ";
$result=mysqli_query($con,$sql);

if (mysqli_num_rows($result) > 0) {
	$sql2=" update user_info set password='$_POST[pass1]' where id=$_POST[id_edit] ";
	$result2=mysqli_query($con,$sql2) or die('Update Error');
	
	mws_message('เปลี่ยนรหัสผ่านเรียบร้อย','logout.php');
} else {
	mws_message('รหัสผ่านเก่าผิดพลาด','ch_pass.php');
}

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