<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
            
            <?php 
			
			//query_posts( array(
			//				'post_type' => 'portfolio',
			//				'posts_per_page' => -1
			//	)
			//);
			
			?>

			<?php get_search_form(); ?>

            	<!--BEGIN #masonry-->
            	<div id="masonry-portfolio">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
                    <!--BEGIN .hentry -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        
                        <?php 
                        
                        
                        $lightbox = get_post_meta(get_the_ID(), 'tz_portfolio_lightbox', TRUE); 
                        $thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
												$thumb_caption = get_post_meta(get_the_ID(), 'tz-meta-box-portfolio-info', TRUE);
                        
													$embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE);
						
                        $image  = get_post_meta(get_the_ID(), 'tz_portfolio_image', TRUE); 
													$image_caption  = get_post_meta(get_the_ID(), 'tz_portfolio_image_caption', TRUE); 
                        $image2 = get_post_meta(get_the_ID(), 'tz_portfolio_image2', TRUE); 
													$image2_caption  = get_post_meta(get_the_ID(), 'tz_portfolio_image2_caption', TRUE); 
                        $image3 = get_post_meta(get_the_ID(), 'tz_portfolio_image3', TRUE); 
													$image3_caption  = get_post_meta(get_the_ID(), 'tz_portfolio_image3_caption', TRUE); 
                        $image4 = get_post_meta(get_the_ID(), 'tz_portfolio_image4', TRUE); 
													$image4_caption  = get_post_meta(get_the_ID(), 'tz_portfolio_image4_caption', TRUE); 
                        $image5 = get_post_meta(get_the_ID(), 'tz_portfolio_image5', TRUE);
													$image5_caption  = get_post_meta(get_the_ID(), 'tz_portfolio_image5_caption', TRUE); 
						
													$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                        
                        if($lightbox == 'no')
                            $lightbox = FALSE;
                        
                        if($thumb == '')
                            $thumb = FALSE;

                         $large_image = $large_image[0];
                            
                        ?>
                        
                        <div class="post-thumb clearfix">
                        
                            <?php if($lightbox && $embed == '') : ?>
                                <a class="lightbox" title="<?php the_title(); ?>" href="<?php echo $large_image; ?>" rel="nofollow">
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
                            
                            	<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
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