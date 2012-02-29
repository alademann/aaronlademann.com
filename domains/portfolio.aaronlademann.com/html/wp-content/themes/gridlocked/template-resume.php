<?php
/*
Template Name: Resume
*/
?>

<?php get_header(); ?>

			<!-- #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!-- .hentry-->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<!-- .entry-content -->
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<!--// .entry-content -->

				</div>
				<!--// .hentry-->

				<?php endwhile; endif; ?>

			</div>
			<!--// #primary .hfeed-->

<?php get_footer(); ?>