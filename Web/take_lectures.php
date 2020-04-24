<?php
	$master_id = $_COOKIE['master_id'];
	$class_id = $_GET['class_id_fwd'];
	$lecture_id = $_GET['lecture_id_fwd'];
?>

<html>
    <head>
        <title>team1_take_lectures</title>
    </head>
    <body>
		<fieldset>
			<?php
				$db_hostname = "localhost"; 
				$db_user = "root"; 
				$db_password = "yonggoang22"; 
				$db_name = "lms_team1"; 
				
				$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
				
				mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
				
				$db_sql = "SELECT * FROM USER_CLASSES WHERE CLASS_ID = '$class_id' AND USER_ID = '$master_id'";
				$chk_result = mysqli_query($db_conn, $db_sql);
				$chk_count = mysqli_num_rows($chk_result);
				
				if($chk_count != 0){
					$db_sql2 = "SELECT * FROM LECTURES WHERE LECTURE_ID = '$lecture_id'";
					$result = mysqli_query($db_conn, $db_sql2);
					$info = mysqli_fetch_array($result);
					
					$nowtime = (int)date("YmdHis");
					
					if(strtotime($info['start_time']) <= strtotime($nowtime) && strtotime($info['end_time']) >= strtotime($nowtime)) {
						Header("Location:std_question_list.php?lecture_id_fwd=".$lecture_id."&lecture_name_fwd=".$info['name'].""); 
					} else {
						echo "<script type=\"text/javascript\">alert(\"현재 수강 불가능한 강의입니다\");history.back();</script>";
					}
				} else {
					echo "<script type=\"text/javascript\">alert(\"수강 신청하지 않은 과목입니다\");history.back();</script>";
				}
			?>
		</fieldset>
    </body>
</html>