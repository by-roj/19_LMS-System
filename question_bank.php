<fieldset>
<?php
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
	
	mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
					
	$db_sql = "SELECT * FROM QUESTION_BANK";
	$qb_result = mysqli_query($db_conn, $db_sql);
	
	echo "<legend>문제 은행</legend>";
	echo "<table>";
	echo "<tr><td>bank_id</td><td>type</td><td>question</td><td>bogi</td><td>answer</td><td>difficulty</td><td>real_difficulty</td></tr>";
	
	while($info=mysqli_fetch_array($qb_result)){
		if($info['type'] == 0){
			$type = '단답형';
		}else{
			$type = '객관식';
		}
		echo "<tr><td>".$info['bank_id']."</td><td>".$type."</td><td>".$info['question']."</td>
				<td>".$info['bogi']."</td><td>".$info['answer']."</td><td>".$info['difficulty']."</td><td>".$info['real_difficulty']."";
				
		echo "<td>&nbsp;&nbsp;<input type='button' value='문항 삭제' onclick=\"location.href='delete_question_bank.php?bank_id_fwd=".$info['bank_id']."'\"></td>";
		echo "<td><input type=\"button\" value=\"문항 보기\" onclick=\"location.href='show_question_bank.php?bank_id_fwd=".$info['bank_id']."'\"></td></tr>";
	}
	echo "</table>";
	
	echo "<br><input type=\"button\" value=\"과목 목록으로 돌아가기\" onclick=\"location.href='teacher.php'\">";
?>
</fieldset>