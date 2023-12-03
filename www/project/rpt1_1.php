<?php
include "config.ini.php";
$where=""; $mess="";
if (isset($_POST["stdate"])!="") {
	$stdate=toexdate($_POST["stdate"]);
	$endate=toexdate($_POST["endate"]);
	$where=" where insdate>='$stdate' and insdate<='$endate' ";
	$mess=" ตั้งแต่วันที่ : $_POST[stdate] &nbsp;&nbsp;ถึงวันที่ : $_POST[endate] ";
}

$sql=" select * from buy  ";
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
        <td class="h_1">รายการการจัดซื้อพัสดุ</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="h_2"><?php echo $mess; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <?php if (mysqli_num_rows($result) > 0) {  ?>
      <table width="900" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr class="h_table">
          <td width="116" height="25">ลำดับ</td>
          <td width="246">ปส.ที่</td>  
          <td width="329">วันที่</td>
          <td width="199">สถานะ</td>
        </tr>
        <?php
			  	for ($i=1;$i<=mysqli_num_rows($result);$i++) { 
					$rs=mysqli_fetch_array($result);
              ?>
        <tr>
          <td><div align="center"><?php echo $i; ?></div></td>
          <td><div align="center"><?php echo $rs["no"]; ?></div></td>
          <td><div align="center"><?php echo $rs["dd"]."/".$rs["mm"]."/".$rs["yy"]; ?></div></td>
          <td><div align="center">
            <?php if ($rs["status"]==1) { echo "รอการอนุมัติ"; } else if ($rs["status"]==2) { echo "อนุมัติแล้ว"; } else if ($rs["status"]==3) { echo "ไม่อนุมัติ"; } else if ($rs["status"]==4) { echo "ตรวจรับแล้ว"; } ?>
          </div></td>
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
    </td>
  </tr>
</table>
</body>
</html>