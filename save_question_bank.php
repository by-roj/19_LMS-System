<html>
    <head>
        <title>team1_question_bank</title>
    </head>
    <body>
	<?php
		$question_id = $_GET['question_id_fwd'];
		
		$db_hostname = "localhost"; 
		$db_user = "root"; 
		$db_password = "yonggoang22"; 
		$db_name = "lms_team1"; 	

		$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
			
		mysqli_select_db($db_conn,$db_name) or die('DB 선택 실패');
		
		$db_sql ="SELECT * FROM QUESTIONS WHERE QUESTION_ID='$question_id'";
		$q_result = mysqli_query($db_conn, $db_sql);
		$q_info = mysqli_fetch_array($q_result);
		
		$type = $q_info['type'];
		$question = $q_info['question'];
		$bogi = $q_info['bogi'];
		$answer = $q_info['answer'];
		$difficulty = $q_info['difficulty'];
		$real_difficulty = $q_info['real_difficulty'];
		
		if($q_info['type'] == 1){
			$db_sql2 = "INSERT INTO QUESTION_BANK(TYPE, QUESTION_ID, QUESTION, BOGI, ANSWER, DIFFICULTY, REAL_DIFFICULTY) 
				VALUES('$type', '$question_id', '$question', '$bogi', '$answer', '$difficulty', '$real_difficulty')";
		}else{
			$db_sql2 = "INSERT INTO QUESTION_BANK(TYPE, QUESTION_ID, QUESTION, ANSWER, DIFFICULTY, REAL_DIFFICULTY) 
				VALUES('$type', '$question_id', '$question', '$answer', '$difficulty', '$real_difficulty')";
		}
		
		$b_result = mysqli_query($db_conn, $db_sql2);
		
		$lecture_id = $q_info['lecture_id'];
		$db_sql3 = "SELECT * FROM LECTURES WHERE LECTURE_ID='$lecture_id'";
		$l_result = mysqli_query($db_conn, $db_sql3);
		$l_info = mysqli_fetch_array($l_result);
		$lecture_name = $l_info['name'];
		
		$db_sql6 = "SELECT * FROM QUESTION_BANK WHERE QUESTION_ID = '$question_id'";
		$result6 = mysqli_query($db_conn, $db_sql6);
		$info6 = mysqli_fetch_array($result6);
		
		$db_sql4 = "SELECT * FROM QUESTION_KEYWORDS WHERE QUESTION_ID='$question_id'";
		$k_result = mysqli_query($db_conn, $db_sql4);
		
		$chk = 1;
		$bank_id = $info6['bank_id'];
		while($k_info=mysqli_fetch_array($k_result)){
			$k_keyword = $k_info['keyword'];
			$k_score = $k_info['score_portion'];
			
			$db_sql5 = "INSERT INTO QUESTION_BANK_KEYWORD VALUES('$bank_id', '$k_keyword', '$k_score')";
			$bk_result = mysqli_query($db_conn, $db_sql5);
			if(!$bk_result){
				$chk = 0;
			}
		}
		
		if($b_result && ($chk == 1)){
			echo "<script type=\"text/javascript\">alert(\"".$question_id." 문항이 문제 은행에 저장되었습니다\");
					location.href=\"show_questions.php?lecture_id_fwd=".$lecture_id.
					"&lecture_name_fwd=".$lecture_name."&question_id_fwd=".$question_id."\"</script>";
		}
	?>
	</body>