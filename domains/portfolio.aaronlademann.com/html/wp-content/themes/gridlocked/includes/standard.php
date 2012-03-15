<!--BEGIN .masonry-brick -->
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
	<section class="wellOverlay">&nbsp;</section>
  <figcaption>                  
		<h2 class="entry-title"><a class="permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </figcaption>
	<footer>
		<?php if(!is_singular()) : get_template_part('includes/post-meta'); endif; ?>
  <footer>
</article>
<!--END .masonry-brick-->