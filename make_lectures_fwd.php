<?php
	$db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1"; 
	
	$lecture_id = $_POST['lectureID'];
	$lecture_name = $_POST['lecture_name'];
	$lecture_sDate = $_POST['start_date'];
	$lecture_sTime = $_POST['start_time'];
	$lecture_eDate = $_POST['end_date'];
	$lecture_eTime = $_POST['end_time'];
	$lecture_class_id = $_POST['class_id'];
	$master_id = $_COOKIE['master_id'];
	
	$sdatetime = (int)($lecture_sDate."".$lecture_sTime);
	$edatetime = (int)($lecture_eDate."".$lecture_eTime);
	
	if($sdatetime == 0 || $edatetime == 0){
		echo "<script type=\"text/javascript\">alert(\"날짜와 시간을 숫자로 입력해 주세요\");history.back();</script>";
	}
	
	//mysql_connect: 서버에 접속하기 위해 필요 
	$db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
	
	setcookie('lecture_keyword_lectureID',$lecture_id);
	
	//DB 선택해서 연동 
	mysqli_select_db($db_conn, $db_name) or die('DB 선택 실패'); 
	
	$db_sql = "SELECT * FROM LECTURES WHERE LECTURE_ID='$lecture_id'";
	$result = mysqli_query($db_conn, $db_sql);
	$count = mysqli_num_rows($result);
	
	if($count != 0){
		echo "<script type=\"text/javascript\">alert(\"중복된 lecture id입니다. 확인해 주세요\");history.back();</script>";
	}
	
	if($sdatetime > $edatetime) {
		echo "<script type=\"text/javascript\">alert(\"잘못된 날짜입니다. 확인해 주세요\");history.back();</script>";
	}
	
	$insert_sql = "INSERT INTO LECTURES VALUES('$lecture_id','$lecture_name','$sdatetime','$edatetime','$lecture_class_id')";
	$make_classes_result = mysqli_query($db_conn,$insert_sql);
?>
<html>
 <body>
	<fieldset>
		<table>
 		<form action=make_lecture_keyword.php method="POST">
			<tr>
				<th>Keyword : </th>
				<td><input type="text" name="keyword"></td>
			</tr>
			<tr>
				<th>Weight : </th>
				<td><input type="number" min="0.00" max="10.00" step="any" name="key_weight"></td>				
			</tr>
			<tr>
				<td><input type="submit" value="키워드 생성하기"></td>
			</tr>
		</form>
		</table>
	</fieldset>
    <input type="button" value="키워드를 모두 생성하고 돌아가겠습니다." onclick="location.href='teacher.php'">
 </body>
</html>
