<!--BEGIN #sidebar .aside-->
<aside id="sidebar" class="aside">
	<!-- BEGIN #logo -->
	<header id="logo">
		<?php /*
		If "plain text logo" is set in theme options then use text
		if a logo url has been set in theme options then use that
		if none of the above then use the default logo.png */
		if (get_option('tz_plain_logo') == 'true') { ?>
					
		<?php if(is_folio_home()) { ?>
		<!-- HOME PAGE -->
		<h1><?php bloginfo( 'name' ); ?></h1>
		<?php } ?>
		<?php if(!is_folio_home()){ ?>
		<!-- NOT THE HOME PAGE -->
		<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php } ?> 

		<?php } elseif (get_option('tz_logo')) { ?>
		<?php if(is_folio_home()) { ?>
		<!-- HOME PAGE -->
		<h1 style="background-image: url(<?php echo get_option('tz_logo'); ?>);"><?php bloginfo( 'name' ); ?></h1>
		<?php } ?>
		<?php if(!is_folio_home()){ ?>
		<!-- NOT THE HOME PAGE -->
		<a href="<?php echo home_url(); ?>" rel="nofollow"><img id="logoimg" src="<?php echo get_option('tz_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
		<?php } ?> 
		<?php } else { ?>
		<?php if(is_folio_home()) { ?>
		<!-- HOME PAGE -->
		<h1 style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/logo.png);"><?php bloginfo( 'name' ); ?></h1>
		<?php } ?>
		<?php if(!is_folio_home()){ ?>
		<!-- NOT THE HOME PAGE -->
		<a href="<?php echo home_url(); ?>" rel="nofollow"><img id="logoimg" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
		<?php } ?> 
		<?php } ?>
    <?php $tagline = get_option('tz_tagline'); ?>
    <?php if($tagline != '') : ?>
    <p id="tagline"><?php echo stripslashes($tagline); ?></p>
    <?php endif; ?>
	</header>
  <!-- END #logo -->
	<?php if(!is_single()) : ?>
	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Portfolio Sidebar') ) :?> 
  <section class="widget">
		<header class="widget-title"><strong>View Options</strong></header>
  	<nav>
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
		</nav>
	</section>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) :?><?php endif; ?>
  <!-- BEGIN #back-to-top -->
	<section id="back-to-top" class="link insetBox">
		<span class="icon"><span class="arrow"></span></span>
		<span class="text"><?php _e('Back to Top', 'framework'); ?></span>
	</section>
	<!-- END #back-to-top -->
<!--END #sidebar .aside-->
</aside>