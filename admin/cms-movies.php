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
		<title>Spywarrior - Manage Movies</title>
		
		<link rel="icon" type="image/png" href="favicon.png">
		<link href="css/core.css" rel="stylesheet" type="text/css">
		<link href="css/common.css" rel="stylesheet" type="text/css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<header id="header" class="base-padding"></header>
		<nav id="main-nav"></nav>
		<section id="change-password"></section>
		<main class="cms-movies cms-main">
			<div class="inner padding">	
				<section id="cms-response" class="cms-subsection">
					<div class="close-btn"><i class="fas fa-times"></i></div>
					<div class="inner"></div>
				</section>
				<section class="cms-subsection">
					<h1 class="title">Upload Movies</h1>
					<form class="cms-m-form cms-m-uploader" action="appcore/section_manager/s_movies.php" method="POST" enctype="multipart/form-data">
						<table>	
							<tr>
								<td>Movie Title<span class="required">*</span></td>
								<td><input type="text" class="if-s1" placeholder="Movie Name" name="movie-name" required/></td>
							</tr>
							<tr>
								<td>Movie File<br/>(mp4)<span class="required">*</span></td>
								<td><input type="file" class="if-file-s1" name="movie-file" required/></td>
							</tr>
							<tr>
								<td>Thumbnail File <br/>(jpg, png)<span class="required">*</span></td>
								<td><input type="file" class="if-file-s1" name="movie-thumbnail" required/></td>
							</tr>
							<tr>
								<td class="cms-m-form-submit loader-wrapper"><input type="submit" class="btn-s1" value="Upload"/></td>
							</tr>
						</table>
					</form>
				</section>
				<section class="cms-subsection">
					<h1 class="title">Currently Listed</h1>
					<div class="data-container">
						<table class="table-s1 data-listings">
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Last Update</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</table>
					</div>
				</section>
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