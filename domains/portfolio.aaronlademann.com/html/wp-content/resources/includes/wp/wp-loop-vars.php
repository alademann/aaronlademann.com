<?php include(custom_includes_dir() . "/wp/wp-loop-vars_taxonomy.php"); ?>
<?php 
					
	$post_count = 0; 

	$empty = 'data-empty="'.__('No more posts available.', 'framework').'" ';
					
	$src = 'data-src="'.get_template_directory_uri().'/includes/get-posts.php" ';
					
	$offset = 'data-offset="'.get_option('posts_per_page').'" ';
					
	$catQ = 0;
	$cat = '';
	if(is_category())
		$catQ = get_query_var('cat');
		$cat = 'data-category="'.$catQ.'" '; 
					
	$authorQ = 0;
	$author = '';
	if(is_author())
		$authorQ = get_query_var('author');
		$author = 'data-author="'.$authorQ.'" '; 
					
	$tagQ = '';
	$tag = '';
	if(is_tag())
		$tagQ = get_query_var('tag');
		$tag = 'data-tag="'.$tagQ.'" '; 
						
	$dateQ = '';
	$date = '';
	if(is_archive())
		$dateQ = get_query_var('monthnum');
		$date = 'data-date="'.$dateQ.'" '; 
						
	$searchQ = '';
	$search = '';
	if(is_search())
		$searchQ = get_query_var('s');
		$search = 'data-search="'.$searchQ.'" '; 



	// The Query
	if($base_slug != $curr_slug){

		$the_query = new WP_Query( array(
				'post_type' => 'portfolio',
				$taxType => $curr_slug,
				'posts_per_page' => -1,
				//'cat' => $catQ,
				//'author' => $authorQ,
				//'tag' => $tagQ,
				//'monthnum' => $dateQ,
				's' => $searchQ
			)
		);

	} else {
		
		$the_query = new WP_Query( array(
				'post_type' => 'portfolio',
				'posts_per_page' => -1,
				//'cat' => $catQ,
				//'author' => $authorQ,
				//'tag' => $tagQ,
				//'monthnum' => $dateQ,
				's' => $searchQ
			)
		);	

	}
					
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$post_count++;
	endwhile;
					
		$total_results = $post_count;

	// Reset Post Data
	wp_reset_postdata();
					
	$post_count = $post_count - get_option('posts_per_page');
					
	if($post_count <= 0) 
		$post_count = 0;


	// paginate
  if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
  } elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
  } else {
		$paged = 1;
  }


	$option_posts_per_page = get_option( 'posts_per_page' );
  function my_option_posts_per_page() {
			global $option_posts_per_page;
			if ( is_tax( 'skill-type') || is_tax( 'portfolio-type') || is_tax( 'media-type') || is_tax( 'project') || is_tax( 'tools-used') ) {
					$paged = 0;
					return -1;
			} else {
					return $option_posts_per_page;
			}
	}

		// The Query
	if($base_slug != $curr_slug){
		// taxonomy page
		query_posts( array( 
			'post_type' => 'portfolio',
			$taxType => $curr_slug,
			'posts_per_page' => my_option_posts_per_page(), 
			'paged' => $paged,
			//'cat' => $catQ,
			//'author' => $authorQ,
			//'tag' => $tagQ,
			//'monthnum' => $dateQ,
			's' => $searchQ
			) 
		);

	} else if(is_search()) {
		// search page
		query_posts( array( 
			'post_type' => 'portfolio',
			'posts_per_page' => my_option_posts_per_page(), 
			'paged' => $paged,
			//'cat' => $catQ,
			//'author' => $authorQ,
			//'tag' => $tagQ,
			//'monthnum' => $dateQ,
			's' => $searchQ
			) 
		);

	} else {
		
		query_posts( array( 
			'post_type' => 'portfolio',
			'posts_per_page' => my_option_posts_per_page(), 
			'paged' => $paged,
			//'cat' => $catQ,
			//'author' => $authorQ,
			//'tag' => $tagQ,
			//'monthnum' => $dateQ,
			's' => $searchQ
			) 
		);

	}
 
  



					
?>