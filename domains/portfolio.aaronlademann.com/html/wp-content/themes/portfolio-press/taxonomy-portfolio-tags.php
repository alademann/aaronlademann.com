<?php
/*
This template is for displaying the portfolio tags
*/
?>

<?php get_header(); ?>

			<div id="portfolio">

            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; global $post; ?>
            
            <div class="portfolio-item item<?php echo $count; ?> <?php if ($count % 3 == 0) { echo 'last'; } ?>">
            
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'portfoliopress'); ?> <?php the_title_attribute(); ?>" class="thumb"><?php the_post_thumbnail('portfolio-thumbnail'); ?></a>
            
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'portfoliopress'); ?> <?php the_title_attribute(); ?>" class="title-overlay"><?php the_title() ?></a>
            
            </div>
            
            <?php if ($count % 3 == 0) { echo '<div class="clear"></div>'; } ?>
            
            <?php endwhile; ?> 
            
            <?php /* Display navigation to next/previous pages when applicable */ ?>
            
			<?php if (  $wp_query->post_count > 9 || $wp_query->max_num_pages > 1 || is_paged() ) : ?>

			<?php if (function_exists('wp_pagenavi') ) { ?>
	    
				<?php wp_pagenavi(); ?>
	    
			<?php } else { ?>
        
				<nav id="nav-below">
				<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'portfoliopress' ); ?></h1>		
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'portfoliopress' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'portfoliopress' ) ); ?></div>
				</nav><!-- #nav-below -->
    
    		<?php } ?>
		<?php endif; ?>

		<?php else: ?>
            
            <h2 class="title"><?php _e('Sorry, no posts matched your criteria.', 'portfoliopress') ?></h2>
            
            <?php endif; ?>  

			</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>