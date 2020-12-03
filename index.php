<?php require_once "config/client_commons.php"; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Spywarrior</title>

		<?php echo $commons["head"]; ?>
		<link rel="stylesheet" type="text/css" href="scripts/libraries/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="scripts/libraries/slick/slick-theme.css"/>
		<link rel="stylesheet" type="text/css" href="scripts/libraries/audio-player/audioplayer.css"/>
		<link href="https://vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />
	</head>
	<body>
	    <?php echo $commons["page_preloader"]; ?>
		<header id="header"></header>

		<main id="homepage-wrapper">
			<section class="main-section page-margin-centered section-music padding">
				<h1 class="section-title">Music</h1>
				<div class="inner page-margin-normal base-padding">
					<div class="data-container">
						<div class="data-main">
							<div class="loader">
								<img src="/images/preloaders/round-cyan.gif"/>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="main-section page-margin-centered section-movies padding">
				<h1 class="section-title">Movies</h1>
				<div class="inner page-margin-normal base-padding">
					<div class="data-container">
						<div class="data-main">
							<div class="loader">
								<img src="/images/preloaders/round-cyan.gif"/>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="main-section page-margin-centered section-events padding">
				<h1 class="section-title">Upcoming and Recently passed Events</h1>
				<div class="inner page-margin-normal base-padding">
					<div class="data-container">
						<div class="data-main">
							<div class="loader">
								<img src="/images/preloaders/round-cyan.gif"/>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
		
		<script src="scripts/libraries/slick/slick.min.js"></script>
		<script src="scripts/libraries/audio-player/audioplayer.js"></script>
		<script src="https://vjs.zencdn.net/7.8.4/video.js"></script>
		<script src="scripts/content-scroller.js"></script>
		<?php echo $commons["footer"]; ?>
	</body>
</html>