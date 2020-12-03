<?php require_once "config/client_commons.php"; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Spywarrior - Prayer Request</title>
		<?php echo $commons["head"]; ?>
	</head>
	<body>
	    <?php echo $commons["page_preloader"]; ?>
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
		
		<?php echo $commons["footer"]; ?>
		<script src="scripts/request_handlers.js"></script>
	</body>
</html>