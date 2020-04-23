<html>
    <head>
        <title>teacher_main</title>
    </head>
    <body>
	<fieldset>
	<?php
		echo "<legend>과목 목록</legend>";
		$db_hostname = "localhost"; 
		$db_user = "root"; 
		$db_password = "yonggoang22"; 
		$db_name = "lms_team1"; 		
		
		$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
		
		mysqli_select_db($db_conn,$db_name) or die('DB 선택 실패');
		
		$db_sql = "SELECT * FROM CLASSES";
		$classes_result = mysqli_query($db_conn, $db_sql);
		$count = mysqli_num_rows($classes_result);
		
		echo "<table>";
		echo "<tr><td>class_id</td><td>name</td><td>capacity</td><td>master_id</td></tr>";
		while($info=mysqli_fetch_array($classes_result)){
			echo "<tr>
					<td><a href='tec_lecture_list.php?class_id_fwd=".$info['class_id']."&class_name_fwd=".$info['name']."'>".$info['class_id']."
					</a>
					</td>
					<td>".$info['name']."
					</td>
					<td>".$info['capacity']."
					</td>
					<td>".$info['master_id']."
					</td>
					<td>";
			echo "&nbsp;&nbsp;<input type='button' value='과목 삭제' onclick=\"location.href='delete_class.php?class_id_fwd=".$info['class_id']."&class_name_fwd=".$info['name']."'\"></td>";
			echo "<td><input type='button' value='".$info['name']." 강의 생성' onclick=\"location.href='make_lectures.php?class_id_fwd=".$info['class_id']."&class_name_fwd=".$info['name']."'\">";
			echo "	</td>
					</tr>";
			
		}
		echo "</table>";
		
	?>
	<br>
	<input type="button" value="문제 은행" onclick="location.href='question_bank.php'">
	<input type="button" value="과목 생성" onclick="location.href='make_classes.php'">
	</fieldset>
	</body>
</html>