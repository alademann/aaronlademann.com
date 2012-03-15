<?php
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
	$base_slug = "portfolio"; // configure this based on what the home dir of the wordpress portfolio system is

		$path_elements = pathinfo($_SERVER['REQUEST_URI']); // array that stores the diff parts of the uri
			$parent_paths = $path_elements['dirname'] . '/';
			$current_taxonomy = $path_elements['basename'] . '/'; // $path_elements['basename'] = $path_elements['filename'] + $path_elements['extension']

		$full_path = $parent_paths . $current_taxonomy;
	
		// explode $full_path into pieces that we can use for breadcrumb link slugs
		$path_slugs = explode('/', $full_path);
		$base_slug = $path_slugs[0]; // main portfolio path

		$dir_depth = 0;
		foreach($path_slugs as $slug){
			//echo $slug, " ", $i;
			if("" !== $slug) :
				// we only want to count non-empty, non "base" (/portfolio/) slugs as directories
				$dir_depth++;
			endif;
		}
		//echo $dir_depth;
		// now that we know how many paths deep we are...
		$curr_slug = $path_slugs[$dir_depth];
		$par_slug = $path_slugs[$dir_depth-1];
		$tax_slug = $path_slugs[$dir_depth-($dir_depth-2)];
?>    