
            </div>
            <!--// #content -->

        </div> 
        <!--// #container -->

        <!-- #footer -->       
        <div id="footer" class="clearfix">
        		
            <div id="footerNav" class="nav">
							<?php wp_nav_menu( array( 'theme_location' => 'secondary') ); ?>
            </div>
            
            <p class="copyright" id="copyright">&copy; Copyright <?php echo date( 'Y' ); ?> Aaron Lademann</p>
            
            <p class="credit"><?php echo get_option('tz_footer_copy'); ?></p>

        </div>
				<!--// #footer -->
	
	<!-- HOOK FOOT -->
	<?php wp_footer(); ?>
	<!--// HOOK FOOT -->
	
	<script> 
		head.js("<?php echo get_template_directory_uri(); ?>/js/analytics.js");
	</script>
	
	<?php if( is_page_template('template-resume.php') ){ ?>	
	<script> 
		head.js("<?php echo get_template_directory_uri(); ?>/js/lettering.min.js", 
			function() {
				// inline scripts here
				$("#name").lettering('words'); 
			
			});
	</script>
	<?php } ?>
</body>
</html>