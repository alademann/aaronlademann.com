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

		// GLOBAL VARS
		$jqloaded = true;
		var $ = jQuery.noConflict();
		// -----------

		function checkitout(__el, cl) {
			var $checkThis;
			if (__el == "b") {
				$checkThis = $("body");
			} else if (__el == "h") {
				$checkThis = $("html");
			} else {
				// something unexpected happened... don't know what i'm supposed to check.
				try {
					console.log("ruh roh... checkitout() doesn't recognize " + __el + " as a valid parameter. valid params are [h, b]");
				}catch (e) {
					// browser doesn't support console output.
				}
				return false;
			}
			// simple function that repeats the same .hasClass() test to set conditional vars in all_set()
			//console.info("checkitout(" + __el + ", ." + cl + ") = " + $checkThis.hasClass(cl));
			return $checkThis.hasClass(cl) ? true : false;
		} // END checkitout()

		// CONDITIONAL VARS (use these to ONLY LOAD WHAT YOU NEED)
		$isBrowserIE = checkitout("h", "ie");
		$isBrowserIE6_8 = checkitout("h", "lt-ie9");
		$isIphone = checkitout("h", "iphone");
		$isIphone = checkitout("h", "ipad");
		$isCSSTransitions = checkitout("h", "csstransitions");
		$wp_isPageTypeSingle = checkitout("b", "single");
		$wp_isPageTypeResume = checkitout("b", "page-template-template-resume-php");
		$wp_isUserLoggedIn = checkitout("b", "logged-in");

		
		// once jquery is loaded, load all the jquery plugins 'n schtuff

		// NO MATTER WHAT (MUST LOAD FIRST)
		// -----------------------------------------------------------------------------------------------
		head.js({ jquerycookie: "/public/js/jquery/jquery.cookie.js" }
					 , { jqueryeasing: "/public/js/jquery/jquery.easing.1.3.js" }
					 , { jqueryreject: "/public/js/jquery/jReject/js/jquery.reject.js" }
					 , { consoleSafe: "/public/js/console-safe.js" }
		);
		if($isBrowserIE) {
			head.js({ jquerysmartresize: "/public/js/jquery/jquery.smartresize.js" } // loads with masonry on grid pages
						,{ imagesloaded: "/public/js/jquery/jquery.imagesloaded.js" } // loads with masonry on grid pages
			);
		}
		// END NO MATTER WHAT (MUST LOAD FIRST)
		
		// ANIMATION H__elPERS (only if csstransitions aren't enabled)
		// -----------------------------------------------------------------------------------------------
		if(!$isCSSTransitions) {
			
			head.js({ jqueryshadowanimate: "/public/js/jquery/jquery.animate-shadow-min.js" }
						 ,{ jqueryanimatecolors: "/public/js/jquery/jquery.animate-colors.js" }
			);
			
		}
		// END ANIMATION H__elPERS

		// GRID PAGES ONLY (NO SINGLE PAGES)
		// -----------------------------------------------------------------------------------------------
		if(!$wp_isPageTypeSingle) {
			
			head.js({ masonry: "/public/js/jquery/jquery.masonry.min.js" });
			// once masonry is loaded...
			head.ready("masonry", function(){
				head.js({ infinitescroll: "/public/js/jquery/infinite-scroll/jquery.infinitescroll.min.js" });
			}); // END head.ready("masonry")

			head.ready("infinitescroll", function() {
				head.js({ gridlockedcustom: "/public/js/_custom-portfolio.js" });
			}); // END head.ready("infinitescroll");

		} else {
			
			// NOT GRID PAGES
			// -----------------------------------------------------------------------------------------------
			if(!$wp_isPageTypeResume) {
				head.js({ slidesjs: "/public/js/jquery/slides.min.jquery.js" });
			}

			head.js({ jquerysmartresize: "/public/js/jquery/jquery.smartresize.js" } // loads with masonry on grid pages
						 ,{ imagesloaded: "/public/js/jquery/jquery.imagesloaded.js" } // loads with masonry on grid pages
			);

			head.ready("imagesloaded", function() {
				head.js({ gridlockedcustom: "/public/js/_custom-portfolio.js" });
			}); // END head.ready("imagesloaded");

		}
		// END GRID PAGES ONLY

		// NO MATTER WHAT (MUST LOAD LAST)
		// -----------------------------------------------------------------------------------------------
		head.js({ bootstrap: "/public/js/bootstrap/bootstrap.js" });
		head.ready("gridlockedcustom", function() {
			
			// RESUME PAGE ONLY
			// -----------------------------------------------------------------------------------------------	
			if($wp_isPageTypeResume) {
			
				head.js({ jqueryhotkeys: "/public/js/jquery/jquery.hotkeys.js" }, 
				function(){
					redirect_CtrlP();
				});	
			
			}
			// END RESUME PAGE ONLY	

		});
		// END NO MATTER WHAT (MUST LOAD LAST)

		// GRIDLOCKED SHORTCODES STUFF
		// -----------------------------------------------------------------------------------------------
//		head.js({ tzjqueryuicustom:			"/public/js/jquery/jquery-ui-1.8.5.custom.min.js"	}
//					  ,{ tzshortcodes:				"/public/js/jquery/jquery.shortcodes.js"						}

//		);

		// CONDITIONAL VAR CHECKING H__elPER
		// -----------------------------------------------------------------------------------------------		

		

	} // END if(window.jQuery)
	
} // END load_therest()
