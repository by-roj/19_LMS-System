<?php
	$master_id = $_COOKIE['master_id'];
	$lecture_id = $_GET['lecture_id_fwd'];
	$lecture_name = $_GET['lecture_name_fwd'];
	$question_id = $_GET['question_id_fwd'];
?>
<html>
    <head>
        <title>team1_show_questions</title>
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
				}else{
					$type = '객관식';
				}
				
				$bogi_explode = explode('<br/>', $info['bogi']);
				
				echo "<legend>".$question_id."&nbsp;문항</legend>";
				
				echo "<table>";
				echo "<tr><th>question_id : </th><td>".$info['question_id']."</td></tr>
						<tr><th>type : </th><td>".$type."</td></tr>
						<tr><th>question : </th><td>".$info['question']."</td></tr>";
						
				echo "<tr><th>bogi : </th><td>";
				$i = 0;
				while(array_key_exists($i, $bogi_explode)) {
					printf($bogi_explode[$i]);
					echo "<br>";
					$i = $i + 1;
				}
				
				echo "</td><tr><th>answer : </th><td>".$info['answer']."</td></tr>";
				echo "<tr><th>difficulty : </th><td>".$info['difficulty']."</td></tr>";
				echo "<tr><th>real_difficulty : </th><td>".$info['real_difficulty']."</td></tr>";
						
				echo "</table>";
				
				$lid = $info['lecture_id'];
				$db_sql2 = "SELECT * FROM LECTURES WHERE LECTURE_ID = '$lid'";
				$result2 = mysqli_query($db_conn, $db_sql2);
				$info2 = mysqli_fetch_array($result2);
				
				$cid = $info2['class_id'];
				$db_sql3 = "SELECT * FROM CLASSES WHERE CLASS_ID = '$cid'";
				$result3 = mysqli_query($db_conn, $db_sql3);
				$info3 = mysqli_fetch_array($result3);
				
				echo "<br><input type=\"button\" value=\"문제 은행에 저장\" 
						onclick=\"location.href='save_question_bank.php?question_id_fwd=".$question_id."'\">";
						
				echo "&nbsp;&nbsp;<input type=\"button\" value=\"문항 목록으로 돌아가기\" 
						onclick=\"location.href='tec_question_list.php?class_id_fwd=".$info3['class_id'].
						"&class_name_fwd=".$info3['name']."&lecture_id_fwd=".$lecture_id."&lecture_name_fwd=".$lecture_name."'\">";
			?>
		</fieldset>
		</form>
	</body>
</html>
