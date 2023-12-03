<?php
include "config.ini.php";
include "cke_date_func.php";
$insdate=toexdate($_POST["insdate"]);

//บันทึกข้อมูลตรวจรับ
$sql=" select * from buy where id=$_POST[bid] ";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);

$sql2=" insert into receive value(null,$rs[no],$rs[id],'$rs[insdate]','$_POST[send]','$_POST[doc]','$_POST[section]','$insdate') ";
$result2=mysqli_query($con,$sql2) or die('Insert Error');

$sql2=" select max(id) as mid from receive ";
$result2=mysqli_query($con,$sql2);
$rs2=mysqli_fetch_array($result2);
//อัพเดทสถานะการสั่งซื้อ
$sql3=" update buy set status=4 where id=$rs[id] ";
$result3=mysqli_query($con,$sql3) or die('Update Error');
//บันทึกข้อมูลรับพัสดุ
$sql4=" select * from buy_detail where bid=$rs[id] ";
$result4=mysqli_query($con,$sql4);
for ($i=1;$i<=mysqli_num_rows($result4);$i++) {
	$rs4=mysqli_fetch_array($result4);	
	$sql5=" insert into rec_detail value(null,$rs2[mid],$rs4[pid],'$rs4[quantity]') ";
	$result5=mysqli_query($con,$sql5) or die('Insert Error2');
	//อัพเดทสต๊อกพัสดุ
	$sql6=" select * from procurment where id=$rs4[pid] ";
	$result6=mysqli_query($con,$sql6);	
	$rs6=mysqli_fetch_array($result6);
	$stock=$rs6["stock"] + $rs4["quantity"];
	
	$sql7=" update procurment set stock='$stock' where id=$rs4[pid] ";
	$result7=mysqli_query($con,$sql7) or die('Update Error2');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>&nbsp;</title>
</head>

<body>
<div align="center"><strong>บันทึกข้อมูลเรียบร้อย</strong><br /><br /><a href="#" onclick="javaascript:parent.$.fancybox.close();">ตกลง</a></div>
</body>
</html>