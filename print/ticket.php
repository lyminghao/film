<?php

	session_start();
	if(isset($_SESSION['stuid']) == false){
		
		$url = "index.php";
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
		
		exit;
	}

	$dst_path = '55.jpg';
 	//����ͼƬ��ʵ��
	$dst = imagecreatefromstring(file_get_contents($dst_path));
	if(isset($_GET['id']) == true){
		$ok = $_GET['id'];
	}
	if(isset($_SESSION['stuid']) == true){
		$stu = $_SESSION['stuid'];
	}
	
	$dir = "tickets/".sha1(md5(md5(md5($ok)))).".jpg";
	if(is_readable($dir) == true){
		echo "<img src=\" $dir \">";
		exit;
	}
	
	include('phpqrcode/phpqrcode.php');
	// ��ά������
	$data = $ok;
	// ���ɵ��ļ���
	$filename = "qrcodeimg/".$ok.".png";
	// ������L��M��Q��H
	$errorCorrectionLevel = 'L';
	// ��Ĵ�С��1��10
	$matrixPointSize = 4;
	if(is_readable($filename) == false){
		QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
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
		echo "alert('δ�ҵ���ӰƱ��')";
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
	
	if($minute < 10){
		$time = $year."-".$month."-".$date." ".$hour.":0".$minute;
		$tia = $year."-".$month."-".$date;
		$tib = $hour.":0".$minute;
	}
	else{
		$time = $year."-".$month."-".$date." ".$hour.":".$minute;
		$tia = $year."-".$month."-".$date;
		$tib = $hour.":".$minute;
	}
	$seat = $seatrow."��".$seatcol."��";
	
	$font = 'simhei.ttf';//����
	$str = "2011-1-1 12:00";
	$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//��ɫ
	$str1 = iconv('GB2312','UTF-8','����ѧϰ�ռ�');
	$str2 = iconv('GB2312','UTF-8',$time);
	$str3 = $name;
	$str4 = iconv('GB2312','UTF-8',$seat);
	$str5 = iconv('GB2312','UTF-8',$ok);
	$str6 = iconv('GB2312','UTF-8',$tia);
	$str7 = iconv('GB2312','UTF-8',$tib);
	imagefttext($dst, 20, 0, 75, 165, $black, $font, $str1); //place
	imagefttext($dst, 20, 0, 75, 235, $black, $font, $str2); //time
	imagefttext($dst, 20, 0, 75, 310, $black, $font, $str3); //activity name
	imagefttext($dst, 20, 0, 35, 430, $black, $font, $str4); //seat
	imagefttext($dst, 20, 0, 380, 160, $black, $font, $str5); //fj ticket number
	imagefttext($dst, 18, 0, 355, 235, $black, $font, $str6); //fj time.date
	imagefttext($dst, 20, 0, 370, 310, $black, $font, $str7); //fj time.hour
	imagefttext($dst, 12, 0, 355, 385, $black, $font, $str3); //fj activity name
	imagefttext($dst, 20, 0, 360, 465, $black, $font, $str4);
	
	$qrimg = imagecreatefrompng($filename);
 	imagecopy($dst, $qrimg, 190, 365, 0 ,0, 100, 100);
	//���ͼƬ
	//list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
    //header('Content-Type: image/jpg');
	
    imagejpeg($dst, $dir);
	echo "<img src=\" $dir \">";
 	imagedestroy($dst);
?>