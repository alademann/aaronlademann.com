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
<script id="googleanalytics" type="text/javascript">
	var _gaq=[['_setAccount','UA-3765006-1'],['_setDomainName','aaronlademann.com'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php include(custom_includes_dir() . "/portfolio/footer-scripts.php"); ?>
</body>
</html>