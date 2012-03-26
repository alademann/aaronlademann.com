<?php if (!is_admin()) { 
	$jQueryScriptDir		= public_uri() . "/js/jquery/";
	$bootstrapScriptDir = public_uri() . "/js/bootstrap/";
	$isIOS = is_ios($_SERVER['HTTP_USER_AGENT']);
?>
<script id="nomatterwhat">
	head.js({ jquery: "/wp-includes/js/jquery/jquery.js" }, function(){
		
		head.ready("jquery", function(){		
			// once jquery is loaded, load all the jquery plugins 'n schtuff

			head.js(
				 { jqueryeasing:				"<?php echo $jQueryScriptDir; ?>jquery.easing.1.3.js"						}
				,{ jqueryuicustom:			"<?php echo $jQueryScriptDir; ?>jquery-ui-1.8.5.custom.min.js"	}
				,{ jquerysmartresize:		"<?php echo $jQueryScriptDir; ?>jquery.smartresize.js"					}
				,{ jqueryshadowanimate:	"<?php echo $jQueryScriptDir; ?>jquery.animate-shadow-min.js"		}
				,{ jqueryanimatecolors: "<?php echo $jQueryScriptDir; ?>jquery.animate-colors.js"				}
				,{ jquerycookie:				"<?php echo $jQueryScriptDir; ?>jquery.cookie.js"								}
				,{ masonry:							"<?php echo $jQueryScriptDir; ?>jquery.masonry.min.js"					}
				,{ imagesloaded:				"<?php echo $jQueryScriptDir; ?>jquery.imagesloaded.js"					}
				,{ tzshortcodes:				"<?php echo $jQueryScriptDir; ?>jquery.shortcodes.js"						}
				,{ bootstrapcollapse:		"<?php echo $bootstrapScriptDir; ?>bootstrap-collapse.js"				}
				,{ bootstrapbutton:			"<?php echo $bootstrapScriptDir; ?>bootstrap-button.js"					}
				,{ bootstrapdropdown:		"<?php echo $bootstrapScriptDir; ?>bootstrap-dropdown.js"				}
				

			, function() {
				
				// done loading the core js

			}); // END head.js (core)

		}); // end head.ready("jquery");

		head.ready("masonry", function(){
			// once masonry is loaded...

			head.js({ infinitescroll: "<?php echo $jQueryScriptDir; ?>infinite-scroll/jquery.infinitescroll.min.js" });
		
		}); // END head.ready("masonry")

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
<?php if(is_singular()) { ?>
<script id="singlesonly">
	head.ready("jquery", function(){

		head.js({ slidesjs: "<?php echo $jQueryScriptDir; ?>slides.min.jquery.js" });
		
	}); // END head.ready("jquery")
</script>
<?php } ?>
<script id="customizations">
	head.ready(function(){

		head.js({ gridlockedcustom: "<?php echo $jQueryScriptDir; ?>jquery.gridlocked-custom.js" });
		<?php if($isIOS) { ?>
		head.js({ iOS:							"<?php echo public_uri(); ?>/js/iOSfixedPosition.js"				 });
		<?php } ?>

	}); // END head.ready
</script>
<?php if( is_page_template('template-resume.php') ){ ?>	
<script id="resumeScripts"> 
	
	head.ready("gridlockedcustom", function(){
		//var $ = jQuery.noConflict();

		head.js({ jqueryhotkeys: "<?php echo $jQueryScriptDir; ?>jquery.hotkeys.js" }, 
			function(){
				redirect_CtrlP();
			});

	}); // END head.ready(jquery)

</script>
<?php } ?>