<?php if (!is_admin()) { 
	$jQueryScriptDir		= public_uri() . "/js/jquery/";
	$bootstrapScriptDir = public_uri() . "/js/bootstrap/";
	$isIOS = is_ios();
?>
<script id="nomatterwhat">
	Modernizr.load([
		{
			load: '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js',
			complete: function() {
				if (!window.jQuery) {
					// load local copy if google cdn is down
					Modernizr.load('/public/js/jquery/jquery-latest.min.js');
					console.warn("google CDN was down, had to load local jQuery resource");
				} else {
					load_therest();
				}
			} 

		}]);
	
	function load_therest(){
	if(window.jQuery){	
		//head.ready("jquery", function(){		
			// once jquery is loaded, load all the jquery plugins 'n schtuff
			
			head.js({ masonry:					"<?php echo $jQueryScriptDir; ?>jquery.masonry.min.js"				});
			head.ready("masonry", function(){
				// once masonry is loaded...

				head.js({ infinitescroll: "<?php echo $jQueryScriptDir; ?>infinite-scroll/jquery.infinitescroll.min.js" });
				head.js({ gridlockedcustom: "<?php echo $jQueryScriptDir; ?>jquery.gridlocked-custom.js"	});
		
			}); // END head.ready("masonry")
			

			head.js(
				 { jqueryeasing:				"<?php echo $jQueryScriptDir; ?>jquery.easing.1.3.js"						}
				,{ jqueryuicustom:			"<?php echo $jQueryScriptDir; ?>jquery-ui-1.8.5.custom.min.js"	}
				,{ jquerysmartresize:		"<?php echo $jQueryScriptDir; ?>jquery.smartresize.js"					}
				,{ jqueryshadowanimate:	"<?php echo $jQueryScriptDir; ?>jquery.animate-shadow-min.js"		}
				,{ jqueryanimatecolors: "<?php echo $jQueryScriptDir; ?>jquery.animate-colors.js"				}
				,{ jquerycookie:				"<?php echo $jQueryScriptDir; ?>jquery.cookie.js"								}
				
				//,{ imagesloaded:				"<?php echo $jQueryScriptDir; ?>jquery.imagesloaded.js"					}
				,{ tzshortcodes:				"<?php echo $jQueryScriptDir; ?>jquery.shortcodes.js"						}
				,{ bootstrapcollapse:		"<?php echo $bootstrapScriptDir; ?>bootstrap-collapse.js"				}
				,{ bootstrapbutton:			"<?php echo $bootstrapScriptDir; ?>bootstrap-button.js"					}
				,{ bootstrapdropdown:		"<?php echo $bootstrapScriptDir; ?>bootstrap-dropdown.js"				}
				,{ bootstrapalerts:		"<?php echo $bootstrapScriptDir; ?>bootstrap-alert.js"						}
				

			, function() {
				
				// done loading the core js

			}); // END head.js (core)

		//}); // end head.ready("jquery");



	} // END if(window.jQuery)
}
</script>
<!--[if (gte IE 6)&(lte IE 8)]>
	<script id="selectivizr">
		if(window.jQuery){	
			head.js({ selectivizr: "<?php echo public_uri(); ?>/js/selectivizr-min.js" });
		}
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