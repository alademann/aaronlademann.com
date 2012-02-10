<?php

// hard-coding $action to 'get' since dynamically sending it update based on cookie status throws a ridiculous error
function tz_likeThis( $post_id, $action = 'get' ) {
	
	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if

	switch($action) {
	
	// the get action doesn't check for / set a cookie
	case 'get':
		$data = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($data[0])) {
			$data[0] = 0;
			add_post_meta($post_id, '_likes', '0', true);
		} //if

		return $data[0];
	break;
	
	// appears unable to check the cookie / set the cookie... so 'update' is not currently an option.
	case 'update':
		
		if(isset($_COOKIE["like_" + $post_id])) {
			return;
		} //if
		
		$currentValue = get_post_meta($post_id, '_likes');
		$currentTitle = get_post_meta($post_id, '_wholikes');
		
		if(!is_numeric($currentValue[0])) {
			$currentValue[0] = 0;
			add_post_meta($post_id, '_likes', '1', true);
		} //if
		
		$currentValue[0]++;
		
		update_post_meta($post_id, '_likes', $currentValue[0]);
		update_post_meta($post_id, '_wholikes', tz_whoLikes($post_id, $currentValue[0]));

		setcookie("like_" + $post_id, $post_id, time()+60*60*24*30*600, '/');
	break;

	} //switch

} //tz_likeThis

function tz_whoLikes($post_id, $likes){
	
	$what = "'" . get_the_title($post_id) . "'";
	$who = $likes . ' people like ';
	if($likes == 1) {
		$who = $likes . ' person likes ';
	} 
	 // if(current user likes it)
	if(isset($_COOKIE["like_" + $post_id])) {	

		$who = 'You ';
		if($likes > 1){
			$others_count = "$likes" - 1;
			$others = 'and ' . $others_count . ' others like ';
			if($likes == 2) {
				$others = 'and 1 other person like ';
			}
		} else {
			// only you like it.
			$others = 'like ';
		}

		$wholikesit = $who . $others . $what;

	} else {
		// current user hasn't liked it yet	
		$wholikesit = $who . $what;
	}

	return $wholikesit;

}

function tz_printLikes($post_id) {
	$likes = tz_likeThis($post_id);
	$wholikes = tz_whoLikes($post_id, $likes);

	update_post_meta($post_id, '_wholikes', $wholikes);

	 // if(current user likes it)
	if(isset($_COOKIE["like_" + $post_id])) {	

		print '<a title="'. $wholikes .'" href="#" rel="nofollow" class="likeThis active" id="like-'.$post_id.'"><span class="icon"></span><span class="count">'.$likes.'</span></a>';
		return;

	} else {
		// current user hasn't liked it yet

		print '<a title="'. $wholikes .'" href="#" rel="nofollow" class="likeThis" id="like-'.$post_id.'"><span class="icon"></span><span class="count">'.$likes.'</span></a>';

	}

} //tz_printLikes


function setUpPostLikes($post_id) {
	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if
	
	
	add_post_meta($post_id, '_likes', '0', true);
	add_post_meta($post_id, '_wholikes', '', true);

} //setUpPost


function checkHeaders() {
	if(isset($_POST["likepost"])) {
		tz_likeThis($_POST["likepost"],'update');
	} //if

} //checkHeaders


function jsIncludes() {
	wp_enqueue_script('jquery');

} //jsIncludes

add_action ('publish_post', 'setUpPostLikes');
add_action ('init', 'checkHeaders');
add_action ('get_header', 'jsIncludes');
?>