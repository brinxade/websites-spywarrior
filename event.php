<?php require_once "config/client_commons.php"; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Spywarrior - Event</title>

		<?php echo $commons["head"]; ?>
		<link 
			rel="stylesheet" 
			href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" 
			integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" 
			crossorigin="anonymous" />
	</head>
	<body>
		<?php echo $commons["page_preloader"]; ?>
		<header id="header"></header>

		<section class="main-section section-events padding">
			<div class="inner page-margin-normal base-padding">
				<div class="event-info">
					<h1 class="section-title" id="event-name">...</h1>
					<p id="event-location">...</p>
					<p id="event-date">...</p>
					<p id="event-desc">...</p>
				</div>
				<div class="event-content">
					<div class="event-photos">
						<h2 class="content-title">Photos</h2>
						<div class="content-inner"></div>
					</div>
					<div class="event-videos">
						<h2 class="content-title">Videos</h2>
						<div class="content-inner"></div>
					</div>
				</div>
			</div>
		</section>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" 
		integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous"></script>
		<?php echo $commons['footer']; ?>
		<script src="scripts/view_event.js"></script>
	</body>
</html>