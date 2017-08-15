<?php 
	$postType = 'portfolio';
	$taxType = 'portfolio-type';
?>
<?php get_header(); ?>
<?php include(custom_includes_dir() . "/portfolio/get-image-sizes.php"); ?> 
<!--BEGIN #primary .hfeed-->
<section id="primary" class="hfeed span12">
<?php if ( function_exists('yoast_breadcrumb') ) { ?>
	<header>
		<h1 class="<?php echo $taxType ?>"><?php wp_title(''); ?></h1>
		<nav><?php	yoast_breadcrumb('<ul class="breadcrumb"><li>','</li></ul>');
		} ?>
		</nav>
	</header>
	
	<!--BEGIN #masonry-->
	<section id="masonry-portfolio"class="masonry clearfix">
	<?php include(custom_includes_dir() . "/wp/wp-loop-vars.php"); ?>
	<?php if ( have_posts() ) : $count = 0; while ( have_posts() ) : the_post(); $count++; ?>	

	<?php include(gridlocked_includes_dir() . "/standard.php"); ?>

	<?php endwhile; ?>
	
	</section>
	<!--END #masonry-->

	<footer id="index-navigation" class="hidden clearfix navigation page-navigation">
		<nav>
			<ul class="pager">
				<li class="nav-next">
					<?php next_posts_link(__('Go Back In Time &rarr;', 'framework')) ?>
				</li>
				<li class="nav-previous">
					<?php if(is_folio_home()) { ?>
					<?php previous_posts_link(__('&larr; See The Future', 'framework')) ?>
					<?php } else { ?>
					<a href="/" rel="nofollow">Home</a>
					<?php } ?>
				</li>
			</ul>
		</nav>
	</footer>
	
	<?php else: ?>

	<article style="padding-left: 24px;" class="emptyResults">
		<header><p class="h2"><strong>Nothing to see here&hellip;</strong></p></header>
		<p>Sorry, there are no projects posted in Aaron&rsquo;s &ldquo;<?php echo $term->name; ?>&rdquo; Portfolio Archives. <br /><br />Eventually, Aaron should be adding projects here - but in the meantime, you can <a rel="nofollow" href="mailto:aaron.lademann@gmail.com?subject=Empty Archives Page for  <?php echo $term->name; ?>">Contact Aaron</a> to let him know you were looking for his <?php echo $term->name; ?> Projects.</p>
	</article>

	<?php endif; ?>

</section>
<!--END #primary .hfeed-->
<?php get_footer(); ?>