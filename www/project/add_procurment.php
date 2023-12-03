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
<script type="text/javascript">
function chk_form() {
	var Rtn=true;
	var mess="กรุณากรอกข้อมูล";
	
 
	if (document.getElementById("type").value=="") {
		Rtn=false;
		mess+=" - ประเภท<?=$Title?> \r  ";	
	}
	if (document.getElementById("name").value=="") {
		Rtn=false;
		mess+=" - ชื่อ<?=$Title?>  \r  ";	
	}
	if (document.getElementById("detail").value=="") {
		Rtn=false;
		mess+=" - รายละเอียด<?=$Title?>  \r  ";	
	}
	if (document.getElementById("stock").value=="") {
		Rtn=false;
		mess+=" - จำนวน<?=$Title?> \r  ";	
	}
	if (document.getElementById("price").value=="") {
		Rtn=false;
		mess+=" - ราคา<?=$Title?> \r  ";	
	}
	if (document.getElementById("fileupload").value=="") {
		Rtn=false;
		mess+=" - ภาพ<?=$Title?> ";	
	}
	if (Rtn==false) {
		alert(mess);
	}
	return Rtn;	
}
</script>
</head>

<body>
<table width="500" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><form action="add_procurment2.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk_form();">
      <fieldset>
        <legend>เพิ่มรายการอุปกรณ์<?=$Title?></legend>
        <table width="500" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="right">ประเภทกีฬา : </div></td>
            <td><select name="type" id="type">
            <option value="0">---- เลือก ----</option>
            <?php
				$sql2=" select * from sup_type  ";
				$result2=mysqli_query($con,$sql2);
				for ($i=1;$i<=mysqli_num_rows($result2);$i++) {
					$rs2=mysqli_fetch_array($result2);	
					echo "<option value='$rs2[id]'>$rs2[name]</option>";
				}
            ?>
            </select></td>
          </tr>
          <tr>
            <td><div align="right">ชื่อ<?=$Title?> : </div></td>
            <td><input name="name" type="text" id="name" size="40" /></td>
          </tr>
          <tr>
            <td><div align="right">รายละเอียด : </div></td>
            <td><textarea name="detail" id="detail" cols="35" rows="5"></textarea></td>
          </tr>
          <tr>
            <td><div align="right">จำนวน : </div></td>
            <td><input name="stock" type="text" id="stock" size="5" /> 
              / หน่วย</td>
          </tr>
          <tr>
            <td><div align="right">รูปภาพ : </div></td>
            <td><input type="file" name="fileupload" id="fileupload" /></td>
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