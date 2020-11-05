<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

		<link rel="icon" type="image/png" href="favicon.png">
		<title>Spywarrior - Music</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="scripts/libraries/particles-js/particles.min.js"></script>
		<script src="scripts/loader.js"></script>
		<script src="scripts/effects.js"></script>
		<script src="scripts/search.js"></script>

		<link rel="stylesheet" type="text/css" href="css/core.css"/>
		<link rel="stylesheet" type="text/css" href="css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="css/common.css"/>
		<link rel="stylesheet" type="text/css" href="css/ui.css"/>
	</head>
	<body>
	    <div id="webpage-preloader">
			<div class="inner">
				<div class="logo normal transition"><img src="images/logo.png" alt="Logo"/></div>
				<div class="preloader linear-dots center"></div>
			</div>
		</div>
		<header id="header"></header>
		<main class="base-padding">
			<section class="section-search">
				<div class="inner">
					<div class="search-hero">
						<input type="text" autocomplete="off" placeholder="Search Music" data-target="music" data-output="section-music"/>
					</div>
				</div>
			</section>
			<section class="main-section page-margin-centered section-music padding">
				<div class="inner page-margin-normal base-padding">
					<div class="data-container">
						<h5 class="search-placeholder-text"></h5>
						<h5 class="placeholder-text">There are no songs currently. Please come back later!</h5>
					</div>
				</div>
			</section>
		</main>
		<footer id="footer" class="base-padding"></footer>
		<script src="https://kit.fontawesome.com/6f67bd47b3.js" crossorigin="anonymous"></script>
		<script src="scripts/preloader.js"></script>
	</body>
</html>