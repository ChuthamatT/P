<?php
include "config.ini.php";

$sql=" select * from buy where id=$_GET[bid] ";
$result=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($result);

$sql2=" select * from mm where id=$rs[mm] ";
$result2=mysqli_query($con,$sql2);
$rs2=mysqli_fetch_array($result2);
?>
<?PHP 
function convert($number){ 
$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
$number = str_replace(",","",$number); 
$number = str_replace(" ","",$number); 
$number = str_replace("บาท","",$number); 
$number = explode(".",$number); 
if(sizeof($number)>2){ 
return 'ทศนิยมหลายตัวนะจ๊ะ'; 
exit; 
} 
$strlen = strlen($number[0]); 
$convert = ''; 
for($i=0;$i<$strlen;$i++){ 
	$n = substr($number[0], $i,1); 
	if($n!=0){ 
		if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
		elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
		elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
		else{ $convert .= $txtnum1[$n]; } 
		$convert .= $txtnum2[$strlen-$i-1]; 
	} 
} 

$convert .= 'บาท'; 
if($number[1]=='0' OR $number[1]=='00' OR 
$number[1]==''){ 
$convert .= 'ถ้วน'; 
}else{ 
$strlen = strlen($number[1]); 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[1], $i,1); 
	if($n!=0){ 
	if($i==($strlen-1) AND $n==1){$convert 
	.= 'เอ็ด';} 
	elseif($i==($strlen-2) AND 
	$n==2){$convert .= 'ยี่';} 
	elseif($i==($strlen-2) AND 
	$n==1){$convert .= '';} 
	else{ $convert .= $txtnum1[$n];} 
	$convert .= $txtnum2[$strlen-$i-1]; 
	} 
} 
$convert .= 'สตางค์'; 
} 
return $convert; 
} 
## วิธีใช้งาน
//$x = '950.25'; 
//echo  $x  . "=>" .convert($x); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบขอสั่งซื้อ</title>
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
	font-size:22px;
	text-align:center;
}
.style4 {font-size: 10}
</style>
</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td><table width="900" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="181"><div align="center"><img src="images/krut.jpg" width="100" height="110" /></div></td>
        <td width="713" class="h_1">บันทึกข้อความ</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="right">ส่วนราชการ : </div></td>
        <td>โรงเรียนพระปริยัติธรรมวัดธรรมมงคล แผนกสามัญศึกษา โทร. 02-3328227</td>
      </tr>
    </table>
      <table width="900" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td width="182"><div align="right">ที่ ปส.02011008 / </div></td>
          <td width="264"><?php echo $rs["no"]; ?></td>
          <td width="65"><div align="right">วันที่ </div></td>
          <td><?php echo $rs["dd"]; ?>&nbsp;&nbsp;เดือน&nbsp;<?php echo $rs2["name"]; ?> &nbsp;&nbsp;พ.ศ&nbsp;<?php echo $rs["yy"]; ?></td>
        </tr>
    </table>
      <table width="900" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td width="182"><div align="right">เรื่อง : </div></td>
          <td colspan="3"><?php echo $rs["subject"]; ?></td>
        </tr>
        <tr>
          <td><div align="right">เรียน : </div></td>
          <td colspan="3"><?php echo $rs["send"]; ?></td>
        </tr>
        <tr>
          <td><div align="right">ข้าพเจ้า : </div></td>
          <td width="187"><?php echo $rs["fname"]; ?></td>
          <td width="78"><div align="right">นามสกุล : </div></td>
          <td width="443"><?php echo $rs["lname"]; ?></td>
        </tr>
        <tr>
          <td><div align="right">ตำแหน่ง : </div></td>
          <td><?php echo $rs["position"]; ?></td>
          <td><div align="right">ฝ่าย : </div></td>
          <td><?php echo $rs["section"]; ?></td>
        </tr>
        <tr>
          <td><div align="right">มีความประสงค์ : </div></td>
          <td colspan="3"><?php echo $rs["want"]; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><div align="center"><font size="+1">ได้เสนอขอให้จัดซื้อพัสดุ - คุรุภัณฑ์ ดังรายการต่อไปนี้</font></div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>
      <table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr class="h_table">
          <td width="43">ที่</td>
          <td width="407">รายการ</td>
          <td width="108">จำนวน</td>
          <td width="96">หน่วยละ</td>
          <td width="134">ราคา/บาท</td>
        </tr>
        <?php
			$sql3=" select * from buy_detail where bid=$rs[id] ";
			$result3=mysqli_query($con,$sql3);
			$sum_total=0;
			for ($i=1;$i<=mysqli_num_rows($result3);$i++) {
				$rs3=mysqli_fetch_array($result3);
				
				$sql4=" select * from procurment where id=$rs3[pid] ";
				$result4=mysqli_query($con,$sql4);
				$rs4=mysqli_fetch_array($result4);
				
				$sum_total+=$rs3["quantity"] * $rs4["price"];
        ?>
        <tr>
          <td><div align="center"><?php echo $i; ?></div></td>
          <td>&nbsp;<?php echo $rs4["name"]; ?></td>
          <td><div align="center"><?php echo $rs3["quantity"]; ?></div></td>
          <td><div align="right"><?php echo number_format($rs4["price"],2); ?>&nbsp;</div></td>
          <td><div align="right"><?php echo number_format($rs4["price"] * $rs3["quantity"],2); ?>&nbsp;</div></td>
        </tr>
        <?php } ?>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3"><div align="center"><strong>รวมเป็นเงินทั้งสิ้น</strong></div></td>
          <td><div align="right"><?php echo number_format($sum_total,2); ?>&nbsp;</div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="4">&nbsp;</td>
        </tr>
    </table>
      <table width="900" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td width="287">&nbsp;</td>
          <td width="607">&nbsp;</td>
        </tr>
        <tr>
          <td><blockquote>
            <p> เป็นจำนวนเงิน            <?php echo number_format($sum_total,2); ?>          บาท</p>
          </blockquote></td>
          <td> (<? $x = number_format($sum_total,2);  echo convert($x); ?>)</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>
      <table width="900" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td width="501">&nbsp;</td>
          <td width="393">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>ลงชื่อ ..............................................ผู้ขอเบิก</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><div align="justify">
            <blockquote>
              <blockquote>
                <p>( <?php echo $rs["fname"]; ?>    <?php echo $rs["lname"]; ?> )</p>
              </blockquote>
            </blockquote>
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td> ตำแหน่ง  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $rs["position"]; ?>   </td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>