<?php
include "config.ini.php";
include "cke_date_func.php";
$get_qty="quantity"; $get_pid="pid";

if (isset($_POST["bid"])!="") { 
	if ($_POST["bid"]!="") { 
		$mid=$_POST["bid"];		
	} else {
		$sql2=" select max(id) as mid from borrow ";
		$result2=mysqli_query($con,$sql2);
		$rs2=mysqli_fetch_array($result2);
		if ($rs2["mid"] > 0) { $mid=$rs2["mid"]+1; } else { $mid=1; }	
	}
}



$sql=" select * from procurment ";
$result=mysqli_query($con,$sql);
for ($i=1;$i<=mysqli_num_rows($result);$i++) {
	$qty=0; $pid=0;
	
	$qty=$_POST[$get_qty.$i];
	$pid=$_POST[$get_pid.$i];
	if ($qty!="") { 
		$sql3=" insert into borrow_detail value(null,$mid,$pid,'$qty',1) ";
		$result3=mysqli_query($con,$sql3) or die('Insert Error');
	}
}
echo "<script language='javascript'>";
echo " parent.$.fancybox.close(); ";
echo "</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>&nbsp;</title>
</head>

<body>

</body>
</html>