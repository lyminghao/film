<?php
$dst_path = '5.jpg';  
 //创建图片的实例
$dst = imagecreatefromstring(file_get_contents($dst_path)); 
 //打上文字
$font = 'simhei.ttf';//字体
$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//字体颜色
$str1 = iconv('GB2312','UTF-8','地点'); 
$str2 = iconv('GB2312','UTF-8','时间'); 
$str3 = iconv('GB2312','UTF-8','活动'); 
$str4 = iconv('GB2312','UTF-8','座位'); 
$str5 = iconv('GB2312','UTF-8','票号'); //str分别代表需要从数据库中取出的数据
$str6 = iconv('GB2312','UTF-8','日期'); 
imagefttext($dst, 50, 0, 200, 350, $black, $font, $str1); 
imagefttext($dst, 50, 0, 200, 500, $black, $font, $str2); 
imagefttext($dst, 50, 0, 200, 650, $black, $font, $str3); 
imagefttext($dst, 50, 0, 100, 925, $black, $font, $str4);  
imagefttext($dst, 50, 0, 800, 350, $black, $font, $str5); 
imagefttext($dst, 50, 0, 800, 500, $black, $font, $str6); 
imagefttext($dst, 50, 0, 800, 670, $black, $font, $str2);
imagefttext($dst, 50, 0, 800, 825, $black, $font, $str3); 
imagefttext($dst, 50, 0, 800, 985, $black, $font, $str4);  
 //输出图片
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
        header('Content-Type: image/jpg');
        imagejpeg($dst);
   
 imagedestroy($dst);

?>