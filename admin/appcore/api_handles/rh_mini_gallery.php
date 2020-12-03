<?php

    function r_getMiniGallery($response, $clientData){
        $clientData=json_decode($clientData, true);
        $contentTarget=$clientData['contentTarget'];
        $contentTypes=array("songs","movies", "events");
        $contentLimit=10;
        $page=intval(empty($clientData["page"])?"1":$clientData["page"]);
        $contentLimitRange=" ORDER BY id DESC LIMIT ".($contentLimit*($page-1)).",".($contentLimit*$page);
        $responseData;

        //To enable pagination on server-level, uncomment the line below
        $contentLimitRange="";

        $contentRows=array();

        $db=new DatabaseConnection();
        
        if($contentTarget=="*"){
            for($i=0;$i<count($contentTypes);$i++){
                $content=array();

                //Fetching Songs
                $result = $db->query("SELECT COUNT(1) FROM data_".$contentTypes[$i]);
                $rows = intval($result->fetch_array()[0]);
                $contentRows[$i] =ceil($rows/$contentLimit);

                $result=$db->query("SELECT * FROM data_".$contentTypes[$i].$contentLimitRange);

                if($result->num_rows>0)
                    while($row=$result->fetch_assoc())
                        array_push($content, $row);

                $responseData[$contentTypes[$i]]=$content;
            }
        }

        $response['paginationDisable']=1;
        $response['contentRange']=$contentLimitRange;
        $response['pageCount']=$contentRows;
        $response['data']=$responseData;
        $response['ok']=1;
        return $response;
    }

?>