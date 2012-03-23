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
		var offset;
		switch (orientation) {
				
				// If we're horizontal
				case 90:
				case -90:
				
				// Set orient to landscape
				document.body.setAttribute("orient", "landscape");
				$('body').addClass("landscape");
				$('body').removeClass("portrait");
				offset = 0;
				
				break;  
				
				// If we're vertical
				default:
				
				// Set orient to portrait
				document.body.setAttribute("orient", "portrait");
				$('body').addClass("portrait");
				$('body').removeClass("landscape");
				offset = 0;
				
				break;
		}
		
		updateFixedPosition("#footer",offset);
		
}

head.ready("jquery", function() {

	aarons_customStuff();

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