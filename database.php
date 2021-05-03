<?php 
	
	
	
	
	function DBRead($table, $params, $fields){
		$table = $table;
		$params = $params;
		$query = "SELECT {$fields} FROM {$table}{$params}";
		$result = DBExecute($query);
		//echo '<p>'.$query.';</p>';
		if(!mysqli_num_rows($result))
			return false;
		else{
			while($res = mysqli_fetch_assoc($result)){
				$data[] = $res;
			}
			return $data;
		}
		
	}
	
	function DBExecute($query){
		$link = DBConnect();
		$result = @mysqli_query($link, $query) or die(mysqli_error($link));
		
		DBClose($link);
		return $result;
		
		
	}