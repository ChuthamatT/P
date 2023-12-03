<?php
include "config.ini.php";
include "cke_date_func.php";
//ตรวจสอบไฟล์ภาพ
if ($_FILES["fileupload"]["tmp_name"]!="") {
	$sql2=" select max(id) as mid from procurment ";
	$result2=mysqli_query($con,$sql2);
	$rs2=mysqli_fetch_array($result2);
	if ($rs2["mid"] > 0) { $mid=$rs2["mid"]+1; } else { $mid=1; }
	
	$fname=explode(".",$_FILES["fileupload"]["name"]);
	$photoname=$mid.".".$fname[1];
 	move_uploaded_file($_FILES["fileupload"]["tmp_name"],"images/procurment/".$photoname);
}

$sql=" select MAX(id) AS id2 from procurment";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);
//echo $rs['id2'];
$sql2=" select * from sup_type where id=$_POST[type] ";
					$result2=mysqli_query($con,$sql2);
					$rs2=mysqli_fetch_array($result2);

$no=$rs2['id']."0".$rs['id2'];
//echo $no;
//exit();
$sql=" insert into procurment value(null,'$no',$_POST[type],'$_POST[name]','$_POST[detail]','$_POST[stock]','$_POST[price]','$photoname') ";
$reuslt=mysqli_query($con,$sql) or die('Insert Error');
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
<div align="center"><font size="+2">บันทึกข้อมูลเรียบร้อย</font><br /><br /><a href="#" onclick="javaascript:parent.$.fancybox.close();">ตกลง</a></div>
</body>
</html>