head.ready("jquery", function() {
	var $ = jQuery.noConflict();

// fullHeight(elem,parentElem,aboveElem,belowElem);
function fullHeight(elem, parentElem, aboveElem, belowElem) {
	//
	//outerWrapper = $("#container");
	var dheight = parentElem.height(),
	    container = elem.height(),
	    wheight = $(window).height() - ($(aboveElem).height() + $(belowElem).height()),
	    cheight = wheight - dheight + container;

	if (wheight > dheight) {
		$(elem).height(cheight);
	}

	$(window).resize(function() {
		wheight = $(window).height();
		noscroll();
		changepush();
	});

	function noscroll() {
		if (wheight > dheight) {
			$('html').addClass('noscroll');
		} else if (wheight <= dheight) {
			$('html').removeClass('noscroll');
		} else {
		}

	}

	function changepush() {
		if (wheight > dheight) {
			$(elem).height(wheight - dheight + container);
		}

	}

} // END function fullHeight()

});