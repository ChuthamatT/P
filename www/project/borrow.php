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
 
if (isset($_GET["stdate"])!="") {
 $stdate=toexdate($_GET["stdate"]);
 $endate=toexdate($_GET["endate"]);
 
$sql=" select * from borrow where (date(insdate) BETWEEN '".$stdate."' AND '".$endate."') AND status='".$_GET['stt_p']."' ORDER BY b_id ASC";
	
}else{

$sql=" select * from borrow where status='".$_GET['stt_p']."' ORDER BY b_id ASC ";

}

$result=mysqli_query($con,$sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายการยืม-คืน อุปกรณ์กีฬา</title>
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
function del_b(val1) {
	if (confirm("คุณแน่ใจหรือว่าต้องการลบข้อมูลการยืมนี้ ?")==true) {
		top.window.location='del_borrow.php?stt_p=<?=$_GET['stt_p']?>&id_del='+val1;	
	}
}
function find_bor() {
	if (document.getElementById("stdate").value=="" || document.getElementById("endate").value=="") {
		alert('กรุณาใส่วันที่ให้ครบ');
	} else {
		top.window.location='borrow.php?stt_p=<?=$_GET['stt_p']?>&stdate='+document.getElementById("stdate").value+'&endate='+document.getElementById("endate").value;	
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
              <td width="751">&nbsp;</td>
              <td width="114"><div align="center"><a href="add_borrow.php"><img src="images/icon/1352332838_001_01.png" width="24" height="24" border="0" /></a></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>ตั้งแต่วันที่ :
                <input name="stdate" type="text" id="stdate" size="9" value="<?=$_GET['stdate']?>" />
				ถึงวันที่ :
            <input name="endate" type="text" id="endate" size="9" value="<?=$_GET['endate']?>" />
            <input type="button" name="button" id="button" value="ค้นหา" onclick="find_bor()" /></td>
              <td><div align="center"><a href="add_borrow.php">เพิ่มข้อมูลการยืม</a></div></td>
            </tr>
          </table>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><font size="+1">
				<?php if($_GET['stt_p']==1){ ?>
				รายการยืม 
				<?php }else{ ?>
				รายการคืน
        <?php } ?>
				<?=$Title?> 
				</font></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php if (mysqli_num_rows($result) > 0) { ?>
            <table width="1061" border="1" align="center" cellpadding="0" cellspacing="0" id="newtb">
              <tr class="h_table">
                <th width="52" height="30">ลำดับ</th>
                <th width="156">ชื่อผู้ยืม</th>
                <th width="92">จำนวน</th>
                <th width="154">ทำรายการ </th>
                
                <th width="131">สถานะ</th>
                <th width="92">รายการยืม</th>
                <th width="68">ส่งคืน</th>
                <th width="39">ลบ</th>
              </tr>
            
              <?php
			  $i=0;
			  while($rs=mysqli_fetch_array($result)){
				 $i++;
				 if($rs['status']=='1'){
				 	$stt = 'รอส่งคืน'.$Title;
				 }else{
				 	$stt = 'ส่งคืน'.$Title.'แล้ว';
				 }
				$rtn_date  = $rs['rtn_date'];
				$DTime = $rs['DTime'];
				 
				$sql = mysqli_query($con,"select * from borrow_detail where brw_id='".$rs['b_id']."'");
				$num_list = mysqli_num_rows($sql);
				 
              ?>
              <tr>
                <td><div align="center"><?php echo $i; ?></div></td>
                <td><?php echo $rs["b_name"]; ?></td>
                <td align="center"><?=$num_list?> รายการ </td>
                <td align="center"><?=datetime_full($DTime)?></td>
                
                <td align="center"><?php echo $stt; ?></td>
                <td>
				<div align="center">
				<a href="borrow_report.php?bid=<?php echo $rs["b_id"]; ?>" id="edit1" class="various iframe">
				<img src="images/icon/1352332827_001_38.gif" width="24" height="24" border="0" /></a>
				</div>
				
				</td>
                <td><div align="center"><a href="repatriate.php?rep_id=<?php echo $rs["b_id"]; ?>"  id="edit1" class="various iframe"><img src="images/icon/1352332831_001_39.png" width="24" height="24" border="0" /></a></div></td>
                <td><div align="center"><a href="#" onclick="del_b('<?php echo $rs["b_id"]; ?>')"><img src="images/icon/1352332857_001_05.gif" width="24" height="24" border="0" /></a></div></td>
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
            <?php 
            
            }?>

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