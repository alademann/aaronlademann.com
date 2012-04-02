<?php if (!is_admin()) { 
	$jQueryScriptDir		= public_uri() . "/js/jquery/";
	$bootstrapScriptDir = public_uri() . "/js/bootstrap/";
	$isIOS = is_ios();
?>
<script id="nomatterwhat">
$jqloaded = false;

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

		$jqloaded = true;
		// GLOBAL VARS
		var $ = jQuery.noConflict();
		$jQdir = "/public/js/jquery/";
		$twBdir = "/public/js/bootstrap/";
		// -----------

		// CONDITIONAL VARS (use these to ONLY LOAD WHAT YOU NEED)
		$isBrowserIE = yepnope("h", "ie");
		$isBrowserIE6_8 = yepnope("h", "lt-ie9");
		$isIphone = yepnope("h", "iphone");
		$isIphone = yepnope("h", "ipad");
		$wp_isPageTypeSingle = yepnope("b", "single");
		$wp_isPageTypeResume = yepnope("b", "page-template-template-resume-php");
		$wp_isUserLoggedIn = yepnope("b", "logged-in");

		//head.ready("jquery", function(){		
			// once jquery is loaded, load all the jquery plugins 'n schtuff
			
			head.js({ jquerycookie:				"<?php echo $jQueryScriptDir; ?>jquery.cookie.js"						});
			head.js({ masonry:					"<?php echo $jQueryScriptDir; ?>jquery.masonry.min.js"				});
			head.ready("masonry", function(){
				// once masonry is loaded...

				head.js({ infinitescroll: "<?php echo $jQueryScriptDir; ?>infinite-scroll/jquery.infinitescroll.min.js" });
				head.js({ slidesjs: "<?php echo $jQueryScriptDir; ?>slides.min.jquery.js" });
				
				// main template customization
				head.js({ gridlockedcustom: "<?php echo $jQueryScriptDir; ?>jquery.gridlocked-custom.js"	});
				
				head.js({ jqueryhotkeys: "<?php echo $jQueryScriptDir; ?>jquery.hotkeys.js" }, 
				function(){
					redirect_CtrlP();
				});
		
			}); // END head.ready("masonry")
			

			head.js(
				 { jqueryeasing:				"<?php echo $jQueryScriptDir; ?>jquery.easing.1.3.js"						}
				,{ jqueryuicustom:			"<?php echo $jQueryScriptDir; ?>jquery-ui-1.8.5.custom.min.js"	}
				,{ jquerysmartresize:		"<?php echo $jQueryScriptDir; ?>jquery.smartresize.js"					}
				,{ jqueryshadowanimate:	"<?php echo $jQueryScriptDir; ?>jquery.animate-shadow-min.js"		}
				,{ jqueryanimatecolors: "<?php echo $jQueryScriptDir; ?>jquery.animate-colors.js"				}
				
				,{ imagesloaded:				"<?php echo $jQueryScriptDir; ?>jquery.imagesloaded.js"					}
				,{ tzshortcodes:				"<?php echo $jQueryScriptDir; ?>jquery.shortcodes.js"						}
				,{ bootstrapcollapse:		"<?php echo $bootstrapScriptDir; ?>bootstrap-collapse.js"				}
				,{ bootstrapbutton:			"<?php echo $bootstrapScriptDir; ?>bootstrap-button.js"					}
				,{ bootstrapdropdown:		"<?php echo $bootstrapScriptDir; ?>bootstrap-dropdown.js"				}
				,{ bootstrapalerts:		"<?php echo $bootstrapScriptDir; ?>bootstrap-alert.js"						}
				

			, function() {
				
				// done loading the core js

			}); // END head.js (core)

		//}); // end head.ready("jquery");



		function yepnope(el, cl) {
			var $checkThis;
			if (el = "b") {
				$checkThis = $("body");
			} else if (el = "h") {
				$checkThis = $("html");
			} else {
				// something unexpected happened... don't know what i'm supposed to check.
				console.warn("ruh roh... yepnope() doesn't recognize " + el + " as a valid parameter. valid params are [h, b]");
				return false;
			}
			// simple function that repeats the same .hasClass() test to set conditional vars in all_set()
			return $checkThis.hasClass(cl) ? true : false;
		} // END yepnope()

	} // END if(window.jQuery)
} // END load_therest()

</script>
<!--[if (gte IE 6)&(lte IE 8)]>
	<script id="selectivizr">
		if(window.jQuery){	
			head.js({ selectivizr: "<?php echo public_uri(); ?>/js/selectivizr-min.js" });
		}
	</script>
<![endif]-->
<?php } ?>