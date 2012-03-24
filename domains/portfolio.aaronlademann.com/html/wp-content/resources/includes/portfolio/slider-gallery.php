<?php 
	function get_mimetype($uri){
		$length = strlen($uri);
		$period_pos = strrpos($uri,".") + 1;

		return substr($uri,$period_pos,($length-$period_pos));
	}
	function get_rawsrc($uri){

		$period_pos = strrpos($uri,".");
			
		$is_medium = strrpos($uri,"-med");
		if($is_medium){
			$raw_src = substr($uri, 0, $period_pos - 4);	
		} else {
			$raw_src = substr($uri, 0, $period_pos);
		}

			return $raw_src;

	} // END get_rawsrc
	function get_fullsize($uri){
			
		$mime = get_mimetype($uri);	
		$raw_src = get_rawsrc($uri);
			
		return $raw_src . "." . $mime;		

	} // END get_fullsize
	function get_thumbsize($uri){

		$mime = get_mimetype($uri);	
		$raw_src = get_rawsrc($uri);

		return $raw_src . "-thumb_sm." . $mime;
	}
	
?>