<?php

    
    $lecture_id = $_GET['lecture_id_fwd'];
    $lecture_name = $_GET['lecture_name_fwd'];

    $db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password ="yonggoang22"; 
	$db_name = "lms_team1";    

    $db_conn = mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
      
    mysqli_select_db($db_conn,$db_name) or die('DB 선택 실패');
    
    $db_sql = "SELECT * FROM LECTURE_KEYWORDS WHERE lecture_id = '$lecture_id'";
    $keywords_result = mysqli_query($db_conn, $db_sql);

?>
<html>
    <head>
        <title>team1_make_questions</title>
    </head>
    <body>
     <fieldset>
        <legend><?php printf($lecture_name)?>의 문항을 만들어주세요</legend>
        <form action=make_questions_fwd.php enctype ="multipart/form-data" method="POST" name="question_fwd" id="question_fwd" onsubmit="return check_onClick()">
        <table>
            <tr>
                <th>lecture_id : </th>
                <td><input type="number" name="question_lectureID" value="<?php echo $lecture_id?>" readonly="readonly"></td>
            </tr>
            <tr>
                <th>question_id : </th>
                <td><input type="number" name="questionID"></td>
                <td>
                </td>
            </tr>
            <tr>
                <th>type : </th>
                <td>
                <select name="taskOption" onChange="innerHtmlSelect(this.value)" >
                    <option value="">--문제타입--</option>
                    <option value=0>단답형</option>
                    <option value=1>객관식</option>
                    <option value=2>개별문항</option>
                </select>
                </td>            
            </tr>
        </table> 
        <div id = 'div_html'></div>
        <table>
            <?php
                $count = 0;
                echo "<tr><th>keywords : </th>";
                while($info=mysqli_fetch_array($keywords_result)){
                    echo "<td>
                    <label>
                    <input type='checkbox' name='question_key[]' value='".$info['keyword']."'>
                    ".$info['keyword']."
                    </label>
                    <br>
                    </td>";                               
                    $count++;
                }
                echo "</tr>";      
            ?>  
            </table>
            <table>                     
            <tr>
                <td><div id = 'scoreContainer'></div></td>
            </tr>
            <tr>
                <td><input type="submit" value="문항 생성"></td>
            </tr>
            </table>
        
        </form>
    </fieldset>
    </body>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript">
         $("input[name='question_key[]']").click(function(){
            var $scoreContaier = $("#scoreContainer");
             var keyword = $(this).val();
            if($(this).prop("checked")){
               $scoreContaier.append("<span data-keyword='"+keyword+"'><table><th>"+keyword+"의 점수:</th><td><input type='number' name='score[]' placeholder='배점을 입력하세요'><br></td></table></span>");
            }
                else{
               $("#scoreContainer span").each(function(){
                   if($(this).attr("data-keyword") === keyword){
                       $(this).remove();
                        }
                    });
            }
            });

            function check_onClick(){
                if(question_fwd.questionID.value==""){
                    alert("입력값이 부족합니다. 확인해 주세요.");
                    return false;
                }
            }

            function innerHtmlSelect(val){
                var html="<table>";                                       
                if(val==""){
                    html = "";
                }else{
                    if(val==0){
                        html =  html+ "<tr>"
                                +"<th>question : </th>"
                                +"<td><textarea name=\"question\" form=\"question_fwd\" cols=\"100\" rows=\"5\" wrap=\"hard\" placeholder=\"문제를 입력해주세요\"></textarea></td>"
                                +"</tr>"
                                +"<tr>"
                                +"<th>answer : </th>"
                                +"<td><textarea name=\"question_ans\" form=\"question_fwd\" cols=\"100\" rows=\"5\" wrap=\"hard\" placeholder=\"답을 입력해주세요\"></textarea></td>"
                                +"</tr>";
                    }else if(val==1){
                                html = html+ "<tr>"
                                +"<th>question : </th>"
                                +"<td><textarea name=\"question\" form=\"question_fwd\" cols=\"100\" rows=\"5\" wrap=\"hard\" placeholder=\"문제를 입력해주세요\"></textarea></td>"
                                +"</tr>"
                                +"<tr>"
                                +"<th>bogi : </th>"
                                +"<td><textarea name=\"bogi\" form=\"question_fwd\" cols=\"100\" rows=\"10\" wrap=\"hard\" placeholder=\"보기를 입력해주세요\"></textarea></td>"
                                +"</tr>"
                                +"<tr>"
                                +"<th>answer : </th>"
                                +"<td><textarea name=\"question_ans\" form=\"question_fwd\" cols=\"100\" rows=\"5\" wrap=\"hard\" placeholder=\"답을 입력해주세요\"></textarea></td>"
                                +"</tr>";                                
                    }else if(val==2){
                        html = html+ "<tr>"
                                +"<th>question : </th>"
                                +"<td><textarea name=\"question\" form=\"question_fwd\" cols=\"100\" rows=\"5\" wrap=\"hard\" placeholder=\"문제를 입력해주세요\"></textarea></td>"
                                +"</tr>"
                                +"<tr>"
                                +"<th>파라미터 excel 파일 업로드 : </th>"
                                +"<td><input type=\"file\" name=\"param_file\"></td>"
                                +"</tr>";
                    }
                        html = html +"<tr>"
                                +"<th>difficulty : </th>"
                                +"<td><input type=\"number\" min=\"0.00\" max=\"10.00\" step=\"any\" name=\"question_diff\"></td>"
                                +"</tr>";
                    }
                document.getElementById('div_html').innerHTML = html;
            }
        </script>
</html>