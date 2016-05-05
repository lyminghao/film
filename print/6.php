<?php

	session_start();
	if(isset($_SESSION['stuid']) == false){
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('请先登陆！')";
		echo "</script>";
		
		$url = "index.php";
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}

	$dst_path = '5.jpg';
 	//创建图片的实例
	$dst = imagecreatefromstring(file_get_contents($dst_path));
	if(isset($_GET['id']) == true){
		$ok = $_GET['id'];
	}
	if(isset($_SESSION['stuid']) == true){
		$stu = $_SESSION['stuid'];
	}
	
	$con = mysql_connect("localhost","root","");
	if(!$con){
  		die('Error! Could not connect: ' . mysql_error());
  	}
    $sql = "SELECT * FROM booking";
	mysql_query('set names UTF8;');
	mysql_select_db("film");
    $result = mysql_query($sql);
	$movid = -1;
	while($row = mysql_fetch_array($result)){
		if($row[0] == $ok){
			if($row[2] == $stu){
				$movid = $row[1];
				$seatrow = $row[4];
				$seatcol = $row[5];
			}
			break;
		}
	}
	
	if($movid == -1){
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('未找到该影票！')";
		echo "</script>";
		
		$url = "person.php";
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	$sqlstr = "SELECT * FROM movie";
	$mv = mysql_query($sqlstr);
	while($r = mysql_fetch_array($mv)){
		if($r[0] == $movid){
			$name = $r[1];
			$year = $r[2];
			$month = $r[3];
			$date = $r[4];
			$hour = $r[5];
			$minute = $r[6];
		}
	}
	
	if($minute < 10) $time = $year."-".$month."-".$date." ".$hour.":0".$minute;
	else $time = $year."-".$month."-".$date." ".$hour.":".$minute;
	$seat = $seatrow."排".$seatcol."座";
	
	$font = 'simhei.ttf';//字体
	$str = "2011-1-1 12:00";
	$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//颜色
	$str1 = iconv('GB2312','UTF-8','数字学习空间');
	$str2 = iconv('GB2312','UTF-8',$time);
	//$str3 = iconv('GB2312','UTF-8','a');
	$str3 = $name;
	$str4 = iconv('GB2312','UTF-8',$seat);
	$str5 = iconv('GB2312','UTF-8',$ok);
	$str6 = iconv('GB2312','UTF-8','日期');
	imagefttext($dst, 40, 0, 200, 350, $black, $font, $str1);
	imagefttext($dst, 40, 0, 200, 500, $black, $font, $str2);
	imagefttext($dst, 40, 0, 200, 650, $black, $font, $str3);
	imagefttext($dst, 50, 0, 100, 925, $black, $font, $str4); 
	imagefttext($dst, 50, 0, 800, 350, $black, $font, $str5);
	imagefttext($dst, 50, 0, 800, 500, $black, $font, $str6);
	imagefttext($dst, 20, 0, 800, 670, $black, $font, $str2);
	imagefttext($dst, 20, 0, 800, 825, $black, $font, $str3);
	imagefttext($dst, 50, 0, 800, 985, $black, $font, $str4);
 	//输出图片
	list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
    header('Content-Type: image/jpg');
    imagejpeg($dst);
 	imagedestroy($dst);
?>