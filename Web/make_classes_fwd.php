<?php
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	$class_id = $_POST['classID'];
	$class_name = $_POST['class_name'];
	$class_capacity = $_POST['class_capacity'];
	$master_id = $_COOKIE['master_id'];

	//mysql_connect: 서버에 접속하기 위해 필요 
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
	
	//DB 선택해서 연동 
	mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
	
	$db_sql = "SELECT * FROM CLASSES WHERE CLASS_ID='$class_id'";
	$result = mysqli_query($db_conn, $db_sql);
	$count = mysqli_num_rows($result);
	
	if($count != 0){
		echo "<script type=\"text/javascript\">alert(\"중복된 class id입니다. 확인해 주세요\");history.back();</script>";
	}else{
		$insert_sql = "INSERT INTO CLASSES VALUES($class_id,'$class_name',$class_capacity,'$master_id')";
		$make_classes_result = mysqli_query($db_conn,$insert_sql);
	
		header("Location: teacher.php");
	}
?>