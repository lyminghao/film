<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<?php
	
	$flag = true;
	
	if(isset($_POST['username']) == false || isset($_POST['password']) == false || isset($_POST['confirmpwd']) == false || isset($_POST['name']) == false || isset($_POST['gender']) == false || isset($_POST['school']) == false || isset($_POST['number']) == false || isset($_POST['email']) == false || isset($_POST['phone']) == false){
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('请将信息填写完整！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$confirmpwd = trim($_POST['confirmpwd']);
	$name = trim($_POST['name']); //姓名
	$gender = trim($_POST['gender']); //性别 1:male 2:female
	$school = trim($_POST['school']); //学院
	$number = trim($_POST['number']); //学号
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	
	if($username == "" || $password == "" || $confirmpwd == "" || $name == "" || $gender == "" || $school =="" || $number == "" || $email == "" || $phone ==""){
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('请将信息填写完整！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	if($password != $confirmpwd){ // password not match
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('两次输入密码不一致！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	$con = mysql_connect("localhost","root","");
	if(!$con){
  		die('Error! Could not connect: ' . mysql_error());
  	}
	$sql = "SELECT * FROM student";
	mysql_query('set names UTF8;');
	mysql_select_db("film");
    $result = mysql_query($sql);
	
    while($row = mysql_fetch_array($result)){ //username exist
		if($row[1] == $username){
			$flag = false;
			$url = "register.html";
			echo "<script language='javascript' type='text/javascript'>";
			echo "alert('该用户名已被注册！')";
			echo "</script>";
			
			echo "<script language='javascript' type='text/javascript'>";
  			echo "window.location.href='$url'";
  			echo "</script>";
		}
	}
	
	if(@preg_match("/^[0-9a-zA-Z_]{6,12}$/", $username) == 0){ //username invalid
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('用户名格式错误，必须为6-12位英文字母或数字！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	if(@preg_match("/^[0-9a-zA-Z_]{6,12}$/", $password) == 0){ //password invalid
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('密码格式错误，必须为6-12位英文字母或数字！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	//convert to md5
	$password = md5($password);
	
	if(@preg_match("/[0-9a-zA-Z_]+/", $name) != 0 || strlen($name) > 12){ //name invalid
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('姓名格式错误！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	if($gender != "1" && $gender != "2"){ //gender invalid
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('请选择性别！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	else{
		$sex = "Unknown";
		if($gender == "1"){
			$sex = "男";
		}
		else{
			$sex = "女";
		}
	}
	
	if($school!="1" && $school!="2" && $school!="3" && $school!="4" && $school!="5" && $school!="6" && $school!="7" && $school!="8" && $school!="9" && $school!="10" && $school!="11" && $school!="12" && $school!="13" && $school!="14" && $school!="15" && $school!="16" && $school!="17" && $school!="18" && $school!="19" && $school!="20" && $school!="21" && $school!="22" && $school!="23"){ //school invalid
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('请选择学院！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	else{
		switch($school){
			case "1":
				$schoolstr = "教育学部";
				break;
			case "2":
				$schoolstr = "政法学院";
				break;
			case "3":
				$schoolstr = "经济学院";
				break;
			case "4":
				$schoolstr = "商学院";
				break;
			case "5":
				$schoolstr = "文学院";
				break;
			case "6":
				$schoolstr = "历史文化学院";
				break;
			case "7":
				$schoolstr = "外国语学院";
				break;
			case "8":
				$schoolstr = "音乐学院";
				break;
			case "9":
				$schoolstr = "美术学院";
				break;
			case "10":
				$schoolstr = "马克思主义学部";
				break;
			case "11":
				$schoolstr = "数学与统计学院";
				break;
			case "12":
				$schoolstr = "计算机科学与信息技术学院";
				break;
			case "13":
				$schoolstr = "信息与软件工程学院";
				break;
			case "14":
				$schoolstr = "物理学院";
				break;
			case "15":
				$schoolstr = "化学学院";
				break;
			case "16":
				$schoolstr = "生命科学学院";
				break;
			case "17":
				$schoolstr = "地理科学学院";
				break;
			case "18":
				$schoolstr = "环境学院";
				break;
			case "19":
				$schoolstr = "体育学院";
				break;
			case "20":
				$schoolstr = "传媒科学学院";
				break;
			case "21":
				$schoolstr = "远程与继续教育学院";
				break;
			case "22":
				$schoolstr = "民族教育学院";
				break;
			case "23":
				$schoolstr = "留学生教育学院";
				break;
			default:
				$schoolstr = "Unknown";
		}
	}
	
	if(@preg_match("/^[0-9]+$/", $number) == 0){ //stu-number invalid
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('学号格式错误！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}

	if(@preg_match("/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/", $email) == 0){ //email invalid
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('电子邮箱格式错误！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	if(@preg_match("/^1[358][0-9]{9}$/", $phone) == 0){ //phone number invalid
		$flag = false;
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('手机号码格式错误！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	
	$sqlstr = "INSERT INTO `film`.`student` (`stuid`, `username`, `password`, `name`, `number`, `gender`, `school`, `email`, `phone`) VALUES (NULL, '$username', '$password', '$name', '$number', '$sex', '$schoolstr', '$email', '$phone');";
	/*INSERT INTO  `film`.`student` (`stuid` ,`username` ,`password` ,`name` ,`number` ,`gender` ,`school`,`email` ,`phone`)VALUES (NULL ,  'lyminghao',  'e10adc3949ba59abbe56e057f20f883e',  '刘明昊',  '2013012455',  '男',  '计算机科学与信息技术学院',  'lyminghao@qq.com',  '15543016096');
	*/
	//echo $sqlstr;
	if($flag) $res = mysql_query($sqlstr);
	if($res == true){
		$url = "index.php";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('注册成功，请登录！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}
	else{
		$url = "register.html";
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('注册失败，请与管理员联系！')";
		echo "</script>";
		
		echo "<script language='javascript' type='text/javascript'>";
  		echo "window.location.href='$url'";
  		echo "</script>";
	}

?>