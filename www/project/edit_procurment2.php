<?php
include "config.ini.php";
$photo="";
if ($_FILES["fileupload"]["tmp_name"]!="") {	
	$fname=explode(".",$_FILES["fileupload"]["name"]);
	$photoname=$_POST["id_edit"].".".$fname[1];
	move_uploaded_file($_FILES["fileupload"]["tmp_name"],"images/procurment/".$photoname);
	$photo=" ,photo='$photoname' ";
}

$sql=" update procurment set no='$_POST[no]',type=$_POST[type],name='$_POST[name]',detail='$_POST[detail]' ";
$sql.=" ,stock='$_POST[stock]',price='$_POST[price]'  $photo  where id=$_POST[id_edit] ";
$result=mysqli_query($con,$sql) or die('Edit Error');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>&nbsp;</title>
<style type="text/css">
body {
	margin:0px;
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
}
</style>
</head>

<body>
<div align="center"><font size="+2">แก้ไขข้อมูลเรียบร้อย</font><br /><br /><a href="#" onclick="javaascript:parent.$.fancybox.close();">ตกลง</a></div>
</body>
</html>