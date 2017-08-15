<header>
<?php if ( function_exists('yoast_breadcrumb') ) { ?>
<!-- BEGIN .breadcrumb navigation -->
	<nav id="crumbpaths">
		<?php	yoast_breadcrumb('<ul class="breadcrumb"><li>','</li></ul>'); ?>
	</nav>
<!-- END .breadcrumb navigation --> 
<?php } ?>

	<!--BEGIN .single-page-navigation -->
	<nav class="navigation single-page-navigation clearfix">
		<section class="nav-previous">
			<?php next_post_link(__('%link', 'framework'), '<span class="arrow">%title</span>') ?>
		</section>
		<section class="nav-next">
			<?php previous_post_link(__('%link', 'framework'), '<span class="arrow">%title</span>') ?>
		</section>					
	</nav>
	<!--END .single-page-navigation -->
</header>