<?php
session_start();
include "config.ini.php";
include "cke_date_func.php";
$bid="";
if (isset($_GET["bid"])!="") {
//echo	$bid=$_GET["bid"];
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
	font-size:14px;
	color:#FFF;
	background:url(images/menu_bar.png);
	font-weight:bold;
}
</style>
</head>

<body>
<table width="580" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<div style="padding:5px;">
 <form class="form-inline" method="post"  name="searchform" id="searchform">
 <div class="form-group">
 <label for="textsearch" >ชื่ออุปกรณ์</label>
 <input type="text" name="search" id="itemname" class="form-control" placeholder="ข้อความ คำค้นหา!" autocomplete="off">
 <input type="submit" name="button_search" id="button" value="ค้นหา" />
 </div>
 </form>
 </div>	
 
	<form id="form1" name="form1" method="post" action="actionSQL.php">
	
	<div>
	
	

	</div>
      <table width="680" border="1" cellspacing="0" cellpadding="0">
        <tr class="h_table">
          <td width="49">ลำดับ</td>
          <td width="67">เลข<?=$Title?></td>
          <td width="222">ชื่อ</td>
          <td width="101">ภาพ</td>
          <td width="67">คงเหลือ</td>
		   <td width="56">เลือก</td>
          <td width="102">จำนวน</td>
          </tr>
        <?php
 if($_POST['button_search']){
 $keyword = trim($_POST['search']);
 $sql=" select * from procurment WHERE(name LIKE '%".$keyword."%' OR no LIKE '%".$keyword."%') ";
 }else{
 $sql=" select * from procurment ";
 }
		 	

			$result=mysqli_query($con,$sql);
				 $i=0;
				while($rs=mysqli_fetch_array($result)){
				$i++;
				$id = $rs['id'];
for($n=0; $n<count($_SESSION['sessp_id']); $n++){
$npid = $_SESSION['sessp_id'][$n];
$nump = $_SESSION['sess_num'][$n];
 
if($npid == $id){
	$chkid = $npid;
	 $num = $nump;
	continue;
	}
	
}

//echo $chkid;
//echo $num ;
        ?>
        <tr>
          <td><div align="center"><?php echo $i; ?></div></td>
          <td><div align="center"><?php echo $rs["no"]; ?></div></td>
          <td>&nbsp;<?php echo $rs["name"]; ?></td>
          <td><div align="center"><img src="images/procurment/<?php echo $rs["photo"]; ?>" width="80" height="80" /></div></td>
          <td align="center">
		  
		   <div align="center"><?php echo $rs["stock"]; ?></div>
	  
		  </td>
		  <td align="center">
		  
	 
		   <?php if($chkid==$id){ ?>
			
		   <input name="chk[]" type="checkbox" value="<?php echo $id; ?>" checked="checked" >
		  
		   <?php }else{?>
				<input name="chk[]" type="checkbox" value="<?php echo $id; ?>" require >
			
		   <?php } ?>

		  </td>
          <td>
		  <div align="center">
		    <?php if($chkid==$id){ ?>
            <input  name="<?=$id?>_num" type="text" id="txt_num" size="6" style="text-align:center;" value="<?=$num?>" />
              <?php }else{ ?>
			  <input  name="<?=$id?>_num" type="text" id="txt_num" size="6" style="text-align:center;" />
			  <?php } ?>
          </div>
		  </td>
          </tr>
        <?php } ?>
      </table>
      <input type="hidden" id="bid" name="bid" value="<?php echo $bid; ?>" />
<p>
<div align="center">

<input type="submit" name="button" id="button" value="ตกลง" />
<input type="hidden" name="TbName" value="procurment" />
<input type="hidden" name="sql" value="ADD" />
  &nbsp;&nbsp;
  <input type="button" name="button2" id="button2" value="ยกเลิก" onclick="javaascript:parent.$.fancybox.close();" />
</div>
      </p>
    </form></td>
  </tr>
</table>


<div class="loading"></div>
 <div class="row" id="list-data" style="margin-top: 10px;"></div>

<script type="text/javascript">
 $(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "search_ajax.php",
 type: "post",
 data: {itemname: $("#itemname").val()},
 beforeSend: function () {
 $(".loading").show();
 },
 complete: function () {
 $(".loading").hide();
 },
 success: function (data) {
 $("#list-data").html(data);
 }
 });
 });
 $("#searchform").on("keyup keypress",function(e){
 var code = e.keycode || e.which;
 if(code==13){
 $("#btnSearch").click();
 return false;
 }
 });
 });
 </script>
 
</body>
</html>