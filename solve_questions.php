<?php
	$master_id = $_COOKIE['master_id'];

	$lecture_id = $_GET['lecture_id_fwd'];
	$question_id = $_GET['question_id_fwd'];
?>
<html>
    <head>
        <title>team1_solve_questions</title>
    </head>
    <body>
		<form action="question_log.php" method="get" id="answer_fwd">
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
				
				if($info['type'] == 0){
					$type = '단답형';
				}else if($info['type'] == 1){
					$type = '객관식';
				}else if($info['type'] == 2){
					$type = '단답형(개별문항)';
				}
				
				$bogi_explode = explode('<br/>', $info['bogi']);
				
				echo "<legend>".$question_id."&nbsp;문항 풀기</legend>";
				
				$db_sql3 = "SELECT * FROM QUESTION_LOG WHERE QUESTION_ID = '$question_id' AND USER_ID = '$master_id'";
				$log_result = mysqli_query($db_conn, $db_sql3);
				$log_count = mysqli_num_rows($log_result);
				
				if($log_count != 0){
					echo "<span style=\"color:red\">제출 완료</span><br>";
				}
				
				echo "<table>";
				echo "<tr><th>question_id : </th><td><input type=\"number\" name=\"question_id\" value=\"".$question_id."\" readonly =\"readonly\"></td></tr>
						<tr><th>type : </th><td>".$type."</td></tr>
						<tr><th>question : </th><td>".$info['question']."</td></tr>";
						
				echo "<tr><th>bogi : </th><td>";
				$i = 0;
				while(array_key_exists($i, $bogi_explode)) {
					printf($bogi_explode[$i]);
					echo "<br>";
					$i = $i + 1;
				}
				
				echo "</td><tr><th>answer : </th><td>
					<textarea name=\"answer\" form=\"answer_fwd\" cols=\"100\" rows=\"5\" wrap=\"hard\" placeholder=\"답을 입력해주세요\"></textarea></td></tr>";
				
				echo "<tr><th>lecture_id : </th><td><input type=\"number\" name=\"lecture_id\" value=\"".$lecture_id."\" readonly =\"readonly\"></td></tr>";
				echo "</table>";
				
				echo "<br><input type=\"submit\">";
				
				$db_sql4 = "SELECT * FROM LECTURES WHERE LECTURE_ID = '$lecture_id'";
				$result4 = mysqli_query($db_conn, $db_sql4);
				$info4 = mysqli_fetch_array($result4);
				
				$lecture_name = $info4['name'];
				
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"문항 목록으로 돌아가기\" onclick=\"location.href='std_question_list.php?lecture_id_fwd=".$lecture_id.
						"&lecture_name_fwd=".$lecture_name."'\">";
			?>
		</fieldset>
		</form>
	</body>
</html>


