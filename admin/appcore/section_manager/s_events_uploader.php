<?php
    require_once "../config.php";

    $response=array();
    $response['status']=0;
    $response['errors']=array();
    $response['text']="Unknown error occured";

    if(!empty($_FILES['event-file']) && !empty($_POST["event-id"]))
    {   
        $eventId=$_POST["event-id"];
        $filename=$_FILES['event-file']['name'];
        $tmpName=$_FILES['event-file']['tmp_name'];

        /* Location */
        $location = STORAGE_EVENTS.strval($eventId)."/".$filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","mp4","png");

        if(!in_array(strtolower($imageFileType),$valid_extensions))
        {
            $uploadOk = 0;
            array_push($response['errors'], "Invalid file type");
        }
            

        if($uploadOk != 0){
            if(!move_uploaded_file($tmpName,$location)){
                $uploadOk = 0;
                array_push($response['errors'], "File upload failed");
            }
        }

        if($uploadOk == 1){
            $response['status']=1;
            $response['text']="File upload successful";
        }
    }
    else
    {
        array_push($response['errors'], "No file selected");
    }

    echo json_encode($response);

?>