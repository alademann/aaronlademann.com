<?php get_header(); ?>
<!--BEGIN #primary .hfeed-->
<section id="primary" class="hfeed">
	<header>
<?php if ( function_exists('yoast_breadcrumb') ) { ?>
	<!-- BEGIN .breadcrumb navigation -->
		<nav id="crumbpaths">
			<?php	yoast_breadcrumb('<ul class="breadcrumb"><li>','</li></ul>'); ?>
		</nav>
	<!-- END .breadcrumb navigation --> 
<?php } ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<!--BEGIN .single-page-navigation -->
		<nav class="navigation single-page-navigation clearfix">
			<section class="nav-previous">
				<?php next_post_link(__('%link', 'framework'), '<span class="arrow">%title</span>') ?>
			</section>
			<!--<section class="portfolio-link">
				<a href="<?php echo get_permalink( get_option('tz_portfolio_page') ); ?>"> <span class="icon"><?php _e('Back to Portfolio', 'framework'); ?></span></a> 
			</section>-->
			<section class="nav-next">
				<?php previous_post_link(__('%link', 'framework'), '<span class="arrow">%title</span>') ?>
			</section>					
		</nav>
		<!--END .single-page-navigation -->
	</header>
	<?php include(custom_includes_dir() . "/portfolio/slider-gallery.php"); ?>
 
	<!--BEGIN .hentry -->
  <article class="<?php post_class(); ?>" id="post-<?php the_ID(); ?>">
  <?php if($image1 != '') : ?>
  <!-- its an image gallery -->
		<?php if($image8 != '' || $image2 == '') : 
		// if there is only 1, or there are 8 or more images... don't display the caption.
		?>
		<style type="text/css">.lightbox .caption { visibility: hidden !important; display: none !important; }</style>
		<?php endif; ?>

		<?php include(custom_includes_dir() . "/portfolio/slider-gallery-img-sources.php"); ?>

		<?php tz_gallery(get_the_ID()); ?>
		<?php if($image2 != '') : ?>
		<div class="arrow"></div>
		<?php else: ?>
		<div class="arrow noslider"></div>
		<?php endif; ?>

    <!--BEGIN .slider -->
    <section id="slider-<?php the_ID(); ?>" class="slider" data-loader="<?php echo  get_template_directory_uri(); ?>/images/<?php if(get_option('tz_alt_stylesheet') == 'dark.css'):?>dark<?php else: ?>light<?php endif; ?>/ajax-loader.gif">
      <section class="slides_container clearfix">
        <?php if($image1 != '') : ?>
      	<figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image1_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image1_caption; ?></strong></figcaption>
      			<img height="<?php echo $image1_h; ?>" width="<?php echo $image1_w; ?>" src="<?php echo $image1; ?>" alt="<?php echo $image1_caption; ?>" class="<?php echo $image1_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
        <?php if($image2 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image2_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image2_caption; ?></strong></figcaption>
      			<img height="<?php echo $image2_h; ?>" width="<?php echo $image2_w; ?>" src="<?php echo $image2; ?>" alt="<?php echo $image2_caption; ?>" class="<?php echo $image2_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
        <?php if($image3 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image3_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image3_caption; ?></strong></figcaption>
      			<img height="<?php echo $image3_h; ?>" width="<?php echo $image3_w; ?>" src="<?php echo $image3; ?>" alt="<?php echo $image3_caption; ?>" class="<?php echo $image3_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
        <?php if($image4 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image4_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image4_caption; ?></strong></figcaption>
      			<img height="<?php echo $image4_h; ?>" width="<?php echo $image4_w; ?>" src="<?php echo $image4; ?>" alt="<?php echo $image4_caption; ?>" class="<?php echo $image4_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
        <?php if($image5 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image5_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image5_caption; ?></strong></figcaption>
      			<img height="<?php echo $image5_h; ?>" width="<?php echo $image5_w; ?>" src="<?php echo $image5; ?>" alt="<?php echo $image5_caption; ?>" class="<?php echo $image5_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
				<?php if($image6 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image6_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image6_caption; ?></strong></figcaption>
      			<img height="<?php echo $image6_h; ?>" width="<?php echo $image6_w; ?>" src="<?php echo $image6; ?>" alt="<?php echo $image6_caption; ?>" class="<?php echo $image6_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
        <?php if($image7 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image7_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image7_caption; ?></strong></figcaption>
      			<img height="<?php echo $image7_h; ?>" width="<?php echo $image7_w; ?>" src="<?php echo $image7; ?>" alt="<?php echo $image7_caption; ?>" class="<?php echo $image7_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
        <?php if($image8 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image8_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image8_caption; ?></strong></figcaption>
      			<img height="<?php echo $image8_h; ?>" width="<?php echo $image8_w; ?>" src="<?php echo $image8; ?>" alt="<?php echo $image8_caption; ?>" class="<?php echo $image8_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
        <?php if($image9 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image9_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image9_caption; ?></strong></figcaption>
      			<img height="<?php echo $image9_h; ?>" width="<?php echo $image9_w; ?>" src="<?php echo $image9; ?>" alt="<?php echo $image9_caption; ?>" class="<?php echo $image9_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
        <?php if($image10 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image10_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image10_caption; ?></strong></figcaption>
      			<img height="<?php echo $image10_h; ?>" width="<?php echo $image10_w; ?>" src="<?php echo $image10; ?>" alt="<?php echo $image10_caption; ?>" class="<?php echo $image10_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
				<?php if($image11 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image11_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image11_caption; ?></strong></figcaption>
      			<img height="<?php echo $image11_h; ?>" width="<?php echo $image11_w; ?>" src="<?php echo $image11; ?>" alt="<?php echo $image11_caption; ?>" class="<?php echo $image11_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
				<?php if($image12 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image12_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image12_caption; ?></strong></figcaption>
      			<img height="<?php echo $image12_h; ?>" width="<?php echo $image12_w; ?>" src="<?php echo $image12; ?>" alt="<?php echo $image12_caption; ?>" class="<?php echo $image12_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
				<?php if($image13 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image13_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image13_caption; ?></strong></figcaption>
      			<img height="<?php echo $image13_h; ?>" width="<?php echo $image13_w; ?>" src="<?php echo $image13; ?>" alt="<?php echo $image13_caption; ?>" class="<?php echo $image13_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
				<?php if($image14 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image14_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image14_caption; ?></strong></figcaption>
      			<img height="<?php echo $image14_h; ?>" width="<?php echo $image14_w; ?>" src="<?php echo $image14; ?>" alt="<?php echo $image14_caption; ?>" class="<?php echo $image14_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
				<?php if($image15 != '') : ?>
        <figure>
      		<a class="lightbox" title="Click to view full-size <?php echo $image15_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>">
      			<figcaption><strong class="caption"><?php echo $image15_caption; ?></strong></figcaption>
      			<img height="<?php echo $image15_h; ?>" width="<?php echo $image15_w; ?>" src="<?php echo $image15; ?>" alt="<?php echo $image15_caption; ?>" class="<?php echo $image15_mime; ?>" />
      		</a>
      	</figure>
        <?php endif; ?>
      </section>
    </section>
		<!--END .slider -->
	<?php else: ?>
	<!-- its a video gallery -->
	<?php $embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE); ?>
  <?php if($embed == '') : ?>
  <?php tz_video(get_the_ID()); ?>
  <?php $heightSingle = get_post_meta(get_the_ID(), 'tz_video_height_single', TRUE); ?>
		<style type="text/css">.single .jp-video-play, .single div.jp-jplayer.jp-jplayer-video { height: <?php echo $heightSingle; ?>px; }</style>
		<!-- BEGIN jquery_jplayer -->
		<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer jp-jplayer-video"></div>
		<div class="jp-video-container">
			<div class="jp-video">
				<div class="jp-type-single">
					<div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
						<ul class="jp-controls">
							<li>
								<div class="seperator-first"></div>
							</li>
							<li>
								<div class="seperator-second"></div>
							</li>
							<li><a href="#" class="jp-play" tabindex="1">play</a></li>
							<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
							<li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
							<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
						</ul>
						<div class="jp-progress-container">
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
						</div>
						<div class="jp-volume-bar-container">
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<!-- END jquery_jplayer -->
  <?php else: ?>
		<?php echo stripslashes(htmlspecialchars_decode($embed)); ?>
  <?php endif; ?>          
  <?php endif; ?>
  <!-- END IF(image or video) -->
  
		<!--BEGIN .entry-content -->
		<?php
			$simple_style = '';
			$item_content = get_the_content();
			if($image2 == ''){
				if($item_content == ''){
					$simple_style = 'min-height: 1px !important; margin-top: -22px !important;';
				}
			}
		?>	 
		<section class="entry-content" style="<?php echo $simple_style; ?>">
  	
		</section>
		<!--END .entry-content -->
		<!--BEGIN #single-sidebar-->
  	<section id="single-sidebar">
  		<?php 
  			if(get_the_content() != ''){
  				$caption = get_the_content(); 
  				} else {
  				$caption = stripslashes(htmlspecialchars_decode(get_post_meta(get_the_ID(), 'tz_portfolio_caption', TRUE))); 
  			}		
  			$link = get_post_meta(get_the_ID(), 'tz_portfolio_link', TRUE); 
  		?>
  		<!--BEGIN .entry-meta .entry-header-->
  		<header>
  			<h1><?php the_title(); ?></h1>					
  			<ul class="entry-header clearfix">
  				<li class="like-count">
  					<?php tz_printLikes(get_the_ID()); ?>
  				</li>
  				<?php if($caption != '') : ?>
  				<li class="caption"><strong class="black"><?php echo the_date('F j, Y'); ?></strong><br /> <?php echo $caption; ?> </li>
  				<?php endif; ?>
  				<?php if($link != '') : ?>
  				<li class="link"><a target="_blank" href="<?php echo $link; ?>"><span class="icon"></span><?php _e('View Project', 'framework'); ?></a></li>
  				<?php endif; ?>
  			</ul>
  		</header>
			<!--END .entry-meta .entry-header-->
  		<div class="seperator clearfix"><div class="line"></div></div>
			<footer>
				<ul class="entry-meta clearfix">
					<li class="terms">
						<ul>
							<?php
							// depending on the type of portfolio piece it is, there may be no client...
							$portfolio_type_args = array('orderby' => 'term_group', 'order' => 'ASC', 'fields' => 'all');
							$portfolio_type_terms = wp_get_object_terms($post->ID, 'portfolio-type', $portfolio_type_args);
							if(!empty($portfolio_type_terms)){
								if(!is_wp_error( $portfolio_type_terms )){
									echo '<li><h3 class="widget-title">Portfolio Type</h3></li><li>';
						      $i = 0;
						      foreach($portfolio_type_terms as $portfolio_type){
										if($i == 0){ 
											$portfolio_type_main = $portfolio_type->name; 
						          $portfolio_type_main_link = get_term_link($portfolio_type->slug, 'portfolio-type');
											echo '<strong>'; 
						          $title = 'View all ' . $portfolio_type_main . ' content in Aaron&rsquo;s Portfolio';
										}
						        if($i > 0){ 
											$portfolio_type_child = $portfolio_type->name; 
						          $portfolio_type_child_link = get_term_link($portfolio_type->slug, 'portfolio-type');
											echo ' > '; 
						          $title = 'View all ' . $portfolio_type_main . ' ' . $portfolio_type_child . ' content in Aaron&rsquo;s Portfolio';
										}
										echo '<a title="'. $title .'" href="'.get_term_link($portfolio_type->slug, 'portfolio-type').'">'.$portfolio_type->name.'</a>'; 
										if($i == 0){ echo '</strong>'; }
						        $i++;
						      } // END foreach()
						      echo '</li>';
								} // END if(!is_wp_error)
							} // END if(!empty())

							$client_args = array('orderby' => 'term_group', 'order' => 'ASC', 'fields' => 'all');
							$client_terms = wp_get_object_terms($post->ID, 'project', $client_args);
							if(!empty($client_terms)){
								if(!is_wp_error( $client_terms )){
									echo '<li><h3 class="widget-title">Client / Project</h3></li><li>';
						      $i = 0;
						      foreach($client_terms as $client){
										if($i == 0){ 
											$client_main = $client->name;
						          echo '<strong>'; 
						          $title = 'View all projects done for ' . $client_main; 
						        }
						        if($i > 0){ echo ' > '; $title = 'View all ' . $client->name . ' project elements for ' . $client_main; 
										}
						        echo '<a title="'. $title .'" href="'.get_term_link($client->slug, 'project').'">'.$client->name.'</a>'; 
						        if($i == 0){ echo '</strong>'; 
										}
						        $i++;
						      } // END foreach()
									echo '</li>';
								} // END if(!is_wp_error)
							} // END if(!empty())
							?>
						</ul>
						<ul>
							<?php
							$skill_args = array('orderby' => 'term_group', 'order' => 'ASC', 'fields' => 'all');
							$skill_terms = wp_get_object_terms($post->ID, 'skill-type', $skill_args);
							if(!empty($skill_terms)){
								if(!is_wp_error( $skill_terms )){
									echo '<li><h3 class="widget-title">Skill(s) Used</h3></li><li>';
						      $i = 0;
						      foreach($skill_terms as $skill){
										if($i == 0){ echo '<strong>'; }
											if($i > 0){ echo ' > '; 
											}
											echo '<a title="View all ' . $skill->name . ' content in Aaron&rsquo;s Portfolio" href="'.get_term_link($skill->slug, 'skill-type').'">'.$skill->name.'</a>';
											if($i == 0){ echo '</strong>'; 
											}
						          $i++;
						        }
						        echo '</li>';
									}
								}
							?>
						</ul>
						<ul>
							<?php
							$media_args = array('orderby' => 'term_group', 'order' => 'ASC', 'fields' => 'all');
							$media_terms = wp_get_object_terms($post->ID, 'media-type', $media_args);
							if(!empty($media_terms)){
								if(!is_wp_error( $media_terms )){
									echo '<li><h3 class="widget-title">Media Type(s)</h3></li><li>';
						      $i = 0;
						      foreach($media_terms as $media){
										if($i > 0){ echo ', '; 
										}
						        echo '<a title="View all portfolio content made for the following media: ' . $media->name . '" href="'.get_term_link($media->slug, 'media-type').'">'.$media->name.'</a>';
										$i++;
						      } // END foreach()
						      echo '</li>';
								}
							}
							?>
						</ul>
						<ul>
							<?php
							$tool_args = array('orderby' => 'term_group', 'order' => 'ASC', 'fields' => 'all');
							$tool_terms = wp_get_object_terms($post->ID, 'tools-used', $tool_args);
							if(!empty($tool_terms)){
								if(!is_wp_error( $tool_terms )){
									echo '<li><h3 class="widget-title">Tool(s) Used</h3></li><li>';
						      $i = 0;
						      foreach($tool_terms as $tool){
										if($i > 0){ echo ', '; 
										}
						        echo '<a title="View all pieces created using ' . $tool->name . '" href="'.get_term_link($tool->slug, 'tools-used').'">'.$tool->name.'</a>';
										$i++;
						      }
						      echo '</li>';
								}
							}
							?>
						</ul>
					</li>
				</ul>
			</footer>
			<!--END .entry-meta entry-footer -->
  		<div class="seperator clearfix"><div class="line"></div></div>
  		<?php edit_post_link( __('[Edit]', 'framework'), '<ul><li class="edit-post">', '</li></ul>' ); ?>
  	</section>
		<!--END #single-sidebar-->
  </article>
	<!--END .hentry-->
<?php endwhile; else: ?>
	</header>
	<!--BEGIN #post-0-->
	<article id="post-0" class="<?php post_class() ?>">
		<h1 class="entry-title">
			<?php _e('Error 404 - Not Found', 'framework') ?>
		</h1>
		<!--BEGIN .entry-content-->
		<section class="entry-content">
			<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
		</section>
		<!--END .entry-content-->
	</article>
	<!--END #post-0-->
<?php endif; ?>
<!--END #primary .hfeed-->
</section>
<?php get_footer(); ?>