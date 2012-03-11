	</section>
  <!--// #content -->
</section> 
<!--// #container -->
<!-- #footer -->       
<footer id="footer" class="clearfix">  		
	<nav id="footerNav" class="nav">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary') ); ?>
	</nav>
  <p class="copyright" id="copyright">&copy; Copyright <?php echo date( 'Y' ); ?> Aaron Lademann</p>
  <p class="credit"><?php echo get_option('tz_footer_copy'); ?></p>
</footer>
<!--// #footer -->
<!-- HOOK FOOT -->
<?php wp_footer(); ?>
<!--// HOOK FOOT -->
<?php if (!is_admin()) { ?>
<script id="nomatterwhat">
	head.js({ jquery: "/wp-includes/js/jquery/jquery.js" }, function(){
		
		head.js(
				{ jqueryuicustom: "<?php echo public_uri(); ?>/js/jquery/jquery-ui-1.8.5.custom.min.js" }
			,{ jqueryshadowanimate: "<?php echo public_uri(); ?>/js/jquery/jquery.animate-shadow-min.js" }
			,{ jqueryanimatecolors: "<?php echo public_uri(); ?>/js/jquery/jquery.animate-colors.js" }
			,{ jquerycookie: "<?php echo public_uri(); ?>/js/jquery/carhartl-jquery-cookie/jquery.cookie.js" }
			,{ tzshortcodes: "<?php echo public_uri(); ?>/js/jquery/jquery.shortcodes.js" }
			,{ tzcustom: "<?php echo public_uri(); ?>/js/jquery/jquery.gridlocked-custom.js" }
		, function() {
			// all done
		});

	});

		
</script>
<!--[if (gte IE 6)&(lte IE 8)]>
	<script id="selectivizr">
		head.ready("jquery", function(){
			head.js({ selectivizr: "<?php echo public_uri(); ?>/js/selectivizr-min.js" });
		});
	</script>
<![endif]-->
<?php } ?>
<?php if(is_ios($_SERVER['HTTP_USER_AGENT'])) { ?>
<script id="iosonly">
	head.js({ iOS: "<?php echo public_uri(); ?>/js/iOSfixedPosition.js" });
</script>
<?php } ?>
<?php if(is_singular()) { ?>
<script id="singlesonly">
	head.js({ jqueryeasing: "<?php echo public_uri(); ?>/js/jquery/jquery.easing.1.3.js" });
	<?php if(has_post_format('image')) { ?>
		head.js({ fancybox: "<?php echo public_uri(); ?>/js/jquery/jquery.fancybox-1.3.4.pack.js" });
	<?php } ?>
	<?php if(has_post_format('gallery') || get_post_type() == 'portfolio') { ?>
		head.js({ fancybox: "<?php echo public_uri(); ?>/js/jquery/jquery.fancybox-1.3.4.pack.js" });;
		head.js({ slidesjs: "<?php echo public_uri(); ?>/js/jquery/slides.min.jquery.js" }
		, function(){
			head.ready(function(){
				// slides.jquery.js is finished loading.
				var lboxes = jQuery(".slider").find(".lightbox");
				jQuery.each(lboxes, function(){
					jQuery(this).find(".caption, img").css("visibility","visible");
				});	
			});
		});
		head.js({ jPlayer: "<?php echo public_uri(); ?>/js/jquery/jquery.jplayer.min.js" });
	<?php } ?>
	<?php if(has_post_format('video') || has_post_format('audio')) { ?>
		head.js({ jPlayer: "<?php echo public_uri(); ?>/js/jquery/jquery.jplayer.min.js" });
	<?php } ?>
</script>
<?php } ?>
<?php if(!is_singular()) { ?>
<script id="notsingles">
	head.js(
			{ slidesjs: "<?php echo public_uri(); ?>/js/jquery/slides.min.jquery.js" }
		,{ masonry: "<?php echo public_uri(); ?>/js/jquery/jquery.masonry.min.js" }
		,{ fancybox: "<?php echo public_uri(); ?>/js/jquery/jquery.fancybox-1.3.4.pack.js" }
		,{ jqueryeasing: "<?php echo public_uri(); ?>/js/jquery/jquery.easing.1.3.js" }
		,{ jPlayer: "<?php echo public_uri(); ?>/js/jquery/jquery.jplayer.min.js" }
	, function() {
		// all done
	});
</script>
<?php } ?>
<?php if( is_page_template('template-resume.php') ){ ?>	
<script> 
	head.js({ jqueryhotkeys: "<?php echo public_uri(); ?>/js/jquery/jquery.hotkeys.js" }, 
		function(){
			try{
			// forward ctrl+p folks to the printed version of the resume.
				jQuery(document).bind("keydown", "ctrl+p", function(event){
					event.preventDefault();
					_gaq.push(["_trackPageview", "/resume/pdf-download"]);
					window.location = jQuery("#resume #pdf > a").attr("href");
				});
			} catch(err){
				//error - didn't work, go ahead and do the default action.
				_gaq.push(["_trackPageview", "/resume/print"]);
				return true;
			}
			try{
				jQuery(document).bind("keydown", "ctrl+shift+p", function(event){
					event.preventDefault();
					_gaq.push(["_trackPageview", "/resume/pdf-download"]);
					window.location = jQuery("#resume #pdf > a").attr("href");
				});
			} catch(err){
				//error - didn't work, go ahead and do the default action.
				_gaq.push(["_trackPageview", "/resume/print"]);
				return true;
			}
		});
	head.js({ jquerylettering: "<?php echo public_uri(); ?>/js/jquery/lettering.min.js" }, 
		function() {
			// inline scripts here
			jQuery("#name").lettering('words'); 
			
		});
</script>
<?php } ?>
</body>
</html>