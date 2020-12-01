<?php

	function r_replyToPrayer($response, $data)
	{
		require_once MAILER;

		$clientData=json_decode($data, true);
		$target="data_".$clientData["target"];
		$email=$clientData["email"];

		$message=!empty($clientData["message"])?$clientData["message"]:"Hi there, we have seen your prayer request and fulfilled it. God Bless!";
		$subject=!empty($clientData["subject"])?$clientData["subject"]:"Prayer Request Fulfilled";

		$db=new DatabaseConnection();

		if(send_mail($email, $subject, $message))
		{
			if($db->query("DELETE FROM $target WHERE id=".$clientData['id'])){
				
				$response['ok']=1;
			}
			else{
				$response['ok']=0;
			}
		}
		else
		{
			$response['ok']=0;
		}

		$response["replyInfo"]="$email | $subject | $message";
		return $response;
	}

	function r_putPrayerRequest($response, $data)
	{		
		$data=json_decode($data,true);
		if(!empty($data['name']) && !empty($data['email'] && !empty($data['prayer'])))
		{
			$name=$data['name'];
			$email=$data['email'];
			$prayer=$data['prayer'];

			$db=new DatabaseConnection();
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$response['response']="Please enter a valid email";
				$response['ok']=0;
				array_push($response['errors'],"Email Invalid");
				return $response;
			}

			if ($result = $db->query("SELECT * FROM `data_prayer_requests` LIMIT 1"))
				if (!$result->fetch_object())
					$db->query("ALTER TABLE data_prayer_requests AUTO_INCREMENT = 1");

			if($result=$db->query("INSERT INTO data_prayer_requests(name, email, prayer) VALUES('$name','$email','$prayer')"))
			{
				$response['response']="Prayer has been sent. God bless!";
				$response['ok']=1;
				return $response;
			}
		}
		else
		{
			$response['response']="All fields are required";
			$response['ok']=0;
			array_push($response['errors'],"Empty Fields");
			return $response;
		}
	}

	function r_getPrayerRequests($response,$data)
	{
		$results_limit=10;
		$data=json_decode($data,true);

		if(!array_key_exists("page",$data) || empty($data["page"]))
			$data["page"]=1;

		$page=$data["page"];
		$results_range=array($results_limit,$results_limit*($page-1));

		$db=new DatabaseConnection();
		if($result=$db->query("SELECT * FROM data_prayer_requests LIMIT $results_range[0] OFFSET $results_range[1]"))
		{
			$max_pages=ceil($db->query("SELECT count(1) FROM data_prayer_requests")->fetch_array()[0]/$results_limit);

			$response_data=array();
			while($row=$result->fetch_assoc())
				array_push($response_data, $row);

			$response["response"]="Fetched $results_limit results for page $data[page]";
			$response["data"]=array(
				"results"=>$response_data,
				"page"=>$data["page"], 
				"page_items"=>$results_limit,
				"page_max"=>$max_pages
			);

			$response["ok"]=1;
		}
		else
		{
			$response["error"]="SQL Error";
			$response["response"]="Failed to fetch data";
			$response["ok"]=0;
		}

		return $response;
	}
	
?>