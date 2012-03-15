var $ = jQuery.noConflict();
var isFirstLoad = true;
var currPage = window.location.pathname;

// global vars to store the selector to prevent breakage
$masonryWrapperClass = ".masonry";
$masonryBoxClass = ".masonry-brick"; 
//console.info(currPage);


/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end $
	(GRIDLOCK THEME CUSTOMIZATIONS BY AARON LADEMANN)
 
-----------------------------------------------------------------------------------*/

function caption_as_url(caption) {
	// strip whitespace
	var caption_as_url = caption.replace(/ /g,"_");
	// strip quotes
	caption_as_url = caption_as_url.replace(/"([^"]*)"/g, "$1");
	return caption_as_url;
	//console.info(caption_as_url);
} // caption_as_url()

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

}

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
			var lightBoxImage = $(".single #primary").find(".lightbox img");
			$.each(lightBoxImage, function() {
				lightboxTitleArray[i] = $(this).attr("alt");
				//console.info("lightboxTitleArray[" + i + "] = " + lightboxTitleArray[i]);
				i++;
			});

			trackLightBoxStuff(paginationLinks, lightboxTitleArray);

		});

	} // END if ($(thisLoaded).is( lightboxGalleryDiv ))
}, false);     // end addEventListener

/*-----------------------------------------------------------------------------------*/
/*	MISC SCRIPTS (Custom)
/*-----------------------------------------------------------------------------------*/

head.ready("jquery", function() {


	//------------------------------ add 2nd level of parent categories in sidebar nav
	var sidebar = $("#sidebar").attr("id");
	//console.info(sidebar);
	if(sidebar = "sidebar") {
		//console.info("found the sidebar");
		var nestedParentCat = $("#" + sidebar).find(".widget li>ul.children>li.current-cat-parent");
		var nestedGrandParentCat = $(nestedParentCat).parent().parent();
		$(nestedGrandParentCat).addClass("current-cat-grandparent");

	} // END if(sidebar);

	// disable right click on all portfolio images
	$($masonryWrapperClass + ' img, .lightbox img, .fancybox-img').live('contextmenu', function(e) {
		return false;
	});

	var hentries = $($masonryWrapperClass).find($masonryBoxClass);
	$.each(hentries, function() {

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


		//------------------------------ thumbnail hover effects

		//var thumbnail = $(".post-thumb > a > img", this);
		cssTransitions = $("html.csstransitions");
		cssTransitions = cssTransitions.length;
		//console.info(cssTransitions);

		bindMasonryHover($(this));

	}); // END .each(hentries)

	function bindPermalink(pl,here) {
		$(pl).bind("click", function() {
			window.location = here;
		});
	}

	function bindMasonryHover(elem) {
		// activate a hover in / hover out function for each entry
		$(elem).hover(function() {
			// hover in
			$(this).addClass("hover");
			var permalinkAnchor = $(this).find("a.permalink");
			var permalink = permalinkAnchor.attr("href");
			bindPermalink($(this),permalink);

			

			permalinkAnchor.click(function() {
				$(elem).unbind("click");
			});

			var likeItAnchor = $(this).find(".likeThis");
			likeItAnchor.click(function() {
				$(elem).unbind("click");
				bindPermalink(elem,permalink);
			});
			//var thumbnail = $(".post-thumb > a > img", this);

			if(!cssTransitions) {
				// if css transitions arent available...
				$(this).stop(true, true).animate({
					backgroundColor: "rgba(255,255,255,0.9)",
					boxShadow: "0 2px 0 rgba(255, 255, 255, 1.0)"
				}).find("> .wellOverlay").stop(true, true).animate({
					boxShadow: "0 1px 3px 0 rgba(0, 0, 0, 0.3) inset"
				}, { queue: true, duration: 700 }, function() {
					// animation complete
				});

			} // end if(!Modernizr.csstransitions)


		}, function() {
			// hover out
			$(this).removeClass("hover");
			//var thumbnail = $(".post-thumb > a > img", this);

			$(this).unbind("click");

			if(!cssTransitions) {
				// if css transitions arent available...

				$(this).stop(true, true).animate({
					backgroundColor: "rgba(204,204,204,0.2)",
					boxShadow: "0 2px 0 rgba(255, 255, 255, 0.7)"
				}).find("> .wellOverlay").stop(true, true).animate({
					boxShadow: "0 1px 7px 0 rgba(0, 0, 0, 0.4) inset"
				}, { queue: true, duration: 700 }, function() {
					// animation complete
				});

			} // end if(!Modernizr.csstransitions)

		}); // end .masonry-box hover
	}

	//------------------------------ track navigation items that go elsewhere
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

});                  // END head.ready

/* END AARONS CUSTOM STUFF */


/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end $
	(GRIDLOCK THEME)
 
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Remove JavaScript fallback class
/*-----------------------------------------------------------------------------------*/
 
$('#container').removeClass('js-disabled');
 
/*-----------------------------------------------------------------------------------*/
/*	Let's get ready!
/*-----------------------------------------------------------------------------------*/

head.ready(function() {

	// trigger the stuff tht needs to happen immediately.
	contentHeight();
	//loadMoreWidth();

	/*-----------------------------------------------------------------------------------*/
	/*	Widget Overlay Stuff
	/*-----------------------------------------------------------------------------------*/

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

	/*-----------------------------------------------------------------------------------*/
	/*	Masonry Layout
	/*-----------------------------------------------------------------------------------*/

	if($().masonry) {

		var infscrPageview = 1;
		//console.info("masonry loaded");
		// cache masonry wrap
		//		var $wall = $($masonryWrapperClass);

		//		$wall.masonry({
		//			columnWidth: 380,
		//			animate: true,
		//			animationOptions: {
		//				duration: 500,
		//				easing: 'easeInOutCirc',
		//				queue: false
		//			},
		//			itemSelector: $masonryBoxClass
		//		}, function() {
		//			$('#load-more-link').fadeIn(200);
		//		});

		// cache masonry wrap
		var $wall = $($masonryWrapperClass);
		var $masonryThumbs = $($masonryBoxClass).find("> .post-thumb > a > img");

		$masonryThumbs.imagesLoaded(function() {

			console.info("hello images");

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


			// usage:
			// $(elem).infinitescroll(options,[callback]);
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
		}

		// unbind typical infinite scroll trigger
		

	} // END if(masonry)




	/*-----------------------------------------------------------------------------------*/
	/*	Load More Post Functions
	/*-----------------------------------------------------------------------------------*/

	var loadMoreLink = $('#load-more-link a');

	var offset = parseInt(loadMoreLink.attr('data-offset'));
	var cat = parseInt(loadMoreLink.attr('data-category'));
	var author = parseInt(loadMoreLink.attr('data-author'));
	var tag = loadMoreLink.attr('data-tag');
	var date = loadMoreLink.attr('data-date');
	var searchQ = loadMoreLink.attr('data-search');

	if(!cat)
		cat = 0;

	if(!author)
		author = 0;

	if(!tag)
		tag = '';

	if(!date)
		date = 0;

	if(!searchQ)
		searchQ = '';

	function tz_loadMore() {

		var off = false;

		var currentCount = parseInt($('#post-count').text());

		if(currentCount == 0) {
			loadMoreLink.text(loadMoreLink.attr('data-empty'));
			off = true;
		}

		loadMoreLink.click(function(e) {
			var newCount = currentCount - $(this).attr('data-offset');

			e.preventDefault();

			//console.log(offset);

			if(off != true) {

				$(this).unbind("click");

				$('#post-count').html('<img src="' + $('#post-count').attr('data-src') + '" alt="Loading..." />');
				$('#remaining').html('');


				$('#new-posts').load($(this).attr('data-src'), {

					offset: offset,
					category: cat,
					author: author,
					tag: tag,
					date: date,
					searchQ: searchQ

				}, function() {

					// create $ object
					$boxes = $('#new-posts ' + $masonryBoxClass);

					if($().masonry) {
						$wall.append($boxes).masonry({ appendedContent: $boxes }, function() {

							tz_fancybox();
							tz_overlay();
							tz_likeInit();

							if(newCount > 0) {
								$('#load-more-link a').find('#post-count').text(newCount);
								$('#remaining').text(' ' + $('#remaining').attr('data-text'));
							} else {
								$('#load-more-link a').text($('#load-more-link a').attr('data-empty'));
								off = true;
							}

							$('#load-more-link a').bind("click", tz_loadMore());

						});
					}

					offset = offset + parseInt($('#load-more-link a').attr('data-offset'));
				});
			}

			//return false;

		});

	}

	tz_loadMore();

	$(window).resize(function() {
		//		//isFirstLoad = false;
		loadMoreWidth();
		contentHeight();
	});

	function loadMoreWidth() {

		var loadMoreLink = $('#load-more-link a');
		var masonryWrap = $($masonryWrapperClass).width();

		if(masonryWrap > 380 && masonryWrap < 760) {
			animateWidth(loadMoreLink, 340);

		} else if(masonryWrap > 760 && masonryWrap < 1140) {
			animateWidth(loadMoreLink, 720);

		} else if(masonryWrap > 1140 && masonryWrap < 1520) {
			animateWidth(loadMoreLink, 1100);

		} else if(masonryWrap > 1520 && masonryWrap < 1900) {
			animateWidth(loadMoreLink, 1480);

		} else if(masonryWrap > 1900 && masonryWrap < 2280) {
			animateWidth(loadMoreLink, 1860);

		} else if(masonryWrap > 2280 && masonryWrap < 2660) {
			animateWidth(loadMoreLink, 2240);
		}
	}

	function animateWidth(elem, size) {
		elem.stop().animate({ width: size }, 200);
	}




	/*-----------------------------------------------------------------------------------*/
	/*	PrettyPhoto Lightbox
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
	}

	tz_fancybox();

	/*-----------------------------------------------------------------------------------*/
	/*	Overlay Animation
	/*-----------------------------------------------------------------------------------*/

	function tz_overlay() {
		$('.post-thumb a').hover(function() {
			$(this).find('.overlay').fadeIn(150);
		}, function() {
			$(this).find('.overlay').fadeOut(150);
		});
	}

	tz_overlay();

	/*-----------------------------------------------------------------------------------*/
	/*	Back to Top
	/*-----------------------------------------------------------------------------------*/

	//	var topLink = $('#back-to-top');

	//	function tz_backToTop(topLink) {

	//		if($(window).scrollTop() > 0) {
	//			//console.info($(window).scrollTop());
	//			topLink.stop().fadeIn(200);
	//		} else {
	//			topLink.stop().fadeOut(200);
	//		}
	//	}

	//	$(window).scroll(function() {
	//		tz_backToTop(topLink);
	//	});

	//	// aaronl: custom (was pointing to the anchor link)
	//	$(topLink).click(function() {
	//		$('html, body').stop().animate({ scrollTop: 0 }, 500);
	//		return false;
	//	});

	// aaronl: custom (since i'm removing the anchor link, i need to set up a hover system for the wrapper div)			
	//	head.ready("jquery", function() {
	//		var colorIn;
	//		var colorOut;
	//		var hovClass;
	//		if($.support.opacity) {
	//			colorIn = 'rgba(0, 0, 0, .1)';
	//			colorOut = 'rgba(0, 0, 0, 0)';
	//			hovClass = 'hover';
	//		} else {
	//			colorIn = '#d3d7d8';
	//			colorOut = 'transparent';
	//			hovClass = 'ieHover';
	//		}

	//		// firefox seems to be making the browser itself change opacity
	//		// the plugin i'm using here may be pretty buggy.
	//		$('#back-to-top, .insetBox > li:not([class*="current"]) > a').hover(
	//			function() {
	//				$(this).addClass(hovClass);
	//				$(this).stop().animate({ backgroundColor: colorIn });
	//			},
	//			function() {
	//				$(this).removeClass(hovClass);
	//				$(this).stop().animate({ backgroundColor: colorOut });
	//			}
	//		);

	//	});



	/*-----------------------------------------------------------------------------------*/
	/*	Add title attributes
	/*-----------------------------------------------------------------------------------*/

	$('.nav-previous a').attr('title', $('.nav-previous a').text());
	$('.nav-next a').attr('title', $('.nav-next a').text());

	function contentHeight() {

		var windowHeight = $(window).height();
		var mastHeight = $("#masthead").height();
		var footerHeight = $('#footer').height();

		// aaronl: custom (changed offset to 170
		//var yOffset = 170;
		var elemHeight = windowHeight - mastHeight;
		//var elemScrollHeight = $("#content").height() - footerHeight - mastHeight;
		// prevent flicker
		//$(window).resize(function() {
		//	if(elemScrollHeight > elemHeight) {
		//		$("html").addClass("noscroll");
		//	} else if(elemScrollHeight <= elemHeight) {
		//		$("html").removeClass("noscroll");
		//	}
		//});
		// apply 100% height
		//$('#container, #content, #primary, .single #primary .hentry').css('min-height', elemHeight);
		//$("#single-sidebar").css("min-height", elemHeight - 100);
		$("#container").css("min-height", elemHeight);

		//contentWidth();
	}
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

		}



	}



	/*-----------------------------------------------------------------------------------*/
	/*	Like Script
	/*-----------------------------------------------------------------------------------*/

	function tz_whoLikes($post_id, $likes) {

		var page_type = $("body").attr("class");
		page_type = page_type.split(" ");
		if(page_type[0] = "single") {
			$what = $("#single-sidebar h1").text();
		} else {
			$what = $("#post-" + $post_id).find(".entry-title").text();
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

	}

	function tz_reloadLikes(who, postID) {
		var text = $("#" + who).html();
		var patt = /(\d)+/;

		var num = patt.exec(text);
		num[0]++;
		text = text.replace(patt, num[0]);
		var updated_title = tz_whoLikes(postID, num[0]);
		$("#" + who).attr("title", updated_title);
		$("#" + who).html('<span class="count">' + text + '</span>');

		// is it active?
		if($.cookie("like_" + postID)) {
			$("#" + who).addClass("active").css("visibility", "visible");
		}

	} //reloadLikes


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
				//var id = $(this).attr("id");
				//id = id.split("like-");

				// set the cookies here instead of in the php file since php cannot get the expiration set correctly.
				$.cookie("like_" + id[1], id[1], { expires: 7300, path: '/', domain: '.aaronlademann.com' });

				$.ajax({
					type: "POST",
					url: "/index.php",
					data: "likepost=" + id[1],
					success: tz_reloadLikes("like-" + id[1], id[1])
				});


				return false;
			});

		});


	}

	tz_likeInit();

});               // END head.ready()

