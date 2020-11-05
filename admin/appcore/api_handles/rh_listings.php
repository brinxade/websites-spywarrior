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
			break;
		}

		$db=new DatabaseConnection();
		$result=$db->query("SELECT * FROM $target WHERE id=".$data['id'])->fetch_assoc();

		$response['row']=$result;

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
		
		return $response;
	}
	
?>