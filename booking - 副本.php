<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./image/favicon.ico">

    <title>数字学习空间-东师净月图书馆</title>

    <link href="./bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap-3.3.4-dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body role="document">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="color:#FFF" href="#">『数字学习空间』座位预定系统</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li>
            	<a href="person.php">个人主页</a>
            </li>
            <li>
            	<a href="mytickets.php">查看预订</a>
            </li>
            <li>
            	<a href="contpeople.php">管理联系人</a>
            </li>
            <li>
            	<a href="manageinfo.php">账号设置</a>
            </li>
          </ul>
          <div style="float:right; line-height:50px; color:#FFF">
            欢迎你，
            <?php
    	 		session_start();
		 		if(isset($_SESSION['username']) == false){
					echo "<script language='javascript' type='text/javascript'>";
					echo "alert('请先登陆！')";
					echo "</script>";
					
					$url = "index.php";
					echo "<script language='javascript' type='text/javascript'>";
  					echo "window.location.href='$url'";
  					echo "</script>";
		 		}
	  	 		else if(isset($_GET['id']) == false){
					echo "<script language='javascript' type='text/javascript'>";
					echo "alert('请先选择活动！')";
					echo "</script>";
							
					$url = "person.php";
					echo "<script language='javascript' type='text/javascript'>";
  					echo "window.location.href='$url'";
  					echo "</script>";
				}
				else echo $_SESSION['username'];
			?>
            ！
            <a href="destroy.php" style="color:#FFF">退出</a>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container theme-showcase" role="main">
      
	  <div class="page-header">
        <h1></h1>
      </div>
      <div class="alert alert-success" role="alert">
      	<?php
			$con = mysql_connect("localhost","root","");
			if(!$con){
  				die('Error! Could not connect: ' . mysql_error());
  			}
			$sql = "SELECT * FROM movie";
			mysql_query('set names UTF8;');
			mysql_select_db("film");
    		$result = mysql_query($sql);
			$flag = false;
			$movid = $_GET['id'];
    		while($row = mysql_fetch_array($result)){
				if($row[0] == $movid){
					$name = $row[1];
					$year = $row[2];
					$month = $row[3];
					$date = $row[4];
					$hour = $row[5];
					$minute = $row[6];
					$flag = true;
					break;
				}
			}
			
			if($flag == false){
				echo "<script language='javascript' type='text/javascript'>";
				echo "alert('本活动不可预订！')";
				echo "</script>";
					
				$url = "person.php";
				echo "<script language='javascript' type='text/javascript'>";
  				echo "window.location.href='$url'";
  				echo "</script>";
			}
			else{
				echo "<strong>您正在预定 《 $name 》&nbsp;的座位，放映时间： $year 年 $month 月 $date 日";
				if($minute < 10) echo " $hour : 0$minute </strong>";
				else echo " $hour : $minute </strong>";
			}
		?>
      </div>
      <div>
      <br><br><br>
      <div class="alert alert-info" role="alert" style="font-size:16px; text-align:center">
        <strong>屏 &nbsp;&nbsp;&nbsp;&nbsp; 幕</strong>
      </div>
      <br><br>
      <form>
      <?php
	  	 
		 $sqls = "SELECT * FROM booking";
         $num = 0;
		 $x = 0;
         
		 for($i = 1; $i <= 10; $i++){
			 if($i == 6){
				 echo "<p>&nbsp;</p>";
			 }
			 echo "<p style=\"text-align:center\">";
			 $flag = false;
			 for($j =1; $j <= 13; $j++){
				 if(($i==1 && $j == 11) || ($i>=2 && $i<=4 && $j==12) || ($i>=5 && $i<=10 && $j==13)){
				    echo "<br>";
					break;
				 }
				 else{
	                //$x = 10 - $j;
	                if($i==1){
						$x = 11 - $j;
					}
					else if($i>=2 && $i<=4){
						$x = 12 - $j;
					}
					else if($i>=5 && $i<=10){
						$x = 13 - $j;
					}
					
					$res = mysql_query($sqls);
		 			$f = false;
    	 			while($r = mysql_fetch_array($res)){
						if($r[1] == $movid && $r[4] == $i && $r[5] == $x){
							$f = true;
							break;
						}
					}
					if($f == false) 
						echo "<button type=\"button\" class=\"btn btn-success\" style=\"width:95px\" onClick=\"javascript:window.location.href='processbook.php?id=$movid&r=$i&c=$x'\">".$i."排".$x."座</button>";
					else echo "<button type=\"button\" class=\"btn btn-danger\" style=\"width:95px\" disabled=\"true\">".$i."排".$x."座</button>";
				 }
			 }
			 echo "</p>";
		 }
		   
	  ?>
      </form>
      </div>
      
      </br>
       </br></br>
      
      <div class="well">
        <p style="text-align:center">版权所有 2010-2015 &copy; 东师净月图书馆 数字学习空间</p>
        <p style="text-align:center">Designed &amp; Powered by lyminghao etc.</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./Theme Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
  

<div id="global-zeroclipboard-html-bridge" class="global-zeroclipboard-container" title="" style="position: absolute; left: 0px; top: -9999px; width: 15px; height: 15px; z-index: 999999999;" data-original-title="复制到剪贴板">      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="global-zeroclipboard-flash-bridge" width="100%" height="100%">         <param name="movie" value="/assets/flash/ZeroClipboard.swf?noCache=1429082438738">         <param name="allowScriptAccess" value="sameDomain">         <param name="scale" value="exactfit">         <param name="loop" value="false">         <param name="menu" value="false">         <param name="quality" value="best">         <param name="bgcolor" value="#ffffff">         <param name="wmode" value="transparent">         <param name="flashvars" value="trustedOrigins=v3.bootcss.com%2C%2F%2Fv3.bootcss.com%2Chttp%3A%2F%2Fv3.bootcss.com">         <embed src="/assets/flash/ZeroClipboard.swf?noCache=1429082438738" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="100%" height="100%" name="global-zeroclipboard-flash-bridge" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="trustedOrigins=v3.bootcss.com%2C%2F%2Fv3.bootcss.com%2Chttp%3A%2F%2Fv3.bootcss.com" scale="exactfit">                </object></div><svg xmlns="http://www.w3.org/2000/svg" width="1140" height="500" viewBox="0 0 1140 500" preserveAspectRatio="none" style="visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs></defs><text x="0" y="53" style="font-weight:bold;font-size:53pt;font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle">Thirdslide</text></svg></body></html>