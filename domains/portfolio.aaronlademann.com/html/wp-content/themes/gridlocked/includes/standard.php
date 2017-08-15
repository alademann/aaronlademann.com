<!--BEGIN .masonry-brick -->
<article class="<?php echo join( ' ', get_post_class( '', the_ID() ) ); ?> box masonry-brick" id="post-<?php the_ID(); ?>">

<?php
$lightbox = get_post_meta(get_the_ID(), 'tz_portfolio_lightbox', TRUE);
$thumbSrc = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE);
$isIphone = is_iphone();
if($isIphone || $deviceClass == "iphone") :
	$thumb = get_iosThumb($thumbSrc);
else:
	$thumb = $thumbSrc;
endif;

$iPhoneThumb = get_post_meta(get_the_ID(), 'iOS-thumb', TRUE);
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
  <section class="figcaption">
		<h2 class="entry-title"><a class="permalink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </section>
	<footer>
		<?php if(!is_singular()) : get_template_part('includes/post-meta'); endif; ?>
  </footer>
</article>
<!--END .masonry-brick-->