<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<?php
	session_start();
	unset($_SESSION['stuid']);
	unset($_SESSION['username']);
	
	echo "<script language='javascript' type='text/javascript'>";
	echo "alert('退出成功！')";
	echo "</script>";
					
	$url = "index.php";
	echo "<script language='javascript' type='text/javascript'>";
  	echo "window.location.href='$url'";
  	echo "</script>";
?>