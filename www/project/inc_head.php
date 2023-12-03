<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="2">
            <tr>
              <td width="174"><img src="images/logo.png" width="150" height="150" /></td>
              <td width="465"><?php echo $sys_head; ?></td>
              <td width="273" valign="bottom">
              <table width="270" border="0" cellspacing="2" cellpadding="0">
                <tr>
                  <td style="background:url(images/bgh1.png)" height="70">
                  <table width="250" border="0" align="right" cellpadding="0" cellspacing="2">
                    <tr>
                      <td width="46"><img src="images/icon/group.png" width="24" height="24" /></td>
                      <td width="198">สถานะ:
                        <?php  
				$sql2=" select * from user_type where id=$utype ";
				$result2=mysqli_query($con,$sql2);
				$rs2=mysqli_fetch_array($result2);
				echo $rs2["name"];
			?></td>
                    </tr>
                    <tr>
                      <td><img src="images/icon/1352332937_001_57.png" width="24" height="24" /></td>
                      <td>ชื่อผู้ใช้งาน : <?php echo $uname; ?></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table>
</body>
</html>
