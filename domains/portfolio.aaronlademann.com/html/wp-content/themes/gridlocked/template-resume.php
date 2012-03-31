<?php
/*
Template Name: Resume
*/
?>
 
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="resume" class="span12" itemscope itemtype="http://data-vocabulary.org/Person">

	<!-- header -->
	<header id="hd" class="row-fluid">
		<?php the_block("header"); ?>
	</header>
	<!--/ header -->
	<!-- body -->
	<section id="bd">
		<!-- PROFILE -->
		<details class="well row-fluid" id="profile" open>
			<summary class="h2 serif span3"><span class="inner">Profile</span></summary>	
			<section class="enlarge span9">
				<section class="inner">	
					<?php the_block("profile"); ?>
				</section>
			</section>	
		</details>
		<!--/ PROFILE -->
		<!-- SPECIALTIES -->
		<details class="well row-fluid" id="specialties" open>
			<summary class="h2 serif span3"><span class="inner">Specialties</span></summary>	
			<section class="span9">
				<section class="inner">
					<?php the_block("specialties"); ?>
				</section>
			</section>
		</details>
		<!--/ SPECIALTIES -->
		<!-- EXPERIENCE -->
		<details class="well row-fluid" id="experience" open>
			<summary class="h2 serif span3"><span class="inner">Experience</span></summary>	
			<section class="span9">
				<section class="inner">
					<!-- JOB -->
					<section class="job clearfix">
						<?php the_block("job 1"); ?>
					</section>
					<!--/ JOB -->
					<!-- JOB -->
					<section class="job clearfix">
						<?php the_block("job 2"); ?>
					</section>
					<!--/ JOB -->
					<!-- JOB -->
					<section class="job clearfix">
						<?php the_block("job 3"); ?>
					</section>
					<!--/ JOB -->
					<!-- JOB -->
					<section class="job clearfix">
						<?php the_block("job 4"); ?>
					</section>
					<!--/ JOB -->
					<!-- JOB -->
					<section class="job clearfix">
						<?php the_block("job 5"); ?>
					</section>
					<!--/ JOB -->
					<!-- JOB -->
					<section class="job clearfix">
						<?php the_block("job 6"); ?>
					</section>
					<!--/ JOB -->
					<!-- JOB -->
					<section class="job clearfix">
						<?php the_block("job 7"); ?>
					</section>
					<!--/ JOB -->
					<!-- JOB -->
					<section class="job clearfix">
						<?php the_block("job 8"); ?>
					</section>
					<!--/ JOB -->
				</section>
			</section>
		</details>
		<!--/ EXPERIENCE -->
		<!-- SKILLS -->
		<details class="well row-fluid" id="skills" open>
			<summary class="h2 serif span3"><span class="inner">Skills <abbr title="and">&amp;</abbr> Tools</span></summary>
			<section class="span9">
				<section class="inner">
					<section class="row-fluid">
						<?php the_block("skills_tools creative"); ?>
					</section>
					<section class="row-fluid">
						<?php the_block("skills_tools web"); ?>
					</section>
					<section class="row-fluid">
						<?php the_block("skills_tools mktg"); ?>
					</section>
				</section>
			</section>
		</details>
		<!--/ SKILLS -->
		<!-- EDUCATION -->
		<details class="well row-fluid" id="education" open>
			<summary class="h2 serif span3"><span class="inner">Education</span></summary>
			<section class="span9">
				<section class="inner">
					<?php the_block("education"); ?>
				</section>
			</section>
		</details>
		<!--/ EDUCATION -->
	</section>
	<!--/ body -->
	<footer id="ft">
		<?php the_block("footer"); ?>
	</footer>
</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>