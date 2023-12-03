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

 
?>
<?php  

$where="";
if (isset($_GET["name"])!="") {
	$where=" where mb_identity like '%$_GET[name]%' OR mb_fname  like '%$_GET[name]%' ";
}


if (isset($_GET["type"])!="") {
	if ($where=="") {
		$where=" where type=$_GET[type] ";
	} else {
		$where.=" and type=$_GET[type] ";
	}
	
}

 
$q="select * from member $where order by mb_id desc";  
 
$qr=mysqli_query($con,$q);  
$total=mysqli_num_rows($qr);  
$e_page=50; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า     

if(!isset($_GET['s_page'])){     
    	$_GET['s_page']=0;     
		
		}else{     
    		$chk_page=$_GET['s_page'];       
 			   $_GET['s_page']=$_GET['s_page']*$e_page;     
		}  
			   
	$q.=" LIMIT ".$_GET['s_page'].",$e_page";  
	$qr=mysqli_query($con,$q);
	  
	if(mysqli_num_rows($qr)>=1){     
    $plus_p=($chk_page*$e_page)+mysqli_num_rows($qr);     
		}else{     
    $plus_p=($chk_page*$e_page);         //$plus_p มีค่าอยู่ที่ 100
	}    
	 
$total_p=ceil($total/$e_page);     
$before_p=($chk_page*$e_page)+1;    //$before_p มีค่าอยู่ที่ 50
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลสมาชิก</title>
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
	if (confirm("คุณแน่ใจหรือว่าต้องการลบข้อมูลออกจากระบบ?")==true) {
		top.window.location='del_member.php?id_del='+val1;	
	}
} 

function find_pro() {
	var url="";
	if (document.getElementById("name").value=="") {
		alert('กรุณาใส่ข้อมูล รหัสหรือชื่อ ด้วยนะ');
	} else {
		if (document.getElementById("name").value!="") {
			url="?name="+document.getElementById("name").value;
		}
		top.window.location='member.php'+url;
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
              <td width="64">&nbsp;</td>
              <td width="693">&nbsp;</td>
              <td width="155"><div align="center"><a href="add_member.php" id="add1" class="various iframe"><img src="images/icon/1352332838_001_01.png" width="24" height="24" border="0" /></a></div></td>
            </tr>
            <tr>
              <td>รหัส/ชื่อ : </td>
              <td>
			  <input type="text" name="name" id="name" value="<?=$_GET['name']?>" /> 
			  <input type="button" name="button" id="button" value="ค้นหา" onclick="find_pro()" />
			  </td>
              <td><div align="center"><a href="add_member.php" id="add1" class="various iframe">ลงทะเบียนสมาชิกใหม่</a></div></td>
            </tr>
          </table>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><font size="+1">ข้อมูลสมาชิก</font></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php if (mysqli_num_rows($qr) > 0) {  ?>
            <table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr class="h_table">
                <td width="52" height="30">ลำดับ</td>
                <td width="133">รหัสนักศึกษา</td>
                <td width="206">ชื่อ - นามสกุล</td>
                <td width="159">อาจารย์ที่ปรึกษา</td>
                <td width="118">สถานะ(ยืม/คืน)</td>
                <td width="57">แก้ไข</td>
                <td width="59">ลบ</td>
              </tr>
              <?php
			  	for ($i=1;$i<=mysqli_num_rows($qr);$i++) {
					$rs=mysqli_fetch_array($qr);
					
					
 
              ?>
              <tr>
                <td><div align="center"><?php echo $i; ?></div></td>
                <td><div align="center"><a href="add_borrow.php?identity=<?php echo $rs["mb_identity"]; ?>"><?php echo $rs["mb_identity"]; ?></a></div></td>
                <td>&nbsp;<?php echo $rs["mb_title_name"]."&nbsp;".$rs["mb_fname"]."&nbsp;&nbsp;".$rs["mb_lname"]; ?></td>
                <td><div align="center"><?php echo $rs["mb_teacher"]; ?></div></td>
                <td><div align="center">
				<?php 
				
				$sql2=mysqli_query($con,"select * from borrow where b_identity='".$rs["mb_identity"]."' ");
					  @mysqli_num_rows($sql2);
					if(@mysqli_num_rows($sql2)>0){
					
					$rst=mysqli_fetch_array($sql2);
						 if($rst['status']=='1'){
						echo $stt = "<a href=\"borrow_report.php?bid=".$rst["b_id"]." \" id=\"edit1\" class=\"various iframe\">รอส่งคืน".$Title."</a>";
						}else if($rst['status']=='2'){
						echo	$stt = 'ส่งคืน'.$Title.'แล้ว';
						 } 
					}else{
					echo	"-";
					}
			 
				
				
				
				 ?></div></td>
                <td>
				<div align="center">
				
				<a href="edit_member.php?id_edit=<?php echo $rs["mb_id"]; ?>" id="edit<?php echo $i; ?>" class="various iframe">
				<img src="images/icon/1352332831_001_39.png" width="24" height="24" border="0" /></a>				</div>				</td>
                <td><div align="center"><a href="#" onclick="del_user('<?php echo $rs["mb_id"]; ?>')"><img src="images/icon/1352332857_001_05.gif" width="24" height="24" border="0" /></a></div></td>
              </tr>
			   <?php } ?>
            </table>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
 <td width="738">

		<?php // if($total > $e_page){ ?>
		<div class="browse_page">
		<?php     
		 // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า     
		  page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);       
		?>
		</div>
		<?php // } ?>
						
		 </td>
                <td width="156">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><div align="right">จำนวน : <?php echo mysqli_num_rows($qr);  ?> รายการ </div> </td>
                </tr>
            </table>
			<?php // if($total > $e_page){ ?>
 
			
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