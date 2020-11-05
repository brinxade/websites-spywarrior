<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

		<link rel="icon" type="image/png" href="favicon.png">
		<title>Spywarrior - Prayer Request</title>

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
		<div class="modal global">
			<div class="inner">
				<p class="data"></p>
			</div>
		</div>
		<header id="header"></header>
		<main class="base-padding">
			<section class="main-section section-prayers page-margin-centered padding">
				<h1 class="section-title">Prayer Request</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis nunc ornare, pulvinar justo eu, pulvinar quam. Sed dictum id elit et viverra. Suspendisse dignissim leo sollicitudin elit iaculis, eget ullamcorper ante rutrum. Nam feugiat nisi nec nulla semper posuere. Vestibulum mi leo, cursus a diam non, scelerisque placerat lacus. Nam semper vehicula neque, in consectetur eros lobortis eu. Nam et libero tellus. Sed placerat faucibus risus, vel lacinia libero volutpat eu.
				</p>
				<div class="form-prayer">
					<div class="field-group">
						<span class="label">Name</span>
						<input id="pr-name" class="if" type="text" placeholder="John Doe"/>
					</div>
					<div class="field-group">
						<span class="label">Email</span>
						<input id="pr-email" class="if" type="text" placeholder="John.doe@example.com"/>
					</div>
					<div class="field-group">
						<span class="label">Prayer</span>
						<textarea id="pr-prayer" class="txtarea" placeholder="Your Prayer"></textarea>
					</div>
					<div class="field-group">
						<button id="pr-submit" class="btn">Send</button>
						<p id="pr-status"></p>
					</div>
				</div>
			</section>
		</main>
		<footer id="footer" class="base-padding"></footer>
		<script src="scripts/request_handlers.js"></script>
		<script src="https://kit.fontawesome.com/6f67bd47b3.js" crossorigin="anonymous"></script>
		<script src="scripts/preloader.js"></script>
	</body>
</html>