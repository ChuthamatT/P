<?php

error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
 
 
date_default_timezone_set("Asia/Bangkok");
$host="localhost";
$user="root";
$pass="12345678";
$dbname="db_project";
$con=mysqli_connect("$host","$user","$pass","$dbname");
@mysqli_query($con,"SET NAMES UTF8");
// Check connection
if (mysqli_connect_errno()){
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$System_Title = 'ระบบการจัดการยืม - คืนอุปกรณ์กีฬา';
$Title = 'อุปกรณ์';
$text_title = ' Borrowing - returning sports equipment management system';

$conn=mysqli_connect($host,$user,$pass,$db_name) or die("Connect Error!!");
 
mysqli_query($con,"SET NAMES UTF8");

/*
mysqli_query($con,"SET character_set_results=tis620");
	mysqli_query($con,"SET character_set_client='tis620'");
	mysqli_query($con,"SET character_set_connection='tis620'");
	mysqli_query($con,"collation_connection = tis620_thai_ci");
	mysqli_query($con,"collation_database = tis620_thai_ci");
	mysqli_query($con,"collation_server = tis620_thai_ci");
*/

$sys_head="<font size='+2'>ระบบการจัดการยืม - คืนอุปกรณ์กีฬา</font><br><br><font size='+1'><b> Borrowing - returning sports equipment management system</b></size>";
$sys_foolter="&copy; Copyright  ระบบการจัดการยืม - คืนอุปกรณ์กีฬา Borrowing - returning sports equipment management system";

/* Function Date-Time*/
function getcurdate() {
	$curdate=date("Y-m-d");
	return $curdate;	
}
function getcurtime() {
	$curtime=date("H:i:s");
	return $curtime;
}
function todate($date) {
	$extdate=explode("-",$date);
	$stmonth=$extdate[0];
	$stday=$extdate[1];
	$styear=$extdate[2];
	$intdate=date("$styear-$stday-$stmonth");
	return $intdate;
}
function tointdate($date) {
	$extdate=explode("-",$date);
	$stday=$extdate[0]+543;
	$stmonth=$extdate[1];
	$styear=$extdate[2];
	$intdate=date("$styear-$stmonth-$stday");
	return $intdate;
}
function toexdate($date) {
	$extdate=explode("-",$date);
	$styear=$extdate[0];
	$stmonth=$extdate[1];
	$stday=$extdate[2] ;
	$intdate=date("$stday-$stmonth-$styear");
	return $intdate;
}
function datediff($strDate1,$strDate2) {
	return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
}
/* Function */
function mws_message($mess,$goto) {
	echo "<script language='javascript'>";
	echo " alert('$mess'); ";
	echo " top.window.location='$goto'; ";
	echo "</script>";
}
function mws_goto($str) {
	echo "<script language='javascript'>";	
	echo " top.window.location='$str'; ";
	echo "</script>";
}
?>

<?php
function displaydate_eng($x) {
	$thai_m=array("January","February","March","April","May","June","July","August","September","October","November","December");
	$txt = substr($x,0,10); 
	$time = substr($x,10); 
	$date_array=explode("-",$txt);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];
	
	$m=$thai_m[$m];
	$y=$y;

	$displaydate_eng="$d $m $y / $time";
	return $displaydate_eng;
}

function displaydate($x) {

	$thai_m=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.", "พ.ย.","ธ.ค.");
	$txt = substr($x,0,10); 
	$time = substr($x,10); 
	$date_array=explode("-",$txt);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	
	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate_th="$d $m $y";
	return $displaydate_th;
}

function datetime($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$txt = substr($x,0,10); 
	$time = substr($x,10); 
	$date_array=explode("-",$txt);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	//$datetime="$d $m $y เวลา $time วินาที";
		$datetime="<b style='color: red;'>$d</b> $m <b style='color: red;'>$y</b>";
	return $datetime;
}

function datetime1($x) {
	$thai_m=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.", "พ.ย.","ธ.ค.");
	$txt = substr($x,0,10); 
	$time = substr($x,10,6); 
	$date_array=explode("-",$txt);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$datetime1="$d $m $y   เวลา  $time นาที";

	return $datetime1;
}

function datetime_full($x) {
$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$txt = substr($x,0,10); 
	$time = substr($x,10); 
	$date_array=explode("-",$txt);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$datetime1="<b>$d</b> $m $y <b>เวลา</b>$time";

	return $datetime1;
}

function fcDate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$txt = substr($x,0,10); 
	$time = substr($x,10); 
	$date_array=explode("-",$txt);
	$y=$date_array[0]+543;
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y;

		$datetime="$d $m $y";
		return $datetime;
}

function checkemail($checkemail){
	if(ereg( "^[^@]+@([a-zA-Z0-9\-]+\.)+([a-zA-z0-9\-](2)|net|com|gov|mil|org|edu|int|co.th)$",$checkemail)){
		return true ;
		
	}else{
		exit("<script>alert('รูปแบบ e-mail ไม่ถูกต้อง');(history.back());</script>");
		return  false;
	}
}

////////////////// 	คำนวนอายุ ///////////////////////////

	function calage($pbday){
	$today = date("d/m/Y");
	list($bady , $bmonth , $byear) = explode("/" , $pbday);
	list($tday , $tmonth , $tyear) = explode("/" , $today);
	
	if($byear < 1970){
		$yearad = 1970 - $byear;
		$byear = 1970;
	}else{
		$yearad = 0;
	}
	
	$mbirth = mktime(0,0,0,$bmonth,$bday,$byear);
	$mnow = mktime(0,0,0,$tmonth,$tday,$tyear);
	
	$mage= ($mnow - $mbirth);
	$age = (date("Y",$mage)-1970 + $yearad)." ปี / ".(date("m", $mage)-1)." เดือน / ".(date("d", $mage)-15)." วัน " ; return($age);

	}
	
//// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
function calage_year($pbday){ // เอาเฉพาะปี
	$today = date("d/m/Y");
	list($bady , $bmonth , $byear) = explode("/" , $pbday);
	list($tday , $tmonth , $tyear) = explode("/" , $today);
	
	if($byear < 1970){
		$yearad = 1970 - $byear;
		$byear = 1970;
	}else{
		$yearad = 0;
	}
	
	$mbirth = mktime(0,0,0,$bmonth,$bday,$byear);
	$mnow = mktime(0,0,0,$tmonth,$tday,$tyear);
	
	$mage= ($mnow - $mbirth);
	$age = (date("Y",$mage)-1970 + $yearad); return($age); // เอาเฉพาะปี

	}

?>


<?php     
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า     
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){     
    global $urlquery_str;  
	global $id_type;
    $pPrev=$chk_page-1;  
    $pPrev=($pPrev>=0)?$pPrev:0;  
    $pNext=$chk_page+1;  
    $pNext=($pNext>=$total_p)?$total_p-1:$pNext;       
    $lt_page=$total_p-4;  
	
	// Link Page
	$lnk = "pp=".$_GET['pp']."&stt=".$_GET['stt']."";
	
    if($chk_page>0){    
        echo "<a  href='?".$lnk."&s_page=$pPrev&urlquery_str=".$urlquery_str."' class='naviPN'> Prev </a>";  
    }  
    if($total_p>=11){  
        if($chk_page>=4){  
            echo "<a $nClass href='?".$lnk."&s_page=0&urlquery_str=".$urlquery_str."'>1</a> <a class='SpaceC'>. . .</a>";     
        }  
        if($chk_page<4){  
            for($i=0;$i<$total_p;$i++){    
                $nClass=($chk_page==$i)?"class='selectPage'":"";  
                if($i<=4){  
                echo "<a $nClass href='?".$lnk."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }  
                if($i==$total_p-1 ){   
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?".$lnk."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }         
            }  
        }  
        if($chk_page>=4 && $chk_page<$lt_page){  
            $st_page=$chk_page-3;  
            for($i=1;$i<=5;$i++){  
                $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";  
                echo "<a $nClass href='?".$lnk."&s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";      
            }  
            for($i=0;$i<$total_p;$i++){    
                if($i==$total_p-1 ){   
                $nClass=($chk_page==$i)?"class='selectPage'":"";  
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?".$lnk."&s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }         
            }                                     
        }     
        if($chk_page>=$lt_page){  
            for($i=0;$i<=4;$i++){  
                $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";  
                echo "<a $nClass href='?".$lnk."&s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";     
            }  
        }          
    }else{  
        for($i=0;$i<$total_p;$i++){    
            $nClass=($chk_page==$i)?"class='selectPage'":"";  
            echo "[ <a href='?".$lnk."&s_page=$i&urlquery_str=".$urlquery_str."' $nClass  >".intval($i+1)."</a> ] ";     
        }         
    }     
    if($chk_page<$total_p-1){  
        echo "<a href='?".$lnk."&s_page=$pNext&urlquery_str=".$urlquery_str."'  class='naviPN'> Next </a>";  
    }  
}     
?>