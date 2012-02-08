var $ = jQuery.noConflict();
$(document).ready(function() {

	// make the hentry boxes have the same width as the thumbnail
	var hentries = $("#masonry-portfolio").find(".hentry");
	$.each(hentries, function() {
		var thumbnail = $(".post-thumb > a > img", this);
		
		$(thumbnail).load(function() {
			var pic_width = $(this).width();
			//var pic_height = $(this).height();
			console.debug(pic_width);
			$(this).closest(".hentry").css("width", pic_width + "px");

		});

		// activate a hover in / hover out function for each entry
		$(this).hover(function() {
			// hover in
			//var thumbnail = $(".post-thumb > a > img", this);
			$(this).stop(true, true).animate({
				backgroundColor: "#ffffff"
			}, { queue: true, duration: 1000 }, function () {
				// animation complete
			});
			$(thumbnail).stop(true, true).animate({
				opacity: 1.0
			}, { queue: true, duration: 1000 }, function () {
				// animation complete
				$(this).toggleClass("hover");
			});
			
		}, function() {
			// hover out
			//var thumbnail = $(".post-thumb > a > img", this);
			$(this).stop(true, true).animate({
				backgroundColor: "#fafafa"
			}, { queue: true, duration: 1000 }, function () {
				// animation complete
			});
			$(thumbnail).stop(true, true).animate({
				opacity: 0.8
			}, { queue: true, duration: 1000 }, function () {
				// animation complete
				$(this).toggleClass("hover");
			});
			
		}
		);

	});
});