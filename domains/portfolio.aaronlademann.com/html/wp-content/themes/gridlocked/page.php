<?php get_header(); ?>

			<!--BEGIN #primary .hfeed-->
			<section id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!--BEGIN .hentry-->
				<section <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<h1 class="entry-title"><?php the_title(); ?></h1>

					<!--BEGIN .entry-content -->
					<article class="entry-content">
						<?php the_content(); ?>

					<!--END .entry-content -->
					</article>

				<!--END .hentry-->
				</section>

				<?php endwhile; endif; ?>

			<!--END #primary .hfeed-->
			</section>

<?php get_footer(); ?>