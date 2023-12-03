<?php
include "config.ini.php";
include "cke_date_func.php";
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
</style>
<script language="javascript">
function chk_form() {
	var Rtn=true;
	var mess=" กรุณากรอกข้อมูล \r  ";
	
	if (document.getElementById("type").value=="0") {
		Rtn=false;	
		mess+=" - ประเภทผู้ใช้งาน \r  ";
	}
	if (document.getElementById("fname").value=="" || document.getElementById("lname").value=="") {
		Rtn=false;	
		mess+=" - ชื่อ - นามสกุล \r  ";
	}
	if (document.getElementById("position").value=="") {
		Rtn=false;	
		mess+=" - ตำแหน่ง \r  ";
	}
	if (document.getElementById("username").value=="") {
		Rtn=false;	
		mess+=" - Username \r  ";
	}
	if (document.getElementById("password").value=="") {
		Rtn=false;	
		mess+=" - Password  ";
	}
	return Rtn;	
}
</script>
</head>

<body>
<table width="400" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="add_user2.php" onsubmit="return chk_form()">
      <fieldset>
        <legend>เพิ่มผู้ใช้งาน</legend>
        <table width="400" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="right">ประเภทผุ้ใช้งาน : </div></td>
            <td><select name="type" id="type" style="width:160px">
            <option value="0">--- เลือก ---</option>
            <?php
				$sql2=" select * from user_type  ";
				$result2=mysqli_query($con,$sql2);
				for ($i=1;$i<=mysqli_num_rows($result2);$i++) {
					$rs2=mysqli_fetch_array($result2);	
					echo "<option value='$rs2[id]'>$rs2[name]</option>";
				}
            ?>
            </select></td>
          </tr>
          <tr>
            <td><div align="right">ชื่อ : </div></td>
            <td><input name="fname" type="text" id="fname" size="30" /></td>
          </tr>
          <tr>
            <td><div align="right">นามสกุล : </div></td>
            <td><input name="lname" type="text" id="lname" size="30" /></td>
          </tr>
          <tr>
            <td><div align="right">ตำแหน่ง : </div></td>
            <td><input name="position" type="text" id="position" size="30" /></td>
          </tr>
          <tr>
            <td><div align="right">Username : </div></td>
            <td><input type="text" name="username" id="username" /></td>
          </tr>
          <tr>
            <td><div align="right">Password : </div></td>
            <td><input type="password" name="password" id="password" /></td>
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