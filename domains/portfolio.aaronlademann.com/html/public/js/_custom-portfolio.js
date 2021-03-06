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
$wp_pageNavSelector = ".navigation";
$wp_pageNavNext = ".nav-next a";
// detect whether or not browser can handle css animations / transitions
$cssTransitions = $("html.csstransitions").length;
$norgba = $("html.no-rgba").length;
$useJStoAnimate = $cssTransitions > 0 ? false : true;
$cssFadeShowClass = "opaque";
// is it a single page?
$isSinglePage = $("body.single").length;
$isIphone = $("body").hasClass("iphone");
$isIE = $("body").hasClass("ie");

/*--------------------------------------------------------------------------------------------------------

	********************* HEAD.READY() *********************

----------------------------------------------------------------------------------------------------------*/

function dependents(elems) {
		if(elems == "all") {
			elems = $($masonryWrapperClass).find($masonryBoxClass);
		}
		// these are all the actions that need to happen each time masonry happens, or more bricks appear, etc...
		// placeing in a function for easy extensibility
		tz_likeInit(); // check cookies for like-it action
		disableRightClick($masonryWrapperClass + ' img, .lightbox img, .fancybox-img'); // disable right click on all portfolio images
		html5elems_init();
		contentHeight(); // dynamic content height
		if($().masonry) {
			masonBrickBindings(elems);
		}
} // END dependents()

if(window.jQuery) {

	if($().masonry) {
		masonTheLayout();
	} else {
		// initial call for dependents()
		// must call separately if the page is not masoned
		// if the page is masoned, dependents() is triggered from the masonTheLayout() function.
		dependents("all");
	}// END if(masonry)

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

	// trigger this stuff on window resize
	$(window).bind("smartresize", function(event) {
		contentHeight();
	});

	if(!$isIE) {

		window.addEventListener("orientationchange", function() { // switching between landscape and horizontal
			updateOrientation();

			if($().masonry) {
				masonTheLayout();
			} // END if(masonry)

		}, false);

	}


	tz_widgetOverlay(); // TODO - only trigger this if the widget overlay function is enabled in WP
	tz_navTitles(); // TODO - figure out what this does ;)


} // END head.ready()

/*-----------------------------------------------------------------------------------*/
//	We're ready!
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
//	MOBILE DEVICE ORIENTATION FUNCTIONS
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

} // END updateOrientation

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
//	DYNAMIC HEIGHT / WIDTH FUNCTIONS
/*-----------------------------------------------------------------------------------*/

function contentHeight() {

	var windowHeight, mastHeight, footerHeight, elemHeight;
	windowHeight = $(window).height();
	mastHeight = $("#masthead").height();
	footerHeight = $('#footer').height();
	elemHeight = windowHeight - mastHeight;

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

	var slider, sidebar, windowWidth, hSpacing, hSpaces, hPads, scrollBarWidth, newWidth, isNoScroll;
	slider = $(".single .slider");
	sidebar = $(".single #single-sidebar");
	windowWidth = $(window).width();
	hSpacing = 40; // width of horizontal gaps
	hSpaces = 3; // number of horizontal gaps
	hPads = hSpacing * hSpaces;
	//console.info($(slider).width());
	//console.info(windowWidth);
	if($(slider).width() > 0) {
		// single page, figure out the dynamic width of the
		// right sidebar as long as the window width isn't less than 1024
		scrollBarWidth = 16;
		newWidth = windowWidth - $(slider).width() - hPads - scrollBarWidth;
		isNoScroll = $("html.noscroll").attr("id");
		//isNoScroll = $(isNoScroll).width();
		if(isNoScroll != -1) {
			newWidth = newWidth + scrollBarWidth;
		}

		$(sidebar).width(newWidth);
		$(sidebar).css("visibility", "visible");

	} // END if($(slider))

} // END contentWidth()

/*-----------------------------------------------------------------------------------*/
//	SLIDESHOW INITIATION (single page only)
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

	var lboxes, howMany;
	lboxes = $(".slider").find(".lightbox");
	howMany = lboxes.length;
//	console.info("there are " + howMany + " lightboxes");
	$.each(lboxes, function(i) {
		//console.info("found a lightbox... it's number " + i);
		$(".caption, img", this).addClass($cssFadeShowClass);

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
//	hentry mouseover / mouseout effects
/*-----------------------------------------------------------------------------------*/
function hentryMouseOver(elem, hoverClass) {

	elem.addClass(hoverClass);
	var permalink, permalinkAnchor, likeItAnchor;
	permalinkAnchor = elem.find("a.permalink");
	permalink = permalinkAnchor.attr("href");
	bindPermalink(elem, permalink);

	permalinkAnchor.click(function() {
		elem.unbind("click");
	});

	likeItAnchor = elem.find(".likeThis");
	likeItAnchor.click(function() {
		elem.unbind("click");
		bindPermalink(elem, permalink);
	});

	if(!$cssTransitions && !$norgba) {
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

	if(!$cssTransitions && !$norgba) {
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
//	Masonry Layout
/*-----------------------------------------------------------------------------------*/

function masonTheLayout() {

	var infscrPageview, $wall, $masonryThumbs, infScrollNextSelector;
	infscrPageview = 1;
	$wall = $($masonryWrapperClass);

	dependents("all"); // trigger all the separate actions / functions that need to accompany the masonry layout.

	//var iewall = $("body.ie").find("#" + $wall.attr("id"));
	//$(iewall).animate({ opacity: 1 }, 0);
	// why isn't this working in IE???
	//console.info("should be adding class transReady to #" + $wall.attr("id"));
	$wall.addClass("transReady"); // so that we can delay the css transitions until everything is ready to roll.

	$masonryThumbs = $($masonryBoxClass).find("> .post-thumb > a > img");

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

		infScrollNextSelector = $($wp_pageNavSelector + " " + $wp_pageNavNext).length;
		// make sure there IS a "next page" link before attempting infinitescroll()
		if(infScrollNextSelector > 0){
			// prevent accidental infinite scroll triggering on page reload by automatically scrolling the page to the top
			$('body').animate({
				left: '0'
			}, 300, function() {

				try {
					scroll_forever();
				} catch(e) {
					console.log("Error (line 349 of _custom-portfolio.js): " + e);
				}


			});
		} // END if(infScrollNextSelector > 0)

	//});        // END $wall.imagesLoaded()


	function scroll_forever() {

		$container = $($masonryWrapperClass);
		// infinitescroll() is called on the element that surrounds
		// the items you will be loading more of
		try {

			$container.infinitescroll({
				navSelector: $wp_pageNavSelector,
				nextSelector: $wp_pageNavNext,
				itemSelector: $masonryBoxClass,
				loadingText: 'Loading more goodies',
				loadingMsgRevealSpeed: 300,
				bufferPx: 180,
				extraScrollPx: 40,
				donetext: 'No more goodies here',
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

					dependents($newElems); // bind / trigger all the stuff that happens on new layout load

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
//	"Like" Scripts
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
			classes = $(this).addClass("active");

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

	var item, text, patt, num, updated_title;
	item = $("#" + who);
	text = item.html();
	patt = /(\d)+/;

	num = patt.exec(text);
	num[0]++;
	text = text.replace(patt, num[0]);
	updated_title = tz_whoLikes(item, num[0], postID);
	item.attr("title", updated_title);
	item.html('<span class="count">' + text + '</span>');

	// is it active?
	// if so, add the active class for coloration
	if($.cookie("like_" + postID)) {
		item.addClass("active");
	}
	// reveal it no matter what
		item.addClass($cssFadeShowClass);

} // END tz_reloadLikes()

function bindPermalink(pl, here) {

	$(pl).bind("click", function() {
		window.location = here;
	});

} // END bindPermalink()

function caption_as_url(caption) {

	// strip whitespace
	var captionAsUrl = caption.replace(/ /g,"_");
	// strip quotes
	captionAsUrl = captionAsUrl.replace(/"([^"]*)"/g, "$1");
	return captionAsUrl;
	//console.info(caption_as_url);

} // END caption_as_url()

function tz_navTitles() {

	$('.nav-previous a').attr('title', $('.nav-previous a').text());
	$('.nav-next a').attr('title', $('.nav-next a').text());

} // END tz_navTitles()

/*-----------------------------------------------------------------------------------*/
//	add 2nd level of parent categories in sidebar nav
/*-----------------------------------------------------------------------------------*/
function sidebarParentNavs() {

	var sidebar, nestedParentCat, nestedGrandParentCat;
	sidebar = $("#sidebar").attr("id");
	//console.info(sidebar);
	if(sidebar == "sidebar") {
		//console.info("found the sidebar");
		nestedParentCat = $("#" + sidebar).find(".widget li>ul.children>li.current-cat-parent");
		nestedGrandParentCat = $(nestedParentCat).parent().parent();
		$(nestedGrandParentCat).addClass("current-cat-grandparent");

	} // END if(sidebar);

} // END sidebarParentNavs()

/*-----------------------------------------------------------------------------------*/
//	disable right click context menu to protect copyrighted images
/*-----------------------------------------------------------------------------------*/
function disableRightClick(disableOnThis) {

	$(disableOnThis).live('contextmenu', function(e) {
		return false;
	});

} // END disableRightClick(disableOnThis)

/*-----------------------------------------------------------------------------------*/
//	prevent HTML version of resume from being printed, redirect to pdf instead
/*-----------------------------------------------------------------------------------*/
function redirect_CtrlP() {

	try{
		$(document).bind("keydown", "ctrl+p", function(event){
			event.preventDefault();
			_gaq.push(["_trackPageview", "/resume/pdf-download"]);
			window.location = $("#resume #pdf > a").attr("href");
		});
	} catch(e1){
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
	} catch(e2){
		//error - didn't work, go ahead and do the default action.
		_gaq.push(["_trackPageview", "/resume/print"]);
		return true;
	}

}

/*-----------------------------------------------------------------------------------*/
//	track "likes" in google analytics as events
/*-----------------------------------------------------------------------------------*/
function ga_trackLikes() {

	//------------------------------ track "likes" in google analytics
	var folioItemTitle, likeButton;
	folioItemTitle = $(this).find(".entry-title").text();
	//console.info(folioItemTitle);
	likeButton = $(this).find(".likeThis").not(".active");
	$.each(likeButton, function() {

		var cssID, folioItemID;
		cssID = $(this).attr("id");
		folioItemID = cssID.substring(cssID.lastIndexOf("-") + 1);

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
//	track external navigation clicks in google analytics
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
//	Track Lightbox Opens
/*-----------------------------------------------------------------------------------*/

function trackLightBoxStuff(pglinks,arr) {

	var lboxTitles, pageLinks, lightboxLink;
	lboxTitles = arr;

	//------------------------------ track pagination clicks in google analytics

	$(pglinks).find("li.current > a").addClass("active");
		pageLinks = $(pglinks).find("li > a");
		$.each(pageLinks, function() {

			$(this).live('click', function(e) {
				if(e.button == 0) {

					if($(this).attr("class") != "active") {

						var pageIndex, whichPage;
						pageIndex = $(this).attr("href");
						pageIndex = parseFloat(pageIndex.substring(pageIndex.lastIndexOf("#") + 1));
						// this is the caption of the image they selected via the pagination nav
						whichPage = lboxTitles[pageIndex];

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
		lightboxLink = $(".single #primary").find("a.lightbox");
		$.each(lightboxLink, function() {

			$(this).bind("click", function() {

				var imageCaption, imageCaption_url;
				imageCaption = $(this).find("> .caption").text();
				imageCaption_url = caption_as_url(imageCaption);

				_gaq.push(['_trackEvent', 'portfolio', 'fullsize-view', currPage + "?img=" + imageCaption_url]);

			}); //end .bind("click")


			//TODO: track individual lightbox image pageviews once the lightbox has already opened (forward / backward buttons)

		});   // end .each(lightboxLink)

} // END trackLightBoxStuff()

/*-----------------------------------------------------------------------------------*/
//	Widget Overlay Stuff
/*-----------------------------------------------------------------------------------*/

function tz_widgetOverlay() {

	var widgetOverlay, widgetTrigger, widgetOverlayHeight;
	widgetOverlay = $('#widget-overlay-container');
	widgetTrigger = $('#overlay-open a');

	widgetOverlayHeight = widgetOverlay.height() + 3;

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
//	FancyBox Lightbox
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
//	Overlay Animation
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