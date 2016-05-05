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
            <li class="active">
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
				if(isset($_SESSION['username'])){
					echo $_SESSION['username'];
				}
				else{
					echo "<script language='javascript' type='text/javascript'>";
					echo "alert('请先登陆！')";
					echo "</script>";
					
					$url = "index.php";
					echo "<script language='javascript' type='text/javascript'>";
  					echo "window.location.href='$url'";
  					echo "</script>";
				}
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
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
          <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img alt="First slide [1140x500]" src="./image/poster_1.jpg" data-holder-rendered="true">
          </div>
          <div class="item">
            <img alt="Second slide [1140x500]" src="./image/poster_2.jpg" data-holder-rendered="true">
          </div>
          <div class="item">
            <img alt="Third slide [1140x500]" src="./image/poster_3.jpg" data-holder-rendered="true">
          </div>
        </div>
        <a class="left carousel-control" href="http://v3.bootcss.com/examples/theme/#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="http://v3.bootcss.com/examples/theme/#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      
	  <div class="page-header">
        <h1>&gt;&gt; 正在预定中</h1>
      </div>
      <div class="row">
      
          <?php
		  	
		  	function isok($r, $cy, $cm, $cd, $ch, $ci){
				$year = $r[2];
				$month = $r[3];
				$date = $r[4];
				$hour = $r[5];
				$minute = $r[6];
				
				if($year > $cy) return true;
				else if($year < $cy) return false;
				
				if($month > $cm) return true;
				else if($month < $cm) return false;
				
				if($date > $cd) return true;
				else if($date < $cd) return false;
				
				if($hour > $ch) return true;
				else if($hour < $ch) return false;
				
				if($minute > $ci) return true;
				else if($minute < $ci) return false;
				
				return false;
			}
			
		 	$con = mysql_connect("localhost","root","");
			if(!$con){
  				die('Error! Could not connect: ' . mysql_error());
  			}
	
    		$sql = "SELECT * FROM movie ORDER BY movid DESC";
	
			mysql_query('set names UTF8;');
			mysql_select_db("film");
    		$result = mysql_query($sql);
			
			date_default_timezone_set('prc');
			$cur_y = (int)date("Y", time());
			$cur_m = (int)date("m", time());
			$cur_d = (int)date("d", time());
			$cur_h = (int)date("h", time());
			$cur_i = (int)date("i", time());
			//echo "<h1>$cur_y $cur_m $cur_d $cur_h $cur_i</h1>";
    		while($row = mysql_fetch_array($result)){
				if(isok($row, $cur_y, $cur_m, $cur_d, $cur_h, $cur_i) == true){
					echo "<div class=\"panel panel-primary\">";
					echo "<div class=\"panel-heading\">";
					echo "<h3 class=\"panel-title\"><a href=\"booking.php?id=$row[0] \">《 $row[1] 》</a></h3>";
					echo "</div>";
					echo "<div class=\"panel-body\">";
					if($row[6] >= 10) echo "放映时间：$row[2] 年 $row[3] 月 $row[4] 日 $row[5]: $row[6] <br>";
					else echo "放映时间：$row[2] 年 $row[3] 月 $row[4] 日 $row[5]: 0$row[6] <br>";
					echo "影片简介：$row[7]";
					echo "</div>";
					echo "</div>";
				}
			}
		  ?>   
      </div>
      <div class="page-header">
        <h1>&gt;&gt; 已结束预定</h1>
      </div>
      <div class="row">
        <?php
			$result = mysql_query($sql);
        	while($row = mysql_fetch_array($result)){
				if(isok($row, $cur_y, $cur_m, $cur_d, $cur_h, $cur_i) == false){
					echo "<div class=\"panel panel-danger\">";
					echo "<div class=\"panel-heading\">";
					echo "<h3 class=\"panel-title\"><a href=\"#\">《 $row[1] 》</a></h3>";
					echo "</div>";
					echo "<div class=\"panel-body\">";
					if($row[6] >= 10) echo "放映时间：$row[2] 年 $row[3] 月 $row[4] 日 $row[5]: $row[6] <br>";
					else echo "放映时间：$row[2] 年 $row[3] 月 $row[4] 日 $row[5]: 0$row[6] <br>";
					echo "影片简介：$row[7]";
					echo "</div>";
					echo "</div>";
				}
			}
        ?>
      </div>
	  
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