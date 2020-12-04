<?php require_once "config/client_commons.php"; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Spywarrior - Music</title>

		<?php echo $commons["head"]; ?>
		<link rel="stylesheet" type="text/css" href="scripts/libraries/audio-player/audioplayer.css"/>
	</head>
	<body>
		<?php echo $commons["page_preloader"]; ?>
		<header id="header"></header>

		<main class="base-padding">
			<section class="content">
				<h1 class="section-title">Music</h1>
				<div class="search-hero">
					<input id="search" type="text" placeholder="Search" data-target="songs" data-output="data-container"/>
				</div>
				<div class="content-wrapper">
					<div class="data-container" data-target="songs">
						<div class="loader"><img src="/images/preloaders/round-cyan.gif"/></div>
					</div>
				</div>
			</section>
		</main>
		
		<script src="scripts/libraries/audio-player/audioplayer.js"></script>
		<?php echo $commons["footer"]; ?>
		<script src="scripts/content-sections.js"></script>
	</body>
</html>