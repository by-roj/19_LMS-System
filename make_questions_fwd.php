<?php
    require './vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet; 
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $allData = array();
    $param_row = 0;

    $lecture_id = $_POST['question_lectureID'];
    $question_id = $_POST['questionID'];
    $question_type = $_POST['taskOption'];
    $question = $_POST['question'];
    if($question_type == 1){
        $bogi = $_POST['bogi'];
        $clean_content = htmlspecialchars($_POST['bogi'], ENT_QUOTES);
        $clean_content = str_replace("\r\n","<br/>",$clean_content); //줄바꿈 처리
        $clean_content = str_replace("\u0020","&nbsp;",$clean_content); // 스페이스바 처리
    }else if($question_type == 2){
        if($_FILES['param_file']['error']>0){
            printf("error");
        }else{
            
            $filename = $_FILES['param_file']['name'];

            $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($filename);
            $sheetsCount = $objPHPExcel->getSheetCount();

            for($i = 0; $i < $sheetsCount; $i++) {

                $objPHPExcel -> setActiveSheetIndex($i);
                $sheet = $objPHPExcel -> getActiveSheet();
                $highestRow = $sheet -> getHighestRow();                       // 마지막 행
                
                $highestColumn = $sheet -> getHighestColumn();   // 마지막 컬럼
                // 한줄읽기
                for($row = 1; $row <= $highestRow; $row++) {
                    // $rowData가 한줄의 데이터를 셀별로 배열처리 된다.
                    $rowData = $sheet -> rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
                    // $rowData에 들어가는 값은 계속 초기화 되기때문에 값을 담을 새로운 배열을 선안하고 담는다.
                    
                    $allData[$row] = $rowData[0];
                    $param_row = $row;
                }
            }

        }
    }
    
    if($question_type == 0 || $question_type ==1) {
        $answer = $_POST['question_ans'];
    }
    $difficulty = $_POST['question_diff'];
    
    $db_hostname = "localhost"; 
	$db_user = "root"; 
	$db_password = "yonggoang22"; 
	$db_name = "lms_team1";    

    $db_conn=mysqli_connect($db_hostname,$db_user,$db_password, $db_name); 
      
    mysqli_select_db($db_conn,$db_name) or die('DB 선택 실패');
    
    $db_sql ="";
    if($question_type==0){
        $db_sql = "INSERT INTO QUESTIONS VALUES($question_id,$question_type,$question,'',$answer',$difficulty,0,$lecture_id)";
    }else if($question_type==1){
        $db_sql = "INSERT INTO QUESTIONS VALUES($question_id,$question_type,$question,$clean_content,$answer,$difficulty,0,$lecture_id)";
    }else if($question_type==2) {
        $db_sql = "INSERT INTO QUESTIONS VALUES($question_id,$question_type,$question,'','',$difficulty,0,$lecture_id)";
    }
    
    $questions_result = mysqli_query($db_conn, $db_sql);

    if($question_type==2) {
        for($i=2;$i<=$param_row;$i++){
            $tmp_count = 0;
            $tmp_param_data = $allData[$i];
            foreach($tmp_param_data as $tmp_param){                
                $insert_param[$tmp_count] = $tmp_param;
                $tmp_count = $tmp_count +1;
            }
            echo "<br>";
            
            $qID = (int)$insert_param[0];
            $key = (int)$insert_param[1];
            $type = (int)$question_type;
            
            // print(gettype($qID));
            // print(gettype($key));
            // print(gettype($type));


            for($j=0;$j<count($insert_param);$j++){
                if(empty($insert_param[$j])){
                    $insert_param[$j] = 0;
                }
            }
			/*
            print(gettype($insert_param[0]));
            print(gettype($insert_param[1]));
            print(gettype($type));
            print(gettype($insert_param[2]));
            print(gettype($insert_param[3]));
            print(gettype($insert_param[4]));
            print(gettype($insert_param[5]));
            print(gettype($insert_param[6]));            
            print(gettype($insert_param[7]));
            echo "<br>";
			*/
            // print("NULL");
            $db_sql2 = "INSERT INTO PARAMETER VALUES($insert_param[0],$insert_param[1],$type,$insert_param[2],$insert_param[3],$insert_param[4],$insert_param[5],$insert_param[6],$insert_param[7])";
            
            $param_result = mysqli_query($db_conn,$db_sql2);
        
        }
        echo "<br>";
    }
    
    $count1 = 0;
    if(!empty($_POST['score'])) {
        foreach($_POST['score'] as $score){
            $score_portion[$count1] = $score;
            $count1++;
        }
    }
    $count2 = 0;
    if(!empty($_POST['question_key'])) {
        foreach($_POST['question_key'] as $keyword) {
            $db_sql3 = "INSERT INTO QUESTION_KEYWORDS VALUES($question_id,$keyword,$lecture_id,$score_portion[$count2])";
            $keywords_result = mysqli_query($db_conn,$db_sql3);
            $count2++;
        }
    }
	
	$db_sql5 = "SELECT * FROM LECTURES WHERE LECTURE_ID = '$lecture_id'";
	$result5 = mysqli_query($db_conn, $db_sql5);
	while($info5 = mysqli_fetch_array($result5)){
		$class_id = $info5['class_id'];
		$lecture_name = $info5['name'];
	}
	
	$db_sql6 = "SELECT * FROM CLASSES WHERE CLASS_ID = '$class_id'";
	$result6 = mysqli_query($db_conn, $db_sql6);
	while($info6 = mysqli_fetch_array($result6)){
		$class_name = $info6['name'];
	}

	if($questions_result){
		echo "<script type=\"text/javascript\">alert(\"문항이 추가되었습니다\");location.href='tec_question_list.php?class_id_fwd=".$class_id."&class_name_fwd=".$class_name."&lecture_id_fwd=".$lecture_id."&lecture_name_fwd=".$lecture_name."'</script>";
	}else{
		echo "<script type=\"text/javascript\">alert(\"문항 추가에 실패했습니다\");history.back();</script>";
	}
?>