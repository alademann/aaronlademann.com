<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
  <!-- IE Compliance Mode Control -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<!--// IE Compliance Mode Control -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="robots" content="index,follow" />
	<meta name="author" content="Aaron Lademann" />
	<meta name="copyright" content="Copyright <?php echo date( 'Y' ); ?> Aaron Lademann. All Rights Reserved." />

	<title><?php wp_title(' &#124; ', true, 'right'); ?><?php if( !is_page_template('template-resume.php') ){ ?><?php bloginfo('name'); ?><?php } ?></title>
	
	<!-- Styles -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo get_option('tz_alt_stylesheet'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/aa_core/template.css" type="text/css" media="screen" />
	<?php 
		if( is_page_template('template-resume.php') OR is_page_template('template-full-width.php') ){ 
	?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/aa_core/base.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/aa_core/yui-reset.css" type="text/css" media="all" />
	
		<?php if( is_page_template('template-resume.php') ){ ?>	
			<!-- Resume Styles -->
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/aa_core/resume.css" type="text/css" media="all" />
			<!--// Resume Styles -->
		<?php } ?>
	
	<?php } ?>
	<!--// Styles -->

	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (get_option('tz_feedburner')) { echo get_option('tz_feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />  
	<!--// RSS & Pingbacks -->

  <?php
  $browserAsString = $_SERVER['HTTP_USER_AGENT'];
  if (strstr($browserAsString, " AppleWebKit/") && strstr($browserAsString, " Mobile/")) { 
		// set false for now
		//$is_ios = false;
		$is_ios = true; 
	?>
	<!-- Mobile Visitor -->
		<?php if ( !is_single() ) { 
						if( !is_page_template('template-resume.php') AND !is_page_template('template-full-width.php') ) {
		?>
			<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0;">
		<?php		}
					} 
		?>
  <link rel="stylesheet" type="text/css" media="screen" href="/css/aa_core/iOS.css" />    
	<link rel="stylesheet" type="text/css" media="screen" href="/css/iOS.css" />    
	<!--// Mobile Visitor -->
	<?php } ?>

	<!-- HOOK HEAD -->
	<?php wp_head(); ?>
	<!--// HOOK HEAD -->
	
</head>
<body <?php body_class(); ?>>

	<!-- #bg-line-->
    <!--<div id="bg-line"></div>-->

    <!-- aaronlademann.com primary navigation-->
      <div id="masthead">
          
        <div id="topNav" class="nav">
  
          <?php wp_nav_menu( array('theme_location' => 'primary', 'container' => '')); ?>
          
        </div>
          
        <div id="logoContainer">
            <a id="mastlogo" href="http://aaronlademann.com/" title="AaronLademann.com" rel="nofollow">
              <img src="http://aaronlademann.com/_images/_template/masthead-aaronlademann.com-logo.png" width="294" height="52" alt="<?php echo bloginfo( 'name' ) ?>" />
            </a> 
  
        </div>
      
      </div>
    <!--// aaronlademann.com primary navigation--> 

        <!-- #container -->
        <div id="container" class="clearfix js-disabled">
    
            <!-- #content -->
            <div id="content">
            	
                <?php if(get_option('tz_widget_overlay') == 'true') : ?>
                
            		<!-- #widget-overlay-container -->
                 <div id="widget-overlay-container">
            
                     <!-- #widget-overlay -->
                     <div id="widget-overlay">
                        
                         <!-- #overlay-inner -->
                         <div id="overlay-inner" class="clearfix">
                         
														<div class="column">
                            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 1') ) ?>
                            </div>
                            <div class="column">
                            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 2') ) ?>
                            </div>
                            <div class="column">
                            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 3') ) ?>
                            </div>
                            <div class="column">
                            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 4') ) ?>
                            </div>
                         
                         </div>
												 <!--// #overlay-inner -->
    
                     </div>
										 <!--// #widget-overlay -->
                     
                     <div id="overlay-open"><a href="#"><?php _e('Open Widget Area', 'framework'); ?></a></div>
                 
                 </div>
								 <!--// #widget-overlay-container -->
                 
								<?php endif; ?>

								<?php 
									if( !is_page_template('template-resume.php') AND !is_page_template('template-full-width.php') ){ 
								?>
								<!-- SIDEBAR -->        
								<?php get_sidebar(); ?>
								<!--// SIDEBAR -->
								<?php 
									}
								?>