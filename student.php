<html>
    <head>
        <title>student_main</title>
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
		
		echo "<table>";
		echo "<tr><td>class_id</td><td>name</td><td>capacity</td><td>master_id</td></tr>";
		while($info=mysqli_fetch_array($classes_result)){
			echo "<tr><td><a href='std_lecture_list.php?class_id_fwd=".$info['class_id']."&class_name_fwd=".$info['name']."'>"
				.$info['class_id']."</a></td><td>".$info['name']."</td><td>".$info['capacity']."</td><td>".$info['master_id']."</td>";
			echo "<td><input type=\"button\" value=\"수강\" onclick=\"location.href='take_classes.php?class_id_fwd=".$info['class_id'].
					"&class_name_fwd=".$info['name']."&class_cap_fwd=".$info['capacity']."'\"></td></tr>";
		}
		echo "</table>";
		
	?>
	<br>
	</fieldset>
	</body>
</html>