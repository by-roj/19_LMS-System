<?php
	$master_id = $_COOKIE['master_id'];
	$lecture_id = $_GET['lecture_id_fwd'];
	$lecture_name = $_GET['lecture_name_fwd'];
?>
<html>
    <head>
        <title>team1_question_list</title>
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
				
				$db_sql = "SELECT * FROM QUESTIONS WHERE LECTURE_ID = '$lecture_id'";
				$questions_result = mysqli_query($db_conn, $db_sql);
				
				echo "<legend>".$lecture_id."&nbsp;".$lecture_name." 문항 목록</legend>";
				echo "<table>";
				echo "<tr><td>question_id</td><td>type</td><td>question</td><td>difficulty</td><td>real_difficulty</td></tr>";
				
				while($info=mysqli_fetch_array($questions_result)){
					if($info['type'] == 0){
						$type = '단답형';
					}else if($info['type'] == 1){
						$type = '객관식';
					}else if($info['type'] == 2){
						$type = '단답형(개별문항)';
					}
					echo "<tr><td>".$info['question_id']."</td><td>".$type."</td><td>".$info['question']."</td>
							<td>".$info['difficulty']."</td><td>".$info['real_difficulty']."";
					echo "<td><input type=\"button\" value=\"풀기\" onclick=\"location.href='solve_questions.php?lecture_id_fwd=".$lecture_id.
							"&question_id_fwd=".$info['question_id']."'\"></td></tr>";
				}
				echo "</table>";
				
				$db_sql2 = "SELECT * FROM LECTURES WHERE LECTURE_ID = '$lecture_id'";
				$result2 = mysqli_query($db_conn, $db_sql2);
				$info2 = mysqli_fetch_array($result2);
				
				$class_id = $info2['class_id'];
				
				$db_sql3 = "SELECT * FROM CLASSES WHERE CLASS_ID = '$class_id'";
				$result3 = mysqli_query($db_conn, $db_sql3);
				$info3 = mysqli_fetch_array($result3);
				
				$class_name = $info3['name'];
				
				echo "<br><input type=\"button\" value=\"강의 목록으로 돌아가기\" onclick=\"location.href='std_lecture_list.php?class_id_fwd=".$class_id.
						"&class_name_fwd=".$class_name."'\">";
			?>
		</fieldset>
	</body>
</html>

