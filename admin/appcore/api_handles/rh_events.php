<?php

function r_getEventData($response, $clientData){
    $clientData=json_decode($clientData, true);
    $eventId=(int)$clientData["id"];
    
    $response['dataPhotos']=array();
    $response['dataVideos']=array();
    $dataVideos=array();
    $dataPhotos=array();

    foreach(glob(STORAGE_EVENTS.$eventId."/*") as $filename){
        $ext=pathinfo($filename, PATHINFO_EXTENSION);

        if($ext=="png" || $ext=="jpg")
            array_push($response['dataPhotos'], basename($filename));
        else
            array_push($response['dataVideos'], basename($filename));
    }

    $db=new DatabaseConnection();
    $response['dataEventInfo']=$db->query("SELECT * FROM data_events WHERE id=$eventId")->fetch_assoc();

    return $response;
}

function r_deleteEventData($response, $clientData){
    $clientData=json_decode($clientData, true);
    $eventId=$clientData["id"];
    $filepath=STORAGE_EVENTS."$eventId/".basename($clientData["filepath"]);
    
    $response["status"]=0;
    if(file_exists($filepath))
        if(unlink($filepath))
            $response["status"]=1;

    $response["path"]=$filepath;
    
    return $response;
}

?>