<?php
include "config.ini.php";
include "cke_date_func.php";
$bid="";
if (isset($_GET["bid"])!="") {
	$bid=$_GET["bid"];
}
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
function chk_num(val1) {
	 if(isNaN(val1)) {
		alert('ช่องนี้กรอกได้เฉพาะตัวเลขเท่านั้นค่ะ');
	}
}
</script>
</head>

<body>
<table width="702" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="add_item2.php">
      <table width="700" border="1" cellspacing="0" cellpadding="0">
        <tr class="h_table">
          <td width="54">ลำดับ</td>
          <td width="91">รหัสอุปกณ์กีฬา</td>
          <td width="227">ชื่อ</td>
          <td width="109">ภาพ</td>
          <td width="91">จำนวน</td>
          <td width="114"><p>ราคา / หน่วย</p></td>
        </tr>
        <?php
			$sql=" select * from procurment  ";
			$result=mysqli_query($con,$sql);
			for ($i=1;$i<=mysqli_num_rows($result);$i++) {
				$rs=mysqli_fetch_array($result);
        ?>
        <tr>
          <td><div align="center"><?php echo $i; ?></div></td>
          <td><div align="center"><?php echo $rs["no"]; ?></div></td>
          <td>&nbsp;<?php echo $rs["name"]; ?></td>
          <td><div align="center"><img src="images/procurment/<?php echo $rs["photo"]; ?>" width="80" height="80" /></div></td>
          <td><div align="center">
          <input name="quantity<?php echo $i; ?>" type="text" id="quantity<?php echo $i; ?>" size="6" onchange="chk_num(this.value)" />
          <input type="hidden" name="pid<?php echo $i; ?>" id="pid<?php echo $i; ?>" value="<?php echo $rs["id"]; ?>" />
          </div></td>
          <td><div align="center"><?php echo number_format($rs["price"],2)." บาท"; ?></div></td>
        </tr>
        <?php } ?>
      </table>
      <table width="700" border="0" align="center" cellpadding="0" cellspacing="2">
        <tr>
          <td width="738">หน้า 1 / 1 </td>
          <td width="156">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><div align="right">รวมทั้งสิ้น : <?php echo mysqli_num_rows($result);  ?> รายการ </div></td>
        </tr>
      </table>
      <input type="hidden" id="bid" name="bid" value="<?php echo $bid; ?>" />
<p>
<div align="center"><input type="submit" name="button" id="button" value="ตกลง" />
  &nbsp;
  <input type="button" name="button2" id="button2" value="ยกเลิก" onclick="javaascript:parent.$.fancybox.close();" />
</div>
      </p>
    </form></td>
  </tr>
</table>
</body>
</html>