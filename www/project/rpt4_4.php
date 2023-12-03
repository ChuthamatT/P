<?php
include "config.ini.php";

$sql=" select * from user_info ";
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
	font-weight:bold;
	background:#CCC;
}
.h_1 {
	font-size:24px;
	text-align:center;
	font-weight:bold;
}
.h_2 {
	text-align:center;
	font-weight:bold;
	font-size:20px;
}
</style>
</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td><table width="900" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="h_1">รายงานผู้ใช้งานระบบ</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <?php if (mysqli_num_rows($result) > 0) {  ?>
    <table width="880" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr class="h_table">
        <td width="59" height="30">ลำดับ</td>
        <td width="154">ประเภทผู้ใช้งาน</td>
        <td width="233">ชื่อ - นามสกุล</td>
        <td width="173">ตำแหน่ง</td>
        <td width="134">Username</td>
        <td width="113">ใช้งานล่าสุด</td>
        </tr>
      <?php
			  	for ($i=1;$i<=mysqli_num_rows($result);$i++) {
					$rs=mysqli_fetch_array($result);
					
					$sql2=" select * from user_type where id=$rs[type] ";
					$result2=mysqli_query($con,$sql2);
					$rs2=mysqli_fetch_array($result2);
              ?>
      <tr>
        <td><div align="center"><?php echo $i; ?></div></td>
        <td><div align="center"><?php echo $rs2["name"]; ?></div></td>
        <td>&nbsp;<?php echo $rs["fname"]."&nbsp;&nbsp;".$rs["lname"]; ?></td>
        <td><div align="center"><?php echo $rs["position"]; ?></div></td>
        <td><div align="center"><?php echo $rs["username"]; ?></div></td>
        <td><div align="center"><?php echo toexdate($rs["ll_date"]); ?></div></td>
        </tr>
      <?php } ?>
    </table>
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><a href="#" onclick="javascript:window.print();"><img src="images/icon/printer.png" width="24" height="24" border="0" /></a></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <?php } else { ?>
      <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div align="center"><font size="+1">ไม่พบข้อมูล</font></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
    </table>
    <?php } ?>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>