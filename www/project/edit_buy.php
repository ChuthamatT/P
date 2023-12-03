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
$sql=" select * from buy where id=$_GET[id_edit] ";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบยืม - คืน อุปกรณ์กีฬามหาวิทยาลัยธนบุรี</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="source/jquery.fancybox.pack.js"></script>
<script language="javascript">
$(function() {
	$('a[id^="add"]').fancybox({
			'width'				: '72%',
			'height'			: '20%',
			'autoScale'     	: false,
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'type'				: 'iframe',
			'beforeClose'	:	function() {
					//parent.location.reload(true); 
					parent.frame1.location.reload(true); 
				}
	});	
});
function chk_form() {
	var Rtn=true;
	var mess=" กรุณาใส่ข้อมูล \r ";
	
	if (document.getElementById("no").value=="") {
		Rtn=false;
		mess+=" - ปส. ที่ \r  ";	
	}
	if (document.getElementById("dd").value=="" || document.getElementById("mm").value=="0" || document.getElementById("yy").value=="0") {
		Rtn=false;
		mess+=" - วันที่ \r  ";	
	}
	if (document.getElementById("subject").value=="") {
		Rtn=false;
		mess+=" - เรื่อง  \r  ";	
	}
	if (document.getElementById("to").value=="") {
		Rtn=false;
		mess+=" - เรียน  \r  ";	
	}
	if (document.getElementById("fname").value=="" || document.getElementById("").value=="") {
		Rtn=false;
		mess+=" - ชื่อ นามสกุล \r  ";	
	}
	if (document.getElementById("position").value=="") {
		Rtn=false;
		mess+=" - ตำแหน่ง \r  ";	
	}
	if (document.getElementById("section").value=="") {
		Rtn=false;
		mess+=" - ฝ่าย \r  ";	
	}
	if (document.getElementById("want").value=="") {
		Rtn=false;
		mess+=" - มีความประสงค์  ";	
	}
	if (Rtn==false) {
		alert(mess);	
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
              <td width="168"><div align="center"><a href="buy.php">[กลับหน้าใบสั่งซื้อ]</a></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <form id="form1" name="form1" method="post" action="edit_buy2.php" onsubmit="return chk_form()">
            <table width="700" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td>
                  <fieldset>
                    <legend>ข้อมูลใบสั่งซื้อ</legend>
                    <table width="700" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td width="140">&nbsp;</td>
                        <td width="204">&nbsp;</td>
                        <td width="42">&nbsp;</td>
                        <td width="66">&nbsp;</td>
                        <td width="41">&nbsp;</td>
                        <td width="86">&nbsp;</td>
                        <td width="30">&nbsp;</td>
                        <td width="73">&nbsp;</td>
                      </tr>
                      <tr>
                        <td><div align="right">ที่ ปส. 02011008 / </div></td>
                        <td><input type="text" name="no" id="no" value="<?php echo $rs["no"]; ?>" /></td>
                        <td><div align="right">วันที่ </div></td>
                        <td><select name="dd" id="dd">
                        <?php
							echo "<option value='$rs[dd]'>$rs[dd]</option>";
							for ($i=1;$i<=31;$i++) {
								echo "<option value='$i'>$i</option>";
							}
                        ?>
                        </select></td>
                        <td><div align="right">เดือน</div></td>
                        <td><select name="mm" id="mm">
                        <?php
							$sql2=" select * from mm where id=$rs[mm] ";
							$result2=mysqli_query($con,$sql2);
							$rs2=mysqli_fetch_array($result2);	
							echo "<option value='$rs2[id]'>$rs2[name]</option>";
								
							$sql2=" select * from mm where id!=$rs[mm] ";
							$result2=mysqli_query($con,$sql2);
							for ($i=1;$i<=mysqli_num_rows($result2);$i++) {
								$rs2=mysqli_fetch_array($result2);	
								echo "<option value='$rs2[id]'>$rs2[name]</option>";
							}
                        ?>
                        </select></td>
                        <td><div align="right">พ.ศ. </div></td>
                        <td><select name="yy" id="yy">
                        <?php
							echo "<option value='$rs[yy]'>$rs[yy]</option>";	
							$cy=date("Y")+543;
							for ($i=0;$i<=10;$i++) {
								$ny=$cy-$i;
								echo "<option value='$ny'>$ny</option>";	
							}
                        ?>
                        </select></td>
                      </tr>
                    </table>
                    <table width="700" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td width="141"><div align="right">เรื่อง : </div></td>
                        <td width="553"><input name="subject" type="text" id="subject" size="50" value="<?php echo $rs["subject"]; ?>" /></td>
                      </tr>
                      <tr>
                        <td><div align="right">เรียน : </div></td>
                        <td><input name="to" type="text" id="to" size="50" value="<?php echo $rs["send"]; ?>" /></td>
                      </tr>
                      <tr>
                        <td><div align="right">ข้าพเจ้า : </div></td>
                        <td><input type="text" name="fname" id="fname" value="<?php echo $rs["fname"]; ?>" />
                          นามสกุล : 
                            <input type="text" name="lname" id="lname" value="<?php echo $rs["lname"]; ?>" /></td>
                      </tr>
                      <tr>
                        <td><div align="right">ตำแหน่ง : </div></td>
                        <td><input type="text" name="position" id="position" value="<?php echo $rs["position"]; ?>" />
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ฝ่าย :
                          <input type="text" name="section" id="section" value="<?php echo $rs["section"]; ?>" /></td>
                      </tr>
                      <tr>
                        <td><div align="right">มีความประสงค์ : </div></td>
                        <td><textarea name="want" id="want" cols="45" rows="5"><?php echo $rs["want"]; ?></textarea></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;
                        <input type="hidden" name="id_edit" id="id_edit" value="<?php echo $rs["id"]; ?>" />
                        </td>
                      </tr>
                      <tr>
                        <td><div align="right"><a href="add_item.php?bid=<?php echo $rs["id"]; ?>" id="add1" class="various iframe"><img src="images/icon/1352332838_001_01.png" width="24" height="24" border="0" /></a></div></td>
                        <td><a href="add_item.php?bid=<?php echo $rs["id"]; ?>" id="add2" class="various iframe">เพิ่มรายการ</a></td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td><div align="center"><iframe name="frame1" id="frame1" src="item.php?bid=<?php echo $rs["id"]; ?>" width="700" height="200" frameborder="0"></iframe></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><input type="submit" name="button" id="button" value="แก้ไขใบสั่งซื้อ" /></div></td>
              </tr>
            </table>
            <p>&nbsp;</p>
          </form>
            </td>
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