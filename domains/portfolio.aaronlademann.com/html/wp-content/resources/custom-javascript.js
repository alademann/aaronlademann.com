var $ = jQuery.noConflict();
$(document).ready(function() {

	// disable right click on all images
	$('img').live('contextmenu', function(e) {
		return false;
	});

	// make the hentry boxes have the same width as the thumbnail
	var hentries = $("#masonry-portfolio").find(".hentry");
	$.each(hentries, function() {

		// track "likes" in google analytics
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


		// thumbnail hover effects

		var thumbnail = $(".post-thumb > a > img", this);

		// activate a hover in / hover out function for each entry
		$(this).hover(function() {
			// hover in
			//var thumbnail = $(".post-thumb > a > img", this);
			$(this).stop(true, true).animate({
				backgroundColor: "#ffffff"
			}, { queue: true, duration: 1000 }, function() {
				// animation complete
			});
			$(thumbnail).stop(true, true).animate({
				opacity: 1.0
			}, { queue: true, duration: 1000 }, function() {
				// animation complete
				$(this).toggleClass("hover");
			});

		}, function() {
			// hover out
			//var thumbnail = $(".post-thumb > a > img", this);
			$(this).stop(true, true).animate({
				backgroundColor: "#fafafa"
			}, { queue: true, duration: 1000 }, function() {
				// animation complete
			});
			$(thumbnail).stop(true, true).animate({
				opacity: 0.8
			}, { queue: true, duration: 1000 }, function() {
				// animation complete
				$(this).toggleClass("hover");
			});

		}
		);

	});
});