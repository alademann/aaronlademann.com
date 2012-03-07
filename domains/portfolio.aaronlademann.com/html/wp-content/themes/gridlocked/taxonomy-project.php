<?php get_header(); ?>
<?php
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
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if ( function_exists('yoast_breadcrumb') ) { ?>
				<h1 class="client"><?php wp_title(''); ?></h1>
			<?php	yoast_breadcrumb('<ul class="breadcrumb"><li>','</li></ul>');
			} ?>
            
            	<!--BEGIN #masonry-->
            	<div id="masonry-portfolio">

              	<?php 

								query_posts(array( 
										'post_type' => 'portfolio', 
										'posts_per_page' => -1,
										'project' => $curr_slug
									)
								); 

								?>
                
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
                    <!--BEGIN .hentry -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    
                        <?php 
                        $lightbox = get_post_meta(get_the_ID(), 'tz_portfolio_lightbox', TRUE); 
                        $thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
												$embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE);
                        $image  = get_post_meta(get_the_ID(), 'tz_portfolio_image', TRUE); 
												$folio_summary  = get_post_meta(get_the_ID(),'tz_portfolio_caption', TRUE); 
												if($folio_summary == ''){
													$folio_summary = get_the_title();
												}
                        $lightbox = FALSE;
                        
													if($thumb == ''){
															$thumb = FALSE;
													}
                            
                        ?>
                        
                        <div class="post-thumb clearfix">
                        
                             <?php if($lightbox && $embed == '') : ?>
                                <a class="lightbox" title="<?php the_title(); ?>" href="<?php echo $large_image; ?>">
                                    <span class="overlay">
                                        <span class="icon"></span>
                                    </span>
                                    
                                    <?php if($thumb) : ?>
                                    <img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
                                    <?php else: ?>
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                    <?php endif; ?>
                                </a>
                            <?php else: ?>
                            
                                <a title="<?php echo $folio_summary; ?>" href="<?php the_permalink(); ?>">
                                <?php if($thumb) : ?>
                                	<img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
                                <?php else: ?>
                                <?php the_post_thumbnail('thumbnail'); ?>
                                <?php endif; ?>
                                </a>
                                
                            <?php endif; ?>
                            
                        </div>
                        
                        <div class="arrow"></div>	
                        
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        
                        <!--<div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                        </div>-->
                        
												<?php if(!is_singular()) : get_template_part('includes/post-meta'); endif; ?>
                        
                    <!--END .hentry-->  
                    </div>

                <?php endwhile; endif; ?>
                </div>
                <!--END #masonry-->
                
			<!--END #primary .hfeed-->
			</div>

<?php get_footer(); ?>