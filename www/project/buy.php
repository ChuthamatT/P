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
$where="";
if (isset($_GET["stdate"])!="") {
	$stdate=toexdate($_GET["stdate"]);
	$endate=toexdate($_GET["endate"]);
	$where=" where insdate>='$stdate' and insdate<='$endate' ";
}
$sql=" select * from buy $where order by id desc ";
$result=mysqli_query($con,$sql);
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
function del_buy(val1) {
	if (confirm("คุณแน่ใจหรือว่าต้องการลบใบขอสั่งซื้อนี้ ?")==true) {
		top.window.location='del_buy.php?id_del='+val1;	
	}
}
function find_buy() {
	if (document.getElementById("stdate").value=="" || document.getElementById("endate").value=="") {
		alert('กรุณาใส่วันที่ให้ครบ');
	} else {
		top.window.location='buy.php?stdate='+document.getElementById("stdate").value+'&endate='+document.getElementById("endate").value;	
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
              <td width="740">&nbsp;</td>
              <td width="125"><div align="center"><a href="add_buy.php"><img src="images/icon/1352332838_001_01.png" width="24" height="24" border="0" /></a></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>ตั้งแต่วันที่ : 
                <input name="stdate" type="text" id="stdate" size="9" /> 
                ถึงวันที่ : 
                <input name="endate" type="text" id="endate" size="9" />  
                <input type="button" name="button" id="button" value="ค้นหา" onclick="find_buy()" /></td>
              <td><div align="center"><a href="add_buy.php">เพิ่มใบสั่งซื้อ</a></div></td>
            </tr>
          </table>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><font size="+1">รายการใบสั่งซื้อ</font></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php if (mysqli_num_rows($result) > 0) {  ?>
            <table width="900" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr class="h_table">
                <td width="69" height="25">ลำดับ</td>
                <td width="134">ปส.ที่</td>
                <td width="128">วันที่</td>
                <td width="221">ใบขอจัดซื้อ</td>
                <td width="200">สถานะ</td>
                <td width="67">แก้ไข</td>
                <td width="65">ลบ</td>
              </tr>
              <?php
			  	for ($i=1;$i<=mysqli_num_rows($result);$i++) { 
					$rs=mysqli_fetch_array($result);
              ?>
              <tr>
                <td><div align="center"><?php echo $i; ?></div></td>
                <td><div align="center"><?php echo $rs["no"]; ?></div></td>
                <td><div align="center"><?php echo $rs["dd"]."/".$rs["mm"]."/".$rs["yy"]; ?></div></td>
                <td><div align="center"><a href="buy_report.php?bid=<?php echo $rs["id"]; ?>" target="_new"><img src="images/icon/1352332827_001_38.gif" width="24" height="24" border="0" /></a></div></td>
                <td><div align="center"><?php if ($rs["status"]==1) { echo "รอการอนุมัติ"; } else if ($rs["status"]==2) { echo "อนุมัติแล้ว"; } else if ($rs["status"]==3) { echo "ไม่อนุมัติ"; } else if ($rs["status"]==4) { echo "ตรวจรับแล้ว"; } ?></div></td>
                <td><div align="center"><a href="edit_buy.php?id_edit=<?php echo $rs["id"] ?>"><img src="images/icon/1352332831_001_39.png" width="24" height="24" border="0" /></a></div></td>
                <td><div align="center"><a href="#" onclick="del_buy('<?php echo $rs["id"]; ?>')"><img src="images/icon/1352332857_001_05.gif" width="24" height="24" border="0" /></a></div></td>
              </tr>
              <?php } ?>
            </table>
            <?php } else { ?>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><font size="+2">ไม่พบข้อมูล</font></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php } ?>
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