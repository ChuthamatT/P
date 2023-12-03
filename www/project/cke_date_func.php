<?php
function fcDate_eng59($x) {
	$thai_m=array("January","February","March","April","May","June","July","August","September","October","November","December");
	$txt = substr($x,0,10); //ตัดข้อความ เวลาออก 2012-08-05 17:35:20
	$time = substr($x,10); //ตัดข้อความ วันที่ออก 2012-08-05 17:35:20
	$date_array=explode("-",$txt);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];
	
	$m=$thai_m[$m];
	$y=$y;

	$displaydate_eng="$d $m $y / $time";
	return $displaydate_eng;
}
/* Function Date-Time*/
$strendDate2=date("Y-m-d");
$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$thai_month_arr=array(
	"0"=>"",
	"1"=>"มกราคม",
	"2"=>"กุมภาพันธ์",
	"3"=>"มีนาคม",
	"4"=>"เมษายน",
	"5"=>"พฤษภาคม",
	"6"=>"มิถุนายน",	
	"7"=>"กรกฎาคม",
	"8"=>"สิงหาคม",
	"9"=>"กันยายน",
	"10"=>"ตุลาคม",
	"11"=>"พฤศจิกายน",
	"12"=>"ธันวาคม"					
);
function thai_date59($time){
	global $thai_day_arr,$thai_month_arr;
	$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
	$thai_date_return.=	"ที่ ".date("j",$time);
	$thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
	$thai_date_return.=	" พ.ศ.".(date("Y",$time)+543);
	$thai_date_return.=	"  ".date("H:i")." น.";
	return $thai_date_return;
}
function Enddatediff($strendDate1,$strendDate2) { 
	if($strendDate1 < $strendDate2){exit();}} // 1 Hour =  60*60 28/4/2559
 function TimeDiff($strTime1,$strTime2) {
	return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
	}
$strendDate1=date("2024-04-04");
Enddatediff($strendDate1,$strendDate2);
?>