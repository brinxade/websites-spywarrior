<?php

	function r_getListings($response, $data)
	{		
		$data=json_decode($data,true);
		if(!empty($data["target"])){
			$listings_target="data_".$data["target"];

			$db=new DatabaseConnection();
			$results=$db->query("SELECT * FROM $listings_target");
			$response_data=array();

			if($results->num_rows>0){
				while($row=$results->fetch_assoc()){
					array_push($response_data, $row);
				}
			}else $response_data=[];
		}

		$response['data']=$response_data;
		$response['response']="Fetched ".count($response_data)." listings";
		return $response;
	}

	function rmdir_recursive($dir) {
		foreach(scandir($dir) as $file) {
			if ('.' === $file || '..' === $file) continue;
			if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
			else unlink("$dir/$file");
		}
		rmdir($dir);
	}

	function r_deleteListings($response, $data)
	{
		$data=json_decode($data,true);
		$target="data_".$data['target'];

		switch($data['target']){
			case 'songs':
				$path=STORAGE_MUSIC;
			break;

			case 'movies':
				$path=STORAGE_MOVIES;

			case 'events':
				$dirPath=STORAGE_EVENTS.strval($data['id']);
				if (is_dir($dirPath)) {
					$response['path']=$dirPath;
					rmdir_recursive($dirPath);
				}
			break;
		}

		$db=new DatabaseConnection();
		$result=$db->query("SELECT * FROM $target WHERE id=".$data['id'])->fetch_assoc();

		$response['row']=$result;
		
		if(!empty($result['filepath']))
		{
			if(unlink($path.$result['filepath']) && unlink($path."thumbnails/".$result['thumbnail']))
			{
				if($db->query("DELETE FROM $target WHERE id=".$data['id']))
					$response['ok']=true;
				else
					$response['response']="ERR_DB_ERROR";
			}
			else
			{
				$response['response']="ERR_FILE_DELETE_FAILED";
			}
		}
		else
		{
			if($db->query("DELETE FROM $target WHERE id=".$data['id']))
				$response['ok']=true;
		}
		
		return $response;
	}
	
?>