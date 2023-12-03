<?php session_start(); ob_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
unset( $_SESSION['sess_id'] );
unset( $_SESSION['sess_userid'] );
unset( $_SESSION['sess_name'] );
session_regenerate_id();


echo "<script language='javascript'>";
echo " top.window.location = 'index.php'; ";
echo "</script>";
?>
