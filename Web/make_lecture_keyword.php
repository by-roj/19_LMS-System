<?php
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	$keyword = $_POST['keyword'];
	$key_weight = $_POST['key_weight'];
	$lecture_id = $_COOKIE['lecture_keyword_lectureID'];

	//mysql_connect: 서버에 접속하기 위해 필요 
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
	
	//DB 선택해서 연동 
	mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 

	$count_sql = "SELECT * FROM LECTURE_KEYWORDS WHERE lecture_id='$lecture_id'";
	$count_result = mysqli_query($db_conn,$count_sql);
	$lecture_keywords_count = mysqli_num_rows($count_result);
	
	if($lecture_keywords_count >= 10){
		
		echo "<script type=\"text/javascript\">alert(\"생성 가능한 키워드 개수를 초과하였습니다.\");history.back();</script>";
	}else {
		$insert_sql = "INSERT INTO LECTURE_KEYWORDS(lecture_id,keyword,weight) VALUES($lecture_id,'$keyword',$key_weight)";
		$make_classes_result = mysqli_query($db_conn,$insert_sql);
		
		if($make_classes_result != 0) {
			echo "<script type=\"text/javascript\">alert(\"키워드가 입력되었습니다.\");history.back();</script>";
		} 
	}
	
?>