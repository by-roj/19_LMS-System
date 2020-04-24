<?php
	$master_id = $_COOKIE['master_id'];
	
	$class_id = $_GET['class_id_fwd'];
	$class_name = $_GET['class_name_fwd'];
	$class_cap = $_GET['class_cap_fwd'];
?>
<html>
    <head>
        <title>team1_take_classes</title>
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
				
				$db_sql = "SELECT * FROM USER_CLASSES WHERE CLASS_ID = '$class_id'";
				$uc_result = mysqli_query($db_conn, $db_sql);
				$uc_count = mysqli_num_rows($uc_result);
				
				if ($uc_count >= $class_cap) {
					echo "<script type=\"text/javascript\">alert(\"수강 인원 초과\");history.back();</script>";
				} else {
					echo "<legend>".$class_id."&nbsp;".$class_name." 과목을 수강합니다</legend>";
					
					$db_sql2 = "INSERT INTO USER_CLASSES VALUES('student', ".$class_id.", ".$master_id.")";
					$ins_result = mysqli_query($db_conn, $db_sql2);
					
					if($ins_result != 0) {
						echo "<script type=\"text/javascript\">alert(\"수강 신청되었습니다\");history.back();</script>";
					} else {
						echo "<script type=\"text/javascript\">alert(\"이미 수강 신청한 과목입니다\");history.back();</script>";
					}
				}
			?>
		</fieldset>
    </body>
</html>