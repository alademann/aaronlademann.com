	</section>
  <!--// #content -->
	<!-- #footer -->       
	<footer id="footer" class="clearfix">  		
		<nav id="footerNav" class="nav">
			<?php wp_nav_menu( array( 'theme_location' => 'secondary') ); ?>
		</nav>
		<p class="copyright" id="copyright">&copy; Copyright <?php echo date( 'Y' ); ?> Aaron Lademann</p>
		<p class="credit"><?php echo get_option('tz_footer_copy'); ?></p>
	</footer>
	<!--// #footer -->
</section> 
<!--// #container -->

<!-- HOOK FOOT -->
<?php wp_footer(); ?>
<!--// HOOK FOOT -->
<?php include(custom_includes_dir() . "/portfolio/footer-scripts.php"); ?>
</body>
</html>