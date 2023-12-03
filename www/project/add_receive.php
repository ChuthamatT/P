<?php
include "config.ini.php";
include "cke_date_func.php";
$curdate=toexdate(getcurdate());

$sql=" select * from buy where id=$_GET[bid] ";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>&nbsp;</title>
<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.21.custom.css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
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
$(function() {
	$("#insdate").datepicker({
		dateFormat: 'dd-mm-yy',
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],    
		monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		changeMonth: true,   
		changeYear: true ,
		yearRange: 'c-20:c+0'
	});
});
function chk_form() {
	var Rtn=true;
	
	if (document.getElementById("insdate").value==""  || document.getElementById("send").value=="" || document.getElementById("doc").value=="" || document.getElementById("section").value=="") {
		Rtn=false;
		alert('กรุณากรอกข้อมูลให้ครบ');
	}
	return Rtn;	
}
</script>
</head>

<body>
<table width="500" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="add_receive2.php" onsubmit="return chk_form();">
      <fieldset>
        <legend>แบบฟอร์มตรวจรับพัสดุ คุรุภัณฑ์</legend>
        <table width="500" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="right">เลข ปส. </div></td>
            <td>02101008 / <?php echo $rs["no"]; ?></td>
          </tr>
          <tr>
            <td><div align="right">วันที่ตรวจรับ : </div></td>
            <td><input name="insdate" type="text" id="insdate" size="9" value="<?php echo $curdate; ?>" /></td>
          </tr>
          <tr>
            <td><div align="right">เรียน : </div></td>
            <td><input name="send" type="text" id="send" size="30" value="<?php echo $rs["send"]; ?>" /></td>
          </tr>
          <tr>
            <td><div align="right"> เอกสารที่แนบมาด้วย : </div></td>
            <td><textarea name="doc" id="doc" cols="30" rows="5"></textarea></td>
          </tr>
          <tr>
            <td><div align="right">ด้วย ฝ่าย : </div></td>
            <td><input name="section" type="text" id="section" size="30" value="<?php echo $rs["section"]; ?>" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;
            <input type="hidden" name="bid" id="bid" value="<?php echo $rs["id"]; ?>" />
            </td>
          </tr>
          <tr>
            <td colspan="2"><div align="center"><input type="submit" name="button" id="button" value="บันทึกข้อมูล" />
              &nbsp;
              <input type="button" name="button2" id="button2" value="ยกเลิก" onclick="javaascript:parent.$.fancybox.close();" />
            </div></td>
          </tr>
          </table>
      </fieldset>
    </form></td>
  </tr>
</table>
</body>
</html>