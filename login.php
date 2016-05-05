<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<?php
	
	$con = mysql_connect("localhost","root","");
	if(!$con){
  		die('Error! Could not connect: ' . mysql_error());
  	}
	
	$user = $_POST['username'];
	$pwd = $_POST['password'];
	$pwd = md5($pwd);
	
	//echo "$user";
	//echo "<br>";
	//echo "$pwd";
	
    $sql = "SELECT * FROM student";
	
	mysql_query('set names UTF8;');
	mysql_select_db("film");
    $result = mysql_query($sql);
	
	$flag = false;
    while($row = mysql_fetch_array($result)){
		if($row[1] == $user && $row[2] == $pwd){
			session_start();
			$_SESSION['stuid'] = $row[0];
			$_SESSION['username'] = $row[1];
			$flag = true;
			break;
		}
	}
	
	if($flag == true){
		$url = "person.php";
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	else{
		$url = "index.php";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('账号或密码错误，请重新登陆！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	//echo "<h1>$stuid</h1>";
	//session_start();
	//$_SESSION['age']=80;
?>