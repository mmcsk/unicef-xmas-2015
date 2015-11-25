var main = (function(c){
	c.shareTitle = 'Najštedrejšie srdce majú {1}. Súhlasíš?'; 
	c.shareText = 'Pošli SMS v hodnote 3 € na číslo 844 s textom {2} a pomôž naplniť kamión jedlom pre podvyživené deti v Nepále.';

	/**
	 * Initializes a fullPage.js plugin for smooth scrolling
	 */
	c.initFullPage = function() {
		// fullPage initialization
		$('#fullpage').fullpage({
			anchors:['domov', 'region', 'pohlavie', 'jedlo', 'sport', 'zviera', 'podakovanie'],
			// scrollOverflow: true,
			onLeave: function(oldIndex, newIndex) {
				oldIndex--;
				newIndex--;
				$('#block-menu a:eq(' + oldIndex + ')').removeClass('block-menu__link--active');
				if (newIndex)
					$('#block-menu a:eq(' + newIndex + ')').addClass('block-menu__link--active');

				// if (!oldIndex) {
				// 	$('.block-video__play').click();
				// }
			}
		});
	}
	
	return c;
})(circles);


var videoControl = (function() {
	var _vc = {};
	var $video;
	var video;
	var $contentVideo;
	var contentVideo;
	var $videoBlock;
	var $contentVideoBlock;
	var $play;
	var $contentPlay;
	var $contentModalPlay;
	var $contentModal;
	var $contentClose;

	_vc.getVideo = function() {
		$video = $('#video');
		video = $('#video').get(0);
	};

	_vc.getContentVideo = function() {
		$contentVideo = $('#content-video');
		contentVideo = $('#content-video').get(0);
	};

	_vc.initVideoClick = function() {
		$contentVideo.click(function() {
			if ($contentModalPlay.hasClass('hidden')) {
				$contentModalPlay.removeClass('hidden');
				contentVideo.pause();
			}
			else {
				$contentModalPlay.addClass('hidden');
				contentVideo.play();
			}
		});

		$contentVideo.on('touchstart', function() {
			contentVideo.pause();
			$contentClose.click();
		});
	};

	_vc.init = function() {
		_vc.getVideo();
		_vc.getContentVideo();

		_vc.initVideoClick();

		$play = $('.block-video__play');
		$contentPlay = $('.content__text__play-video');
		$contentModalPlay = $('.content-video-modal__play');
		$contentClose = $('.content-video-modal__close');
		$contentModal = $('#content-video-modal');

		$video.click(function() {
			video.pause();
			$play.removeClass('block-video__play--hidden');
		});

		$play.click(function() {
			if ($(this).hasClass('block-video__play--hidden')) {
				video.pause();
			}
			else
				video.play();
			
			$(this).toggleClass('block-video__play--hidden');
		});

		$contentPlay.click(function() {
			var subGroupId = $(this).parents('.box').attr('id');
			var formats = ['webm', 'mp4', 'ogg'];

			
			contentVideo.pause();
			$('#content-video-modal .modal-body').html('<video id="content-video" autoplay preload="auto"><p>This browser does not support HTML5 video.</p></video>');
			_vc.getContentVideo();

			for (var i = 0; i < formats.length; i++) {
				var videoName = subGroupId + '.' + formats[i];
				$contentVideo.append('<source src="/resources/videos/vid_' + videoName + '" type="video/' + formats[i] + '" >');
			}

			$contentVideo.on("canplay", function() {
				contentVideo.play();
			});

			$contentVideo.on('ended', function() {
				$contentModal.modal('hide');
			});

			$contentModal.modal('show');

		});

		$contentModal.on('hide.bs.modal', function() {
			contentVideo.pause();
		});

		$contentModalPlay.click(function() {
			$contentVideo.click();
		});

		$contentClose.click(function() {
			contentVideo.pause();
		});


		$video.on( "canplay", function() {
			$('#block-video').removeClass('invisible');
			video.play();
		});

		video.addEventListener('ended', function() {
			if (this.volume)
				$('.block-video__volume-toggle').click();
			
			this.setAttribute('loop', 'loop');
			this.play();
		});

		_vc.videoPlay = function() {
			video.play();
		};

		_vc.videoPause = function() {
			video.pause();
		};

		_vc.contentVideoPlay = function() {
			contentVideo.play();
		};

		_vc.contentVideoPause = function() {
			contentVideo.pause();
		};
	};

	return _vc;
})();

$('document').ready(function() {
	main.initFullPage();
	main.getVotes(true);
	main.initVoteRefresh();
	// main.playVideo();

	$('.block-share').click(function() {
		var subGroupId = $(this).parents('.box').attr('id');
		var smsCode = $(this).data('smscode');
		var smsCapt = $(this).data('smscapt');
		var title = main.shareTitle.replace(/\{1\}/, smsCapt);
		var desc = main.shareText.replace(/\{2\}/, smsCode);
		
		FB.ui({
			method: 'feed',
			link: 'http://unicef.mayer.sk',
			name: title,
			description: desc,
			picture: 'http://unicef.mayer.sk/resources/share-images/like_' + subGroupId + '.jpg',
			caption: 'Srdce pre Nepál'
		}, function(response){});
	});

	$('.fb-share-button').click(function() {
		alert('a');
	});

	$('.block-video__down').click(function() {
		return;
		$('#block-menu a:eq(1)').click();
	});

	$('.block-video__volume-toggle').click(function() {
		var video = $('#video').get(0);
		var vol = video.volume;
		if (vol) {
			video.volume = 0;
			$(this).children('i').removeClass('glyphicon-volume-up').addClass('glyphicon-volume-off');
		}
		else {
			video.volume = 1;
			$(this).children('i').removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up');
		}
	});

	// modal control
	$('.block-video__more, .block-menu__more').click(function() {
		$("#video").get(0).pause();
		$("#more").modal('show');
		$(".block-video__play").removeClass('block-video__play--hidden');
	});


	videoControl.init();

	/*// video control
	$('#video').click(function() {
		$("#video").get(0).pause();
		$(".block-video__play").removeClass('block-video__play--hidden');
	});

	$('.block-video__play').click(function() {
		if ($(this).hasClass('block-video__play--hidden'))
			$("#video").get(0).pause();
		else
			$("#video").get(0).play();
		
		$(".block-video__play").toggleClass('block-video__play--hidden');
	});

	$('.content__text__play-video').click(function() {
		var subGroupId = $(this).parents('.box').attr('id');
		$modal = $('#content-video-modal');
		$modalVideo = $modal.find('video');
		var formats = ['mp4', 'webm', 'ogg'];
		for (var i = 0; i < formats.length; i++) {
			var videoName = subGroupId + '.' + formats[i];
			$modalVideo.append('<source src="/resources/videos/vid_' + videoName + '" type="video/' + formats[i] + '" />');
		}

		var $video = $('#content-video');
		$video.on( "canplay", function() {
			$video.get(0).play();
		});

		$modal.modal('show');
	});

	$('#content-video').click(function() {
		var video = $(this).get(0);
		var $play = $('.content-video-modal__play');

		if ($play.hasClass('hidden')) {
			$('.content-video-modal__play').removeClass('hidden');
			video.pause();
		}
		else {
			$('.content-video-modal__play').addClass('hidden');
			video.play();
		}
	});

	$('#content-video-modal').on('hidden', function() {
		$('#content-video').get(0).pause();
	});

	$('.content-video-modal__play').click(function() {
		$('#content-video').click();
	});

	$('.content-video-modal__close').click(function() {
		$('#content-video').get(0).pause();
	})*/
});