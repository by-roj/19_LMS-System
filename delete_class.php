<?php
	$class_id = $_GET['class_id_fwd'];
	$class_name = $_GET['class_name_fwd'];
			
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
	
	mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
	
	$db_sql = "DELETE FROM CLASSES WHERE CLASS_ID = '$class_id'";
	$result = mysqli_query($db_conn, $db_sql);
	
	if($result) {
		echo "<script type=\"text/javascript\">alert(\"".$class_id." ".$class_name." 과목이 삭제되었습니다\");location.href=\"teacher.php\";</script>";
	}
?>