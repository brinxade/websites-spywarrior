<?php
	
	/*	
		Validations

		Song name, artist, album: Alphanumeric
		Song File				: mp3, wav
		Song Thumbnail			: jpg, png
	*/

	require_once '../config.php';
	require_once FILE_UPLOADER;
	require_once DB_HANDLER;
	require_once CLIENT_HANDLER;

	$status="";
	$user=new User();
	if(!$user->verify_auth())
		$user->redirect(CMS_HOME);

	$errors=array();
	$all_ok=false;
	$dataExists=false;
	$response="";
	$allowed_ext=array("audio"=>array("mp3","wav"),"images"=>array("jpg","png"));
	$thumbnail_dir="thumbnails/";

	if(isset($_POST['song-name']) && isset($_FILES['song-file']) && isset($_FILES['song-thumbnail']))
	{
		$song_name=trim($_POST['song-name']);
		$song_artist=empty($_POST['song-artist'])?"":trim($_POST['song-artist']);
		$song_album=empty($_POST['song-album'])?"":trim($_POST['song-album']);
		$file_song=$_FILES['song-file'];
		$file_thumbnail=$_FILES['song-thumbnail'];

		if(!empty($song_name) && !empty($file_song['name']) && !empty($file_thumbnail['name']))
		{	
			$conn=new DatabaseConnection();

			if ($result = $conn->query("SELECT * FROM data_songs LIMIT 1"))
				if (!$result->fetch_object())
					$conn->query("ALTER TABLE data_songs AUTO_INCREMENT = 1");

			if($conn->query("SELECT id FROM data_songs WHERE (name='$song_name' AND artist='$song_artist')")->num_rows>0)
				$dataExists=true;

			if(!$dataExists)
			{
				$filename_hash=md5(uniqid(rand(), true));
				$curr_time=time();
				$tfile_song=$filename_hash.".".pathinfo($file_song['name'])['extension'];
				$tfile_thumbnail=$filename_hash.".".pathinfo($file_thumbnail['name'])['extension'];
				
				$result=$conn->query("
					INSERT INTO data_songs(name, album, artist, filepath, thumbnail, last_update) 
					VALUES('$song_name','$song_album','$song_artist', '$tfile_song', '$tfile_thumbnail', '$curr_time')
					");

				if($conn->get_affected_rows()==1)
				{
					$uploader=new Uploader();
					$uploader->setUploadDir(STORAGE_MUSIC);
					$uploader->setAllowedExt($allowed_ext['audio']);
					
					if($uploader->uploadFile($file_song,$tfile_song)==true)
					{
						$uploader->setUploadDir(STORAGE_MUSIC.$thumbnail_dir);
						$uploader->setAllowedExt($allowed_ext['images']);
						
						if($uploader->uploadFile($file_thumbnail,$tfile_thumbnail)==true)
						{
							$response="File Upload Successful";
							$all_ok=true;
						}
						else
						{
							array_push($errors, "File upload failed (Thumbnail)");
							$conn->query("DELETE FROM data_songs WHERE (name='$song_name' AND artist='$song_artist')");
						}
					}
					else
					{
						array_push($errors, "File upload failed (Song)");
						$conn->query("DELETE FROM data_songs WHERE (name='$song_name' AND artist='$song_artist')");
					}
				}
				else
				{
					array_push($errors, "Database Error");
				}
			}
			else
			{
				array_push($errors, "Song already exists");
			}
		}
		else
		{
			array_push($errors, "Fill in all the required fields");
		}
	}
	else
	{
		array_push($errors, "Fill in all the required fields");
	}

	if($all_ok)
		$user->redirect(DIR_ADMIN."/cms-music.php?status=1&response=".$response);
	else
		$user->redirect(DIR_ADMIN."/cms-music.php?status=0&response=".$errors[0]);
?>