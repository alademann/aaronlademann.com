<?php get_header(); ?>
<!--BEGIN #primary .hfeed-->
        
        <div id="primary" class="hfeed">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php 
									
											

                  $image1 = get_post_meta(get_the_ID(), 'tz_portfolio_image', TRUE); 
										$image1_caption = get_post_meta(get_the_ID(), 'tz_portfolio_image_caption', TRUE); 
                  $image2 = get_post_meta(get_the_ID(), 'tz_portfolio_image2', TRUE); 
										$image2_caption = get_post_meta(get_the_ID(), 'tz_portfolio_image2_caption', TRUE); 
                  $image3 = get_post_meta(get_the_ID(), 'tz_portfolio_image3', TRUE); 
										$image3_caption = get_post_meta(get_the_ID(), 'tz_portfolio_image3_caption', TRUE); 
                  $image4 = get_post_meta(get_the_ID(), 'tz_portfolio_image4', TRUE); 
										$image4_caption = get_post_meta(get_the_ID(), 'tz_portfolio_image4_caption', TRUE); 
                  $image5 = get_post_meta(get_the_ID(), 'tz_portfolio_image5', TRUE);
										$image5_caption = get_post_meta(get_the_ID(), 'tz_portfolio_image5_caption', TRUE); 
                  $height = get_post_meta(get_the_ID(), 'tz_portfolio_image_height', TRUE);
                  
									
										$lightbox = get_post_meta(get_the_ID(), 'tz_portfolio_lightbox', TRUE); 
                    $embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE);
                    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
										$thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
										$lightbox = TRUE;
										 
                  
                  //echo $height;
                ?> 

          <!--BEGIN .hentry -->
          <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

            <?php if($image1 != '') : ?>
            <!-- its an image gallery -->
            	<!-- aaronl: custom -->
            	<script type="text/javascript">
							// break down all the different sizes i have for each shot
									<?php if($image1 != '') : ?>raw_src1 = "<?php echo $image1; ?>";<?php endif; ?>
									<?php if($image2 != '') : ?>raw_src2 = "<?php echo $image2; ?>";<?php endif; ?>
									<?php if($image3 != '') : ?>raw_src3 = "<?php echo $image3; ?>";<?php endif; ?>
									<?php if($image4 != '') : ?>raw_src4 = "<?php echo $image4; ?>";<?php endif; ?>
									<?php if($image5 != '') : ?>raw_src5 = "<?php echo $image5; ?>";<?php endif; ?>

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
											default:
											// something went wrong
											//console.warn("no index " + index + " is defined here.");
										} 
										switch(size)
										{
											case 'thumb':
												img_size = "_thumb";
											break;
											case 'image':
												img_size = "_550";
											break;
											case 'full':
												img_size = "_full";
											break;
											case 'big':
												img_size = "_1920";
											break;
											default:
											// something went wrong
											//console.warn("no size " + size + " is defined here.");
										} 
										var img_dir =  raw_src.slice(0,raw_src.lastIndexOf("/") + 1);
										var img_name = raw_src.slice(raw_src.lastIndexOf("/") + 1,raw_src.lastIndexOf("_"));    
										var img_mime = raw_src.slice(raw_src.lastIndexOf("."),raw_src.length);
										
										var image = img_dir + img_name + img_size + img_mime;
										//console.info("raw_src: " + raw_src + "\nimage: " + image);
										return image;
										
									}
									
									$(document).ready(function(){
									
										var win_width = $(window).width();
										var large_image_size;
										if(win_width > 1024) {
											large_image_size = 'big';
										} else {
											large_image_size = 'full';
										}
										var lightImages = $(".slider").find("a.lightbox");
										$(lightImages).each(function(index){

											var strIndex = (index + 1)+'';
											var lightLink = get_image_src(strIndex,large_image_size);
											$(this).attr("href",lightLink);
											//console.info("link #1 href=" + lightLink);
											
										});
									});
							</script>
              <!-- aaronl: custom -->

              
								<?php tz_gallery(get_the_ID()); ?>
                <!--BEGIN .slider -->
                <div id="slider-<?php the_ID(); ?>" class="slider" data-loader="<?php echo  get_template_directory_uri(); ?>/images/<?php if(get_option('tz_alt_stylesheet') == 'dark.css'):?>dark<?php else: ?>light<?php endif; ?>/ajax-loader.gif">
                  <div id="" class="slides_container clearfix">
                    <?php if($image1 != '') : ?>
                    <div><a class="lightbox" title="Click to view full-size <?php echo $image1_caption; ?>" href="#1" rel="gallery_<?php the_ID(); ?>"><img height="<?php echo $height; ?>" width="550" src="<?php echo $image1; ?>" alt="<?php echo $image1_caption; ?>" /></a></div>   
                    <?php endif; ?>
                    <?php if($image2 != '') : ?>
                    <div><a class="lightbox" title="Click to view full-size <?php echo $image2_caption; ?>" href="#2" rel="gallery_<?php the_ID(); ?>"><img width="550" src="<?php echo $image2; ?>" alt="<?php echo $image2_caption; ?>" /></a></div> 
                    <?php endif; ?>
                    <?php if($image3 != '') : ?>
                    <div><a class="lightbox" title="Click to view full-size <?php echo $image3_caption; ?>" href="#3" rel="gallery_<?php the_ID(); ?>"><img width="550" src="<?php echo $image3; ?>" alt="<?php echo $image3_caption; ?>" /></a></div>
                    <?php endif; ?>
                    <?php if($image4 != '') : ?>
                    <div><a class="lightbox" title="Click to view full-size <?php echo $image4_caption; ?>" href="#4" rel="gallery_<?php the_ID(); ?>"><img width="550" src="<?php echo $image4; ?>" alt="<?php echo $image4_caption; ?>" /></a></div>
                    <?php endif; ?>
                    <?php if($image5 != '') : ?>
                    <div><a class="lightbox" title="Click to view full-size <?php echo $image5_caption; ?>" href="#5" rel="gallery_<?php the_ID(); ?>"><img width="550" src="<?php echo $image5; ?>" alt="<?php echo $image5_caption; ?>" /></a></div> 
                    <?php endif; ?>
                  </div>
                  <!--END .slider -->
                </div>
                <?php if($image2 != '') : ?>
                <div class="arrow"></div>
                <?php else: ?>
                <div class="arrow noslider"></div>
                <?php endif; ?>


            <?php else: ?>
            <!-- its a video gallery -->
            
							<?php $embed = get_post_meta(get_the_ID(), 'tz_portfolio_embed_code', TRUE); ?>
              <?php if($embed == '') : ?>
              <?php tz_video(get_the_ID()); ?>
              <?php $heightSingle = get_post_meta(get_the_ID(), 'tz_video_height_single', TRUE); ?>
              <style type="text/css">
                                          .single .jp-video-play,
                                          .single div.jp-jplayer.jp-jplayer-video {
                                              height: <?php echo $heightSingle; ?>px;
                                          }
                                      </style>
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
							$item_content = the_content('');
							if($image2 == ''){
								if($item_content == ''){
									$simple_style = 'min-height: 1px !important; margin-top: -22px !important;';
								}
							}
						?>
            <div class="entry-content" style="<?php echo $simple_style; ?>">
              <?php the_content(''); ?>
              <!--END .entry-content -->
            </div>
            <!--END .hentry-->
          </div>

          <?php endwhile; else: ?>
          <!--BEGIN #post-0-->
          <div id="post-0" <?php post_class() ?>>
            <h1 class="entry-title">
              <?php _e('Error 404 - Not Found', 'framework') ?>
            </h1>
            <!--BEGIN .entry-content-->
            <div class="entry-content">
              <p>
                <?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?>
              </p>
              <!--END .entry-content-->
            </div>
            <!--END #post-0-->
          </div>
          <?php endif; ?>
          <!--END #primary .hfeed-->
        </div>
        <!--BEGIN #single-sidebar-->
        <div id="single-sidebar">
          <?php 
                    $caption = get_post_meta(get_the_ID(), 'tz_portfolio_caption', TRUE); 
                    $link = get_post_meta(get_the_ID(), 'tz_portfolio_link', TRUE); 
                  ?>
          <!--BEGIN .entry-meta .entry-header-->
					<h1><?php the_title(); ?></h1>
          <ul class="entry-meta entry-header clearfix">
            
            <?php if($caption != '') : ?>
            <li class="caption"><strong class="black"><?php echo the_date('F j, Y'); ?></strong><br /> <?php echo stripslashes(htmlspecialchars_decode($caption)); ?> </li>
            <?php endif; ?>
            <?php if($link != '') : ?>
            <li class="link"> <a target="_blank" href="<?php echo $link; ?>"><span class="icon"></span>
              <?php _e('View Project', 'framework'); ?>
              </a> </li>
            <?php endif; ?>
					</ul>
					<div class="seperator clearfix">
            <div class="line"></div>
          </div>
					<ul class="entry-meta entry-header clearfix">
            <li class="terms">
							<!--<ul>
								<li><h3 class="widget-title">Date Completed</h3></li>
								<li><a href="#" onclick="return false;"><?php echo the_date('F j, Y'); ?></a></li>
							</ul>-->
							
              <ul>
								<?php
								$client_args = array('orderby' => 'term_group', 'order' => 'ASC', 'fields' => 'all');
								$client_terms = wp_get_object_terms($post->ID, 'project', $client_args);
								if(!empty($client_terms)){
									if(!is_wp_error( $client_terms )){
										echo '<li><h3 class="widget-title">Client / Project</h3></li><li>';
										$i = 0;
										foreach($client_terms as $client){
											if($i == 0){ echo '<strong>'; $title = 'View all projects done for ' . $client->name; }
											if($i > 0){ echo ' > '; $title = 'View all ' . $client->name . ' project elements for this client'; }
											echo '<a title="'. $title .'" href="'.get_term_link($client->slug, 'project').'">'.$client->name.'</a>'; 
											if($i == 0){ echo '</strong>'; }
											$i++;
										}
										echo '</li>';
									}
								}
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
											if($i > 0){ echo ' > '; }
											echo '<a title="View all ' . $skill->name . ' content in Aaron&rsquo;s Portfolio" href="'.get_term_link($skill->slug, 'skill-type').'">'.$skill->name.'</a>'; 
											if($i == 0){ echo '</strong>'; }
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
											if($i == 0){ echo '<strong>'; }
											if($i > 0){ echo ' > '; }
											echo '<a title="View all portfolio content made for the following media: ' . $media->name . '" href="'.get_term_link($media->slug, 'media-type').'">'.$media->name.'</a>'; 
											if($i == 0){ echo '</strong>'; }
											$i++;
										}
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
											//if($i == 0){ echo '<strong>'; }
											if($i > 0){ echo ', '; }
											echo '<a title="View all pieces created using ' . $tool->name . '" href="'.get_term_link($tool->slug, 'tools-used').'">'.$tool->name.'</a>'; 
											//if($i == 0){ echo '</strong>'; }
											$i++;
										}
										echo '</li>';
									}
								}
								?>

              </ul>
            </li>
            <!--END .entry-meta entry-header -->
          </ul>
          <div class="seperator clearfix">
            <div class="line"></div>
          </div>
          <?php edit_post_link( __('[Edit]', 'framework'), '<li class="edit-post">', '</li>' ); ?>
          <!--END #single-sidebar-->
        </div>
<?php get_footer(); ?>
