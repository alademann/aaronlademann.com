<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>
<!--BEGIN #primary .hfeed-->
<section id="primary" class="hfeed span12">
<?php 
	if(is_search()){
		echo "<header><h1>Search Results for <mark>". get_search_query() ."</mark></h1><header>";
	}
?>
	<!--BEGIN #masonry-->
	<section id="masonry-portfolio" class="masonry">
	<?php
			query_posts( array(
				'post_type' => 'portfolio',
				'posts_per_page' => -1
				)
			);
	?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
	<?php 
		$home_feature = get_post_meta(get_the_ID(), 'tz_portfolio_home_feature', TRUE);
		if($home_feature == 'yes') : 
	?>			
		<!--BEGIN .hentry -->
    <article class="<?php post_class(); ?> box masonry-brick" id="post-<?php the_ID(); ?>">                
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
			<figure class="post-thumb clearfix">                 
      <?php if($lightbox && $embed == '') : ?>
				<a class="lightbox" title="<?php the_title(); ?>" href="<?php echo $large_image; ?>" rel="nofollow"><span class="overlay"><span class="icon"></span></span>				<?php if($thumb) : ?>
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
      </figure>
      <figcaption>                  
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </figcaption>
			<footer>
				<?php if(!is_singular()) : get_template_part('includes/post-meta'); endif; ?>
      <footer>
    </article>
		<!--END .hentry-->
	<?php endif; ?> 
	<!-- END if home_feature -->
	<?php endwhile; endif; ?>
  </section>
  <!--END #masonry-->
</section>
<!--END #primary .hfeed-->
<?php get_footer(); ?>