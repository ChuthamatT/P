<?php
include "config.ini.php";
 
 

$sql=" update member set  mb_identity=$_POST[mb_identity],mb_fname='$_POST[fname]',mb_lname='$_POST[lname]'";
$sql.=" ,mb_teacher='$_POST[mb_teacher]'  where mb_id=$_POST[id_edit] ";
$result=mysqli_query($con,$sql) or die('Update Error');
/*
echo "<script language='javascript'>";
echo " alert('แก้ไขข้อมูลเรียบร้อย'); ";
echo " parent.$.fancybox.close(); ";
echo "</script>";
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center"><font size="+1">แก้ไขข้อมูลเรียบร้อย</font><br /><br /><a href="#" onclick="javaascript:parent.$.fancybox.close();">ตกลง</a></div>
</body>
</html>