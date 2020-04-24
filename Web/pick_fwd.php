<?php
	$lecture_id = $_POST['lectureID'];
	$bank_id = $_POST['pick_question_id'];
	
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 	

    $db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
		
    mysqli_select_db($db_conn,$db_name) or die('DB 선택 실패');
	
	$db_sql = "SELECT * FROM QUESTION_BANK WHERE BANK_ID='$bank_id'";
	$b_result = mysqli_query($db_conn, $db_sql);
	$type = 0;
	while($b_info = mysqli_fetch_array($b_result)){
		$type = $b_info['type'];
		
		$question_id = $b_info['question_id'];
		$question = $b_info['question'];
		$bogi = $b_info['bogi'];
		$answer = $b_info['answer'];
		$difficulty = $b_info['difficulty'];
		$real_difficulty = $b_info['real_difficulty'];
		
		$db_sql2 = "SELECT * FROM QUESTIONS WHERE QUESTION_ID = '$question_id'";
		$q_result = mysqli_query($db_conn, $db_sql2);
		$q_count = mysqli_num_rows($q_result);
		
		$chk = 0;
		if($q_count != 0){
			$db_sql3 = "UPDATE QUESTIONS SET TYPE='$type', QUESTION='$question', BOGI='$bogi', ANSWER='$answer', DIFFICULTY='$difficulty', REAL_DIFFICULTY='$real_difficulty', LECTURE_ID='$lecture_id' WHERE QUESTION_ID='$question_id'";
			$result3 = mysqli_query($db_conn, $db_sql3);
			$chk = 0;
		}else{
			$db_sql4 ="";
			if($type==0){
				$db_sql4 = "INSERT INTO QUESTIONS VALUES($question_id,$type,'$question','','$answer',$difficulty,0,$lecture_id)";
			}else if($type==1){
				$db_sql4 = "INSERT INTO QUESTIONS VALUES($question_id,$type,'$question','$clean_content','$answer',$difficulty,0,$lecture_id)";
			}else if($type==2) {
				$db_sql4 = "INSERT INTO QUESTIONS VALUES($question_id,$type,'$question','','',$difficulty,0,$lecture_id)";
			}	
			$result4 = mysqli_query($db_conn, $db_sql4);
			$chk = 1;
		}
	}
	
	$db_sql5 = "SELECT * FROM LECTURES WHERE LECTURE_ID = '$lecture_id'";
	$result5 = mysqli_query($db_conn, $db_sql5);
	while($info5 = mysqli_fetch_array($result5)){
		$class_id = $info5['class_id'];
		$lecture_name = $info5['name'];
	}
	
	$db_sql6 = "SELECT * FROM CLASSES WHERE CLASS_ID = '$class_id'";
	$result6 = mysqli_query($db_conn, $db_sql6);
	while($info6 = mysqli_fetch_array($result6)){
		$class_name = $info6['name'];
	}
	
	if($chk == 0){
		if($result3 == 1){
			echo "<script type=\"text/javascript\">alert(\"문항이 추가되었습니다\");location.href='tec_question_list.php?class_id_fwd=".$class_id."&class_name_fwd=".$class_name."&lecture_id_fwd=".$lecture_id."&lecture_name_fwd=".$lecture_name."'</script>";
		}else{
			echo "<script type=\"text/javascript\">alert(\"문항 추가에 실패했습니다\");history.back();</script>";
		}
	}else{
		if($result4 == 1){
			echo "<script type=\"text/javascript\">alert(\"문항이 추가되었습니다\");location.href='tec_question_list.php?class_id_fwd=".$class_id."&class_name_fwd=".$class_name."&lecture_id_fwd=".$lecture_id."&lecture_name_fwd=".$lecture_name."'</script>";
		}else{
			echo "<script type=\"text/javascript\">alert(\"문항 추가에 실패했습니다\");history.back();</script>";
		}
	}
	
?>