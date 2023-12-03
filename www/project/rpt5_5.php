<?php
session_start();
include "config.ini.php";

function fcDatefull($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$txt = substr($x,0,10); //ตัดข้อความ เวลาออก 2012-08-05 17:35:20
	$time = substr($x,10); //ตัดข้อความ วันที่ออก 2012-08-05 17:35:20
	$date_array=explode("-",$txt);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y;

		$fcDatefull="$m $y";
		return $fcDatefull;
}

if (isset($_SESSION["sess_id"])!="") {
	$uid=$_SESSION["sess_userid"];
	$uname=$_SESSION["sess_name"];
	$utype=$_SESSION["sess_type"];
} else {
	mws_message('กรุณาเข้าสู่ระบบก้อน','index.php');
}
 
// echo $_POST['mm'];
//  echo $_POST['yy'];
 
if (!empty($_POST['mm']) and !empty($_POST['yy'])) {
$chkDATE=$_POST['mm']."-".$_POST['yy'];
  $curdate2 = $_POST['yy']."-".$_POST['mm']."-00";
//$sql=mysqli_query($con,"SELECT * FROM borrow WHERE  DATE_FORMAT(DTime,'%m-%Y')='".$chkDATE."' ");
$sql=mysqli_query($con,"SELECT DISTINCT tool_id  FROM borrow, borrow_detail WHERE b_id=brw_id And DATE_FORMAT(DTime,'%m-%Y')='".$chkDATE."' ");
   mysqli_num_rows($sql) ;
 
// $sql=" select * from borrow where (date(DTime) BETWEEN '".$stdate."' AND '".$endate."') AND status='".$_GET['stt_p']."' ORDER BY b_id DESC";
	
} 

 


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
		 รายงานเชิงสถิติ ประจำเดือน <?php echo fcDatefull($curdate2); ?>
		  </td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"></td>
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
    <?php if (mysqli_num_rows($sql) > 0) {  ?>
    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" id="newtb">
              <tr class="h_table">
                <th width="98" height="30">ลำดับ</th>
                <th width="461">ชื่อ<?=$Title?></th>
                <th width="333">จำนวนครั้งที่ถูกยืม</th>
              </tr>
              <?php
			  $i=0;
			  
			  
			  
			  
			  while($rs=mysqli_fetch_array($sql)){
				 $i++;
 
				 $sql2=mysqli_query($con,"select * from procurment where id='".$rs['tool_id']."'");
				 $rs2=mysqli_fetch_array($sql2);
 				  $name=$rs2['name'];
				  
				  
 $sql3=mysqli_query($con,"select sum(borrow+repatriate) AS TotalBw from borrow, borrow_detail where b_id=brw_id And  DATE_FORMAT(DTime,'%m-%Y')='".$chkDATE."' And tool_id='".$rs['tool_id']."' ");
 $rs3=mysqli_fetch_array($sql3);
$TotalBw=$rs3['TotalBw'];				 
              ?>
              <tr>
                <td><div align="center"><?php echo $i; ?></div></td>
                <td><?php echo $name; ?> </td>
                <td align="center"><?=$TotalBw?> ครั้ง </td>
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