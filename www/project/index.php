<?php include "config.ini.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบยืม - คืนอุปกรณ์กีฬา</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script language="javascript">
function chk_login() {
	var Rtn=true;
	
	if (document.getElementById("user").value=="" || document.getElementById("pass").value=="") { 
		Rtn=false;
		alert('กรุณาใส่ข้อมูลให้ครบ');
	}
	return Rtn;	
}
</script>
</head>

<body>
<p>&nbsp;</p>
<table width="632" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td>
    <div id="container">
      <table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
        <tr>
          <td><div align="center">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><font size="+4" color="#33CCFF">ระบบยืม - คืนอุปกรณ์กีฬา</font><br />
              <br />
              <font size="+1" color="#33CCFF"><?=$text_title?></font> <br />
              <br />
              <img src="images/logo.png" width="150" height="150" /></p>
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="300" border="0" align="center" cellpadding="0" cellspacing="2">
            <tr>
              <td><div class="box">
                <div class="box-heading">- เข้าสู่ระบบงาน<?=$Title?>-</div>
                <div class="box-content">
                  <div class="box-category">
                    <form id="form1" name="form1" method="post" action="chk_login.php" onsubmit="return chk_login()">
                      <table width="270" border="0" align="center" cellpadding="0" cellspacing="2">
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td><input type="text" name="user" id="user" style="background:#FFC; color:#999;" onchange="javascript:document.getElementById('pass').focus();"  /></td>
                          <td rowspan="2"><a href="#" onclick="javascript:window.form1.submit();"><img src="images/login_04.jpg" width="74" height="50" border="0" /></a></td>
                        </tr>
                        <tr>
                          <td><input type="password" name="pass" id="pass" style="background:#FFC; color:#999;" /></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                    </form>
                  </div>
                </div>
              </div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="150" valign="bottom" style="font-size:12px;"><div align="center"><font color="#33CCFF"><?php echo $sys_foolter; ?></font></div></td>
        </tr>
      </table>
    </div>
    </td>
  </tr>
</table>
</body>
</html>