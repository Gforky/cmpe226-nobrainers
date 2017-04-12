$(document).ready(function() {
	var fix = $('.switchViewButtons');
	var fixTop = fix.offset().top,
		fixHeight = fix.height();

	$(window).scroll(function() {
		var docTop = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
		
		if(fixTop < docTop) {
			fix.css({'position':'fixed'});
			fix.css({top:0});
		} else {
			fix.css({'position':'static'});
		}
	})
})