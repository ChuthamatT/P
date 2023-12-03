<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
include "config.ini.php";
 define('br','<br />');


$TbName = $_REQUEST['TbName'];
if(!empty($TbName)){
// ติดต่อฐานข้อมูล โดยใช้คำสั่ง include 

// วันเดือนปี เวลาปัจจุบัน
$DateTime = date("Y-m-d H:i:s", mktime(date("H")+0, date("i")+0, date("s")+0, date("m")+0 , date("d")+0, date("Y")+0));

//***** ----  เริ่มตารางใหม่ ---- ****************************************************************************************************************** procurment //
if($TbName=="procurment"){
 //echo $TbName;
	  //#########  procurment #######################################//
	 if($_REQUEST['sql']=="ADD"){ 	
	 	 

 
 
 
 		$CHK = 0;
 
	 //count($_SESSION['sess_num']);
	 $n = count($_POST['chk']);
				for($i=0; $i<$n; $i++){
				

				  	$txtn = $_POST['chk'][$i];
					$num  = $_POST[$txtn.'_num'];
					
					if($num<=0){
						$num = 1;
						} 
				 
						
		if(!is_numeric($num)){ // ตรวจสอบกรอกสินค้าให้ถูก
		 
								echo "กรุณากรอกให้ถูกด้วยนะ1";  exit();
							unset($_SESSION['sessp_id']);
							unset($_SESSION['sess_num']);
								}else if(strpos($_POST['txt_num'][$i],".") !== false){
								echo "กรุณากรอกให้ถูกด้วยนะ2"; exit();
							unset($_SESSION['sessp_id']);
							unset($_SESSION['sess_num']);
								}
								
								
								
										//ส่วนของการตรวจสอบ  
										$sql = mysqli_query($con,"SELECT * FROM procurment WHERE id='".$_POST['chk'][$i]."'");
											$rst = mysqli_fetch_array($sql);
											 $stock = $rst['stock'];
										 	$name = $rst['name'];
											
											if($stock < $num){
											echo  "".$name." ที่ต้องการยืมไม่พอ คงเหลือ ".$stock." <br />"; 
											$CHK = 1;
											continue;
											} 
													
				
					$ID=$_POST['chk'][$i];
					if(count($_SESSION['sessp_id'])=="0"){ 
						 $check=1;
						//ค้นหาว่ามีข้อมูลรหัสอยู่ใน sessp_id  หรือไม่ ถ้าไม่มีให้ check เท่ากับ 1
						}else if (!in_array($ID, $_SESSION['sessp_id'])){
						  $check=1;
						} 
					 
					if($check==1){
							$sql = mysqli_query($con,"SELECT * FROM ".$TbName." WHERE id='".$ID."'");
							$rs1=mysqli_fetch_array($sql);
							  $rs1['id'];
							//ลงทะเบียน session
							
						//	echo $num;
						  	 $_SESSION['sessp_id'][]=$rs1['id']; 
							 $_SESSION['sess_num'][]=$num;
						 
					}
			}
 
 if($CHK==0){
 	echo "<script language='javascript'>";
	echo " parent.$.fancybox.close(); ";
	echo "</script>";	
 }
// ทำให้ข้อมูล array เป็นรูปแบบข้อความ
//echo $not_id = implode(", ", $_SESSION['notID']);
 /*
echo "<script language='javascript'>";
echo " parent.$.fancybox.close(); ";
echo "</script>";	
*/
	 //#########  procurment #######################################//	
	}else if($_REQUEST['sql']=="UPDATE"){ 
		 
		
			  	$n = count($_POST['chk']);
				for($i=0; $i<$n; $i++){
				
				 	$sql = mysqli_query($con,"SELECT * FROM  borrow_detail WHERE tool_id='".$_POST['chk'][$i]."' AND  brw_id='".$_POST['bw_id']."'");
					$rst = mysqli_fetch_array($sql);
					
	
				  	$txtn = $_POST['chk'][$i];
				$rep_num = $_POST[$txtn.'_num'];
				  " ที่ส่งคืน _POST " . $rep_num ;
			   br;
			  	    $num_borrow = $rst['borrow'];
		 
				 	$num_repatriate = $rst['repatriate'];
					
			if($rep_num>$num_borrow){
						echo "".$Title." ที่ส่งคืนไม่ถูกต้อง!";
					}else{
						
				
			$sql2 = mysqli_query($con,"SELECT * FROM ".$TbName." WHERE id = '".$_POST['chk'][$i]."'");
			$rst2 = mysqli_fetch_array($sql2);
			$stock = $rst2['stock'];
		   $rep_num;
		   
		   $price=$_POST['price'];
			
			$up_stock = $stock + $rep_num;
		    $sql_stock = mysqli_query($con,"UPDATE ".$TbName." SET  stock='".$up_stock."' WHERE id = '".$_POST['chk'][$i]."'");
			
		  " ที่ส่งคืน up_numrep " . $up_numrep = $num_repatriate+$rep_num; //  ที่ส่งคืน
			    br;
		  	  "ที่ยืม up_borw " .   $up_borw = $num_borrow-$rep_num; // ที่ยืม
		
		   $sql_stock = mysqli_query($con,"UPDATE borrow_detail SET  repatriate='".$up_numrep."', borrow='".$up_borw."', status='2' WHERE  tool_id = '".$_POST['chk'][$i]."' and  brw_id='".$_POST['bw_id']."'");
			
										
						}
					}
					
		$sql2 = mysqli_query($con,"SELECT * FROM  borrow WHERE b_id='".$_POST['bw_id']."'");		
		$num2 = mysqli_num_rows($sql2);		
			if($num2>0){
				$rs2=mysqli_fetch_array($sql2);
				$b_price=$rs2['price']+$price;
				$sql2_update = mysqli_query($con,"UPDATE borrow SET  price='".$b_price."', insdate='".$DateTime."' WHERE b_id='".$_POST['bw_id']."'");
			
			}		
					
					
		$sql = mysqli_query($con,"SELECT * FROM  borrow_detail WHERE borrow >0 AND  brw_id='".$_POST['bw_id']."'");
		$num = mysqli_num_rows($sql);		
				if($num<=0){
					$sql_update = mysqli_query($con,"UPDATE borrow SET  status='2'  WHERE b_id='".$_POST['bw_id']."'");
					}	
				echo "บันทึกข้อมูลการส่งคืนแล้ว";
				exit();
 			
	 //#########  procurment #######################################//	
	}else if($_REQUEST['sql']=="SESS_DEL"){ 
					$ID=$_REQUEST['ID'];
				for($i=0; $i<count($_SESSION['sessp_id']);$i++) {
					// ค้นหา session  ที่ต้องการลบ
					if(!in_array($_SESSION['sessp_id'][$i], $ID)){
						$_GET['temp_id'][]=$_SESSION['sessp_id'][$i];
						$_GET['temp_num'][]=$_SESSION['sess_num'][$i];			
						}
				} // จบ for
				// ลบ session 
				$_SESSION['sessp_id']=$_GET['temp_id'];
				$_SESSION['sess_num']=$_GET['temp_num'];
				exit("<script>window.location='add_borrow.php';</script>");	
	//#########  procurment #######################################//	
	}else if($_REQUEST['sql']=="DEL"){ 


	 }else{
	 exit("<script>alert('error : ค้นหา SQL ตาราง ".$TbName." ไม่เจอ!');(history.back());</script>");
	 }

		

		
		
//***** ----  เริ่มตารางใหม่ borrow ---- ******************************************************************************************************************  	
}else if($TbName=="borrow"){ 

	  //#########  procurment #######################################//
	 if($_REQUEST['sql']=="ADD"){ 	
		$status = "1";
		$DateTime = date("Y-m-d H:i:s", mktime(date("H")+0, date("i")+0, date("s")+0, date("m")+0 , date("d")+0, date("Y")+0));echo "<br />";
		$DateT = explode("-",$_POST['bdate']);
		$DTime = $DateT[2].'-'.$DateT[1].'-'.$DateT[0].' '.$_POST['txt_Time'];
		
  
 	$price=0;
	//เพิ่มข้อมูลลงในตารางโดยส่งค่ามาจาก ฟอร์ม
	$sql_insert = mysqli_query($con,"INSERT INTO ".$TbName."  VALUES "
			."(0,
			'".$_POST['identity']."', 
			'".$_POST['flname2']."', 
			'".$_POST['txt_allow']."', 
			'".$_POST['txt_note']."', 
			'".$_POST['teacher']."', 
			'".$status."', 
			'".$DTime."', 
 			'', 
			'".$DateTime."')");		
			
			
				if($sql_insert){	
					$last_id = mysqli_insert_id($con);	
					
					for($i=0;$i<count($_SESSION['sessp_id']);$i++){
					 
					 
						$status = "1";
						$sql_insert = mysqli_query($con,"INSERT INTO borrow_detail VALUES ('".$last_id."', 
																																 '".$_SESSION['sessp_id'][$i]."', 
																																 '".$_SESSION['sess_num'][$i]."', 
																																 '0',
																																 '".$status."')");
				 																		 
						$sql2 = mysqli_query($con,"SELECT * FROM procurment WHERE id = '".$_SESSION['sessp_id'][$i]."'");
										$rst2 = mysqli_fetch_array($sql2);
										$stock = $rst2['stock'];
									  	$up_stock = $stock - $_SESSION['sess_num'][$i];
						  
					 $sql_stock = mysqli_query($con,"UPDATE procurment  SET  stock='".$up_stock."' WHERE id = '".$_SESSION['sessp_id'][$i]."'");
																																 
																																 
																																} // end for

																															//ลบ session
unset($_SESSION['sess_num']);
unset($_SESSION['sessp_id']);
														
 
																															exit("<script>alert('บันทึกข้อมูลการยืมแล้ว');window.location='borrow.php?stt_p=1';</script>");	
																															}else{
																															exit("<script>alert('Error : บันทึกข้อมูลไม่ได้! ');(history.back());</script>");
																															}


	 }else{
	 exit("<script>alert('error : ค้นหา SQL ตาราง ".$TbName." ไม่เจอ!');(history.back());</script>");
	 }
	 
	 
	 
	 

//######### -----------------จบ--เริ่มตารางใหม่ -ชื่อตารางไม่ตรงกับที่กำหนดไว้-----------------  #######################################//		
}else{
	exit("<script>alert('ชื่อตารางไม่ตรงกับที่กำหนดไว้! ');(history.back());</script>");
	}
	
//######### -----------------จบ--------------------  #######################################//	
}else{
exit("<script>alert('ไม่พบ ชื่อตาราง ที่ส่งมาด้วย!');(history.back());</script>");
}	
	
//######### -- สคริปใช้บ่อย --- #########//
$TxtMsG = "สคริปใช้บ่อย";
if(empty($TxtMsG)){
	exit("<script>alert(' ข้อความ !');(history.back());</script>");
	exit("<script>alert('ข้อความ');window.location='PageLink.php';</script>");	
	exit("<script>window.location='PageLink.php';</script>");	
	}
//######### -- สคริปใช้บ่อย --- #########//
?>


</body>
</html>
