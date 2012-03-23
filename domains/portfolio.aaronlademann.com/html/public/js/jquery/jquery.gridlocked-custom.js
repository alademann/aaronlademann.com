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

/*--------------------------------------------------------------------------------------------------------

 	********************* HEAD.READY() *********************
 
----------------------------------------------------------------------------------------------------------*/

head.ready(function() {

	// trigger this stuff on window resize
	$(window).smartresize(function() {
		contentHeight();
	});

	contentHeight(); // dynamic content height
	tz_likeInit(); // check cookies for like-it action
	
	if( $().masonry ) {
		masonTheLayout();
	} // END if(masonry)

	disableRightClick($masonryWrapperClass + ' img, .lightbox img, .fancybox-img'); // disable right click on all portfolio images

	tz_widgetOverlay();
	tz_overlay();
	tz_navTitles();
	tz_fancybox();
	lightboxDOMlistener()
	sidebarParentNavs();

}); // END head.ready()

/*-----------------------------------------------------------------------------------*/
/*	We're ready!
/*-----------------------------------------------------------------------------------*/

// Remove JavaScript fallback class
$('#container').removeClass('js-disabled');

/*--------------------------------------------------------------------------------------------------------

 	********************* FUNCTIONS *********************
 
----------------------------------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	DYNAMIC HEIGHT / WIDTH FUNCTIONS
/*-----------------------------------------------------------------------------------*/

function contentHeight() {

	var windowHeight = $(window).height();
	var mastHeight = $("#masthead").height();
	var footerHeight = $('#footer').height();

	var elemHeight = windowHeight - mastHeight;
	$("#container").css("min-height", elemHeight - 50);
	$(".single .lightbox img").css({
		//maxHeight: elemHeight - 130,
		maxHeight: elemHeight - 184,
		height: "auto"
	});

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
	var $wall = $($masonryWrapperClass);
	var $masonryThumbs = $($masonryBoxClass).find("> .post-thumb > a > img");

	$masonryThumbs.imagesLoaded(function() {

		$wall.masonry({
			itemSelector: $masonryBoxClass,
			isAnimated: !Modernizr.csstransitions, // only use js for animations if csstransitions are not supported by the visitor's browser
			animationOptions: {
				duration: 500,
				easing: 'easeInOutCirc',
				queue: false
			}
		});

		$wall.addClass("transReady"); // so that we can delay the css transitions until everything is ready to roll.
		$('body').animate({
			left: '0'
		}, 300, function() {
			// document height should be set now
			scroll_forever();
		});

	}); // END $wall.imagesLoaded()


	function scroll_forever() {

		$container = $($masonryWrapperClass);
		// infinitescroll() is called on the element that surrounds 
		// the items you will be loading more of
		$container.infinitescroll({
			navSelector: ".navigation",
			nextSelector: ".nav-next a",
			itemSelector: $masonryBoxClass,
			loadingText: 'Loading more items',
			loadingMsgRevealSpeed: 0,
			bufferPx: 80,
			extraScrollPx: 0,
			donetext: 'No more items to load',
			debug: false,
			animate: false,
			loadingImg: "/public/images/loading.gif"

		}, function(newElements) {

			// hide new items while they are loading
			var $newElems = $(newElements).css({ opacity: 0 });
			// ensure that images load before adding to masonry layout
			$newElems.imagesLoaded(function() {

				// bind hover effects
				$newElems.hover(function() {
					$(this).addClass("hover");
				}, function() {
					$(this).removeClass("hover");
				})

				// show elems now they're ready
				$newElems.animate({ opacity: 1 });
				$container.masonry('appended', $newElems);

				// since each time this triggers is technically a new page of content...
				infscrPageview++;
				_gaq.push(['_trackPageview', currPage + "/page/" + infscrPageview]);

				contentHeight();

			});

		});
		// END INFINITE SCROLL

	} // END scroll_forever()
		
	// HENTRY EFFECTS
	var hentries = $($masonryWrapperClass).find($masonryBoxClass);
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

} // END masonTheLayout()


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
	if($.cookie("like_" + postID)) {
		item.addClass("active");
	}

	// reveal it no matter what
	item.css("visibility", "visible");

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

function lightboxDOMlistener() {
	
	// store all the image titles in a single lightbox in an array
	window.addEventListener('DOMNodeInserted', function(event) {
		var thisLoaded = event.target.id;
		//console.info(event.target.id);
		var lightboxGalleryLink = 'fancybox-right';
		//console.log(thisLoaded);
		if(thisLoaded == lightboxGalleryLink) {
			//console.warn("found the lightbox gallery");

			$('body').animate({
				top: 0
			}, 500, function() {
				// Animation complete.
				var paginationLinks = $(".single #primary").find(".pagination");
				var lightboxTitleArray = new Array();

				var i = 0;
				var lightBoxImage = $(".single #primary").find(".slides_control figure img");
				$.each(lightBoxImage, function() {
					lightboxTitleArray[i] = $(this).attr("alt");
					//console.info("lightboxTitleArray[" + i + "] = " + lightboxTitleArray[i]);
					i++;
				});

				trackLightBoxStuff(paginationLinks, lightboxTitleArray);

			});

		} // END if ($(thisLoaded).is( lightboxGalleryDiv ))
	}, false);

	// end addEventListener('DOMNodeInserted')

}

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