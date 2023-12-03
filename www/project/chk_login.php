<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "config.ini.php";
include "cke_date_func.php";
$curdate=getcurdate();

$sql=" select * from user_info where username='$_POST[user]' and password='$_POST[pass]' ";
$result=mysqli_query($con,$sql) or die('Select Error!!');

if (mysqli_num_rows($result) > 0) {
	$rs=mysqli_fetch_array($result);
		
	$_SESSION['sess_id']=session_id();
	$_SESSION['sess_userid']=$rs['id'];
	$_SESSION['sess_name']=$rs["fname"]."".$rs["lname"];
	$_SESSION["sess_type"]=$rs["type"];
	$dtime = date("Y-m-d");
	 $sql = mysqli_query($con,"UPDATE user_info SET  ll_date='".$dtime."' WHERE id = '".$_SESSION['sess_id']."'");
	if ($rs["type"]==1 or $rs["type"]==3) { 
		mws_goto('main.php');
	} else if ($rs["type"]==2) {
		mws_goto('main.php');
	}
	
} else {
	mws_message('Wrong username or password!!','index.php');
}
session_write_close();
?>