<?php if (!is_admin()) { ?>
<script id="nomatterwhat">
	head.js({ jquery: "/wp-includes/js/jquery/jquery.js" }, function(){
		
		head.ready("jquery", function(){		

			head.js(
				{ bootstrapcollapse: "<?php echo public_uri(); ?>/js/bootstrap/bootstrap-collapse.js" }
				,{ masonry: "<?php echo public_uri(); ?>/js/jquery/jquery.masonry.min.js" }
				,{ imagesloaded: "<?php echo public_uri(); ?>/js/jquery/jquery.imagesloaded.js" }
				,{ bootstrapbutton: "<?php echo public_uri(); ?>/js/bootstrap/bootstrap-button.js" }
				,{ bootstrapdropdown: "<?php echo public_uri(); ?>/js/bootstrap/bootstrap-dropdown.js" }
				,{ jqueryuicustom: "<?php echo public_uri(); ?>/js/jquery/jquery-ui-1.8.5.custom.min.js" }
				,{ jqueryshadowanimate: "<?php echo public_uri(); ?>/js/jquery/jquery.animate-shadow-min.js" }
				,{ jqueryanimatecolors: "<?php echo public_uri(); ?>/js/jquery/jquery.animate-colors.js" }
				,{ jquerycookie: "<?php echo public_uri(); ?>/js/jquery/carhartl-jquery-cookie/jquery.cookie.js" }
				,{ tzshortcodes: "<?php echo public_uri(); ?>/js/jquery/jquery.shortcodes.js" }
			, function() {
				
				head.ready(function(){
					head.js({ tzcustom: "<?php echo public_uri(); ?>/js/jquery/jquery.gridlocked-custom.js" });
				});

			});

		}); // end head.ready("jquery");

		head.ready("masonry", function(){
			head.js(
				{ infinitescroll: "<?php echo public_uri(); ?>/js/jquery/infinite-scroll/jquery.infinitescroll.min.js" }
				, function(){
					// done with infinitescroll
				});
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
	
	head.ready( "jquery", function(){
		
		head.js({ smartresize: "<?php echo public_uri(); ?>/js/jquery/jquery.smartresize.js" });
		head.js({ jqueryeasing: "<?php echo public_uri(); ?>/js/jquery/jquery.easing.1.3.js" });
	
		head.js({ slidesjs: "<?php echo public_uri(); ?>/js/jquery/slides.min.jquery.js" }
		, function(){
			head.ready(function(){
				// slides.jquery.js is finished loading.
				var lboxes = jQuery(".slider").find("figure");
				jQuery.each(lboxes, function(){
					jQuery(this).find(".caption, img").css("visibility","visible");
				});	
				
			});
		});
		
	}); // END head.ready("jquery")
</script>
<?php } ?>
<?php if(!is_singular()) { ?>
<script id="notsingles">
	head.ready("jquery", function(){
		head.js(
				{ slidesjs: "<?php echo public_uri(); ?>/js/jquery/slides.min.jquery.js" }
			,{ fancybox: "<?php echo public_uri(); ?>/js/jquery/jquery.fancybox-1.3.4.pack.js" }
			,{ jqueryeasing: "<?php echo public_uri(); ?>/js/jquery/jquery.easing.1.3.js" }
			,{ jPlayer: "<?php echo public_uri(); ?>/js/jquery/jquery.jplayer.min.js" }
		, function() {
			// all done
		});
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