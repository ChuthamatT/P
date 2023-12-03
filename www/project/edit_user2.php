<?php
include "config.ini.php";
$password="";
if (isset($_POST["password"])!="") {
	$password=" ,password='$_POST[password]' ";
}

$sql=" update user_info set  type=$_POST[type],fname='$_POST[fname]',lname='$_POST[lname]',position='$_POST[position]' ";
$sql.=" ,username='$_POST[username]' $password where id=$_POST[id_edit] ";
$result=mysqli_query($con,$sql) or die('Update Error');

echo "<script language='javascript'>";
echo " alert('แก้ไขข้อมูลเรียบร้อย'); ";
echo " parent.$.fancybox.close(); ";
echo "</script>";
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