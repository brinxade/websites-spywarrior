<?php require_once "config/client_commons.php"; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Spywarrior - Events</title>
		<?php echo $commons['head']; ?>
	</head>
	<body>
	    <?php echo $commons['page_preloader']; ?>
		<header id="header"></header>

		<section class="main-section section-events padding hero">
			<div class="inner page-margin-normal base-padding">
				<h1 class="section-title t-center">Events</h1>
				<div class="data-container" data-target="events">
				<div class="loader"><img src="/images/preloaders/round-cyan.gif" width="70" height="70"/></div>
				</div>
			</div>
		</section>
		
		<?php echo $commons['footer']; ?>
		<script src="scripts/content-sections.js"></script>
	</body>
</html>