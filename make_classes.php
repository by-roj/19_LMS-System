<?php
	$master_id = $_COOKIE['master_id'];
?>
<html>
    <head>
        <title>team1_make_classes</title>
    </head>
    <body>
     <fieldset>
        <legend>과목 정보를 입력하세요!</legend>
        <table>
        <form action=make_classes_fwd.php method="POST" name="class_fwd" id="class_fwd" onsubmit="return check_onClick()">
            <tr>
                <th>Class_id : </th>
                <td><input type="number" name="classID"></td>
            </tr>
            <tr>
                <th>Name : </th>
                <td><input type="text" name="class_name"></td>
            </tr>
			<tr>
                <th>Capacity : </th>
                <td><input type="number" name="class_capacity"></td>
            </tr>
			<tr>
                <th>Master_id : </th>
                <td><?php printf($master_id); ?></td>
            </tr>
        <input type="submit" value="과목 생성하기">
        </form>
        </table>
     </fieldset>
    </body>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript">
		function check_onClick(){
			if(class_fwd.classID.value=="" || class_fwd.class_name.value=="" || class_fwd.class_capacity.value==""){
				alert("입력값이 부족합니다. 확인해 주세요");
				return false;
			}
		}
	</script>
</html>

