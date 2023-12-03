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
<title>เปลี่ยนรหัสผ่าน</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="source/jquery.fancybox.pack.js"></script>
<script language="javascript">
$(function() {
	$('a[id^="add"]').fancybox({
			'width'				: '40%',
			'height'			: '20%',
			'autoScale'     	: false,
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'type'				: 'iframe',
			'beforeClose'	:	function() {
					parent.location.reload(true); 
				}
	});	
	$('a[id^="edit"]').fancybox({
			'width'				: '40%',
			'height'			: '20%',
			'autoScale'     	: false,
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'type'				: 'iframe',
			'beforeClose'	:	function() {
					parent.location.reload(true); 
				}
	});	
});
function del_sup(val1) {
	if (confirm("คุณแน่ใจหรือว่าต้องการลบประเภทอุปกรณ์นี้ ?")==true) {
		top.window.location='del_suptype.php?id_del='+val1;	
	}
}
function chk_form() {
	var Rtn=true;
	
	if (document.getElementById("oldpass").value=="" || document.getElementById("pass1").value=="" || document.getElementById("pass2").value=="") {
		alert('กรุณาหรอกข้อมูลให้ครบ');	
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
              <td width="697">&nbsp;</td>
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
                <td><form id="form1" name="form1" method="post" action="ch_pass2.php" onsubmit="return chk_form()">
                  <fieldset>
                    <legend>เปลี่ยนรหัสผ่าน</legend>
                    <table width="400" border="0" cellpadding="0" cellspacing="2">
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><div align="right">รหัสผ่านเก่า : </div></td>
                        <td><input type="password" name="oldpass" id="oldpass" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><div align="right">รหัสผ่านใหม่ : </div></td>
                        <td><input type="password" name="pass1" id="pass1" /></td>
                      </tr>
                      <tr>
                        <td><div align="right">ยืนยันรหัสผ่านใหม่ : </div></td>
                        <td><input type="password" name="pass2" id="pass2" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;<input type="hidden" name="id_edit" id="id_edit" value="<?php echo $uid; ?>" /></td>
                      </tr>
                      <tr>
                        <td colspan="2"><div align="center"><input type="submit" name="button" id="button" value="เปลี่ยนรหัสผ่าน" /></div></td>
                        </tr>
                    </table>
                  </fieldset>
                </form></td>
              </tr>
            </table>
            <p>&nbsp;</p>
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