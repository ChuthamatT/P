<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
body {
	margin:0px;
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
}
</style>
<script language="javascript">
function chk_form() {
	var Rtn=true;
	
	if (document.getElementById("name").value=="") {
		Rtn=false;
		alert('กรุณาใส่ชื่อประเภทอุปกรณ์');
	}
	return Rtn;	
}
</script>
</head>

<body>
<table width="450" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="add_suptype2.php" onsubmit="return chk_form()">
      <fieldset>
        <legend>เพิ่มประเภทอุปกรณ์</legend>
        <table width="450" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="right">ชื่อประเภทอุปกรณ์ : </div></td>
            <td><input name="name" type="text" id="name" size="30" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><div align="center"><input type="submit" name="button" id="button" value="บันทึก" />
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