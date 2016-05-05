<!DOCTYPE html>
<html lang="zh-CN" style="">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
    <link href="./image/favicon.ico" mce_href="favicon.ico" rel="bookmark" type="image/x-icon" />
	<link href="./image/favicon.ico" mce_href="favicon.ico" rel="icon" type="image/x-icon" />
	<link href="./image/favicon.ico" mce_href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="./css/reset.79d5f7ca9ad8.css">
	<link rel="stylesheet" type="text/css" href="./css/index.dcdee45bcbe3.css">
	<link rel="stylesheet" type="text/css" href="./css/color.css">
	<title>数字学习空间-座位预定系统</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
}
</style>
</head>

<body class="index" style="height: 753px; display: block;">
	<?php
		session_start();
		if(isset($_SESSION['stuid'])){
			$url = "person.php";
			echo "<script language='javascript' type='text/javascript'>";
  			echo "window.location.href='$url'";
  			echo "</script>";
		}
	?>
	<div id="bg">
    	<div><img src="./image/bgimg.jpg"></div>
	</div>
	<div id="scroll" style="transform: translate3d(0px, 0px, 0px);">
  	<section id="login" style="height: 753px;">
    <div class="floor1">
      <div class="logo">
        <h1>
            <a href="http://www.library.nenu.edu.cn" title="东师净月图书馆">
                <img src="./image/liblogo2.png" alt="数字学习空间-座位预定系统">
            </a>
        </h1>
      </div>
      <div class="text">
        <div>
            <p>东师净月图书馆</p><br>
            <p>『 数字学习空间 』座位预定系统</p>
        </div>
      </div>
    </div>
    <div class="floor2">
        <div class="no_login">
          <h2>登 录</h2>
          <form id="index_login" action="login.php" method="post">
            <ul>
              <li style="position: relative;">
                <input class="user_name" type="text" id="index_user_name" name="username" value="" data-complete="" placeholder="用户名" autocomplete="off" required>
              </li>
              <li>
                <input type="password" value="" name="password" placeholder="密码" required>
              </li>
              <li class="cf">
                <a class="fr" id="forget" href="#" title="忘记密码">忘记密码?</a>
              </li>
              <li>
                <button id="index_login_btn" type="submit" class="color_p_btn">立刻登录</button>
              </li>
            </ul>
          </form>
          <div class="register">
            <p>新用户？快速注册 &gt;&gt;<a class="color_c" id="index_register_btn" href="register.html" title="">立即注册</a></p>
          </div>
    </div>
	</section>
	</div>
</body>
</html>