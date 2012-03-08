
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
	
	<?php if (!is_admin()) { ?>
	<script id="nomatterwhat">
		head.js({ jquery: "/wp-includes/js/jquery/jquery.js" }, function(){
		
			head.js(
				 { jqueryuicustom: "<?php echo get_template_directory_uri(); ?>/js/jquery-ui-1.8.5.custom.min.js" }
				,{ jquerycookie: "<?php echo get_template_directory_uri(); ?>/js/carhartl-jquery-cookie/jquery.cookie.js" }
				,{ customjavascript: "/wp-content/resources/custom-javascript.js" }
				,{ jqueryanimatecolors: "<?php echo get_template_directory_uri(); ?>/js/jquery.animate-colors.js" }
				,{ tzshortcodes: "<?php echo get_template_directory_uri(); ?>/js/jquery.shortcodes.js" }
				,{ tzcustom: "<?php echo get_template_directory_uri(); ?>/js/jquery.custom.js" }
			, function() {
				// all done
			});

		});

		
	</script>
	<?php } ?>
	<?php 
		$browserAsString = $_SERVER['HTTP_USER_AGENT'];
		if (strstr($browserAsString, " AppleWebKit/") && strstr($browserAsString, " Mobile/")) { 
	?>
	<script id="iosonly">
		head.js({ iOS: "<?php echo get_template_directory_uri(); ?>/js/iOSfixedPosition.js" });
	</script>
	<?php } ?>
	<?php if(is_singular()) { ?>
	<script id="singlesonly">
		head.js({ jqueryeasing: "<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js" });
		<?php if(has_post_format('image')) { ?>
			head.js({ fancybox: "<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4.pack.js" });
		<?php } ?>
		<?php if(has_post_format('gallery') || get_post_type() == 'portfolio') { ?>
			head.js({ fancybox: "<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4.pack.js" });;
			head.js({ slidesjs: "<?php echo get_template_directory_uri(); ?>/js/slides.min.jquery.js" }
			, function(){
				head.ready(function(){
					// slides.jquery.js is finished loading.
					var lboxes = jQuery(".slider").find(".lightbox");
					jQuery.each(lboxes, function(){
						jQuery(this).find(".caption, img").css("visibility","visible");
					});	
				});
			});
			head.js({ jPlayer: "<?php echo get_template_directory_uri(); ?>/js/jquery.jplayer.min.js" });
		<?php } ?>
		<?php if(has_post_format('video') || has_post_format('audio')) { ?>
			head.js({ jPlayer: "<?php echo get_template_directory_uri(); ?>/js/jquery.jplayer.min.js" });
		<?php } ?>
	</script>
	<?php } ?>
	<?php if(!is_singular()) { ?>
	<script id="notsingles">
		head.js(
			 { slidesjs: "<?php echo get_template_directory_uri(); ?>/js/slides.min.jquery.js" }
			,{ masonry: "<?php echo get_template_directory_uri(); ?>/js/jquery.masonry.min.js" }
			,{ fancybox: "<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4.pack.js" }
			,{ jqueryeasing: "<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js" }
			,{ jPlayer: "<?php echo get_template_directory_uri(); ?>/js/jquery.jplayer.min.js" }
		, function() {
			// all done
		});
	</script>
	<?php } ?>
	<?php if( is_page_template('template-resume.php') ){ ?>	
	<script> 
		head.js({ jquerylettering: "<?php echo get_template_directory_uri(); ?>/js/lettering.min.js" }, 
			function() {
				// inline scripts here
				$("#name").lettering('words'); 
			
			});
	</script>
	<?php } ?>

</body>
</html>