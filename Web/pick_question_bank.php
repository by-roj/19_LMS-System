<?php
	$master_id = $_COOKIE['master_id'];
	
	$lecture_id = $_GET['lecture_id_fwd'];
?>
<html>
    <head>
        <title>team1_pick_question_bank</title>
    </head>
    <body>
     <fieldset>
        <legend>불러올 문항의 조건을 입력하세요!</legend>
        <form action=pick_question_bank_list.php method="POST" name="pick" id="pick">
			<table>
			<tr>
                <th>강의 아이디 : </th>
                <td><input type="number" name="lectureID" value="<?php echo $lecture_id?>" readonly="readonly"></td>
            </tr>
            <tr>
                <th>난이도 : </th>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;최소</td><td><input type="number" name="question_sdiff"></td>
				<td>최대 </td><td><input type="number" name="question_bdiff"></td>
            </tr>
			<tr>
                <th>실질 난이도 : </th>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;최소</td><td><input type="number" name="question_srdiff"></td>
				<td>최대</td><td><input type="number" name="question_brdiff"></td>
            </tr>
			<tr>
                <th>키워드 : </th>
                <td><input type="text" name="question_keyword1"></td>
				<td><input type="text" name="question_keyword2"></td>
				<td><input type="text" name="question_keyword3"></td>
            </tr>
			</table>
			<br><input type="submit" value="제출">
        </form>
     </fieldset>
    </body>
</html>

