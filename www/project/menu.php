<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if ($utype==1) { //ผู้ดูแลระบบ  ?> 
<ul>
	 <li><a href="main.php">หน้าแรก</a></li>
	<li><a href="#">จัดการข้อมูล<?php echo $Title; ?></a>
    <div>
  		<ul>
        	<li><a href="sup_type.php">ประเภทกีฬา</a></li>
            <li><a href="procurment.php">รายการ<?php echo $Title; ?></a></li>
  		</ul>
        </div>
     </li>

       <li><a href="#">รายการยืม - คืน<?php echo $Title; ?></a>
       <div>
  		<ul>
            <li><a href="borrow.php?stt_p=1">รายการยืม<?php echo $Title; ?></a></li>
			<li><a href="borrow.php?stt_p=2">รายการคืน<?php echo $Title; ?></a></li>
            
  		</ul>
        </div>
     </li>
<//li><//a href="#">รายการยืม<//a>
	 <li><a href="member.php">ข้อมูลสมาชิก</a></li>
    <li><a href="user_info.php">ข้อมูลผู้ใช้งาน</a></li>
    <li><a href="#">รายงาน</a>
    <div>
  		<ul>

            <li><a href="rpt3.php?stt_p=1">รายงานการยืม <?php echo $Title; ?></a></li>
			<li><a href="rpt3.php?stt_p=2">รายงานการคืน <?php echo $Title; ?></a></li>
			<li><a href="rpt4_4.php" target="_new">รายงานผู้ใช้งานระบบ</a></li>
  		</ul>
        </div>
     </li>
     	<li><a href="ch_pass.php">เปลี่ยนรหัสผ่าน</a></li>
	<li><a href="logout.php">ออกจากระบบ</a></li>
</ul>
<!-- <?php } else if ($utype==2) { //หัวหน้างาน ?>
<ul>

	<li><a href="bandr.php">รายการยืม - คืน<?php echo $Title; ?></a>
	<div>
  		<ul>
            <li><a href="borrow.php?stt_p=1">รายการยืม<?php echo $Title; ?></a></li>
            <li><a href="borrow.php?stt_p=2">รายการคืน<?php echo $Title; ?></a></li>
  		</ul>
        </div>
	</li>

	<li><a href="member.php">ข้อมูลสมาชิก</a></li>
     <li><a href="#">รายงาน</a>
    <div>
  		<ul>
       
            <li><a href="rpt3.php?stt_p=1">รายงานการยืม <?php echo $Title; ?></a>
			<li><a href="rpt3.php?stt_p=2">รายงานการคืน <?php echo $Title; ?></a>
			</li>
            <li><a href="rpt4_4.php" target="_new">รายงานผู้ใช้งานระบบ</a></li>
  		</ul>
        </div>
     </li>
	<li><a href="ch_pass.php">เปลี่ยนรหัสผ่าน</a></li>
	<li><a href="logout.php">ออกจากระบบ</a></li>
</ul>
<?php } else if ($utype==3) { //เจ้าหน้าที่ ?>
<ul>
 
 
            <li><a href="rpt3.php?stt_p=1">รายงานการยืม <?php echo $Title; ?></a>
			<li><a href="rpt3.php?stt_p=2">รายงานการคืน <?php echo $Title; ?></a>
       <div>
  		<ul>
            <li><a href="borrow.php?stt_p=1">รายการยืม<?php echo $Title; ?></a></li>
			<li><a href="borrow.php?stt_p=2">รายการคืน<?php echo $Title; ?></a></li>
  		</ul>
        </div>
     </li>
	 <li><a href="member.php">ข้อมูลสมาชิก</a></li>
    <li><a href="#">รายงาน</a>
    <div>
  		<ul>
        	
            <li><a href="rpt3.php?stt_p=1">รายงานการยืม <?php echo $Title; ?></a>
			<li><a href="rpt3.php?stt_p=2">รายงานการคืน <?php echo $Title; ?></a>
            <li><a href="rpt4_4.php" target="_new">รายงานผู้ใช้งานระบบ</a></li>
  		</ul>
        </div>
     </li>
	<li><a href="ch_pass.php">เปลี่ยนรหัสผ่าน</a></li>
	<li><a href="logout.php">ออกจากระบบ</a></li>
</ul>
<?php } ?> -->