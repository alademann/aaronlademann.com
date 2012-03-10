<?php get_header(); ?>
<!--BEGIN #primary .hfeed-->
<section id="primary" class="hfeed">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php 
  $image1 = get_post_meta(get_the_ID(), 'tz_portfolio_image', TRUE); 
		if($image1 != ''){
			$image1_caption = image_meta($image1,'caption', 'medium');
			$image1_mime = image_meta($image1,'mime', 'medium');
			$image1_h = image_meta($image1,'height', 'medium');
			$image1_w = image_meta($image1,'width', 'medium');
		}
  $image2 = get_post_meta(get_the_ID(), 'tz_portfolio_image2', TRUE); 
		if($image2 != ''){
			$image2_caption = image_meta($image2,'caption', 'full'); 
			$image2_mime = image_meta($image2,'mime', 'medium');
			$image2_h = image_meta($image2,'height', 'medium');
			$image2_w = image_meta($image2,'width', 'medium');
		}
  $image3 = get_post_meta(get_the_ID(), 'tz_portfolio_image3', TRUE); 
		if($image3 != ''){
			$image3_caption = image_meta($image3,'caption', 'full');
			$image3_mime = image_meta($image3,'mime', 'medium');
			$image3_h = image_meta($image3,'height', 'medium');
			$image3_w = image_meta($image3,'width', 'medium');
		}
  $image4 = get_post_meta(get_the_ID(), 'tz_portfolio_image4', TRUE); 
		if($image4 != ''){
			$image4_caption = image_meta($image4,'caption', 'full');
			$image4_mime = image_meta($image4,'mime', 'medium');
			$image4_h = image_meta($image4,'height', 'medium');
			$image4_w = image_meta($image4,'width', 'medium');
		}
  $image5 = get_post_meta(get_the_ID(), 'tz_portfolio_image5', TRUE);
		if($image5 != ''){
			$image5_caption = image_meta($image5,'caption', 'full'); 
			$image5_mime = image_meta($image5,'mime', 'medium');
			$image5_h = image_meta($image5,'height', 'medium');
			$image5_w = image_meta($image5,'width', 'medium');
		}
  $image6 = get_post_meta(get_the_ID(), 'tz_portfolio_image6', TRUE); 
		if($image6 != ''){
			$image6_caption = image_meta($image6,'caption', 'full');
			$image6_mime = image_meta($image6,'mime', 'medium');
			$image6_h = image_meta($image6,'height', 'medium');
			$image6_w = image_meta($image6,'width', 'medium');
		}
  $image7 = get_post_meta(get_the_ID(), 'tz_portfolio_image7', TRUE); 
		if($image7 != ''){
			$image7_caption = image_meta($image7,'caption', 'full'); 
			$image7_mime = image_meta($image7,'mime', 'medium');
			$image7_h = image_meta($image7,'height', 'medium');
			$image7_w = image_meta($image7,'width', 'medium');
		}
  $image8 = get_post_meta(get_the_ID(), 'tz_portfolio_image8', TRUE); 
		if($image8 != ''){
			$image8_caption = image_meta($image8,'caption', 'full');
			$image8_mime = image_meta($image8,'mime', 'medium');
			$image8_h = image_meta($image8,'height', 'medium');
			$image8_w = image_meta($image8,'width', 'medium');
		}
  $image9 = get_post_meta(get_the_ID(), 'tz_portfolio_image9', TRUE); 
		if($image9 != ''){
			$image9_caption = image_meta($image9,'caption', 'full');
			$image9_mime = image_meta($image9,'mime', 'medium');
			$image9_h = image_meta($image9,'height', 'medium');
			$image9_w = image_meta($image9,'width', 'medium');
		}
  $image10 = get_post_meta(get_the_ID(), 'tz_portfolio_image10', TRUE);
		if($image10 != ''){
			$image10_caption = image_meta($image10,'caption', 'full'); 
			$image10_mime = image_meta($image10,'mime', 'medium');
			$image10_h = image_meta($image10,'height', 'medium');
			$image10_w = image_meta($image10,'width', 'medium');
		}
	$image11 = get_post_meta(get_the_ID(), 'tz_portfolio_image11', TRUE);
		if($image11 != ''){
			$image11_caption = image_meta($image11,'caption', 'full'); 
			$image11_mime = image_meta($image11,'mime', 'medium');
			$image11_h = image_meta($image11,'height', 'medium');
			$image11_w = image_meta($image11,'width', 'medium');
		}
	$image12 = get_post_meta(get_the_ID(), 'tz_portfolio_image12', TRUE);
		if($image12 != ''){
			$image12_caption = image_meta($image12,'caption', 'full'); 
			$image12_mime = image_meta($image12,'mime', 'medium');
			$image12_h = image_meta($image12,'height', 'medium');
			$image12_w = image_meta($image12,'width', 'medium');
		}
	$image13 = get_post_meta(get_the_ID(), 'tz_portfolio_image13', TRUE);
		if($image13 != ''){
			$image13_caption = image_meta($image13,'caption', 'full'); 
			$image13_mime = image_meta($image13,'mime', 'medium');
			$image13_h = image_meta($image13,'height', 'medium');
			$image13_w = image_meta($image13,'width', 'medium');
		}
	$image14 = get_post_meta(get_the_ID(), 'tz_portfolio_image14', TRUE);
		if($image14 != ''){
			$image14_caption = image_meta($image14,'caption', 'full'); 
			$image14_mime = image_meta($image14,'mime', 'medium');
			$image14_h = image_meta($image14,'height', 'medium');
			$image14_w = image_meta($image14,'width', 'medium');
		}
	$image15 = get_post_meta(get_the_ID(), 'tz_portfolio_image15', TRUE);
		if($image15 != ''){
			$image15_caption = image_meta($image15,'caption', 'full'); 
			$image15_mime = image_meta($image15,'mime', 'medium');
			$image15_h = image_meta($image15,'height', 'medium');
			$image15_w = image_meta($image15,'width', 'medium');
		}

  $embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE);
  $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', false, '' );
	$thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
	$lightbox = TRUE;
	$height = get_post_meta(get_the_ID(), 'tz_portfolio_image_height', TRUE);

?> 
	<!--BEGIN .hentry -->
  <article class="<?php post_class(); ?>" id="post-<?php the_ID(); ?>">
  <?php if($image1 != '') : ?>
  <!-- its an image gallery -->
		<?php if($image8 != '' || $image2 == '') : 
		// if there is only 1, or there are 8 or more images... don't display the caption.
		?>
		<style type="text/css">.lightbox .caption { visibility: hidden !important; display: none !important; }</style>
		<?php endif; ?>
																																																																																			<script id="image_raw_sources">
			// break down all the different sizes i have for each shot
			<?php if($image1 != '') : ?>raw_src1 = "<?php echo $image1; ?>";<?php endif; ?>
			<?php if($image2 != '') : ?>raw_src2 = "<?php echo $image2; ?>";<?php endif; ?>
			<?php if($image3 != '') : ?>raw_src3 = "<?php echo $image3; ?>";<?php endif; ?>
			<?php if($image4 != '') : ?>raw_src4 = "<?php echo $image4; ?>";<?php endif; ?>
			<?php if($image5 != '') : ?>raw_src5 = "<?php echo $image5; ?>";<?php endif; ?>
			<?php if($image6 != '') : ?>raw_src6 = "<?php echo $image6; ?>";<?php endif; ?>
			<?php if($image7 != '') : ?>raw_src7 = "<?php echo $image7; ?>";<?php endif; ?>
			<?php if($image8 != '') : ?>raw_src8 = "<?php echo $image8; ?>";<?php endif; ?>
			<?php if($image9 != '') : ?>raw_src9 = "<?php echo $image9; ?>";<?php endif; ?>
			<?php if($image10 != '') : ?>raw_src10 = "<?php echo $image10; ?>";<?php endif; ?>
			<?php if($image11 != '') : ?>raw_src11 = "<?php echo $image11; ?>";<?php endif; ?>
			<?php if($image12 != '') : ?>raw_src12 = "<?php echo $image12; ?>";<?php endif; ?>
			<?php if($image13 != '') : ?>raw_src13 = "<?php echo $image13; ?>";<?php endif; ?>
			<?php if($image14 != '') : ?>raw_src14 = "<?php echo $image14; ?>";<?php endif; ?>
			<?php if($image15 != '') : ?>raw_src15 = "<?php echo $image15; ?>";<?php endif; ?>

			function get_image_src(index,size){
				// break down the raw src info pieces
				var raw_src;
				var img_size;
				//console.info("index: " + index);
				switch(index)
				{
					case '1':
						raw_src = raw_src1;		
					break;
					case '2':
						raw_src = raw_src2;
					break;
					case '3':
						raw_src = raw_src3;
					break;
					case '4':
						raw_src = raw_src4;
					break;
					case '5':
						raw_src = raw_src5;
					break;
					case '6':
						raw_src = raw_src6;
					break;
					case '7':
						raw_src = raw_src7;
					break;
					case '8':
						raw_src = raw_src8;
					break;
					case '9':
						raw_src = raw_src9;
					break;
					case '10':
						raw_src = raw_src10;
					break;
					case '11':
						raw_src = raw_src11;
					break;
					case '12':
						raw_src = raw_src12;
					break;
					case '13':
						raw_src = raw_src13;
					break;
					case '14':
						raw_src = raw_src14;
					break;
					case '15':
						raw_src = raw_src15;
					break;
					default:
					// something went wrong
					//console.warn("no index " + index + " is defined here.");
				} 
				var img_suffix = "-";
				var img_scaled = "-med."; // if there is a larger version of the image, this will show up at the end of the filename
				var img_dir =  raw_src.slice(0,raw_src.lastIndexOf("/") + 1);
				var img_mime = raw_src.slice(raw_src.lastIndexOf("."),raw_src.length);
				var img_name = '';
				if( raw_src.lastIndexOf(img_scaled) != -1 ){
					//console.info(raw_src.lastIndexOf(img_scaled));
					img_name = raw_src.slice(raw_src.lastIndexOf("/") + 1,raw_src.lastIndexOf(img_suffix));	
				} else {
					//console.info("else " + raw_src.lastIndexOf(img_scaled));
					img_name = raw_src.slice(raw_src.lastIndexOf("/") + 1,raw_src.lastIndexOf(img_mime));  	
				}
				var image;

				if(size == "full"){
					image = img_dir + img_name + img_mime; // original uploaded file... no suffix / size added to filename
				} else {
					image = img_dir + img_name + img_suffix + size + img_mime;	
				}
				//console.info("raw_src: " + raw_src + "\nimage: " + image);
				return image;
										
			}
									
			head.ready(function(){
									
				var win_width = $(window).width();
				var large_image_size;
				if(win_width > 1024) {
					if(win_width > 1200) {
						large_image_size = 'full';
					} else {
						large_image_size = 'lg';
					}
				} else {
					large_image_size = 'med';
				}
				var lightImages = $(".slider").find("a.lightbox");
				$(lightImages).each(function(index){
					var strIndex = (index + 1)+'';
					var lightLink;

					var scaled_image = $(this).find("img").attr("src");
					if( scaled_image.lastIndexOf("-med") ){
						lightLink = get_image_src(strIndex,large_image_size);
					} else {
						lightLink = get_image_src(strIndex,"full");
					}

					$(this).attr("href",lightLink);
					//console.info("link #1 href=" + lightLink);
											
				});
			});
	</script>
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
						        i++;
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