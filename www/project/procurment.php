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
if (isset($_GET["name"])!="") {
	$where=" where no like'%$_GET[name]%' OR name  like '%$_GET[name]%' ";
}
if (isset($_GET["type"])!="") {
	if ($where=="") {
		$where=" where type=$_GET[type] ";
	} else {
		$where.=" and type=$_GET[type] ";
	}
}
 
?>
<?php  
 
$q="select * from procurment $where order by id desc";  
 
$qr=mysqli_query($con,$q);  
$total=mysqli_num_rows($qr);  
$e_page=20; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า     

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
<title>รายการอุปกรณ์</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
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
	$('a[id^="view"]').fancybox({
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'type'				: 'iframe'
	});	
});
function del_pro(val1) {
	if (confirm("คุณต้องการลบอุปกรณ์นี้ ?")==true) {
		top.window.location='del_procurment.php?id_del='+val1;	
	}
}
function find_pro() {
	var url="";
	if (document.getElementById("name").value=="" && document.getElementById("type").value=="0") {
		alert('กรุณาใส่ชื่ออุปกรณ์หรือประเภทกีฬา');
	} else {
		if (document.getElementById("name").value!="") {
			url="?name="+document.getElementById("name").value;
		}
		if (document.getElementById("type").value!="0") {
			if (url=="") {
				url="?type="+document.getElementById("type").value;
			} else {
				url+="&type="+document.getElementById("type").value;
			}
		}
		top.window.location='procurment.php'+url;
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
              <td width="168">
              <div align="center"><a href="add_procurment.php"  id="add1" class="various iframe"><img src="images/icon/1352332838_001_01.png" width="24" height="24" border="0" /></a></div>              </td>
            </tr>
            <tr>
              <td><div align="right">ชื่อ : </div></td>
              <td>
                <input type="text" name="name" id="name" />
              ประเภท : 
              <select name="type" id="type">
                <option value="0">---- เลือก ----</option>
                <?php
				$sql2=" select * from sup_type  ";
				$result2=mysqli_query($con,$sql2);
				for ($i=1;$i<=mysqli_num_rows($result2);$i++) {
					$rs2=mysqli_fetch_array($result2);	
					echo "<option value='$rs2[id]'>$rs2[name]</option>";
				}
            ?>
              </select> 
              <input type="button" name="button" id="button" value="ค้นหา" onclick="find_pro()" />              </td>
              <td><div align="center"><a href="add_procurment.php"  id="add2" class="various iframe">เพิ่มรายการ
                <?=$Title?>
              </a></div></td>
            </tr>
          </table>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><font size="+1">รายการ<?=$Title?></font></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
   <?php if (mysqli_num_rows($qr) > 0) { ?>
            <table width="900" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr class="h_table">
                <td width="57" height="30">ลำดับ</td>
                <td width="88">เลข<?=$Title?></td>
                <td width="134">ประเภทกีฬา</td>
                <td width="329">ชื่อ<?=$Title?></td>
                <td width="90">คงเหลือ</td>
                <td width="64">ภาพ</td>
                <td width="66">แก้ไข</td>
                <td width="54">ลบ</td>
              </tr>
              <?php
			  	for ($i=1;$i<=mysqli_num_rows($qr);$i++) { 
					$rs=mysqli_fetch_array($qr);
					
					$sql2=" select * from sup_type where id=$rs[type] ";
					$result2=mysqli_query($con,$sql2);
					$rs2=mysqli_fetch_array($result2);
              ?>
              <tr>
                <td><div align="center"><?php echo $i; ?></div></td>
                <td><div align="center"><?php echo $rs["no"]; ?></div></td>
                <td><div align="center"><?php echo $rs2["name"]; ?></div></td>
                <td>&nbsp;<?php echo $rs["name"]; ?></td>
                <td><div align="center"><?php echo $rs["stock"]; ?></div></td>
                <td><div align="center"><a href="images/procurment/<?php echo $rs["photo"]; ?>"  id="view<?php echo $i; ?>" class="various iframe"><img src="images/icon/1352332827_001_38.gif" width="24" height="24" border="0" /></a></div></td>
                <td><div align="center"><a href="edit_procurment.php?id_edit=<?php echo $rs["id"]; ?>"  id="edit<?php echo $i; ?>" class="various iframe"><img src="images/icon/1352332831_001_39.png" width="24" height="24" border="0" /></a></div></td>
                <td><div align="center"><a href="#" onclick="del_pro('<?php echo $rs["id"]; ?>')"><img src="images/icon/1352332857_001_05.gif" width="24" height="24" border="0" /></a></div></td>
              </tr>
              <?php } ?>
            </table>
            <table width="900" border="0" align="center" cellpadding="0" cellspacing="2">
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
                <td colspan="2"><div align="right">รวมทั้งสิ้น : <?php echo mysqli_num_rows($qr);  ?> รายการ </div> </td>
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