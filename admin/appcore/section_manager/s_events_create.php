<?php
    
    require_once "../config.php";
    require_once DB_HANDLER;
    require_once CLIENT_HANDLER;

	$status="";
	$user=new User();
	if(!$user->verify_auth())
		$user->redirect(CMS_HOME);

    $response='';
    $errors=array();
    $requestOk=false;

    if(!empty($_POST['event-name']) && !empty($_POST['event-date']) && !empty($_POST['event-location']) && !empty($_POST['event-desc']))
    {
        $tableName='data_events';

        $eventName = htmlspecialchars($_POST['event-name']);        
        $eventDate = htmlspecialchars($_POST['event-date']);        
        $eventDesc = htmlspecialchars($_POST['event-desc']);        
        $eventLocation = htmlspecialchars($_POST['event-location']);
        $eventUpdate = time();

        $db=new DatabaseConnection();
        $result=$db->query("INSERT INTO $tableName VALUES (DEFAULT, '$eventName', '$eventDesc', '$eventLocation', '$eventDate', '$eventUpdate')");
        
        if($result){
        
            $eventId=$db->query("
                SELECT id FROM $tableName ORDER BY id DESC LIMIT 1;
            ")->fetch_assoc()["id"];
            $dirPath=STORAGE_EVENTS.strval($eventId);

            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $response='Event created: $eventName';
            $requestOk=true;
        }
        else{
            array_push($errors, "Internal DB Error");
        }
    }
    else
    {
        array_push($errors, "Fill in all the required fields!");
    }

    if($requestOk)
		$user->redirect(DIR_ADMIN."/cms-events.php?status=1&response=".$response);
	else
		$user->redirect(DIR_ADMIN."/cms-events.php?status=0&response=".$errors[0]);

?>