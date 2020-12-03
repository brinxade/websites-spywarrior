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
        <title>Spywarrior - Manage Movies</title>
		<?php echo $client_commons["head"]; ?>
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
								<td>Movie Description<span class="required">*</span></td>
								<td><textarea type="text" class="if-s1" placeholder="Movie Description" name="movie-desc" required></textarea></td>
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
								<th>Delete</th>
							</tr>
						</table>
					</div>
				</section>
			</div>
		</main>

		<?php echo $client_commons["footer"]; ?>
		<script src="scripts/request_handler.js"></script>
	</body>
</html>