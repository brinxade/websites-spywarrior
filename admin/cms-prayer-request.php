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
		<main class="cms-prayer-request cms-main">
			<h1 class="title">Prayer Requests</h1>
			<div class="inner padding">	
				<div class="data-container">
					<table class="table-s1 table-prayer-request">
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Prayer</th>
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