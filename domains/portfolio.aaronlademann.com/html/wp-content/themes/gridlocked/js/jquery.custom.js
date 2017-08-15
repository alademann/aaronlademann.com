var $ = jQuery.noConflict();
/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end $
 
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Remove JavaScript fallback class
/*-----------------------------------------------------------------------------------*/
 
$('#container').removeClass('js-disabled');
 
/*-----------------------------------------------------------------------------------*/
/*	Let's get ready!
/*-----------------------------------------------------------------------------------*/

head.ready("jquery", function() {


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

		// cache masonry wrap
		var $wall = $('#masonry');

		$wall.masonry({
			columnWidth: 380,
			animate: true,
			animationOptions: {
				duration: 500,
				easing: 'easeInOutCirc',
				queue: false
			},
			itemSelector: '.hentry'
		}, function() {
			$('#load-more-link').fadeIn(200);
		});

		// cache masonry wrap
		var $port = $('#masonry-portfolio');

		$port.masonry({
			singleMode: true,
			animate: true,
			animationOptions: {
				duration: 500,
				easing: 'easeInOutCirc',
				queue: false
			},
			itemSelector: '.hentry'
		});

	}

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
					$boxes = $('#new-posts .hentry');

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
		loadMoreWidth();
		contentHeight();
	});

	function loadMoreWidth() {

		var loadMoreLink = $('#load-more-link a');
		var masonryWrap = $('#masonry').width();

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


	loadMoreWidth();

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

	var topLink = $('#back-to-top');

	function tz_backToTop(topLink) {

		if($(window).scrollTop() > 0) {
			//console.info($(window).scrollTop());
			topLink.stop().fadeIn(200);
		} else {
			topLink.stop().fadeOut(200);
		}
	}

	$(window).scroll(function() {
		tz_backToTop(topLink);
	});

	// aaronl: custom (was pointing to the anchor link)
	$(topLink).click(function() {
		$('html, body').stop().animate({ scrollTop: 0 }, 500);
		return false;
	});

	// aaronl: custom (since i'm removing the anchor link, i need to set up a hover system for the wrapper div)				
	head.ready("jquery", function() {
		var colorIn;
		var colorOut;
		var hovClass;
		if($.support.opacity) {
			colorIn = 'rgba(0, 0, 0, .1)';
			colorOut = 'rgba(0, 0, 0, 0)';
			hovClass = 'hover';
		} else {
			colorIn = '#d3d7d8';
			colorOut = 'transparent';
			hovClass = 'ieHover';
		}

		// firefox seems to be making the browser itself change opacity
		// the plugin i'm using here may be pretty buggy.
		$('#back-to-top, .insetBox > li:not([class*="current"]) > a').hover(
			function() {
				$(this).addClass(hovClass);
				$(this).stop().animate({ backgroundColor: colorIn });
			},
			function() {
				$(this).removeClass(hovClass);
				$(this).stop().animate({ backgroundColor: colorOut });
			}
		);

	});
	/*-----------------------------------------------------------------------------------*/
	/*	Add title attributes
	/*-----------------------------------------------------------------------------------*/

	$('.nav-previous a').attr('title', $('.nav-previous a').text());
	$('.nav-next a').attr('title', $('.nav-next a').text());

	function contentHeight() {

		var windowHeight = $(window).height();
		var footerHeight = $('#footer').height();
		// aaronl: custom (changed offset to 170
		var yOffset = 170;
		$('#content').css('min-height', windowHeight - footerHeight - yOffset);

	}

	contentHeight();

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
			$("#" + who).addClass("active").css("visibility","visible");
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

});