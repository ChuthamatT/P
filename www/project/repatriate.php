<?php
include "config.ini.php";
 // เลือกข้อมูลในตารางมาตรวจสอบ
 $TbName = "borrow";
$sql = mysqli_query($con,"SELECT * FROM ".$TbName." WHERE(b_id='".$_REQUEST['rep_id']."')");
$rs = mysqli_fetch_array($sql);
$b_id = $rs['b_id'];
 
 $stt_bw = $rs['status'];

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
#newtb
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
width:100%;
border-collapse:collapse;
}
#newtb td, #newtb th 
{
font-size:1em;
border:1px solid #98bf21;
padding:3px 7px 2px 7px;
}
#newtb th 
{
font-size:1.1em;
padding-top:5px;
padding-bottom:4px;
background-color:#D5ED7D;
color:green;
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
</head>

<body>
<form id="form1" name="form1" method="post" action="actionSQL.php" required>
  <table width="100%" border="1" cellpadding="1" cellspacing="1" id="newtb">
    <tr>
      <th width="8%">เลข<?=$Title?></th>
      <th width="61%">รายการส่งคืน<?=$Title?></th>
      <th width="11%" align="center">จำนวน</th>
      <th width="9%" align="center">เลือก</th>
      <th width="11%" align="center">คืนแล้ว</th>
    </tr>
    <?PHP
	$sql = mysqli_query($con,"SELECT * FROM procurment , borrow_detail WHERE id=tool_id AND  brw_id='".$b_id."'");
	$on = 0;
	while($rst = mysqli_fetch_array($sql)){
 
 
	 $ID = $rst['id'];
	 $re_id = $rst['tool_id'];
	$on++;
	$code = $rst['no'];
	$name = $rst['name'];
 	$num = $rst['borrow'];
	$repatriate=  $rst['repatriate'];
	$numTotal = $numTotal+$num;
	$repatriateTotal = $repatriateTotal + $repatriate;
	
	if($num==0){
	  $display_chk =  'checked="checked" disabled="disabled"';
	}else{
	  $display_chk =  '';
	}
	
	if($stt_bw=='2'){
		$num = $repatriate;
		$numTotal = $repatriateTotal;
		$btn_disp = 'disabled="disabled"';
		$btnvl = 'ส่งคืน'.$Title.'แล้ว';
	}else{
		$num = $rst['borrow'];
 		$numTotal = $numTotal+$num;
		$btn_disp =  '';
		$btnvl = 'ยืนยันส่งคืน'.$Title;
	}
	
	?>
    <tr>
      <td align="center"><?=$rst['no']?></td>
      <td><?=$name?></td>
      <td align="center"><input name="<?=$re_id?>_num" type="text" id="txt_num" size="6" style="text-align:center;" value="<?=$num?>" <?=$display_chk?> />      </td>
      <td align="center"><?php if($chkid==$id){ ?>
	  
	  		
       <input name="chk[]" type="checkbox" value="<?php echo $re_id; ?>"  <?=$display_chk?> required  />
		   <input type="hidden" name="bw_id" value="<?=$b_id?>" />
		 
          <?php }else{ ?>
          <input name="chk[]" type="checkbox" value="<?php echo $re_id; ?>" required />
          <?php } ?> </td>
      <td align="center"><?=$repatriate?></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="5" align="right" valign="middle">
	  
	  <input type="submit" name="button" id="button" value="<?=$btnvl?>" <?=$btn_disp?> />
	  
	<input type="hidden" name="TbName" value="procurment" />
	<input type="hidden" name="sql" value="UPDATE" />
	  
	  </td>
    </tr>
    <tr>
      <td colspan="5" align="left"><?php if($rs['status']=='1'){
							  	$stt = 'รอส่งคืน'.$Title;
								  }else if($rs['status']=='2'){
							  	$stt = 'ส่งคืน'.$Title.'แล้ว';
								  }							 
							   ?>
          <div style="padding:5px;">
            <h4>รายละเอียดการยืม</h4>
            <ul style="list-style:none; line-height:20px;">
                <//li>
                <//label style="display: inline-block; width: 100px;"><//strong><//strong> <//label>
                <//?=datetime_full($rs['rtn_date'])?>
              <///li>
              <li>
                <label style="display: inline-block; width: 100px;">- <strong>ชื่อผู้ยืม</strong> </label>
                <?=$rs['b_name']?>
              </li>
                <//li>
                <//label style="display: inline-block; width: 100px;"> <//strong><///strong><///label>
                <//?=$rs['detail']?>
              <//li>
              <li>
                <label style="display: inline-block; width: 100px;">- <strong>หมายเหตุ</strong></label>
                <?=$rs['note']?>
              </li>
              <li>
                <label style="display: inline-block; width: 100px;">- <strong>ผู้อนุมัติให้ยืม</strong></label>
                <?=$rs['b_allow']?>
              </li>
              <li>
                <label style="display: inline-block; width: 100px;">- <strong>วันที่ยืม</strong></label>
                <?=datetime_full($rs['DTime'])?>
              </li>
              <li>
                <label style="display: inline-block; width: 100px;">- <strong>สถานะการยืม</strong></label>
                <?=$stt?>
              </li>
            </ul>
          </div></td>
    </tr>
  </table>
</form>
</body>
</html>