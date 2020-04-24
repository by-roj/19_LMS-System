<?php
	$class_id = $_GET['class_id_fwd'];
	$class_name = $_GET['class_name_fwd'];
	
	$lecture_id = $_GET['lecture_id_fwd'];
	$lecture_name = $_GET['lecture_name_fwd'];
			
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
	
	mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
	
	$db_sql = "DELETE FROM LECTURES WHERE LECTURE_ID = '$lecture_id'";
	$result = mysqli_query($db_conn, $db_sql);
	
	if($result) {
		echo "<script type=\"text/javascript\">alert(\"".$lecture_id." ".$lecture_name." 강의가 삭제되었습니다\");location.href=\"tec_lecture_list.php?class_id_fwd=".
				$class_id."&class_name_fwd=".$class_name."\";</script>";
	}
?>