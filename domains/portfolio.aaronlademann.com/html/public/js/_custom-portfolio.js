/*--------------------------------------------------------------------------------------------------------

 	jQuery gridlocked customization
	(GRIDLOCK THEME CUSTOMIZATIONS BY AARON LADEMANN)
 
-----------------------------------------------------------------------------------------------------------*/

var $ = jQuery.noConflict();
var isFirstLoad = true;
var currPage = window.location.pathname;

// GLOBAL VARS
$masonryWrapperClass = ".masonry";
$masonryBoxClass = ".masonry-brick";
// detect whether or not browser can handle css animations / transitions
$cssTransitions = $("html.csstransitions").length;
$useJStoAnimate = $cssTransitions > 0 ? false : true;
$cssFadeShowClass = "opaque";
// is it a single page?
$isSinglePage = $("body.single").length;
$isIphone = $("body").hasClass("iphone");
$isIE = $("body").hasClass("ie");

/*--------------------------------------------------------------------------------------------------------

 	********************* HEAD.READY() *********************
 
----------------------------------------------------------------------------------------------------------*/

if(window.jQuery) {

	function launchRejectionModal() {
		$("#jr_wrap").modal({
			backdrop: 'static'
		}); // use twitter bootstrap modal to pop open
	}

	$.reject(
		options = {
			onFail : launchRejectionModal,
			reject : { // Rejection flags for specific browsers
				all: false, // Covers Everything (Nothing blocked)
				msie5: true, msie6: true, msie7: true,
				firefox: true, // Covers FF 1-3
				chrome: true, // Covers Chrome 1-4
				safari1: true, safari2: true, safari3: true,
				/*
					* Possibilities are endless...
					*
					* // MSIE Flags (Global, 5-8)
					* msie, msie5, msie6, msie7, msie8,
					* // Firefox Flags (Global, 1-3)
					* firefox, firefox1, firefox2, firefox3,
					* // Konqueror Flags (Global, 1-3)
					* konqueror, konqueror1, konqueror2, konqueror3,
					* // Chrome Flags (Global, 1-4)
					* chrome, chrome1, chrome2, chrome3, chrome4,
					* // Safari Flags (Global, 1-4)
					* safari, safari2, safari3, safari4,
					* // Opera Flags (Global, 7-10)
					* opera, opera7, opera8, opera9, opera10,
					* // Rendering Engines (Gecko, Webkit, Trident, KHTML, Presto)
					* gecko, webkit, trident, khtml, presto,
					* // Operating Systems (Win, Mac, Linux, Solaris, iPhone)
					* win, mac, linux, solaris, iphone,
					* unknown // Unknown covers everything else
					*/
			},
			display: [], // What browsers to display and their order (default set below)
			browserInfo: { // Settings for which browsers to display
				firefox: {
					text: '<strong>Mozilla Firefox</strong> <br />Version 4+', // Text below the icon
					url: 'http://www.mozilla.com/firefox/' // URL For icon/text link
				},
				safari: {
					text: '<strong>Apple Safari</strong> <br />Version 4+',
					url: 'http://www.apple.com/safari/download/'
				},
				opera: {
					text: '<strong>Opera</strong> <br />Version 11+',
					url: 'http://www.opera.com/download/',
					allow: { all: false, opera: true }
				},
				chrome: {
					text: '<strong>Google Chrome</strong> <br />Version 11+',
					url: 'http://www.google.com/chrome/'
				},
				msie: {
					text: '<strong>Internet Explorer</strong> <br />Version 9+',
					url: 'http://www.microsoft.com/windows/Internet-explorer/',
					allow: { all: false, msie: true } // certainly don't want to recommend IE unless the poor soul is already using it
				},
				gcf: {
					text: 'Google Chrome Frame',
					url: 'http://code.google.com/chrome/chromeframe/',
					// This browser option will only be displayed for MSIE
					allow: { all: false, msie: true }
				}
			},

			// Header of pop-up window
			header: 'Please upgrade your browser to browse Aaron&rsquo;s Portfolio.',
			
			// Paragraph 1
			paragraph1: 'I built aaronlademann.com using the latest techniques and technologies, including HTML5, CSS3 and PHP5.' + 
									'This makes the experience much faster and more enjoyable for everyone.  Unfortunately, ' + 
									$.browser.className + ' ' + $.browser.version + '.' + $.browser.versionX + 
									' doesn&rsquo;t support those technologies - or has known compatibility issues with them.',
			// Paragraph 2
			paragraph2: 'Download one of these great browsers and you&rsquo;ll be on your way.',
			close: false, // Allow closing of window
			// Message displayed below closing link
			closeMessage: 'By closing this window you acknowledge that your experience '+
							'on this website may be degraded',
			closeLink: 'Close This Window', // Text for closing link
			closeURL: '#', // Close URL
			closeESC: true, // Allow closing of window with esc key

			// If cookies should be used to remmember if the window was closed
			// See cookieSettings for more options
			closeCookie: false,
			// Cookie settings are only used if closeCookie is true
			cookieSettings: {
				// Path for the cookie to be saved on
				// Should be root domain in most cases
				path: '/',
				// Expiration Date (in seconds)
				// 0 (default) means it ends with the current session
				expires: 0
			},

			imagePath: '/public/images/icons/browsers/', // Path where images are located
			overlayBgColor: '#000', // Background color for overlay
			overlayOpacity: 0.8, // Background transparency (0-1)

			// Fade in time on open ('slow','medium','fast' or integer in ms)
			fadeInTime: 'fast',
			// Fade out time on close ('slow','medium','fast' or integer in ms)
			fadeOutTime: 'fast'
		}
			
	);  // END jQuery.reject()
	

	if($().masonry) {
		masonTheLayout(); // LINE 315
	} // END if(masonry)

	if($isSinglePage) {
		// functions that should ONLY trigger on .single pages
		initiateSlides();
	} else {
		// functions that should NOT trigger on .single pages
		sidebarParentNavs();
	}

	var $alerts = $("#container").find(".alert");
	if($alerts.length) {
		try {
			// the class used here has to match the data-dismiss attribute of the close <a> tag.
			$(".alert").alert(); // Enable bootstrap alerts		
		} catch(e) { }
	} // END if alerts

	tz_likeInit(); // check cookies for like-it action

	html5elems_init();

	// trigger this stuff on window resize
	$(window).smartresize(function() {
		contentHeight();
		//		contentWidth();
	});

	window.addEventListener("orientationchange", function() { // switching between landscape and horizontal
		updateOrientation();

		if($().masonry) {
			masonTheLayout();
		} // END if(masonry)

	}, false);

	contentHeight(); // dynamic content height
	//	contentWidth();

	disableRightClick($masonryWrapperClass + ' img, .lightbox img, .fancybox-img'); // disable right click on all portfolio images

	tz_widgetOverlay(); // TODO - only trigger this if the widget overlay function is enabled in WP
	tz_navTitles(); // TODO - figure out what this does ;)


}            // END head.ready()

/*-----------------------------------------------------------------------------------*/
/*	We're ready!
/*-----------------------------------------------------------------------------------*/

// Remove JavaScript fallback class
$('#container').removeClass('js-disabled');

/*--------------------------------------------------------------------------------------------------------

 	********************* FUNCTIONS *********************
 
----------------------------------------------------------------------------------------------------------*/

function html5elems_init() {
	//console.info("firing html5elems_init()");
	// give details area the same effect as input:focus when the summary elem is hovered
	var $details_elems = $("#container").find("details");
	if($details_elems.length) {
		$.each($details_elems, function() {
			//console.info("found <details id=" + $(this).attr("id") + ">");
			var summHeader = $("> summary", this);
			//console.info("found summary: " + summHeader.text());
			$(summHeader).bind("mouseover", function() {
				$(this).closest("details").addClass("hover");
			});
			$(summHeader).bind("mouseout", function() {
				$(this).closest("details").removeClass("hover");
			});
		});
	} // END if($details_elems
		
} // END html5elems_init();

/*-----------------------------------------------------------------------------------*/
/*	MOBILE DEVICE ORIENTATION FUNCTIONS
/*-----------------------------------------------------------------------------------*/
function updateOrientation() {
		var orientation = window.orientation;
		
		switch (orientation) {
				// If we're horizontal
				case 90:
				case -90:
					orientLandscape();
					break;  
				
				// If we're vertical
				default:
					orientPortrait();
					break;
		}
		
}

function orientLandscape() {
	var offset;
	// Set orient to landscape
	document.body.setAttribute("orient", "landscape");
	orientLandscape();
	$('body').addClass("landscape");
	$('body').removeClass("portrait");
	offset = 0;

	// contextual thumbnail nav on .single portfolio pages
	thumbnailNav("landscape", offset);

} // END orientLandscape()

function orientPortrait() {
	var offset;
	// Set orient to portrait
	document.body.setAttribute("orient", "portrait");
	$('body').addClass("portrait");
	$('body').removeClass("landscape");
	offset = 0;

	// contextual thumbnail nav on .single portfolio pages
	thumbnailNav("portrait", offset);

} // END orientVertical()

/*-----------------------------------------------------------------------------------*/
/*	DYNAMIC HEIGHT / WIDTH FUNCTIONS
/*-----------------------------------------------------------------------------------*/

function contentHeight() {

	var windowHeight = $(window).height();
	var mastHeight = $("#masthead").height();
	var footerHeight = $('#footer').height();

	var elemHeight = windowHeight - mastHeight;
	$("#container").css("min-height", elemHeight - 50);
	
	if(!$isIphone) {
		$(".single .lightbox img").css({
		//maxHeight: elemHeight - 130,
			maxHeight: elemHeight - 184,
			height: "auto"
		});	
	} else {
		$("body").addClass("foundiOS");
	} // END if(!isIphone)
	

	//contentWidth();

} // END contentHeight()

function contentWidth() {

	var slider = $(".single .slider");
	var sidebar = $(".single #single-sidebar");
	var windowWidth = $(window).width();
	var hSpacing = 40; // width of horizontal gaps
	var hSpaces = 3; // number of horizontal gaps
	var hPads = hSpacing * hSpaces;
	//console.info($(slider).width());
	//console.info(windowWidth);
	if($(slider).width() > 0) {
		// single page, figure out the dynamic width of the 
		// right sidebar as long as the window width isn't less than 1024
		var scrollBarWidth = 16;
		var newWidth = windowWidth - $(slider).width() - hPads - scrollBarWidth;
		var isNoScroll = $("html.noscroll").attr("id");
		//isNoScroll = $(isNoScroll).width();
		if(isNoScroll != -1) {
			newWidth = newWidth + scrollBarWidth;
		}

		$(sidebar).width(newWidth);
		$(sidebar).css("visibility", "visible");

	} // END if($(slider))

} // END contentWidth()

/*-----------------------------------------------------------------------------------*/
/*	SLIDESHOW INITIATION (single page only)
/*-----------------------------------------------------------------------------------*/
function initiateSlides() {
	
	$(".slider").slides({
		preloadImage: '/public/images/loading_light.gif', 
		preload: true,
		generateNextPrev: true, 
		generatePagination: false,
		effect: 'fade',
		fadeEasing: 'easeOutQuad',
		slideSpeed: 700,
		currentClass: $cssFadeShowClass,
		play: 8000,
		pause: 1000,
		autoHeight: false,
		hoverPause: true
	});

	var lboxes = $(".slider").find(".lightbox");
	var howMany = lboxes.length;
//	console.info("there are " + howMany + " lightboxes");
	$.each(lboxes, function(i) {
		//console.info("found a lightbox... it's number " + i);
		$(".caption, img", this).addClass($cssFadeShowClass); ;
		if(i == (howMany - 1)) {
			// done iterating
			//console.info("we've reached the end, jim");
			if(!$isIphone) {
				$(".pagination.thumbs").addClass($cssFadeShowClass);
			} // END if(!isIphone);
		}
	});  // END .each(lboxes)

} // END initiateSlides()

/*-----------------------------------------------------------------------------------*/
/*	hentry mouseover / mouseout effects
/*-----------------------------------------------------------------------------------*/
function hentryMouseOver(elem, hoverClass) {

	elem.addClass(hoverClass);
	var permalinkAnchor = elem.find("a.permalink");
	var permalink = permalinkAnchor.attr("href");
	bindPermalink(elem, permalink);

	permalinkAnchor.click(function() {
		elem.unbind("click");
	});

	var likeItAnchor = elem.find(".likeThis");
	likeItAnchor.click(function() {
		elem.unbind("click");
		bindPermalink(elem, permalink);
	});

	if(!$cssTransitions) {
		// if css transitions arent available...
		elem.stop(true, true).animate({
			backgroundColor: "rgba(255,255,255,0.9)",
			boxShadow: "0 2px 0 rgba(255, 255, 255, 1.0)"
		}).find("> .wellOverlay").stop(true, true).animate({
			boxShadow: "0 1px 3px 0 rgba(0, 0, 0, 0.3) inset"
		}, { queue: true, duration: 700 }, function() {
			// animation complete
		});

	} // end if(!$cssTransitions)

} // END hentryMouseOver(elem)

function hentryMouseOut(elem, hoverClass) {

	elem.removeClass(hoverClass);
	elem.unbind("click");

	if(!$cssTransitions) {
		// if css transitions arent available...

		elem.stop(true, true).animate({
			backgroundColor: "rgba(204,204,204,0.2)",
			boxShadow: "0 2px 0 rgba(255, 255, 255, 0.7)"
		}).find("> .wellOverlay").stop(true, true).animate({
			boxShadow: "0 1px 7px 0 rgba(0, 0, 0, 0.4) inset"
		}, { queue: true, duration: 700 }, function() {
			// animation complete
		});

	} // end if(!$cssTransitions)

} // END hentryMouseOut(elem)

/*-----------------------------------------------------------------------------------*/
/*	Masonry Layout
/*-----------------------------------------------------------------------------------*/

function masonTheLayout() {
	
	var infscrPageview = 1;
	var $wall = $("#masonry-portfolio");

	//var iewall = $("body.ie").find("#" + $wall.attr("id"));
	//$(iewall).animate({ opacity: 1 }, 0);
	// why isn't this working in IE???
	//console.info("should be adding class transReady to #" + $wall.attr("id"));
	$wall.addClass("transReady"); // so that we can delay the css transitions until everything is ready to roll.
	
	var $masonryThumbs = $($masonryBoxClass).find("> .post-thumb > a > img");

	//$masonryThumbs.imagesLoaded(function() {

		$wall.masonry({
			itemSelector: $masonryBoxClass,
			isAnimated: $useJStoAnimate, // only use js for animations if csstransitions are not supported by the visitor's browser
			animationOptions: {
				duration: 500,
				easing: 'easeInOutCirc',
				queue: false
			}
		});

		var infScrollNextSelector = $(".navigation .nav-next a").length;

		if(infScrollNextSelector > 0){
			// prevent accidental infinite scroll triggering on page reload by automatically scrolling the page to the top
			$('body').animate({
				left: '0'
			}, 300, function() {

				try {
					scroll_forever();
				} catch(e) {
					console.log("Error (line 346 of _custom-portfolio.js): " + e);
				}


			});
		}

	//});        // END $wall.imagesLoaded()


	function scroll_forever() {

		$containerID = "#" + $($masonryWrapperClass).attr("id");
		$container = $($containerID);
		// infinitescroll() is called on the element that surrounds 
		// the items you will be loading more of
		try {

			$("#masonry-portfolio").infinitescroll({
				navSelector: ".navigation",
				nextSelector: ".nav-next a",
				itemSelector: $masonryBoxClass,
				loadingText: 'Loading more items',
				loadingMsgRevealSpeed: 700,
				bufferPx: 180,
				extraScrollPx: 40,
				donetext: 'No more items to load',
				debug: false,
				animate: false,
				loadingImg: "/public/images/loading.gif"

			}, function(newElements) {

				$container.addClass("infinite-scroll");
				// hide new items while they are loading
				var $newElems = $(newElements);
				//$newElems.css({ opacity: 0 });
				// ensure that images load before adding to masonry layout
				$newElems.imagesLoaded(function() {

					// show elems now they're ready
					$container.masonry('appended', $newElems, true);
					tz_likeInit();
					contentHeight();
					//$newElems.animate({ opacity: 1 });
					// bind hover effects
					masonBrickBindings($newElems);
					// since each time this triggers is technically a new page of content...
					infscrPageview++;
					_gaq.push(['_trackPageview', currPage + "/page/" + infscrPageview]);



				});

			});
			
		} catch (e) {
			console.log("Error (line 364 of _custom-portfolio.js): " + e);
		}
		
		// END INFINITE SCROLL

	} // END scroll_forever()

	masonBrickBindings($($masonryWrapperClass).find($masonryBoxClass));

} // END masonTheLayout()

function masonBrickBindings(elems) {
	
	// HENTRY EFFECTS
	var hentries = elems;
	$.each(hentries, function() {
		// track masonry portfolio box "likes"
		ga_trackLikes();
		// track external clicks
		ga_trackExternal();
		// masonry thumbnail hover effects
		var hoverClass = "hover";
		$(this).hover(function() { hentryMouseOver($(this), hoverClass); }
								, function() { hentryMouseOut($(this), hoverClass); }
		); // END $(hentries).hover()
	}); // END .each(hentries)
	// END HENTRY EFFECTS

}

/*-----------------------------------------------------------------------------------*/
/*	"Like" Scripts
/*-----------------------------------------------------------------------------------*/

function tz_likeInit() {

	var likeThisLinks = $(".likeThis");

	$.each(likeThisLinks, function() {

		var id = $(this).attr("id");
		id = id.split("like-");

		tz_reloadLikes("like-" + id[1], id[1]);

		$(this).click(function() {
			var classes = $(this).attr("class");
			classes = classes.split(" ");

			if(classes[1] == "active") {
				return false;
			}
			var classes = $(this).addClass("active");

			// set the cookies here instead of in the php file since php cannot get the expiration set correctly.
			$.cookie("like_" + id[1], id[1], { expires: 7300, path: '/', domain: '.aaronlademann.com' });

			$.ajax({
				type: "POST",
				url: "/index.php",
				data: "likepost=" + id[1],
				success: tz_reloadLikes("like-" + id[1], id[1])
			});

			return false;

		}); // END click()

	}); // END .each(likeThisLinks)


} // END tz_likeInit()

function tz_whoLikes($post, $likes, $post_id) {

	var page_type = $("body").attr("class");
	page_type = page_type.split(" ");
	if(page_type[0] == "single") {
		$what = $("h1.entryTitle").text();
	} else {
		$what = $(".box[id$=" + $post_id + "]").find(".entry-title > a").text();
	}


	$who = $likes + ' people like ';
	if($likes == 1) {
		$who = $likes + ' person likes ';
	}
	// if(current user likes it)
	if($.cookie("like_" + $post_id)) {

		$who = 'You ';
		if($likes > 1) {
			$others_count = $likes - 1;
			$others = 'and ' + $others_count + ' others like ';
			if($likes == 2) {
				$others = 'and 1 other person like ';
			}
		} else {
			// only you like it.
			$others = 'like ';
		}

		$wholikesit = $who + $others + $what;

	} else {
		// current user hasn't liked it yet	
		$wholikesit = $who + $what;
	}

	return $wholikesit;

} // END tz_whoLikes

function tz_reloadLikes(who, postID) {

	var item = $("#" + who);
	var text = item.html();
	var patt = /(\d)+/;

	var num = patt.exec(text);
	num[0]++;
	text = text.replace(patt, num[0]);
	var updated_title = tz_whoLikes(item, num[0], postID);
	item.attr("title", updated_title);
	item.html('<span class="count">' + text + '</span>');

	// is it active?
	// if so, add the active class for coloration
	if($.cookie("like_" + postID)) {
		item.addClass("active");
	}
	// reveal it no matter what
		item.addClass($cssFadeShowClass);;

} // END tz_reloadLikes()

function bindPermalink(pl, here) {

	$(pl).bind("click", function() {
		window.location = here;
	});

} // END bindPermalink()

function caption_as_url(caption) {
	
	// strip whitespace
	var caption_as_url = caption.replace(/ /g,"_");
	// strip quotes
	caption_as_url = caption_as_url.replace(/"([^"]*)"/g, "$1");
	return caption_as_url;
	//console.info(caption_as_url);
		
} // END caption_as_url()

function tz_navTitles() {
		
	$('.nav-previous a').attr('title', $('.nav-previous a').text());
	$('.nav-next a').attr('title', $('.nav-next a').text());

} // END tz_navTitles()

/*-----------------------------------------------------------------------------------*/
/*	add 2nd level of parent categories in sidebar nav
/*-----------------------------------------------------------------------------------*/
function sidebarParentNavs() {

	var sidebar = $("#sidebar").attr("id");
	//console.info(sidebar);
	if(sidebar = "sidebar") {
		//console.info("found the sidebar");
		var nestedParentCat = $("#" + sidebar).find(".widget li>ul.children>li.current-cat-parent");
		var nestedGrandParentCat = $(nestedParentCat).parent().parent();
		$(nestedGrandParentCat).addClass("current-cat-grandparent");

	} // END if(sidebar);

} // END sidebarParentNavs()

/*-----------------------------------------------------------------------------------*/
/*	disable right click context menu to protect copyrighted images
/*-----------------------------------------------------------------------------------*/
function disableRightClick(disableOnThis) {

	$(disableOnThis).live('contextmenu', function(e) {
		return false;
	});

} // END disableRightClick(disableOnThis)

/*-----------------------------------------------------------------------------------*/
/*	prevent HTML version of resume from being printed, redirect to pdf instead
/*-----------------------------------------------------------------------------------*/
function redirect_CtrlP() {

	try{
		$(document).bind("keydown", "ctrl+p", function(event){
			event.preventDefault();
			_gaq.push(["_trackPageview", "/resume/pdf-download"]);
			window.location = $("#resume #pdf > a").attr("href");
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

}

/*-----------------------------------------------------------------------------------*/
/*	track "likes" in google analytics as events
/*-----------------------------------------------------------------------------------*/
function ga_trackLikes() {

	//------------------------------ track "likes" in google analytics
	var folioItemTitle = $(this).find(".entry-title").text();
	//console.info(folioItemTitle);
	var likeButton = $(this).find(".likeThis").not(".active");
	$.each(likeButton, function() {
		var cssID = $(this).attr("id");
		var folioItemID = cssID.substring(cssID.lastIndexOf("-") + 1);

		$(this).live("click", function(e) {
			// make sure right-clicks arent tracked
			if(e.button == 0) {
				//console.info("button != 0");
				// track "like" event in google analytics
				_gaq.push(['_trackEvent', 'portfolio', 'likes', folioItemTitle]);
			}

		}); // END .live(click)

	}); // end .each(likeButton)

} // END ga_trackLikes()

/*-----------------------------------------------------------------------------------*/
/*	track external navigation clicks in google analytics
/*-----------------------------------------------------------------------------------*/
function ga_trackExternal() {

	var navBtns = $(".nav").find("a");
	$.each(navBtns, function() {

		//console.info($(this).text());

		$(this).bind("click", function() {

			var btn_text = $(this).text();
			switch(btn_text) {
				case "photos":
					_gaq.push(['_trackEvent', 'nav_external', 'photos.aaronlademann.com']);
					break;
				case "photography":
					_gaq.push(['_trackEvent', 'nav_external', 'photos.aaronlademann.com']);
					break;
				case "contact":
					_gaq.push(['_trackEvent', 'nav_external', 'contact email']);
					break;
				case "resume":
					_gaq.push(['_trackEvent', 'nav_external', 'linkedin']);
					break;
				case "twitter":
					_gaq.push(['_trackEvent', 'nav_external', 'twitter']);
					break;
			}

		}); //end .bind("click");

	}); // END .each(navBtns)	

} // END ga_trackExternal()


/*-----------------------------------------------------------------------------------*/
/*	Track Lightbox Opens
/*-----------------------------------------------------------------------------------*/

function trackLightBoxStuff(pglinks,arr) {

	var lboxTitles = arr;

	//------------------------------ track pagination clicks in google analytics

	$(pglinks).find("li.current > a").addClass("active");
		var pageLinks = $(pglinks).find("li > a");
		$.each(pageLinks, function() {

			$(this).live('click', function(e) {
				if(e.button == 0) {

					if($(this).attr("class") != "active") {

						var pageIndex = $(this).attr("href");
						pageIndex = parseFloat(pageIndex.substring(pageIndex.lastIndexOf("#") + 1));
						// this is the caption of the image they selected via the pagination nav
						var whichPage = lboxTitles[pageIndex];

						//console.info("clicked " + whichPage);

						////////////////////////////// TRACK STUFF NOW ///////////////////////////////////////
						
						//console.info(currPage + "?paginate=" + caption_as_url(whichPage));

						_gaq.push(['_trackPageview', currPage + "?paginate=" + caption_as_url(whichPage)]);
						//_gaq.push(['_trackEvent', 'portfolio', 'likes', folioItemTitle]);

						/////////////////////////////////////////////////////////////////////////////////////

						// remove the one that used to be active
						$(pageLinks).filter(".active").removeClass("active");
						// add the one that is now active
						$(this).addClass("active");


					}

				}

			}); // end .live(click)

		});             // END .each(paginationLink)

		//------------------------------ track lightbox views in google analytics
		var lightboxLink = $(".single #primary").find("a.lightbox");
		$.each(lightboxLink, function() {

			$(this).bind("click", function() {
				
				var imageCaption = $(this).find("> .caption").text();
				var imageCaption_url = caption_as_url(imageCaption);

				_gaq.push(['_trackEvent', 'portfolio', 'fullsize-view', currPage + "?img=" + imageCaption_url]);
				
			}); //end .bind("click")


			//TODO: track individual lightbox image pageviews once the lightbox has already opened (forward / backward buttons)

		});   // end .each(lightboxLink)

} // END trackLightBoxStuff()

/*-----------------------------------------------------------------------------------*/
/*	Widget Overlay Stuff
/*-----------------------------------------------------------------------------------*/

function tz_widgetOverlay() {

	var widgetOverlay = $('#widget-overlay-container');
	var widgetTrigger = $('#overlay-open a');

	var widgetOverlayHeight = widgetOverlay.height() + 3;

	widgetOverlay.css({
		marginTop: -widgetOverlayHeight,
		display: 'block'
	});

	widgetTrigger.toggle(function() {

		widgetOverlay.animate({
			marginTop: 0
		}, 800, 'easeOutBounce');

		widgetTrigger.addClass('close');

	}, function() {

		widgetOverlay.animate({
			marginTop: -widgetOverlayHeight
		}, 800, 'easeOutBounce');

		widgetTrigger.removeClass('close');

	});

} // END tz_widgetOverlay()

/*-----------------------------------------------------------------------------------*/
/*	FancyBox Lightbox
/*-----------------------------------------------------------------------------------*/

function tz_fancybox() {

	if($().fancybox) {
		$("a.lightbox").fancybox({
			'transitionIn': 'fade',
			'transitionOut': 'fade',
			'speedIn': 300,
			'speedOut': 300,
			'overlayShow': true,
			// aaronl: custom
			'autoScale': true,
			'titleShow': false,
			'margin': 10,
			easingIn: 'swing',
			easingOut: 'swing',

			showCloseButton: true,
			showNavArrows: true,
			enableEscapeButton: true,
			enableKeyboardNav: true
		});
	}

} // END tz_fancybox()

/*-----------------------------------------------------------------------------------*/
/*	Overlay Animation
/*-----------------------------------------------------------------------------------*/

function tz_overlay() {

	$('.post-thumb a').hover(function() {
		$(this).find('.overlay').fadeIn(150);
	}, function() {
		$(this).find('.overlay').fadeOut(150);
	});

} // END tz_overlay()

// add a css class that indicates we successfully loaded this script
$("html").addClass("scriptsuccess");