<?php
	
	$str = "가나다라마바사 {param1} 아자차카타파하{param2}";
	$arr = [];
	$i = 0;
	$chk =1;
	
	while($chk == 1){
		$result = strpos($str, "{");
		$arr[$i] = substr($str, 0, $result);
		
		$result2 = strpos($str, "}");
		$str = substr($str, $result2+1);
		
		$i = $i + 1;
		
		if($str == ""){
			$chk = 0;
		}
	}
	
	$i = 0;
	while(array_key_exists($i, $arr)){
		printf($arr[$i]."<br>");
		$i = $i + 1;
	}

?>