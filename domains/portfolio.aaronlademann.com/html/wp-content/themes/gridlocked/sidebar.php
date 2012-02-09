		<!--BEGIN #sidebar .aside-->
		<div id="sidebar" class="aside">
        
        	<!-- BEGIN #logo -->
			<div id="logo">
				<?php /*
				If "plain text logo" is set in theme options then use text
				if a logo url has been set in theme options then use that
				if none of the above then use the default logo.png */
				if (get_option('tz_plain_logo') == 'true') { ?>
				<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php } elseif (get_option('tz_logo')) { ?>
				<a href="<?php echo home_url(); ?>" rel="nofollow"><img id="logoimg" src="<?php echo get_option('tz_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
				<?php } else { ?>
				<a href="<?php echo home_url(); ?>" rel="nofollow"><img id="logoimg" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } ?>
                
                <?php $tagline = get_option('tz_tagline'); ?>
                <?php if($tagline != '') : ?>
                
                <p id="tagline"><?php echo stripslashes($tagline); ?></p>
                
                <?php endif; ?>
                
			<!-- END #logo -->
			</div>
            
						<?php if(is_single()) : ?>
						<!--BEGIN .navigation .single-page-navigation -->
						<div class="navigation single-page-navigation clearfix">
							<div class="nav-previous">
								<?php next_post_link(__('%link', 'framework'), '<span class="arrow">%title</span>') ?>
							</div>
							<div class="portfolio-link"> <a href="<?php echo get_permalink( get_option('tz_portfolio_page') ); ?>"> <span class="icon">
								<?php _e('Back to Portfolio', 'framework'); ?>
								</span> </a> </div>
							<div class="nav-next">
								<?php previous_post_link(__('%link', 'framework'), '<span class="arrow">%title</span>') ?>
							</div>
							<!--END .navigation .single-page-navigation -->
							
						</div>

						<?php endif; ?>
			
						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Portfolio Sidebar') ) :?> 
            
							<div class="widget">
											<span class="widget-title"><strong>View Options</strong></span>
											<ul id="filter" class="insetBox">
                				<li <?php if(is_page_template('template-portfolio.php')) : ?>class="current-menu-item"<?php endif; ?>>
                  				<?php $full_folio_rel = ( is_home() || is_front_page() ) ? 'rel="nofollow"' : ''; ?>
													<a href="<?php echo get_permalink( get_option('tz_portfolio_page') ); ?>" <?php echo $full_folio_rel; ?>>Full Portfolio</a>
												</li>
												<?php wp_list_categories(array('title_li' => 'Project Type', 'taxonomy' => 'skill-type')); ?>
												<?php if(is_tax('project')) :?>
												<?php wp_list_categories(array('title_li' => 'Clients', 'taxonomy' => 'project')); ?>
												<?php endif; ?>
												<?php if(!is_tax('project')) :?>
												<?php wp_list_categories(array('title_li' => 'Clients', 'taxonomy' => 'project', 'depth' => 1)); ?>
												<?php endif; ?>
											</ul>
									</div>
            
            <?php endif; ?>

						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) :?>


						<?php endif; ?>


            
            
            <!-- BEGIN #back-to-top -->
            <div id="back-to-top" class="link insetBox">
            	<!--<a href="#" rel="nofollow">-->
                	<span class="icon"><span class="arrow"></span></span>
                    <span class="text"><?php _e('Back to Top', 'framework'); ?></span>
                <!--</a>--> 
            <!-- END #back-to-top -->
            </div>
		
		<!--END #sidebar .aside-->
		</div>