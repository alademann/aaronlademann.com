Modernizr.load([
		{
			load: '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js',
			complete: function() {
				if (!window.jQuery) {
					// load local copy if google cdn is down
					Modernizr.load('/public/js/jquery/jquery-latest.min.js');
					console.warn("google CDN was down, had to load local jQuery resource");
				} else {

					// GLOBAL VARS
					var $ = jQuery.noConflict();
					$body = $("body");
					$html = $("html");
					$jQdir = "/public/js/jquery/";
					$twBdir = "/public/js/bootstrap/";
					// -----------

					function yepnope(el, cl) {
						var $checkThis;
						if (el = "b") {
							$checkThis = $body;
						} else if (el = "h") {
							$checkThis = $html;
						} else {
							// something unexpected happened... don't know what i'm supposed to check.
							console.warn("ruh roh... yepnope() doesn't recognize " + el + " as a valid parameter. valid params are [h, b]");
							return false;
						}
						// simple function that repeats the same .hasClass() test to set conditional vars in all_set()
						return $checkThis.hasClass(cl) ? true : false;
					}

// END yepnope()

					//function all_set() {
					// this function is called after all the prerequisites are loaded...
					// CONDITIONAL VARS (use these to ONLY LOAD WHAT YOU NEED)
					$isBrowserIE = yepnope("h", "ie");
					$isBrowserIE6_8 = yepnope("h", "lt-ie9");
					$isIphone = yepnope("h", "iphone");
					$isIphone = yepnope("h", "ipad");
					$wp_isPageTypeSingle = yepnope("b", "single");
					$wp_isPageTypeResume = yepnope("b", "page-template-template-resume-php");
					$wp_isUserLoggedIn = yepnope("b", "logged-in");

					// load the rest of our jquery goodies
					Modernizr.load([
							{ load: '/public/js/head.browserdetect.js' }, { load: $jQdir + "jquery.cookie.js" }
						]);
					// load selectivizr for crap ie versions
					if ($isBrowserIE6_8) {

						Modernizr.load([{ load: "/public/js/selectivizr-min.js" }]);

					} // END if($isBrowserIE6_8)

					if (!Modernizr.csstransitions) {

						// only need to load these if the browser doesn't support css transitions
						Modernizr.load([
								{ load: $jQdir + "jquery.animate-shadow-min.js" }, { load: $jQdir + "jquery.animate-colors.js" }
							]);

					} // END if(!Modernizr.csstransitions)

					if (!$wp_isPageTypeSingle) {

						// only load masonry if its a grid layout (not a "single") layout
						Modernizr.load([{
							load: $jQdir + "jquery.masonry.min.js", // TODO: only load this if the page is not .single
							complete: function() {
								// all done loadin this mutha
								console.info("jquery masonry layout enabled");
								// TODO: load the masonry extras
								Modernizr.load([
										{ load: $jQdir + "infinite-scroll/jquery.infinitescroll.min.js" }, { load: $jQdir + "jquery.imagesloaded.js" }
									]);
							}
						}]);

					} else if ($wp_isPageTypeSingle) {

						// only load slides plugin if the page IS single
						Modernizr.load([{ load: $jQdir + "slides.min.jquery.js" }]);

					} else if ($wp_isPageTypeResume) {

						// only load this if its the resume page
						Modernizr.load([{
							load: $jQdir + "jquery.hotkeys.js",
							complete: function() {
								// all done loadin this mutha
								console.info("jquery hotkeys enabled");
								// call function for resume print redirect
								redirect_CtrlP();
							}
						}]);


					} // END if(!wp_isPageTypeSingle)

					Modernizr.load([
							{ load: $jQdir + "jquery.easing.1.3.js" }, { load: $jQdir + "jquery-ui-1.8.5.custom.min.js" }
					// TODO: figure out if this is for admin pages only?
, { load: $jQdir + "jquery.shortcodes.js" }
						]); // END modernizr.load()

					// bootstrap resources
					Modernizr.load([
							{ load: $twBdir + "bootstrap-collapse.js" }, { load: $twBdir + "bootstrap-button.js" }, { load: $twBdir + "bootstrap-dropdown.js" }, { load: $twBdir + "bootstrap-alert.js" }
						]); // END modernizr.load()

					//  load this last
					Modernizr.load([{ load: $jQdir + "jquery.gridlocked-custom.js" }]); // END modernizr.load()

				}
			}
		}
	]);