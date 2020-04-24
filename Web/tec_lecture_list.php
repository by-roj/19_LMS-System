<fieldset>
<?php
	$class_id = $_GET['class_id_fwd'];
	$class_name = $_GET['class_name_fwd'];
	
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	echo "<legend>".$class_id."&nbsp;".$class_name." 강의 목록</legend>";
	
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
		
	mysqli_select_db($db_conn,$db_name) or die('DB 선택 실패');
		
	$db_sql = "SELECT * FROM LECTURES WHERE CLASS_ID = '$class_id'";
	$classes_result = mysqli_query($db_conn, $db_sql);
	$count = mysqli_num_rows($classes_result);

	echo "<table>";
	echo "<tr><td>lecture_id</td><td>name</td><td>소속 과목</td>";

	while($info=mysqli_fetch_array($classes_result)){
		echo "<tr>
				<td><a href='tec_question_list.php?class_id_fwd=".$class_id."&class_name_fwd=".$class_name.
					"&lecture_id_fwd=".$info['lecture_id']."&lecture_name_fwd=".$info['name']."'>".$info['lecture_id']."</a>		
				</td>
				<td>".$info['name']."
				</td>				
				<td>".$class_name."
				</td>";
		echo "<td>&nbsp;&nbsp;<input type='button' value='강의 삭제' onclick=\"location.href='delete_lectures.php?	class_id_fwd=".$class_id."&class_name_fwd=".$class_name."&lecture_id_fwd=".$info['lecture_id']."&lecture_name_fwd=".$info['name']."'\"></td>";
		echo "<td><input type='button' value='점수 확인' onclick=\"location.href='check_score.php?lecture_id_fwd=".$info['lecture_id']."&lecture_name_fwd=".$info['name']."'\"></td>";
		echo "<td><input type='button' value='문항 생성' onclick=\"location.href='questions.php?lecture_id_fwd=".$info['lecture_id']."&lecture_name_fwd=".$info['name']."'\"></td>";
		echo "<td><input type='button' value='문제 은행에서 불러오기' onclick=\"location.href='pick_question_bank.php?lecture_id_fwd=".$info['lecture_id']."'\">";
		echo "	</td>
				</tr>";
			
	}
	echo "</table>";
	echo "<br><input type=\"button\" value=\"과목 목록으로 돌아가기\" onclick=\"location.href='teacher.php'\">";
?>
</fieldset>
