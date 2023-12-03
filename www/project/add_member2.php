<?php
include "config.ini.php";
include "cke_date_func.php";
$curdate=getcurdate();
$status="1";
$sql2=" select * from member where mb_identity='$_POST[mb_identity]' ";
$result2=mysqli_query($con,$sql2);

if (mysqli_num_rows($result2) > 0) {
	echo "<script language='javascript'>";
	echo " alert('รหัสนักศึกษา ซ้ำ'); ";
	echo " parent.$.fancybox.close();";
	echo "</script>";
} else {
	$sql=" insert into member value(null,'$_POST[mb_identity]','$_POST[mb_title_name]','$_POST[fname]','$_POST[lname]','$_POST[mb_teacher]','$status','$curdate') ";
	$result=mysqli_query($con,$sql) or die('Insert Error');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center"><font size="+1">บันทึกข้อมูลเรียบร้อย</font><br /><br /><a href="#" onclick="javaascript:parent.$.fancybox.close();">ตกลง</a></div>
</body>
</html>