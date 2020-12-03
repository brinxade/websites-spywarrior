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
        <title>Spywarrior - Manage Music</title>
		<?php echo $client_commons["head"]; ?>
	</head>
	<body>
        <header id="header" class="base-padding"></header>
        <nav id="main-nav"></nav>
        <section id="change-password"></section>

		<main class="cms-music cms-main">
			<div class="inner padding">
				<section id="cms-response" class="cms-subsection">
					<div class="close-btn"><i class="fas fa-times"></i></div>
					<div class="inner"></div>
				</section>
				<section class="cms-subsection">
					<h1 class="title">Upload Music</h1>
					<form class="cms-m-form cms-m-uploader" action="appcore/section_manager/s_songs.php" method="POST" enctype="multipart/form-data">
						<table>	
							<tr>
								<td>Name<span class="required">*</span></td>
								<td><input type="text" class="if-s1" placeholder="Song Name" name="song-name" required/></td>
							</tr>
							<tr>
								<td>Artist</td>
								<td><input type="text" class="if-s1" placeholder="Song Artist" name="song-artist"/></td>
							</tr>
							<tr>
								<td>Album</td>
								<td><input type="text" class="if-s1" placeholder="Song Album" name="song-album"/></td>
							</tr>
							<tr>
								<td>Song File<br/>(mp3, wav)<span class="required">*</span></td>
								<td><input type="file" class="if-file-s1" name="song-file" required/></td>
							</tr>
							<tr>
								<td>Thumbnail File <br/>(jpg, png)<span class="required">*</span></td>
								<td><input type="file" class="if-file-s1" name="song-thumbnail" required/></td>
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
								<th>Album</th>
								<th>Artist</th>
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