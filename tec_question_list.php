<fieldset>
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
					
	$db_sql = "SELECT * FROM QUESTIONS WHERE LECTURE_ID = '$lecture_id'";
	$questions_result = mysqli_query($db_conn, $db_sql);
	
	echo "<legend>".$lecture_id."&nbsp;".$lecture_name." 문항 목록</legend>";
	echo "<table>";
	echo "<tr><td>question_id</td><td>type</td><td>question</td><td>difficulty</td><td>real_difficulty</td></tr>";
	
	while($info=mysqli_fetch_array($questions_result)){
		if($info['type'] == 0){
			$type = '단답형';
		}else{
			$type = '객관식';
		}
		echo "<tr><td>".$info['question_id']."</td><td>".$type."</td><td>".$info['question']."</td>
				<td>".$info['difficulty']."</td><td>".$info['real_difficulty']."";
				
		echo "<td>&nbsp;&nbsp;<input type='button' value='문항 삭제' onclick=\"location.href='delete_questions.php?class_id_fwd=".$class_id."&class_name_fwd=".$class_name."&lecture_id_fwd=".$lecture_id."&lecture_name_fwd=".$lecture_name."&question_id_fwd=".$info['question_id']."'\"></td>";
		echo "<td><input type=\"button\" value=\"문항 보기\" onclick=\"location.href='show_questions.php?lecture_id_fwd=".$lecture_id.
				"&lecture_name_fwd=".$lecture_name."&question_id_fwd=".$info['question_id']."'\"></td></tr>";
	}
	echo "</table>";
	
	echo "<br><input type=\"button\" value=\"강의 목록으로 돌아가기\" onclick=\"location.href='tec_lecture_list.php?class_id_fwd=".$class_id.
			"&class_name_fwd=".$class_name."'\">";
?>
</fieldset>