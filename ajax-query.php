<?php
	if(!function_exists('get_option'))
	 require_once('../../../wp-config.php');

	//get the all post variables	
	$query = $_REQUEST;
	//make the query string in correct format

	$query = makeQueryString($query);
	// load the next post content
	getNextPost($query);
		
	//get the next posts
	function getNextPost($query){
				ob_start();
					
				if($query['paged']){
					//query post with request page config
						query_posts($query);
						include(TEMPLATEPATH.'/loop.php');
					}
				$buffer = ob_get_contents();
				ob_end_clean();
			//print the out put as html
			echo $buffer; 
	}
	
  //make the query string correct format
	function makeQueryString($query=array()){
		//assign the new query stirng array
		$newQueryStringArray = array();
		//time to make the new query string
		foreach($query as $key => $value){
			//if $value has ',' seperated values, then just put them into a array
			$list = split(',',$value);
			if(count($list)>1){
				$value = $list;
			}
			//make the new string array
			$newQueryStringArray[$key] = $value;			
		}
		return $newQueryStringArray;
	}
?>