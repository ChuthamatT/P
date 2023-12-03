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

$sql=" select * from user_info  ";
$result=mysqli_query($con,$sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลผู้ใช้งาน</title>
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
function del_user(val1) {
	if (confirm("คุณแน่ใจหรือว่าต้องการลบผู้ใช้งานนี้ ?")==true) {
		top.window.location='del_user.php?id_del='+val1;	
	}
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
              <td width="720">&nbsp;</td>
              <td width="145"><div align="center"><a href="add_user.php" id="add1" class="various iframe"><img src="images/icon/1352332838_001_01.png" width="24" height="24" border="0" /></a></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="center"><a href="add_user.php" id="add1" class="various iframe">เพิ่มผู้ใช้งาน</a></div></td>
            </tr>
          </table>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><font size="+1">ข้อมูลผู้ใช้งาน</font></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php if (mysqli_num_rows($result) > 0) {  ?>
            <table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr class="h_table">
                <td width="52" height="30">ลำดับ</td>
                <td width="133">ประเภทผู้ใช้งาน</td>
                <td width="206">ชื่อ - นามสกุล</td>
                <td width="159">ตำแหน่ง</td>
                <td width="118">Username</td>
                <td width="57">แก้ไข</td>
                <td width="59">ลบ</td>
              </tr>
              <?php
			  	for ($i=1;$i<=mysqli_num_rows($result);$i++) {
					$rs=mysqli_fetch_array($result);
					
					$sql2=" select * from user_type where id=$rs[type] ";
					$result2=mysqli_query($con,$sql2);
					$rs2=mysqli_fetch_array($result2);
              ?>
              <tr>
                <td><div align="center"><?php echo $i; ?></div></td>
                <td><div align="center"><?php echo $rs2["name"]; ?></div></td>
                <td>&nbsp;<?php echo $rs["fname"]."&nbsp;&nbsp;".$rs["lname"]; ?></td>
                <td><div align="center"><?php echo $rs["position"]; ?></div></td>
                <td><div align="center"><?php echo $rs["username"]; ?></div></td>
                <td>
				<div align="center">
				
				<a href="edit_user.php?id_edit=<?php echo $rs["id"]; ?>" id="edit<?php echo $i; ?>" class="various iframe">
				<img src="images/icon/1352332831_001_39.png" width="24" height="24" border="0" /></a>
				
				</div>
				
				</td>
                <td><div align="center"><a href="#" onclick="del_user('<?php echo $rs["id"]; ?>')"><img src="images/icon/1352332857_001_05.gif" width="24" height="24" border="0" /></a></div></td>
              </tr>
              <?php } ?>
            </table>
            <?php } else { ?>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><font size="+1">ไม่พบข้อมูล</font></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php } ?>
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