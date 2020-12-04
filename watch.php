<?php require_once "config/client_commons.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Spywarrior - Watch Movie</title>

	<?php echo $commons["head"]; ?>
</head>
<body>
	<?php echo $commons["page_preloader"]; ?>
	<header id="header"></header>

	<main class="base-padding">
		<div id="watch-movie">
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
		</div>
	</main>

	<script src="scripts/watch.js"></script>
	<?php echo $commons["footer"]; ?>
</body>
</html>