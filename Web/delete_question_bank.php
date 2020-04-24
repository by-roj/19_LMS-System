<?php
	$bank_id = $_GET['bank_id_fwd'];
	
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
	
	mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
	
	$db_sql = "DELETE FROM QUESTION_BANK WHERE BANK_ID = '$bank_id'";
	$result = mysqli_query($db_conn, $db_sql);
	
	if($result) {
		echo "<script type=\"text/javascript\">alert(\"문항이 삭제되었습니다\");location.href=\"question_bank.php\"</script>";
	}
?>