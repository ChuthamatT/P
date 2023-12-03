<?php
session_start();

 
include "config.ini.php";

//echo $stdate=toexdate($_POST["stdate"]);
//echo $endate=toexdate($_POST["endate"]);

if (isset($_SESSION["sess_id"])!="") {
	$uid=$_SESSION["sess_userid"];
	$uname=$_SESSION["sess_name"];
	$utype=$_SESSION["sess_type"];
} else {
	mws_message('กรุณาเข้าสู่ระบบก่อน','index.php');
}
 
if (isset($_POST["stdate"])!="") {
  $stdate=toexdate($_POST["stdate"]);
  $endate=toexdate($_POST["endate"]);
 
$sql=" select * from borrow where (date(DTime) BETWEEN '".$stdate."' AND '".$endate."') AND status='".$_GET['stt_p']."' ORDER BY b_id DESC";
	
}else{

$sql=" select * from borrow where status='".$_GET['stt_p']."' ORDER BY b_id DESC ";

}

$result=mysqli_query($con,$sql);
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
.h_table {
	text-align:center;
	font-weight:bold;
	background:#CCC;
}
.h_1 {
	font-size:24px;
	text-align:center;
	font-weight:bold;
}
.h_2 {
	text-align:center;
	font-weight:bold;
	font-size:20px;
}
#newtb
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:100%;
border-collapse:collapse;
}
#newtb td, #newtb th 
{
font-size:1em;
border:1px solid #bbb;
padding:3px 7px 2px 7px;
}
#newtb th 
{
font-size:1.1em;
padding-top:5px;
padding-bottom:4px;
background-color:#ddd;
color:#333;
}
#newtb tr.alt td 
{
color:#000000;
background-color:#EAF2D3;
}
</style>
<script language="javascript">
function del_b(val1,val2) {
	parent.window.frame1.location='del_item.php?id_del='+val1+'&bid='+val2;
}
</script>
</style>
</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td><table width="900" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="h_1"> 
		<?php if($_GET['stt_p']==1){ ?>
				รายงานการยืม 
				<?php }else{ ?>
				รายงานการคืน
				<?php } ?>
				<?=$Title?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="h_2"><?php echo $mess; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <?php if (mysqli_num_rows($result) > 0) {  ?>
    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" id="newtb">
              <tr class="h_table">
                <th width="56" height="30">ลำดับ</th>
                <th width="169">ชื่อผู้ยืม</th>
                <th width="87">จำนวน</th>
                <th width="164">ทำรายการ </th>
                <th width="151">วันส่งคืน</th>
                <th width="116">สถานะ</th>
                <th width="141">ผู้อนุมัติการยืม</th>
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
				 $allow = $rs['b_allow'];
				$sql = mysqli_query($con,"select * from borrow_detail where brw_id='".$rs['b_id']."'");
				$num_list = mysqli_num_rows($sql);
				 
              ?>
              <tr>
                <td><div align="center"><?php echo $i; ?></div></td>
                <td><?php echo $rs["b_name"]; ?></td>
                <td align="center"><?=$num_list?> รายการ </td>
                <td align="center"><?=datetime_full($DTime)?></td>
                <td align="center"><?=datetime_full($rtn_date)?></td>
                <td align="center"><?php echo $stt; ?></td>
                <td align="center"><?=$allow?></td>
              </tr>
              <?php } ?>
      </table>
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><a href="#" onclick="javascript:window.print();"><img src="images/icon/printer.png" width="24" height="24" border="0" /></a></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
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
</table>
</body>
</html>