<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<?php
	//echo "<h1>".$_GET['id']."</h1>";
	//echo "<h1>".$_GET['r']."</h1>";
	//echo "<h1>".$_GET['c']."</h1>";
	session_start();
	if(isset($_SESSION['stuid']) == false){
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('请先登陆！')";
		echo "</script>";
					
		$url = "index.php";
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
		
		exit;
	}
	
	$movid = (int)$_GET['id'];
	$row = (int)$_GET['r'];
	$col = (int)$_GET['c'];
	//echo "$movid $row $column";
	
	$con = mysql_connect("localhost","root","");
	if(!$con){
  		die('Error! Could not connect: ' . mysql_error());
  	}
	$sql = "SELECT * FROM booking";
	mysql_query('set names UTF8;');
	mysql_select_db("film");
    $result = mysql_query($sql);
	
	//invalid seat number
	$flag = true;
	if($row<1 || $row>10) $flag = false;
	else if($col<1 || $col>13) $flag = false;
	else if($row == 1 && ($col == 11 || $col == 12)) $flag = false;
	else if(($row == 2 || $row == 3 || $row == 4) && $col == 12) $flag = false;
	else if($row != 10 && $col == 13) $flag = false;
	
	//seat have been ordered?
	//have already ordered 2 tickets?
	$haveorder = 0;
    while($r = mysql_fetch_array($result)){
		if($r[1] == $movid && $r[4] == $row && $r[5] == $col){
			$flag = false;
			break;
		}
		if($r[1] == $movid && $r[2] == $_SESSION['stuid']){
			$haveorder++;
			if($haveorder > 1){
				$flag = false;
				break;
			}
		}
	}
	//echo "$flag";
	if($flag == false){
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('预订失败！')";
		echo "</script>";
					
		$url = "person.php";
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
		
		exit;
	}
	else{
		$new = "INSERT INTO `booking` (`bookid` ,`movid` ,`stuid` ,`contid` ,`seatrow` ,`seatcolumn`) VALUES (NULL ,  $movid,  ".$_SESSION['stuid'].",  -1,  $row,  $col);";
		$back = mysql_query($new);
		if($back == true){
			echo "<script language='javascript' type='text/javascript'>";
			echo "alert('预订成功！')";
			echo "</script>";
					
			$url = "mytickets.php";
			echo "<script language='javascript' type='text/javascript'>";
  			echo "window.location.href='$url'";
  			echo "</script>";
		}
		else{
			echo "<script language='javascript' type='text/javascript'>";
			echo "alert('预订失败！')";
			echo "</script>";
					
			$url = "person.php";
			echo "<script language='javascript' type='text/javascript'>";
  			echo "window.location.href='$url'";
  			echo "</script>";
		}
	}
	
?>