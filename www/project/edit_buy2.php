<?php
include "config.ini.php";

$sql=" update buy set no='$_POST[no]',dd=$_POST[dd],mm=$_POST[mm],yy=$_POST[yy],subject='$_POST[subject]',send='$_POST[to]' ";
$sql.=" ,fname='$_POST[fname]',lname='$_POST[lname]',position='$_POST[position]',section='$_POST[section]',want='$_POST[want]' ";
$sql.=" where id=$_POST[id_edit] ";
$result=mysqli_query($con,$sql) or die('Update Error');

mws_message('แก้ไขข้อมูลเรียบร้อย','buy.php');

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