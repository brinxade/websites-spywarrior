<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" name="viewport">
	<link href="favicon.png" rel="icon" type="image/png">
	<title>Spywarrior - Watch Movie</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="scripts/libraries/particles-js/particles.min.js"></script>
	<script src="scripts/loader.js"></script>
	<script src="scripts/effects.js"></script>

	<link href="css/core.css" rel="stylesheet" type="text/css">
	<link href="css/reset.css" rel="stylesheet" type="text/css">
	<link href="css/common.css" rel="stylesheet" type="text/css">
	<link href="css/ui.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="webpage-preloader">
		<div class="inner">
			<div class="logo normal transition"><img alt="Logo" src="images/logo.png"></div>
			<div class="preloader linear-dots center"></div>
		</div>
	</div>
	<header id="header"></header>
	<main id="watch-movie">
		<div id="movie-panel">
			<video id="movie" controls src="http://media.w3.org/2010/05/sintel/trailer.mp4"></video>
			<div class="inner">
				<h4 class="title">Comments</h4>
				<div id="comments">
					<p>No comments for this movie yet</p>
				</div>
			</div>
		</div>
		<div id="movie-info-panel">
			<div id="movie-image"><img src=""/></div>
			<div class="inner">
				<h4 id="movie-name" class="title"></h4>
				<p id="movie-desc"></p>
				<div id="user-comment">
					<h5 class="title">Post a Comment</h5>
					<div class="user-comment-inner">
						<input type="text" placeholder="Your Name" class="name" required/>
						<input type="email" placeholder="Your Email" class="email" required/>
						<input type="text" placeholder="Your Comment" class="input-comment" required/>
					</div>
					<button class="button">Submit &nbsp;&nbsp;<i class="far fa-paper-plane"></i></button>
				</div>
				<p id="comment-response"></p>
			</div>
		</div>
	</main>
	<footer class="base-padding" id="footer"></footer>
	<script src="scripts/watch.js"></script> 
	<script src="https://kit.fontawesome.com/6f67bd47b3.js"></script> 
	<script src="scripts/preloader.js"></script>
</body>
</html>