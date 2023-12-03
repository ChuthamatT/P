<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include "config.ini.php";
$curdate=getcurdate();

$sql=" update borrow set status=2,rtn_date='$curdate' where id=$_GET[bid] ";
$result=mysqli_query($con,$sql) or die('Update Error');

//mws_message('ทำรายการคืนเรียบร้อย','');
?>