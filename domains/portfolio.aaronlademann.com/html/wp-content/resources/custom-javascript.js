var $ = jQuery.noConflict();

var currPage = window.location.pathname;
//console.info(currPage);

function caption_as_url(caption) {
	// strip whitespace
	var caption_as_url = caption.replace(/ /g,"_");
	// strip quotes
	caption_as_url = caption_as_url.replace(/"([^"]*)"/g, "$1");
	return caption_as_url;
	//console.info(caption_as_url);
} // caption_as_url()

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

$(document).ready(function() {


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
	$('#masonry-portfolio img, .lightbox img, .fancybox-img').live('contextmenu', function(e) {
		return false;
	});

	// make the hentry boxes have the same width as the thumbnail
	var hentries = $("#masonry-portfolio").find(".hentry");
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

		var thumbnail = $(".post-thumb > a > img", this);

		// activate a hover in / hover out function for each entry
		$(this).hover(function() {
			// hover in
			$(this).addClass("hover");
			//var thumbnail = $(".post-thumb > a > img", this);
			$(this).stop(true, true).animate({
				//backgroundColor: "#ffffff",
				backgroundColor: "rgba(255,255,255,1.0)",
				boxShadow: "0 0 0 rgba(0,0,0,0.2) inset"
			}, { queue: true, duration: 600 }, function() {
				// animation complete
			});

		}, function() {
			// hover out
			$(this).removeClass("hover");
			//var thumbnail = $(".post-thumb > a > img", this);
			$(this).stop(true, true).animate({
				//backgroundColor: "#f2f2f2",
				backgroundColor: "rgba(242,242,242,0.5)",
				boxShadow: "0 0 6px rgba(0,0,0,0.2) inset"
			}, { queue: true, duration: 600 }, function() {
				// animation complete
			});

		}
		);

	}); // END .each(hentries)

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

});