<?php
$dst_path = '5.jpg';  
 //����ͼƬ��ʵ��
$dst = imagecreatefromstring(file_get_contents($dst_path)); 
 //��������
$font = 'simhei.ttf';//����
$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//������ɫ
$str1 = iconv('GB2312','UTF-8','�ص�'); 
$str2 = iconv('GB2312','UTF-8','ʱ��'); 
$str3 = iconv('GB2312','UTF-8','�'); 
$str4 = iconv('GB2312','UTF-8','��λ'); 
$str5 = iconv('GB2312','UTF-8','Ʊ��'); //str�ֱ������Ҫ�����ݿ���ȡ��������
$str6 = iconv('GB2312','UTF-8','����'); 
imagefttext($dst, 50, 0, 200, 350, $black, $font, $str1); 
imagefttext($dst, 50, 0, 200, 500, $black, $font, $str2); 
imagefttext($dst, 50, 0, 200, 650, $black, $font, $str3); 
imagefttext($dst, 50, 0, 100, 925, $black, $font, $str4);  
imagefttext($dst, 50, 0, 800, 350, $black, $font, $str5); 
imagefttext($dst, 50, 0, 800, 500, $black, $font, $str6); 
imagefttext($dst, 50, 0, 800, 670, $black, $font, $str2);
imagefttext($dst, 50, 0, 800, 825, $black, $font, $str3); 
imagefttext($dst, 50, 0, 800, 985, $black, $font, $str4);  
 //���ͼƬ
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
        header('Content-Type: image/jpg');
        imagejpeg($dst);
   
 imagedestroy($dst);

?>