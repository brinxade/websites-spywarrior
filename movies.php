<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

		<link rel="icon" type="image/png" href="favicon.png">
		<title>Spywarrior - Movies</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="scripts/libraries/particles-js/particles.min.js"></script>
		<script src="scripts/loader.js"></script>
		<script src="scripts/effects.js"></script>

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
			<section class="content">
				<h1 class="section-title">Movies</h1>
				<div class="search-hero">
					<input id="search" type="text" placeholder="Search" data-target="movies" data-output="data-container"/>
				</div>
				<div class="content-wrapper">
					<div class="data-container t-center" data-target="movies">
						<div class="loader"><img src="/images/preloaders/round-cyan.gif"/></div>
					</div>
				</div>
			</section>
		</main>
		<footer id="footer" class="base-padding"></footer>
		<script src="https://kit.fontawesome.com/6f67bd47b3.js" crossorigin="anonymous"></script>
		<script src="scripts/content-sections.js"></script>
		<script src="scripts/preloader.js"></script>
	</body>
</html>