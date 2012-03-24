function updateFixedPosition(element,offset){
	var elemHeight = $(element).height();
	var winHt = window.innerHeight;
	var Yoffst = window.pageYOffset;

	var topCSS = (Yoffst + winHt) - (elemHeight - offset);
  $(element).css('top', topCSS + "px");
}


function updateIOSux() {  
	updateOrientation();
}

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

head.ready("jquery", function() {

	aarons_customStuff();

	//$(".pagination").hide();

	// Sniff for orientation property
	if(typeof window.orientation !== "undefined") {

		// Remove scroll class on orientation change
		window.addEventListener("orientationchange", function() {
			updateIOSux();
		}, false);

	}

	// onload
	updateIOSux();
});

function thumbnailNav(orientation, offset) {

	var correctPageType = $("body.single").length;
	if(correctPageType) {

		var slider = $(".slider");
		var vertSlider = $(".slider.vert").length; // check if the vert class is already applied
		var container = $(".slider .pagination.thumbs");
		
		if(vertSlider) {
			if(orientation == "portrait") {
				slider.removeClass("vert");
			} // END if(portrait)
		} else {
			if(orientation == "landscape") {
				slider.addClass("vert");
			}
		}// END if(vertSlider)
		

	} // END if(correctPageType)
	

} // END thumbnailNav

function aarons_customStuff() {
	
//	var isSingle = $("body").hasClass("single");
//	if(isSingle){
//		
//	} else {
//		var logoElem = $("#logo img");
//		$(logoElem).attr("src","http://portfolio.aaronlademann.com/wp-content/themes/gridlocked/images/logo-aa_spackled_ios.png");
//		$(logoElem).css("visibility","visible");
//	}
	
	$(window).bind('scroll', function() {
		updateIOSux();
	})
	.bind('resize', function(){
		updateIOSux();																		
	});
	
//	document.body.addEventListener("touchstart", function(e) {
//		$("#footer").css("visibility","hidden");
//	}, false);
//	
//	document.body.addEventListener("touchend", function(e) {
//		$("#footer").css("visibility","visible");
	//	}, false);	
	
	// keep the zoom levels under control when switching orientations
	if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
		var viewportmeta = document.querySelector('meta[name="viewport"]');
		if (viewportmeta) {
			viewportmeta.content = 'width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0';
			document.body.addEventListener('gesturestart', function() {
				viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
			}, false);
		}
	}

}