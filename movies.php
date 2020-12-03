<?php require_once "config/client_commons.php"; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Spywarrior - Movies</title>
		<?php echo $commons["head"]; ?>
	</head>
	<body>
		<?php echo $commons["page_preloader"]; ?>
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
		
		<?php echo $commons["footer"]; ?>
		<script src="scripts/content-sections.js"></script>
	</body>
</html>