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
$sql=" select * from borrow where id=$_GET[id_edit] ";
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
<link rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.21.custom.css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="source/jquery.fancybox.pack.js"></script>
<script language="javascript">
$(function() {
	$('a[id^="add"]').fancybox({
			'width'				: '50%',
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
	$("#bdate").datepicker({
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
	var mess=" กรุณาใส่ข้อมูล \r ";
	
	if (document.getElementById("bdate").value=="") {
		Rtn=false;
		mess+=" - วันที่ยืม \r  ";	
	}
	if (document.getElementById("btime").value=="") {
		Rtn=false;
		mess+=" - เวลาที่ยืม  \r  ";	
	}
	if (document.getElementById("bname").value=="") {
		Rtn=false;
		mess+=" - ผู้ยืม  \r  ";	
	}
	if (document.getElementById("detail").value=="") {
		Rtn=false;
		mess+=" - ใช้งานในส่วน \r  ";	
	}
	if (document.getElementById("note").value=="") {
		Rtn=false;
		mess+=" - หมายเหตุ \r  ";	
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
              <td width="168">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
            <form id="form1" name="form1" method="post" action="edit_borrow2.php" onsubmit="return chk_form()">
              <table width="620" border="0" align="center" cellpadding="0" cellspacing="2">
                <tr>
                  <td><fieldset>
                    <legend>ข้อมูลการยืม</legend>
                    <table width="620" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td width="188">&nbsp;</td>
                        <td width="426">&nbsp;</td>
                      </tr>
                      <tr>
                        <td><div align="right">วันที่ยืม : </div></td>
                        <td><input name="bdate" type="text" id="bdate" size="9" value="<?php echo toexdate($rs["b_date"]); ?>" />
                          เวลาที่ยืม : 
                            <input name="btime" type="text" id="btime" size="9" value="<?php echo $rs["b_time"]; ?>" /></td>
                      </tr>
                      <tr>
                        <td><div align="right">ชื่อผู้ยืม : </div></td>
                        <td><input name="bname" type="text" id="bname" size="40" value="<?php echo $rs["b_name"]; ?>" /></td>
                      </tr>
                      <tr>
                        <td><div align="right">ใช้งานในส่วน : </div></td>
                        <td><textarea name="detail" id="detail" cols="45" rows="5"><?php echo $rs["detail"]; ?></textarea></td>
                      </tr>
                      <tr>
                        <td><div align="right">หมายเหตุ : </div></td>
                        <td><textarea name="note" id="note" cols="45" rows="5"><?php echo $rs["note"]; ?></textarea></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;<input type="hidden" name="id_edit" id="id_edit" value="<?php echo $rs["id"]; ?>" /></td>
                      </tr>
                      <tr>
                        <td><div align="right"><a href="add_bitem.php?bid=<?php echo $rs["id"]; ?>" id="add1" class="various iframe"><img src="images/icon/1352332838_001_01.png" width="24" height="24" border="0" /></a></div></td>
                        <td><a href="add_bitem.php?bid=<?php echo $rs["id"]; ?>" id="add2" class="various iframe">เพิ่มรายการยืม</a></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><iframe name="frame1" id="frame1" src="bitem.php?bid=<?php echo $rs["id"]; ?>" width="600" height="200" frameborder="0"></iframe></td>
                        </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><div align="center"><input type="submit" name="button" id="button" value="แก้ไขการยืม" /></div></td>
                        </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  </fieldset></td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </form></td>
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