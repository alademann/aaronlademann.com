<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="author" content="Aaron Lademann">
<meta name="copyright" content="Copyright <?php echo date( 'Y' ); ?> Aaron Lademann. All Rights Reserved.">

<title><?php wp_title(''); ?></title>
<?php if( !is_page_template('template-resume.php') ) { ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<?php } ?>

<?php include(custom_includes_dir() . "/portfolio/stylesheets.php"); ?>

<!-- RSS & Pingbacks -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (get_option('tz_feedburner')) { echo get_option('tz_feedburner'); } else { bloginfo( 'rss2_url' ); } ?>">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">  
<!--// RSS & Pingbacks -->

<!-- HOOK HEAD -->
<?php wp_head(); ?>
<!--// HOOK HEAD -->
<style media="screen" id="stupidadminbar">
	html { margin-top: 0 !important; }
	* html body { margin-top: 0 !important; }
</style>
<script type="text/javascript" src="<?php echo public_uri(); ?>/js/modernizr.min.js" id="modernizr"></script>
<script type="text/javascript" src="<?php echo public_uri(); ?>/js/head<?php if(!$is_winIE) { echo ".load"; } ?>.min.js" id="headjs"></script>
</head>
<body class="<?php body_class(); ?> <?php echo $deviceClass; ?>">
<!-- navbar -->
<?php include(custom_includes_dir() . "/portfolio/navbar-top.php"); ?>
<!-- // navbar -->
<!-- #container -->
<section id="container" class="container-fluid clearfix js-disabled">
	<!-- #content -->
	<section id="content" class="row-fluid">
		<?php include(custom_includes_dir() . "/wp/widget-overlay.php"); ?>
		<?php include(custom_includes_dir() . "/php/debug.php"); ?>
		<?php if( !is_page_template('template-resume.php') AND !is_page_template('template-full-width.php') AND !is_single() ){ ?>
    <!-- SIDEBAR -->        

    <!--// SIDEBAR -->
		<?php } ?>