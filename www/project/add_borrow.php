<?php
session_start();
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
include "config.ini.php";
include "cke_date_func.php";
if (isset($_SESSION["sess_id"])!="") {
	$uid=$_SESSION["sess_userid"];
	$uname=$_SESSION["sess_name"];
	$utype=$_SESSION["sess_type"];
} else {
	mws_message('กรุณาเข้าสู่ระบบก่อน','index.php');
}
 count($_SESSION['sessp_id']);
 //  echo  count($_SESSION['notID']);
 if(count($_SESSION['notID'])>0){
 //  echo  $not_id = implode($_SESSION['notID']);
 // $dd = explode("''",$_SESSION['notID']);
//  echo $dd[0];
 //  echo $dd[1];
	//  echo $dd[2];
 
 }
 
 $where="";
if (isset($_GET["identity"])!="") {
	$sql=mysqli_query($con,"select * from member where mb_identity='".$_GET["identity"]."' ");
 	if(@mysqli_num_rows($sql)>=1){
		$rst=mysqli_fetch_array($sql);
		$identity=$rst['mb_identity'];
		$flname=$rst["mb_title_name"]."&nbsp;".$rst["mb_fname"]."&nbsp;&nbsp;".$rst["mb_lname"]; 
		$flname2=$rst["mb_fname"]." ".$rst["mb_lname"]; 
		$teacher=$rst['mb_teacher'];
		
		$sql2=mysqli_query($con,"select * from borrow where b_identity='".$identity."' and status='1' ");
		 
			if(@mysqli_num_rows($sql2)>0){
					 $disp='disabled="disabled"';
					 $txtdisp='สถานะยังไม่คืนอุปกรณ์กีฬา ไม่สามารถยืมอุปกรณ์กีฬาได้';
			 	}else{
			 		$disp="";
					$txtdisp="";
				 }
 
	}else{
	?>
	<div align="center"><font size="+1">ไม่พบข้อมูล</font><br /><br /><a href="#" onClick="javaascript:parent.$.fancybox.close();">ตกลง</a></div>
	<?php
	}
	
	
	
	}
 
 
 

$curtime=getcurtime();
$curdate=toexdate(getcurdate());
$sql=" select max(b_id) as mid from borrow ";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);
if ($rs["mid"]>0) {$mid=$rs["mid"]+1;} else {$mid=1;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบยืม - คืน อุปกรณ์กีฬา</title>
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
	//if (document.getElementById("detail").value=="") {
	//	Rtn=false;
	//	mess+=" - ใช้งานในส่วน \r  ";	
	//}
	if (document.getElementById("note").value=="") {
		Rtn=false;
		mess+=" - หมายเหตุ \r  ";	
	}
	if (Rtn==false) {
		alert(mess);	
	}
	return Rtn;	
}
 
function find_pro() {
	var url="";
	if (document.getElementById("identity").value=="".required) {
		alert('กรุณากรอกรหัสนักศึกษา/รหัสประจำตัว');
	} else {
		if (document.getElementById("identity").value!="") {
			url="?identity="+document.getElementById("identity").value;
		}
 
		top.window.location='add_borrow.php'+url;
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
              <td width="697">&nbsp;</td>
              <td width="168">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
            <form id="form1" name="form1" method="post" action="actionSQL.php" onSubmit="return chk_form()">
              <table width="620" border="0" align="center" cellpadding="0" cellspacing="2">
                <tr>
                  <td><fieldset>
                    <legend>ข้อมูลการยืม</legend>
                    <table width="620" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td colspan="2" align="left">
						
						<div align="left" style="padding: 5px; margin:5px; border-bottom: 2px solid #55C5F5;">
						<a href="add_bitem.php?bid=<?php echo $mid; ?>" id="add1" class="various iframe">
						<img src="images/icon/1352332838_001_01.png" width="24" height="24" border="0" /></a>
						<a href="add_bitem.php?see=add&bid=<?php echo $mid; ?>" id="add2" class="various iframe">เลือกรายการ<?php echo $Title; ?></a></div>						</td>
                        </tr>
                      <tr>
                        <td colspan="2">
						
						  
 <?php
if(count($_SESSION['sessp_id'])=="0"){
	//ลบ session
	unset($_SESSION['sessp_id']);
	unset($_SESSION['sess_num']);
	unset($_SESSION['notID']);
 
}else{
?>
<div style="padding:5px 5px 10px 5px; border-bottom: 2px solid #55C5F5; margin-bottom: 10px;">
<table width="100%" border="1" cellpadding="1" cellspacing="1" id="newtb">
                            <tr>
                              <th width="13%" align="center">เลข<?=$Title?></th>
                              <th width="60%">รายการ</th>
                              <th width="15%" align="center">จำนวน</th>
                              <th width="12%" align="center">ลบ</th>
                            </tr>

<?php
	//หาภาษี
	$on = 0;
	for($i=0;$i<count($_SESSION['sessp_id']);$i++){
	$sql = mysqli_query($con,"SELECT * FROM procurment WHERE id='".$_SESSION['sessp_id'][$i]."'");
	$rst = mysqli_fetch_array($sql);
	 $ID = $rst['id'];
	$on++;
	$name = $rst['name'];
	$num= $_SESSION['sess_num'][$i];
	$numTotal = $numTotal+$num;
	?>
							
                            <tr>
                              <td align="center"><?=$rst['no']?></td>
                              <td><?=$name?></td>
                              <td align="center"><?=$num?></td>
                              <td align="center"><a href="actionSQL.php?TbName=procurment&sql=SESS_DEL&ID[]=<?=$ID?>"><img src="images/icon/1352332857_001_05.gif" border="0" /></a></td>
                            </tr>
							<?php  } ?>
                            <tr>
                              <td colspan="2" align="right" valign="middle"><strong>รวม</strong></td>
                              <td align="center"><?=$numTotal?></td>
                              <td align="center"> </td>
                            </tr>
                          </table>
						</div>
						<?php } ?>
						<!-- 
						<iframe name="frame1" id="frame1" src="bitem.php" width="600" height="300" frameborder="0"></iframe>
						-->						</td>
                        </tr>
				<?php 	if(count($_SESSION['sessp_id'])>0){  ?>
                      <tr>
                        <td width="188"><div align="right">กำหนดส่งคืน : </div></td>
                        <td width="426"><input name="bdate" type="text" id="bdate" size="9" value="<?php echo $curdate; ?>" />
                          เวลา :
                          <input name="txt_Time" type="text" id="txt_Time" size="9" value="<?php echo $curtime; ?>" /></td>
                      </tr>
					 
                      <tr>
                        <td height="30" colspan="2"> <div align="center"><strong>ข้อมูลผู้ยืม</strong></div></td>
                        </tr>
					  <tr>
                        <td><div align="right">รหัสนักศึกษา/รหัสประจำตัว : </div></td>
                        <td>
						<input name="identity" type="text" id="identity" size="15"  value="<?=$identity?>" />
						<input type="button" name="button" id="button" value="ตรวจสอบ" onClick="find_pro()" />
						<input type="button" name="button" onClick="parent.location='member.php?name=<?=$_GET["identity"]?>'" value="ค้นหา" />
						</td>
                      </tr>
					  <tr>
                        <td><div align="right">ชื่อ - นามสกุล : </div></td>
                        <td><input name="txt_name" type="text" id="txt_name" size="40" value="<?=$flname?>" readonly /></td>
                      </tr>
					   <tr>
                        <td align="right"><div align="right">อาจารย์ที่ปรึกษา : </div></td>
                        <td><input name="teacher" type="text" id="txt_teacher" size="40" value="<?=$teacher?>" readonly /></td>
                      </tr>
					  <tr>
                        <td align="left" valign="top"><div align="right">หมายเหตุ : </div></td>
                        <td><textarea name="txt_note" id="txt_note" cols="45" rows="5">-</textarea></td>
                      </tr>
                      <tr>
                        <td align="right"><div align="right">ผู้อนุมัติให้ยืม : </div></td>
                        <td><input name="txt_none" type="text" id="txt_none" size="15" value="<?=$uname?>" disabled="disabled" /></td>
                      </tr>
					
                      <tr>
                        <td>						 </td>
                        <td>
						<input type="submit" name="button" id="button" value="บันทึกการยืม" <?=$disp?> />
						<?php echo $txtdisp; ?>
						<input type="hidden" name="txt_allow" value="<?=$uname?>" />
						<input type="hidden" name="flname2" value="<?=$flname2?>" />
						<input type="hidden" name="TbName" value="borrow" />
						<input type="hidden" name="sql" value="ADD" />						</td>
                      </tr>
					  <?php 	 }  ?> 
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