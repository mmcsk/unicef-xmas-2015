// github access
// user: mmcsk
// pass: m4y3rmcc4nn

/* 
ZAPAD, STRED, VYCHOD
MUZI, ZENY
HOKEJ, FUTBAL
VEGETARIANI, MASOZRUTI
PES, MACKA
ZIVY, UMELY
*/

var scroll = (function($) {
	var _m = {};
	var windowH = $(window).height();
	var windowW = $(window).width();
	var prevScrollTop = $(window).scrollTop();
	var scrollTop = $(window).scrollTop();

	var currentBlock = targetBlock = 0;
	var scrolling = false;
	var blocks = $('.grp').length;
	
	_m.initScroll = function() {
		return;
		currentBlock = Math.floor(scrollTop / windowH);

		$(window).on('scroll', function() {
			prevScrollTop = scrollTop;
			scrollTop = $(this).scrollTop();

			if (scrolling)
				return;


			if (Math.abs(prevScrollTop - scrollTop) < 20) {
				prevScrollTop = scrollTop;
				return;
			}

			targetBlock = (prevScrollTop <= scrollTop) ? currentBlock + 1 : currentBlock - 1;

			if (targetBlock < 0)
				targetBlock = 0;

			if (targetBlock > blocks - 1)
				targetBlock = blocks - 1;


			target = $('#block-menu a').get(targetBlock);

			$(target).click();
		});

		$('a[href^=#]').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
				|| location.hostname == this.hostname
			) {
				scrollToNext(this.hash);
			}
		});
	};
	
	var scrollToNext = function(hash) {
		var target = $(hash);
		scrolling = true;
		disableScroll();
		
		if (target.length) {
			$('html, body').animate({
				scrollTop: target.offset().top
			}, 700, 'swing', function() {

				currentBlock = targetBlock;
				scrolling = false;
				location.href = hash;
				enableScroll();
			});
			return false;
		}
	};

	_m.setCurrentBlock = function(curBlock) {
		if (typeof curBlock === 'number')
			currentBlock = targetBlock = curBlock;
	}
	
	_m.getOffset = function() {
		return scrollTop;
	};

	var keys = {37: 1, 38: 1, 39: 1, 40: 1};

	var preventDefault = function(e) {
		e = e || window.event;
		if (e.preventDefault)
			e.preventDefault();
		e.returnValue = false;
	};

	var preventDefaultForScrollKeys = function(e) {
		if (keys[e.keyCode]) {
			preventDefault(e);
			return false;
		}
	};

	var disableScroll = function() {
		if (window.addEventListener) // older FF
			window.addEventListener('DOMMouseScroll', preventDefault, false);
		window.onwheel = preventDefault; // modern standard
		window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
		window.ontouchmove  = preventDefault; // mobile
		document.onkeydown  = preventDefaultForScrollKeys;
	};

	var enableScroll = function() {
		if (window.removeEventListener)
			window.removeEventListener('DOMMouseScroll', preventDefault, false);
		window.onmousewheel = document.onmousewheel = null;
		window.onwheel = null;
		window.ontouchmove = null;
		document.onkeydown = null;
	};

	return _m;
})($);