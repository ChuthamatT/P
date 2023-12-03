<?php
include "config.ini.php";
include "cke_date_func.php";

$sql=" select * from member where mb_id=$_GET[id_edit] ";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);

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
	
	if (document.getElementById("mb_identity").value=="") {
		Rtn=false;	
		mess+=" - รหัสนักศึกษา \r  ";
	}	
	
	if (document.getElementById("mb_title_name").value=="0") {
		Rtn=false;	
		mess+=" - คำนำหน้าชื่อ \r  ";
	}
	if (document.getElementById("fname").value=="" || document.getElementById("lname").value=="") {
		Rtn=false;	
		mess+=" - ชื่อ - นามสกุล \r  ";
	}
	if (document.getElementById("mb_teacher").value=="") {
		Rtn=false;	
		mess+=" - อาจารย์ที่ปรึกษา \r  ";
	}
 
 
	return Rtn;	
}
</script>
</head>

<body>
<table width="400" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="edit_member2.php" onsubmit="return chk_form()">
      <fieldset>
        <legend>ลงทะเบียนสมาชิกใหม่</legend>
        <table width="400" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
            <td><div align="right">รหัสนักศึกษา : </div></td>
            <td><input name="mb_identity" type="text" id="mb_identity" size="30" value="<?php echo $rs["mb_identity"]; ?>" /></td>
          </tr>
          <tr>
            <td><div align="right">คำนำหน้าชื่อ : </div></td>
            <td>
			
		<select  name="mb_title_name" id="mb_title_name">
						<option value="0" selected="selected">---- เลือกข้อมูล ----</option>
						<?PHP
											// จัดเก็บข้อมูลเดือนในรูปแบบ array 
											$Array_sex = array("นาย", "นางสาว");
											for($i=0; $i < count($Array_sex); $i++){
											
													$sex = $Array_sex[$i];
												
												if($rs['mb_title_name']==$sex){
														echo "<option value=".$sex." selected='selected'>".$sex."</option>";
													}else{
														echo "<option value=".$sex.">".$sex."</option>";
													}
											}
									   ?>
					</select> </td>
          </tr>
          <tr>
            <td><div align="right">ชื่อ : </div></td>
            <td><input name="fname" type="text" id="fname" size="30" value="<?php echo $rs["mb_fname"]; ?>" /></td>
          </tr>
          <tr>
            <td><div align="right">นามสกุล : </div></td>
            <td><input name="lname" type="text" id="lname" size="30" value="<?php echo $rs["mb_lname"]; ?>" /></td>
          </tr>
          <tr>
            <td><div align="right">อาจารย์ที่ปรึกษา : </div></td>
            <td><input name="mb_teacher" type="text" id="mb_teacher" size="30" value="<?php echo $rs["mb_teacher"]; ?>" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><div align="center">
			<input type="hidden" name="id_edit" id="id_edit" value="<?php echo $rs["mb_id"]; ?>" />
			<input type="submit" name="button" id="button" value="บันทึก" />
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