<?php
session_start();
include "config.ini.php";
if (isset($_SESSION["sess_id"])!="") {
	$uid=$_SESSION["sess_userid"];
	$uname=$_SESSION["sess_name"];
	$utype=$_SESSION["sess_type"];
} else {
	mws_message('กรุณาเข้าสู่ระบบก่อน','index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบยืม - คืน อุปกรณ์กีฬา</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.21.custom.css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script language="javascript">
$(function() {
	$("#stdate").datepicker({
		dateFormat: 'dd-mm-yy',
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],    
		monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		changeMonth: true,   
		changeYear: true ,
		yearRange: 'c-20:c+0'
	});
	$("#endate").datepicker({
		dateFormat: 'dd-mm-yy',
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],    
		monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
		changeMonth: true,   
		changeYear: true ,
		yearRange: 'c-20:c+0'
	});
});
function del_sup(val1) {
	if (confirm("คุณแน่ใจหรือว่าต้องการลบประเภทอุปกรณ์นี้ ?")==true) {
		top.window.location='del_suptype.php?id_del='+val1;	
	}
}
function chk_form() {
	var Rtn=true;
	
	if (document.getElementById("stdate").value=="" || document.getElementById("endate").value=="") {
		alert('กรุณาใส่วันที่ให้ครบ');	
	}
	return Rtn;
}
</script>
</head>

<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td>
    <div id="container">
      <table width="940" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td style="background:url(images/watermask.png)" height="170"><?php include "inc_head.php"; ?></td>
        </tr>
        <tr>
          <td>
          <div id="menu">
				<?php include "menu.php"; ?>
           </div>
          </td>
        </tr>
        <tr>
          <td><table width="920" border="0" align="center" cellpadding="0" cellspacing="2">
            <tr>
              <td width="47">&nbsp;</td>
              <td width="697">รายงานการตรวจรับอุปกรณ์</td>
              <td width="168">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td><form id="form1" name="form1" method="post" action="rpt2_2.php" target="_new" onsubmit="return chk_form()">
                  <fieldset>
                    <legend>เงื่อนไขในการทำรายงาน</legend>
                    <table width="400" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><div align="right">ตั้งแต่วันที่ : </div></td>
                        <td><input name="stdate" type="text" id="stdate" size="9" /></td>
                        <td><div align="right">ถึงวันที่ : </div></td>
                        <td><input name="endate" type="text" id="endate" size="9" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="4"><div align="center"><input type="submit" name="button" id="button" value="สร้างรายงาน" /></div></td>
                        </tr>
                    </table>
                  </fieldset>
                </form></td>
              </tr>
            </table>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td style="background:url(images/menu_bar.png); color:#FFF; font-size:12px;" height="33"><div align="center"><?php echo $sys_foolter; ?></div></td>
        </tr>
      </table>
	</div>
    </td>
  </tr>
</table>
</body>
</html>