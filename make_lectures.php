<?php
	$master_id = $_COOKIE['master_id'];
	$class_id = $_GET['class_id_fwd'];
	$class_name = $_GET['class_name_fwd'];
?>
<html>
    <head>
        <title>team1_make_classes</title>
    </head>
    <body>
     <fieldset>
        <legend><?php printf($class_name)?>의 강의를 개설해주세요</legend>
        <table>
        <form action=make_lectures_fwd.php method="POST" name="lecture_fwd" id="lecture_fwd" onsubmit="return check_onClick()">
            <tr>
                <th>Lecture_id : </th>
                <td><input type="number" name="lectureID"></td>
            </tr>
            <tr>
                <th>Name : </th>
                <td><input type="text" name="lecture_name"></td>
            </tr>
			<tr>
                <th>Start Date(YYYYMMDD) : </th>
                <td><input type="text" name="start_date"></td>
				<th>&nbsp;&nbsp;Time(HHMMSS) : </th>
				<td><input type="text" name="start_time"></td>
            </tr>
			<tr>
                <th>End time(YYYYMMDD) : </th>
                <td><input type="text" name="end_date"></td>
				<th>&nbsp;&nbsp;Time(HHMMSS) : </th>
				<td><input type="text" name="end_time"></td>
            </tr>
			<tr>
				<th>Class ID : </th>
				<td><input type="text" name="class_id" value=<?php echo $class_id?> readonly="readonly"></td>
			</tr>
			<tr>
				<td><br></td>
			</tr>
			<tr>
				<td><input type="submit" value="강의 생성하기"></td>
			</tr>
        </form>
        </table>
	 </fieldset>
    </body>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript">
		function check_onClick(){
			if(lecture_fwd.lectureID.value=="" || lecture_fwd.lecture_name.value=="" || lecture_fwd.start_date.value=="" || lecture_fwd.start_time.value=="" || lecture_fwd.end_date.value=="" || lecture_fwd.end_time.value==""){
				alert("입력값이 부족합니다. 확인해 주세요");
				return false;
			}
		}
	</script>
</html>

