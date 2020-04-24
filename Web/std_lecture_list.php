<?php
	$master_id = $_COOKIE['master_id'];
	$class_id = $_GET['class_id_fwd'];
	$class_name = $_GET['class_name_fwd'];
?>
<html>
    <head>
        <title>team1_lecture_list</title>
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
				
				$db_sql = "SELECT * FROM LECTURES WHERE CLASS_ID = '$class_id'";
				$lectures_result = mysqli_query($db_conn, $db_sql);
				
				echo "<legend>".$class_id."&nbsp;".$class_name." 강의 목록</legend>";
				echo "<table>";
				echo "<tr><td>lecture_id</td><td>name</td><td>start_time</td><td>end_time</td></tr>";
				
				while($info=mysqli_fetch_array($lectures_result)){
					echo "<tr><td>".$info['lecture_id']."</td><td>".$info['name']."</td><td>".$info['start_time']."</td><td>".$info['end_time']."</td>";
					echo "<td><input type=\"button\" value=\"수강\" onclick=\"location.href='take_lectures.php?class_id_fwd=".$info['class_id'].
							"&lecture_id_fwd=".$info['lecture_id']."'\"></td></tr>";
				}
				echo "</table>";
				
				echo "<br><input type=\"button\" value=\"과목 목록으로 돌아가기\" onclick=\"location.href='student.php'\">";
			?>
		</fieldset>
	</body>
</html>

