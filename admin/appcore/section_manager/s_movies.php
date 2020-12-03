<?php
	
	/*	
		Validations

		Song name, artist, album: Alphanumeric
		Song File				: mp4
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
	$allowed_ext=array("video"=>array("mp4"),"images"=>array("jpg","png"));
	$thumbnail_dir="thumbnails/";

	if(isset($_POST['movie-name']) && isset($_FILES['movie-file']) && isset($_FILES['movie-thumbnail']) && isset($_POST['movie-desc']))
	{
		$movie_name=trim($_POST['movie-name']);
		$movie_desc=trim($_POST['movie-desc']);
		$file_movie=$_FILES['movie-file'];
		$file_thumbnail=$_FILES['movie-thumbnail'];

		if(!empty($movie_name) && !empty($movie_desc) && !empty($file_movie['name']) && !empty($file_thumbnail['name']))
		{	
			$conn=new DatabaseConnection();

			if ($result = $conn->query("SELECT * FROM data_movies LIMIT 1"))
				if (!$result->fetch_object())
					$conn->query("ALTER TABLE data_movies AUTO_INCREMENT = 1");

			if($conn->query("SELECT id FROM data_movies WHERE name='$movie_name'")->num_rows>0)
				$dataExists=true;

			if(!$dataExists)
			{
				$filename_hash=md5(uniqid(rand(), true));
				$curr_time=time();
				$tfile_movie=$filename_hash.".".pathinfo($file_movie['name'])['extension'];
				$tfile_thumbnail=$filename_hash.".".pathinfo($file_thumbnail['name'])['extension'];
				
				$result=$conn->query("
					INSERT INTO data_movies(name, description, filepath, thumbnail, last_update) 
					VALUES('$movie_name','$movie_desc', '$tfile_movie', '$tfile_thumbnail', '$curr_time')
					");

				if($conn->get_affected_rows()==1)
				{
					$uploader=new Uploader();
					$uploader->setUploadDir(STORAGE_MOVIES);
					$uploader->setAllowedExt($allowed_ext['video']);
					
					if($uploader->uploadFile($file_movie,$tfile_movie)==true)
					{
						$uploader->setUploadDir(STORAGE_MOVIES.$thumbnail_dir);
						$uploader->setAllowedExt($allowed_ext['images']);
						
						if($uploader->uploadFile($file_thumbnail,$tfile_thumbnail)==true)
						{
							$response="File Upload Successful";
							$all_ok=true;
						}
						else
						{
							array_push($errors, "File Upload Failed: Thumbnail File");
							$conn->query("DELETE FROM data_movies WHERE name='$movie_name'");
						}
					}
					else
					{
						array_push($errors, "File Upload Failed: Movie file");
						$conn->query("DELETE FROM data_movies WHERE name='$movie_name'");
					}
				}
				else
				{
					array_push($errors, "Database Error");
				}
			}
			else
			{
				array_push($errors, "Movie already exists");
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
		$user->redirect(DIR_ADMIN."/cms-movies.php?status=1&response=".$response);
	else
		$user->redirect(DIR_ADMIN."/cms-movies.php?status=0&response=".$errors[0]);
?>