
            </div>
            <!--// #content -->

        </div> 
        <!--// #container -->

        <!-- #footer -->       
        <div id="footer" class="clearfix">
        		
            <div id="footerNav" class="nav">
							<?php wp_nav_menu( array( 'theme_location' => 'secondary') ); ?>
            </div>
            
            <p class="copyright" id="copyright">&copy; Copyright <?php echo date( 'Y' ); ?> <a href="http://aaronlademann.com">Aaron Lademann</a></p>
            
            <p class="credit"><?php echo get_option('tz_footer_copy'); ?></p>

        </div>
				<!--// #footer -->
	
	<!-- HOOK FOOT -->
	<?php wp_footer(); ?>
	<!--// HOOK FOOT -->
			
</body>
</html>