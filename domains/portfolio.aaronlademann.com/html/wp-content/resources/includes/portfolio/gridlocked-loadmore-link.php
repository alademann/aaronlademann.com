<section class="ready" id="new-posts"></section>

	<!--BEGIN #load-more-link-->
  <section id="load-more-link">
                
		<a	<?php echo $empty; echo $src; echo $offset; echo $cat; echo $author; echo $tag; echo $date; echo $search ?>href="#">
                     
			<?php _e('Load More...', 'framework'); ?>
      <span>
        <span data-src="<?php echo get_template_directory_uri(); ?>/images/<?php if(get_option('tz_alt_stylesheet') == 'dark.css'):?>dark<?php else: ?>light<?php endif; ?>/ajax-loader.gif" id="post-count">
            <?php echo $post_count; ?>
        </span>
        <span data-text="<?php _e('Remaining', 'framework'); ?>" id="remaining"><?php _e('Remaining', 'framework'); ?></span>
      </span>
    </a>
  <!--END #load-more-link-->
  </section>