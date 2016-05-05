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
            <li class="active">
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
	  <div class="page-header">
        <h1>&gt;&gt; 我的预订</h1>
      </div>
      <div class="alert alert-info" role="alert" style="font-size:16px;">
        <strong>点击相应影片名称可查看影票。</strong>
      </div>
      <div class="row">
      <?php
		 	$con = mysql_connect("localhost","root","");
			if(!$con){
  				die('Error! Could not connect: ' . mysql_error());
  			}
	
    		$sql = "SELECT * FROM booking ORDER BY bookid DESC";
	
			mysql_query('set names UTF8;');
			mysql_select_db("film");
    		$result = mysql_query($sql);
			$flag = false;
    		while($row = mysql_fetch_array($result)){
				if($row[2] == $_SESSION['stuid']){
					$sqlstr = "SELECT * FROM movie";
					$mv = mysql_query($sqlstr);
					while($r = mysql_fetch_array($mv)){
						if($row[1] == $r[0]){
							$flag = true;
							echo "<div class=\"panel panel-primary\">";
							echo "<div class=\"panel-heading\">";
							echo "<h3 class=\"panel-title\"><a href=\"\\film\\print\\ticket.php?id=$row[0]\">《 $r[1] 》</a></h3>";
							echo "</div>";
							echo "<div class=\"panel-body\">";
							if($r[6] < 10) echo "时间：$r[2] 年 $r[3] 月 $r[4] 日 $r[5] : 0$r[6]<br>";
							else echo "时间：$r[2] 年 $r[3] 月 $r[4] 日 $r[5] : 0$r[6]<br>";
							echo "座位：$row[4] 排 $row[5] 列";
							echo "</div>";
							echo "</div>";
							break;
						}
					}
				}
			}
			if($flag == false){
				echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>您尚未预订任何场次</strong></div>";
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