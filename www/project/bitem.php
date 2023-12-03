<?php
include "config.ini.php";
if (isset($_GET["bid"])!="") {
	$sql=" select * from borrow_detail where bid=$_GET[bid] ";
} else {
	$sql2=" select max(id) as mid from borrow ";
	$result2=mysqli_query($con,$sql2);
	$rs2=mysqli_fetch_array($result2);
	if ($rs2["mid"]>0) { $mid=$rs2["mid"]+1; } else { $mid=1; }
	
	$sql=" select * from borrow_detail where bid=$mid ";
}
$result=mysqli_query($con,$sql);
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
.h_table {
	text-align:center;
	font-size:14px;
	color:#FFF;
	background:url(images/menu_bar.png);
	font-weight:bold;
}
</style>
<script language="javascript">
function del_b(val1,val2) {
	parent.window.frame1.location='del_bitem.php?id_del='+val1+'&bid='+val2;
}
</script>
</head>

<body>
<?php if (mysqli_num_rows($result) > 0) { ?>
<table width="580" border="1" cellspacing="0" cellpadding="0">
  <tr class="h_table">
    <td width="55" height="25">ลำดับ</td>
    <td width="340">รายการ</td>
    <td width="72">จำนวน</td>
    <td width="51">ลบ</td>
  </tr>
  <?php
  	$sum_total=0;
  	for ($i=1;$i<=mysqli_num_rows($result);$i++) {
		$rs=mysqli_fetch_array($result);
		
		$sql2=" select * from procurment where id=$rs[pid] ";
		$result2=mysqli_query($con,$sql2);
		$rs2=mysqli_fetch_array($result2);
		
		$sum_total+=$rs["quantity"] * $rs2["price"];
  ?>
  <tr>
    <td><div align="center"><?php echo $i; ?></div></td>
    <td>&nbsp;<?php echo $rs2["name"] ?></td>
    <td><div align="center"><?php echo $rs["quantity"]; ?></div></td>
    <td><div align="center"><a href="#" onclick="del_b('<?php echo $rs["id"]; ?>','<?php echo $rs["bid"]; ?>')"><img src="images/icon/1352332857_001_05.gif" width="24" height="24" border="0" /></a></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>รวม&nbsp;</strong> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php } else { ?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center"><font size="+2">ยังไม่ได้เลือกรายการ</font></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php } ?>
</body>
</html>