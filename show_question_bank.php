<?php
	$master_id = $_COOKIE['master_id'];
	$bank_id = $_GET['bank_id_fwd'];
?>
<html>
    <head>
        <title>team1_show_question_bank</title>
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
				
				$db_sql = "SELECT * FROM QUESTION_BANK WHERE BANK_ID = '$bank_id'";
				$qb_result = mysqli_query($db_conn, $db_sql);
				$info = mysqli_fetch_array($qb_result);
				
				if($info['type'] == 0){
					$type = '단답형';
				}else{
					$type = '객관식';
				}
				
				$bogi_explode = explode('<br/>', $info['bogi']);
				
				echo "<legend>".$bank_id."&nbsp;번 문항</legend>";
				
				echo "<table>";
				echo "<tr><th>question : </th><td>".$info['question']."</td></tr>
						<tr><th>type : </th><td>".$type."</td></tr>";
						
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
				echo "<tr><th>(keyword, score) : </th><td>";
				
				$db_sql2 = "SELECT * FROM QUESTION_BANK_KEYWORD WHERE BANK_ID = '$bank_id'";
				$result2 = mysqli_query($db_conn, $db_sql2);
				
				while($info2 = mysqli_fetch_array($result2)){
					echo "(".$info2['keyword'].", ".$info2['score_portion'].")";
					echo "&nbsp;&nbsp;";
				}
				
						
				echo "</table>";
						
				echo "<br><input type=\"button\" value=\"문제 은행으로 돌아가기\" 
						onclick=\"location.href='question_bank.php'\"";
			?>
		</fieldset>
		</form>
	</body>
</html>
