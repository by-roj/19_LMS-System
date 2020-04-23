<?php 
	session_start(); 
	
	//DB 정보 
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	//mysql_connect: 서버에 접속하기 위해 필요 
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
	
	//DB 선택해서 연동 
	mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
	
	//사용자가 입력한 ID와 비밀번호 받아오기 
	$id=$_POST['loginID']; 
	$password=$_POST['loginPASSWORD']; 
	
	//사용자가 입력한 ID 기준으로 DB에 입력되어있는 ID와 비밀번호 받아오기 
	$db_sql="SELECT * FROM users WHERE email='$id' and password='$password'"; 
	//print_r($db_sql); 
	$result = mysqli_query($db_conn, $db_sql); 
	$count = mysqli_num_rows($result);
	$row = mysqli_fetch_row($result);
	
	setcookie('master_id',$row[0]);
	
	if($count == 0) header("Location: login_fail.php");
	else{
		if($row[3] == 0) header("Location: student.php");
		else if($row[3] == 1) header("Location: teacher.php");
	} 
	//header("Location: main.php");
	
	//$row = mysqli_fetch_array($result);
	
	//print_r($row);
	
	/*
	$row=mysqli_fetch_array($result); 
	printf("%s",$row[0]);
	//printf($row); echo $row; 
	*/
	//ID를 DB에서 확인하여 PASSWORD와 같은지 체크 
?>
