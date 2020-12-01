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
		<title>Spywarrior - Prayer Request</title>
		
		<link rel="icon" type="image/png" href="favicon.png">
		<link href="css/core.css" rel="stylesheet" type="text/css">
		<link href="css/common.css" rel="stylesheet" type="text/css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<header id="header" class="base-padding"></header>
		<nav id="main-nav"></nav>
		<section id="change-password"></section>
		<div class="modal prayer-reply">
			<span class="close"><i class="fas fa-times"></i></span>
			<div class="inner">
				<h1 class="title">Reply</h1>
				<input type="text" id="p-subject" placeholder="Subject"/>
				<textarea type="text" id="p-message" placeholder="Message"></textarea>
				<p>Leave blank to send default email</p>
				<p class="status-text"></p>
				<button class="btn">Send</button>
			</div>
		</div>
		<main class="cms-prayer-request cms-main">
			<h1 class="title">Prayer Requests</h1>
			<div class="inner padding">	
				<div class="data-container">
					<table style="max-width:1200px;margin:0 auto;" class="table-s1 table-prayer-request data-listings">
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Prayer</th>
							<th>Reply</th>
							<th>Delete</th>
						</tr>
					</table>
				</div>
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
		<script src="scripts/common.js"></script>
		<script src="scripts/ui.js"></script>
		<script src="scripts/request_handler.js"></script>
		<script src="https://kit.fontawesome.com/6f67bd47b3.js" crossorigin="anonymous"></script>
	</body>
</html>