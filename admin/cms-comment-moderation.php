<?php 
	require_once "appcore/config.php";
	require_once CLIENT_HANDLER;

	$status="";
	$user=new User();
	if(!$user->verify_auth())
		$user->redirect("index.php?destination=".basename(__FILE__));

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
		<title>Spywarrior - Comment Moderation</title>
		
		<link rel="icon" type="image/png" href="favicon.png">
		<link href="css/core.css" rel="stylesheet" type="text/css">
		<link href="css/common.css" rel="stylesheet" type="text/css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<header id="header" class="base-padding"></header>
		<nav id="main-nav"></nav>
		<section id="change-password"></section>
		<main class="cms-comments-mod cms-main">
			<div class="inner padding">
				<section class="cms-subsection">
					<h1 class="title">Comment Moderation</h1>
					<p>Here you can read, approve and delete comments. Only approved comments will be shown to the users.</p>
					<div class="data-container">
						<table class="table-s1 data-listings data-listings-comments">
							<tr>
								<th>#</th>
								<th>Author</th>
								<th>Email</th>
								<th>Content</th>
								<th>Date</th>
								<th>Approve</th>
								<th>Delete</th>
							</tr>
						</table>
					</div>
				</section>
				<div class="pagination-s1">
					<div class="pagination-wrapper"></div>
					<div class="pagination-jumpto">
						<input id="cms-pagination-jump" type="text" placeholder="Jump to"/>
					</div>
				</div>
			</div>
		</main>
		<footer id="footer" class="base-padding"></footer>
		<script src="scripts/loader.js"></script>
		<script src="scripts/ui.js"></script>
		<script src="scripts/comment_moderation.js"></script>
		<script src="https://kit.fontawesome.com/6f67bd47b3.js" crossorigin="anonymous"></script>
	</body>
</html>