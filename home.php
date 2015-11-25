<?php

$PATH = '/srdceprenepal';

require_once('voter.php');
	$boxContent   = 'Ukáž svoje štedré srdce! Pomôž naplniť kamión jedlom pre deti v núdzi. Pošli SMS v hodnote 3 &euro; na číslo <span class="content__number">844</span> s textom: <span class="content__sms-code">%s</span>';
	$shareCaption1 = 'zdieľaj a ukáž svojim blízkym, aký štedrý si %s';
	$shareCaption2 = 'zdieľaj a ukáž svojim blízkym, aká štedrá si %s';

	$groups = array(
		'region' => array(
			array(
				'nameLabel'      => 'Robo Opatovský',
				'nameDesc'       => 'Západniari majú všetky prvenstvá!',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g1-c1',
				'subGroupClass'  => 'col-md-4',
				'boxContentCode' => 'ZAPAD',
				'dataGroup'      => 'regions',
				'dataSubGroup'   => 'west',
				'dataSplash'     => 'blue',
				'dataLabel'      => 'Západ',
				'dataPercentInt' => '33',
				'dataPercentDec' => '33',
				'dataPercentClass' => '',
				'shareCaption'   => 'Západoslovák',
				'shareDesc'      => 'Západoslováci',
			),
			array(
				'nameLabel'      => 'Ľuboš Kostelný',
				'nameDesc'       => 'My o štedrosti vieme aj tak najviac!',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g1-c2',
				'subGroupClass'  => 'col-md-4',
				'boxContentCode' => 'STRED',
				'dataGroup'      => 'regions',
				'dataSubGroup'   => 'middle',
				'dataSplash'     => 'yellow',
				'dataLabel'      => 'Stred',
				'dataPercentInt' => '33',
				'dataPercentDec' => '33',
				'dataPercentClass' => '',
				'shareCaption'   => 'Stredoslovák',
				'shareDesc'      => 'Stredoslováci',
			),
			array(
				'nameLabel'      => 'Milan Junior Zimnýkoval',
				'nameDesc'       => 'Východ a štedrosť, to sú synonymá!',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g1-c3',
				'subGroupClass'  => 'col-md-4',
				'boxContentCode' => 'VYCHOD',
				'dataGroup'      => 'regions',
				'dataSubGroup'   => 'east',
				'dataSplash'     => 'red',
				'dataLabel'      => 'Východ',
				'dataPercentInt' => '33',
				'dataPercentDec' => '33',
				'dataPercentClass' => 'percent__lbl--small',
				'shareCaption'   => 'východniar',
				'shareDesc'      => 'východniari',
			)
		),
		'pohlavie' => array(
			array(
				'nameLabel'      => 'Táňa Pauhofová',
				'nameDesc'       => 'Neha a štedrosť. To nás charakterizuje.',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g2-c1',
				'subGroupClass'  => 'col-md-6',
				'boxContentCode' => 'ZENY',
				'dataGroup'      => 'genders',
				'dataSubGroup'   => 'women',
				'dataSplash'     => 'magenta',
				'dataLabel'      => 'Ženy',
				'dataPercentInt' => '50',
				'dataPercentDec' => '00',
				'dataPercentClass' => '',
				'shareCaption'   => 'žena',
				'shareDesc'      => 'ženy',

			),
			array(
				'nameLabel'      => 'Braňo Deák',
				'nameDesc'       => 'Páni tvorstva vedia, čo sú city a štedrosť.',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g2-c2',
				'subGroupClass'  => 'col-md-6',
				'boxContentCode' => 'MUZI',
				'dataGroup'      => 'genders',
				'dataSubGroup'   => 'men',
				'dataSplash'     => 'darkblue',
				'dataLabel'      => 'Muži',
				'dataPercentInt' => '50',
				'dataPercentDec' => '00',
				'dataPercentClass' => '',
				'shareCaption'   => 'muž',
				'shareDesc'      => 'muži',
			)
		),
		'jedlo' => array(
			array(
				'nameLabel'      => 'Jana Hospodárová',
				'nameDesc'       => 'My sme ohľaduplnejší a štedrejší k živým tvorom.',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g3-c1',
				'subGroupClass'  => 'col-md-6',
				'boxContentCode' => 'VEGE',
				'dataGroup'      => 'food',
				'dataSubGroup'   => 'herbivores',
				'dataSplash'     => 'green',
				'dataLabel'      => 'Vegetariáni',
				'dataPercentInt' => '50',
				'dataPercentDec' => '00',
				'dataPercentClass' => 'percent__lbl--smaller',
				'shareCaption'   => 'vegetarián',
				'shareDesc'      => 'vegetariáni',

			),
			array(
				'nameLabel'      => 'Braňo Bystriansky',
				'nameDesc'       => 'Ale my sme aj tak najštedrejší.',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g3-c2',
				'subGroupClass'  => 'col-md-6',
				'boxContentCode' => 'MASO',
				'dataGroup'      => 'food',
				'dataSubGroup'   => 'carnivores',
				'dataSplash'     => 'red',
				'dataLabel'      => 'Mäsožravci',
				'dataPercentInt' => '50',
				'dataPercentDec' => '00',
				'dataPercentClass' => 'percent__lbl--smaller',
				'shareCaption'   => 'mäsožravec',
				'shareDesc'      => 'mäsožravci',
			)
		),
		'sport' => array(
			array(
				'nameLabel'      => 'Martin Škrtel',
				'nameDesc'       => 'Na futbalistov nemá nikto!',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g4-c1',
				'subGroupClass'  => 'col-md-6',
				'boxContentCode' => 'FUTBAL',
				'dataGroup'      => 'sports',
				'dataSubGroup'   => 'football',
				'dataSplash'     => 'lightgreen',
				'dataLabel'      => 'Futbalisti',
				'dataPercentInt' => '50',
				'dataPercentDec' => '00',
				'dataPercentClass' => 'percent__lbl--smallr',
				'shareCaption'   => 'futbalový fanúšik',
				'shareDesc'      => 'futbaloví fanúšikovia',

			),
			array(
				'nameLabel'      => 'Zdeno Cíger',
				'nameDesc'       => 'My sme tu doma, na nás hokejistov nemáte!',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g4-c2',
				'subGroupClass'  => 'col-md-6',
				'boxContentCode' => 'HOKEJ',
				'dataGroup'      => 'sports',
				'dataSubGroup'   => 'hockey',
				'dataSplash'     => 'lightblue',
				'dataLabel'      => 'Hokejisti',
				'dataPercentInt' => '50',
				'dataPercentDec' => '00',
				'dataPercentClass' => 'percent__lbl--small',
				'shareCaption'   => 'fanúšik hokeja',
				'shareDesc'      => 'fanúšikovia hokeja',
			)
		),
		'zviera' => array(
			array(
				'nameLabel'      => 'Thomas Puskailer',
				'nameDesc'       => 'Psičkári sú najvernejší a najštedrejší.',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g5-c1',
				'subGroupClass'  => 'col-md-6 background-position-top',
				'boxContentCode' => 'PES',
				'dataGroup'      => 'pets',
				'dataSubGroup'   => 'dogs',
				'dataSplash'     => 'brown',
				'dataLabel'      => 'Psičkári',
				'dataPercentInt' => '50',
				'dataPercentDec' => '00',
				'dataPercentClass' => 'percent__lbl--small',
				'shareCaption'   => 'psičkár',
				'shareDesc'      => 'psičkári',

			),
			array(
				'nameLabel'      => 'Sisa Sklovská',
				'nameDesc'       => 'Naším siedmym zmyslom je štedrosť.',
				'nameBoxClass'   => '',
				'subGroupId'     => 'g5-c2',
				'subGroupClass'  => 'col-md-6',
				'boxContentCode' => 'MACKA',
				'dataGroup'      => 'pets',
				'dataSubGroup'   => 'cats',
				'dataSplash'     => 'purple',
				'dataLabel'      => 'Mačičkári',
				'dataPercentInt' => '50',
				'dataPercentDec' => '00',
				'dataPercentClass' => 'percent__lbl--smallr',
				'shareCaption'   => 'mačičkár',
				'shareDesc'      => 'mačičkári',
			)
		)
	);

	$links = array();
	foreach ($groups as $groupName => $subgroups) {
		$names = array();
		foreach ($subgroups as $sg)
			$names[] = mb_strtoupper($sg['dataLabel']);

		$links[] = array(
			'link' => $groupName,
			'name' => implode(" &mdash; ", $names)
		);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Štedré srdce pre Nepál</title>

		<!-- OG meta tags -->
		<meta property="og:url"           content="http://unicef.mayer.sk" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Srdce pre Nepál" />
		<meta property="og:description"   content="UNICEF hľadá 10 000 štedrých Slovákov, ktorí pomôžu zabezpečiť kamión plný jedla pre podvyživené deti v Nepále. " />
		<meta property="og:image"         content="http://unicef.mayer.sk/resources/images/unicef-heart-for-nepal.jpg" />

		<!-- Bootstrap -->
		<link href="<?= $PATH; ?>/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= $PATH; ?>/css/style.css" rel="stylesheet">
		<link href="<?= $PATH; ?>/css/jquery.fullPage.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="body--grey">
		<!-- Google Tag Manager -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TJNNKF"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TJNNKF');</script>
		<!-- End Google Tag Manager -->

		<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
		<script>
			window.fbAsyncInit = function() {
				FB.init({
					appId      : '860864644028356',
					xfbml      : true,
					version    : 'v2.5'
				});
			};

			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<div id="block-menu">
			<nav>
				<ul id="block-menu__list">
					<li id="block-menu__logo" class="block-menu__list-li">
						<a href="#domov">
							<img src="<?= $PATH; ?>/resources/svg/unicef-logo.svg" title="Unicef" />
						</a>
					</li>
					<?php foreach ($links as $link): ?>
						<li class="block-menu__list-li">
							<a href="#<?= $link['link']; ?>" class="block-menu__link"><?= $link['name']; ?></a>
						</li>
					<?php endforeach; ?>

					<li class="block-menu__list-li">
						<a href="javascript:void(0);" class="block-menu__more block-menu__link">O PROJEKTE</a>
					</li>
				</ul>
			</nav>
			<div id="block-menu__about">
				<!-- <div id="block-menu__about__content">
					Túto kampaň zrealizovali všetci aktéri bez nároku na honorár v spolupráci s agentúrou Mayer/McCann Erickson.
				</div> -->
				<div id="block-menu__about__logo">
					<a href="http://unicef.sk"><img src="<?= $PATH; ?>/resources/svg/menu-logo-bottom.svg" title="Unicef" /></a>
				</div>
			</div>
		</div>

		<div class="loader">
			<div class="loader__logo">
				<img src="<?= $PATH; ?>/resources/svg/unicef-logo.svg" />
			</div>
			<div class="loader__block loader__block--1"></div>
			<div class="loader__block loader__block--2"></div>
			<div class="loader__block loader__block--3"></div>
			<div class="loader__block loader__block--4"></div>
		</div>

		<div id="fullpage">
			<div id="block-main" class="container-fluid text-center">

				<div id="block-video" class="grp full-height invisible section" data-anchor="domov">
					<video id="video" width="auto" autoplay preload="auto" >
						<source data-src="resources/videos/UNICEF_1_junior2.webm" type="video/webm">
						<source data-src="resources/videos/UNICEF_1_junior2.mp4" type="video/mp4">
						<source data-src="resources/videos/UNICEF_1_junior2.ogg" type="video/ogg">
						This browser does not support HTML5 video.
					</video>

					<a href="javascript:void(0);" class="block-video__volume-toggle"><i class="glyphicon glyphicon-volume-up"></i></a>
					<a href="javascript:void(0);" class="block-video__play block-video__play--hidden">
						<img src="<?= $PATH; ?>/resources/svg/play-button.svg" title="Prehrať" />
					</a>
					<a href="javascript:void(0);" class="block-video__more">O PROJEKTE</a>
					<a href="#region" class="block-video__down"><i class="glyphicon glyphicon-menu-down"></i></a>
				</div>
				<?php foreach ($groups as $groupName => $subgroups): ?>
					<div data-anchor="<?= $groupName; ?>" class="grp row section">

						<?php foreach ($subgroups as $sg): ?>
							<div id="<?= $sg['subGroupId']; ?>" class="<?= $sg['subGroupClass']; ?> full-height box">
								<div class="box__name-box <?= $sg['nameBoxClass']; ?>">
									<div class="box__name-box__name"><?= $sg['nameLabel']; ?></div>
									<div class="box__name-box__desc"><?= $sg['nameDesc']; ?></div>
								</div>
								<div class="box__content">
									<div class="content__text">
										<p><?= sprintf($boxContent, $sg['boxContentCode']); ?></p>
										<a href="javascript:void(0);" class="content__text__play-video">
											<img src="<?= $PATH; ?>/resources/svg/play-button.svg" title="Prehrať" />
										</a>
									</div>
									
									<a href="javascript:void(0);" class="block-share" data-smscode="<?= $sg['boxContentCode']; ?>" data-smscapt="<?= $sg['shareDesc']; ?>">
										<img src="<?= $PATH; ?>/resources/svg/fb-icon.svg" class="block-share__icon" />
										<span class="block-share__caption"><?= sprintf(($sg['subGroupId'] == 'g2-c1')? $shareCaption2 : $shareCaption1, $sg['shareCaption']); ?></span>
									</a>
								</div>

								<div id="<?= $sg['dataSubGroup']; ?>" class="circle">
									<div class="circle__percent circle__percent--<?= $sg['dataSplash']; ?>" data-group="<?= $sg['dataGroup']; ?>" data-subgroup="<?= $sg['dataSubGroup']; ?>" data-splash="<?= $sg['dataSplash']; ?>">
										<span class="percent__value">
											<span class="value__int"><?= $sg['dataPercentInt']; ?></span>
											<span class="value__dec"><?= $sg['dataPercentDec']; ?></span>
										</span>
										<span class="percent__lbl <?= $sg['dataPercentClass']; ?>"><?= $sg['dataLabel']; ?></span>
										<a href="#<?= $groupName; ?>" class="percent__lnk">prispej</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
				<footer class="footer section">
					<div class="footer__thanks">
						<p>Túto kampaň zrealizovali všetci aktéri a partneri bez nároku na honorár v spolupráci s agentúrou Mayer/McCann Erickson.</p>
					</div>
					<div class="footer__logos text-center">
						<img src="<?= $PATH; ?>/resources/svg/cowork-2.svg" class="logos__logo" title="Slovak Telekom" />
						<img src="<?= $PATH; ?>/resources/svg/cowork-6.svg" class="logos__logo" title="O2" />
						<img src="<?= $PATH; ?>/resources/svg/cowork-3.svg" class="logos__logo" title="Orange" />
						<img src="<?= $PATH; ?>/resources/svg/cowork-7.jpg" class="logos__logo" title="Stars & Friends" />
						<img src="<?= $PATH; ?>/resources/svg/cowork-4.jpg" class="logos__logo" title="A-SMS" />
						<img src="<?= $PATH; ?>/resources/svg/cowork-1.svg" class="logos__logo" title="PS:Digital" />
						<img src="<?= $PATH; ?>/resources/svg/cowork-5.svg" class="logos__logo" title="Mayer/McCann Erickson" />
					</div>
				</footer>
			</div>
		</div>

		<div id="more" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<div class="modal-body text-center">

						<p><span class="unicef-blue">UNICEF</span> hľadá 10 000 štedrých Slovákov, ktorí pomôžu zabezpečiť kamión plný jedla pre podvyživené deti v Nepále. </p>
						<p>Chcete byť jedným z nich? Zapojte sa do súboja o najštedrejšiu skupinu Slovákov. Nižšie si vyberiete kategóriu, za ktorú chcete  prispieť. Pošlite SMS s príslušným kľúčovým slovom v hodnote 3 € na číslo 844.</p>

						<img src="<?= $PATH; ?>/resources/svg/more-icons.svg" id="more__image" />
						<p class="modal-content__smaller text-center">100 % vyzbieraných prostriedkov bude použitých na zabezpečenie kamióna naplneného jedlom pre deti v Nepále. Ak chcete prispieť iným spôsobom ako prostredníctvom SMS, podrobné informácie nájdete na stránke <a href="http://www.unicef.sk/nepal" target="_blank">UNICEF</a>.</p>
					</div>
				</div>
			</div>
		</div>

		<div id="content-video-modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<button type="button" class="close content-video-modal__close" data-dismiss="modal" aria-label="Close">&times;</button>
					<div class="modal-body text-center">
						<video id="content-video">
							<p>This browser does not support HTML5 video.</p>
						</video>
						<a href="javascript:void(0);" class="content-video-modal__play hidden">
							<img src="/resources/svg/play-button.svg" title="Prehrať" />
						</a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/js/circles.js?t=<?= time(); ?>"></script>
		<script type="text/javascript" src="/js/main.js?t=<?= time(); ?>"></script>
		<script type="text/javascript" src="/js/jquery.fullPage.min.js"></script>
		<script type="text/javascript" src="/js/jquery.slimscroll.min.js"></script>
	</body>
</html>