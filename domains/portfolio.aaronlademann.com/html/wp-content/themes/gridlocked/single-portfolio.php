<?php get_header(); ?>
<!--BEGIN #primary .hfeed-->
<section id="primary" class="hfeed span12">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<!--<php include(custom_includes_dir() . "/portfolio/single-header.php"); ?>  -->
	<!--BEGIN .hentry -->
  <article class="<?php post_class(); ?> row-fluid" id="post-<?php the_ID(); ?>">
		<?php include(custom_includes_dir() . "/portfolio/slider-gallery.php"); ?>
    <section id="slider-<?php the_ID(); ?>" class="slider span8 vert">
			<?php if(!is_ios($_SERVER['HTTP_USER_AGENT'])) { ?>
			<?php include(custom_includes_dir() . "/portfolio/slider-gallery-img-pagination-thumbs.php"); ?> 
			<?php } ?>
			<section class="slideStage">
				<section class="slides_container clearfix">
					<?php include(custom_includes_dir() . "/portfolio/slider-gallery-img-markup.php"); ?>  
				</section>
			</section>
    </section>

		<!--BEGIN #single-sidebar-->
  	<section id="single-sidebar" class="span4">
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
  			<h1 class="entryTitle"><?php the_title(); ?></h1>					
  			<ul class="entry-header clearfix">
  				<li class="like-count">
  					<?php tz_printLikes(get_the_ID()); ?>
						<span class="line vert"></span>
  				</li>
					<li class="published">
						<span class="icon"></span>
						<?php echo the_date('F j, Y'); ?>
					</li>
  				<?php if($caption != '') : ?>
  				<li class="caption">
						<?php echo $caption; ?>
					</li>
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