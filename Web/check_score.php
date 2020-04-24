<html>
    <head>
        <title>check_score</title>
    </head>
    <body>
	<fieldset>
	<?php
		$master_id = $_COOKIE['master_id'];
		$lecture_id = $_GET['lecture_id_fwd'];
		$lecture_name = $_GET['lecture_name_fwd'];
		
		$db_hostname = "localhost"; 
		$db_user = "root"; 
		$db_password = "yonggoang22"; 
		$db_name = "lms_team1"; 
		
		echo "<legend>".$lecture_id." ".$lecture_name."의 문항별 평균 점수</legend>";
		
		$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
		
		mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
		
		$db_sql = "SELECT * FROM QUESTIONS WHERE LECTURE_ID = '$lecture_id'";
		$q_result = mysqli_query($db_conn, $db_sql);
		
		echo "<table>";

		while($q_info = mysqli_fetch_array($q_result)){
			$question_id = $q_info['question_id'];
			echo "<tr><th>".$question_id." 문항 : </th>";
			
			$db_sql2 = "SELECT * FROM QUESTION_KEYWORDS WHERE QUESTION_ID = '$question_id'";
			$key_result = mysqli_query($db_conn, $db_sql2);
						
			$score = 0;
			while($key_info = mysqli_fetch_array($key_result)){
				$score = $score + $key_info['score_portion'];
			}
			
			$db_sql3 = "SELECT * FROM QUESTION_LOG WHERE QUESTION_ID = '$question_id'";
			$log_result = mysqli_query($db_conn, $db_sql3);
			$log_count = mysqli_num_rows($log_result);
						
			$chk = 0;
			while($log_info = mysqli_fetch_array($log_result)){
				if($log_info['result'] == 1){
					$chk = $chk + 1;
				}
			}
			
			if($log_count != 0){
				$average_score = $chk / $log_count * $score;
			} else{
				$average_score = 0;
			}
			echo "<td>".$average_score."점</td></tr>";	
		}
		
		echo "</table>";
	?>
	</fieldset>
	
	<fieldset>
	<?php
		echo "<legend>학생별 점수</legend>";
		echo "<table>";
		
		$db_sql2 = "SELECT * FROM USERS WHERE TYPE=0";
		$s_result = mysqli_query($db_conn, $db_sql2);
		
		while($s_info = mysqli_fetch_array($s_result)){
			$score2 = 0;
			
			$std_id = $s_info['user_id'];
			echo "<tr><th>user_id : </th><td>".$std_id."</td></tr>";
			
			$db_sql5 = "SELECT * FROM QUESTIONS WHERE LECTURE_ID = '$lecture_id'";
			$result5 = mysqli_query($db_conn, $db_sql5);
			
			while($info5 = mysqli_fetch_array($result5)){
				$question_id2 = $info5['question_id'];
				
				echo "<tr><td></td><td>question_id : </td><td>".$question_id2."</td>";
				
				$db_sql4 = "SELECT * FROM QUESTION_KEYWORDS WHERE QUESTION_ID = '$question_id2'";	// 총 배점 구하기
				$k_result = mysqli_query($db_conn, $db_sql4);
				$score2 = 0;
				while($k_info = mysqli_fetch_array($k_result)){
					$score2 = $score2 + $k_info['score_portion'];
				}
				
				$db_sql3 = "SELECT * FROM QUESTION_LOG WHERE USER_ID = '$std_id' AND QUESTION_ID = '$question_id2'";		// result 가져오기
				$l_result = mysqli_query($db_conn, $db_sql3);
				
				$score3 = 0;
				while($info3 = mysqli_fetch_array($l_result)){
					$score3 = $score2 * $info3['result'];
				}
				
				echo "<td></td><td>score : </td><td>".$score3."점</td></tr>";
				
			}
		}
		echo "</table>";
	?>
	</fieldset>
	</body>
</html>




