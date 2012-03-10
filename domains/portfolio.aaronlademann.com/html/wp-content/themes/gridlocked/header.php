<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="author" content="Aaron Lademann">
<meta name="copyright" content="Copyright <?php echo date( 'Y' ); ?> Aaron Lademann. All Rights Reserved.">

<title><?php wp_title(''); ?></title>

<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/screen.css">
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/print.css" media="print">
<?php if(is_ios($_SERVER['HTTP_USER_AGENT'])) { ?>
<!-- iOS Device -->
<?php } ?>
<!--[if IE]>
<link rel="stylesheet" href="<?php echo public_uri(); ?>/css/ie.css" />
<![endif]-->
<noscript><link rel="stylesheet" href="<?php echo public_uri(); ?>/css/noscript.css"></noscript>

<!-- RSS & Pingbacks -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (get_option('tz_feedburner')) { echo get_option('tz_feedburner'); } else { bloginfo( 'rss2_url' ); } ?>">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">  
<!--// RSS & Pingbacks -->

<!-- HOOK HEAD -->
<?php wp_head(); ?>
<!--// HOOK HEAD -->
	
<script id="googleanalytics">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-3765006-1']);
	_gaq.push(['_setDomainName', 'aaronlademann.com']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
<script src="<?php echo public_uri(); ?>/js/head.min.js"></script>
</head>
<body class="<?php body_class(); ?>">
<!-- HEADER -->
<header id="masthead">
	<nav id="topNav" class="nav">
	<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => '')); ?>
  </nav>
  <section id="logoContainer">
		<a id="mastlogo" href="<?php echo site_url(); ?>" title="AaronLademann.com" rel="nofollow">
			<img src="<?php echo site_url(); ?>/public/images/masthead-aaronlademann.com-logo.png" width="294" height="52" alt="<?php echo bloginfo( 'name' ) ?>" />
		</a>  
	</section>    
</header>
<!-- // HEADER -->
<!-- #container -->
<section id="container" class="clearfix js-disabled">
	<!-- #content -->
	<section id="content">
		<?php if(get_option('tz_widget_overlay') == 'true') : ?>
    <!-- #widget-overlay-container -->
    <section id="widget-overlay-container">   
      <!-- #widget-overlay -->
      <aside id="widget-overlay">      
				<!-- #overlay-inner -->
				<section id="overlay-inner" class="clearfix">     
					<section class="column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 1') ) ?>
					</section>
					<section class="column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 2') ) ?>
					</section>
					<section class="column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 3') ) ?>
					</section>
					<section class="column">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Overlay Column 4') ) ?>
					</section>          
				</section>
				<!--// #overlay-inner -->
      </aside>
			<!--// #widget-overlay -->          
      <nav id="overlay-open"><a href="#"><?php _e('Open Widget Area', 'framework'); ?></a></nav>   
    </section>
		<!--// #widget-overlay-container -->
    <?php endif; ?>
		<?php if( !is_page_template('template-resume.php') AND !is_page_template('template-full-width.php') ){ ?>
    <!-- SIDEBAR -->        
    <?php get_sidebar(); ?>
    <!--// SIDEBAR -->
		<?php } ?>