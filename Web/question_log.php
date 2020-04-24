<?php
	$answer = $_GET['answer'];
	$master_id = $_COOKIE['master_id'];

	$lecture_id = $_GET['lecture_id'];
	$question_id = $_GET['question_id'];
?>
<html>
    <head>
        <title>team1_question_log</title>
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
				
				$db_sql = "SELECT * FROM QUESTIONS WHERE LECTURE_ID = '$lecture_id' AND QUESTION_ID = '$question_id'";
				$questions_result = mysqli_query($db_conn, $db_sql);
				$info = mysqli_fetch_array($questions_result);
				
				$q_answer = $info['answer'];
				
				if(!strcmp($q_answer, $answer)){
					// 일치
					$result = 1;
				}else{
					// 불일치
					$result = 0;
				}
				
				$db_sql2 = "SELECT * FROM QUESTION_LOG WHERE QUESTION_ID = '$question_id'";
				$log_result = mysqli_query($db_conn, $db_sql2);
				
				$chk = 0;		// 현재 user_id가 있는지 확인 (중복 제출 여부)
				while($log_info = mysqli_fetch_array($log_result)) {
					if($log_info['user_id'] == $master_id){
						$chk = 1;
					}
				}
				
				if($chk == 0) {
					$db_sql3 = "INSERT INTO QUESTION_LOG VALUES('$question_id', '$master_id', '$q_answer', '$answer', '$result')";
					$result3 = mysqli_query($db_conn, $db_sql3);
				}else {
					$db_sql4 = "UPDATE QUESTION_LOG SET S_ANSWER = '$answer', RESULT = '$result'
								WHERE QUESTION_ID = '$question_id' AND USER_ID = '$master_id'";
					$result4 = mysqli_query($db_conn, $db_sql4);
				}
				
				// 실질 난이도
				$rd_result = mysqli_query($db_conn, $db_sql2);
				$rd_count = mysqli_num_rows($rd_result);
				
				$chk2 = 0;
				while($rd_info = mysqli_fetch_array($rd_result)){
					if($rd_info['result'] == 0){
						$chk2 = $chk2 + 1;
					}
				}
				
				$real_diff = $chk2 / $rd_count * 10;
				
				$db_sql3 = "UPDATE QUESTIONS SET REAL_DIFFICULTY = '$real_diff' WHERE QUESTION_ID = '$question_id'";
				$ru_result = mysqli_query($db_conn, $db_sql3);
				
				Header("Location:solve_questions.php?lecture_id_fwd=".$lecture_id."&question_id_fwd=".$question_id."");
			?>
		</fieldset>
	</body>
</html>


