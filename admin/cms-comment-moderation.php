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
        <title>Spywarrior - Comment Moderation</title>
		<?php echo $client_commons["head"]; ?>
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

		<?php echo $client_commons["footer"]; ?>
		<script src="scripts/comment_moderation.js"></script>
	</body>
</html>