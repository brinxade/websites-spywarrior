<?php

    function r_getMiniGallery($response, $clientData){
        $clientData=json_decode($clientData, true);
        $contentTarget=$clientData['contentTarget'];
        $contentTypes=array("songs","movies");
        $contentLimit=10;
        $responseData;

        $db=new DatabaseConnection();
        
        if($contentTarget=="*"){
            for($i=0;$i<count($contentTypes);$i++){
                $content=array();

                //Fetching Songs
                $result=$db->query("SELECT * FROM data_".$contentTypes[$i]." ORDER BY id DESC LIMIT $contentLimit");

                if($result->num_rows>0)
                    while($row=$result->fetch_assoc())
                        array_push($content, $row);

                $responseData[$contentTypes[$i]]=$content;
            }
        }

        $response['data']=$responseData;
        $response['ok']=1;
        return $response;
    }

?>