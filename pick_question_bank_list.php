<?php
	$lecture_id = $_POST['lectureID'];

	$sdiff = $_POST['question_sdiff'];
	$bdiff = $_POST['question_bdiff'];
	$srdiff = $_POST['question_srdiff'];
	$brdiff = $_POST['question_srdiff'];
	$keyword1 = $_POST['question_keyword1'];
	$keyword2 = $_POST['question_keyword2'];
	$keyword3 = $_POST['question_keyword3'];
	
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 	

    $db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
		
    mysqli_select_db($db_conn,$db_name) or die('DB 선택 실패');
	
	if($sdiff == ""){
		$sdiff = 0;
	}
	if($bdiff == ""){
		$bdiff = 10;
	}
	if($srdiff == ""){
		$srdiff = 0;
	}
	if($brdiff == ""){
		$brdiff = 10;
	}
	$keyword_null = 0;
	if($keyword1 == "" && $keyword2 == "" && $keyword3 == ""){
		$keyword_null = 1;
	}
	
	$db_sql = "SELECT * FROM QUESTION_BANK WHERE DIFFICULTY >= '$sdiff' AND DIFFICULTY <= '$bdiff' AND REAL_DIFFICULTY >= '$srdiff' AND REAL_DIFFICULTY <= '$brdiff'";
	$result = mysqli_query($db_conn, $db_sql);
	
	$arr = [];
	$i = 0;
	while($info=mysqli_fetch_array($result)){
		$bank_id = $info['bank_id'];
		$db_sql2 = "SELECT * FROM QUESTION_BANK_KEYWORD WHERE BANK_ID = '$bank_id'";
		$result2 = mysqli_query($db_conn, $db_sql2);
		
		if($keyword_null == 0){
			while($info2=mysqli_fetch_array($result2)){
				$keyword = $info2['keyword'];
				
				if(!(strcmp($keyword1, $keyword)) || !(strcmp($keyword2, $keyword)) || !(strcmp($keyword3, $keyword))){
					$arr[$i] = $bank_id;
					$i = $i + 1;
				}
			}
		}else{
			$arr[$i] = $bank_id;
			$i = $i + 1;
		}	
	}
	
?>
<fieldset>
<?php
	$i = 0;
	while(array_key_exists($i, $arr)){
		$db_sql2 = "SELECT * FROM QUESTION_BANK WHERE BANK_ID='$arr[$i]'";
		$result2 = mysqli_query($db_conn, $db_sql2);
		
		echo "<table>";
		echo "<tr><td>bank_id</td><td>type</td><td>question</td><td>difficulty</td><td>real_difficulty</td></tr>";
		
		while($info2=mysqli_fetch_array($result2)){
			if($info2['type'] == 0){
				$type = '단답형';
			}else{
				$type = '객관식';
			}
			echo "<tr><td>".$info2['bank_id']."</td><td>".$type."</td><td>".$info2['question']."</td>
					<td>".$info2['difficulty']."</td><td>".$info2['real_difficulty']."";
					
			echo "<td>&nbsp;&nbsp;<input type=\"button\" value=\"문항 보기\" onclick=\"location.href='pick_show_question.php?bank_id_fwd=".$info2['bank_id']."'\"></td></tr>";
		}
		$i = $i + 1;
	}
?>
	<form action=pick_fwd.php method="POST" name="pick_fwd" id="pick_fwd">
		<table>
		<tr>
            <th><br>강의 아이디 : </th>
            <td><br><input type="number" name="lectureID" value="<?php echo $lecture_id?>" readonly="readonly"></td>
            </tr>
		<tr>
			<th>문항 선택(bank_id) : </th>
			<td><input type="number" name="pick_question_id"></td>
		</tr>
		</table>
		<br><input type="submit" value="제출">
	</form>
	
<?php
	echo "</table>";
?>
</fieldset>

















