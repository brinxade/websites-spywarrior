<?php 
	require_once "appcore/config.php";
	require_once CLIENT_HANDLER;
	require_once CLIENT_COMMONS;

	$status="";
	$user=new User();
	if(!$user->verify_auth())
		$user->redirect("index.php?destination=".basename(__FILE__));

?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <title>Spywarrior - Prayer Requests</title>
		<?php echo $client_commons["head"]; ?>
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
		
		<?php echo $client_commons["footer"]; ?>
		<script src="scripts/request_handler.js"></script>
	</body>
</html>