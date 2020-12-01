<?php

    function r_putComment($response, $clientData){
        $clientData=json_decode($clientData, true);

        $response["ok"]=0;

        $author=$clientData["comment"]["name"];
        $content=$clientData["comment"]["comment"];
        $target=$clientData["comment"]["target"];
        $targetId=$clientData["comment"]["targetId"];
        $parentId=0;
        $email=$clientData["comment"]["email"];
        $date=$clientData["comment"]["date"];

        $db=new DatabaseConnection();
        if($db->query("INSERT INTO comments(data_target, data_target_id, parent_id, author, email, content, submit_date) VALUES('$target', $targetId, 0, '$author', '$email','$content', '$date')"))
            $response["ok"]=1;

        return $response;
    }

    function r_editComment($response, $clientData){
        $clientData=json_decode($clientData, true);
        $commentId=$clientData["id"];
        $response["ok"]=0;

        $db=new DatabaseConnection();
        
        switch($clientData['action']){
            case "delete":
                if($db->query("DELETE from comments WHERE id=$commentId"))
                    $response["ok"]=1;
                break;

            case "approve":
                if($db->query("UPDATE comments SET review_pass=1 WHERE id=$commentId"))
                    $response["ok"]=1;
                break;

            default:
                $response["response"]="Invalid action requested";
                break;
        }

        return $response;
    }

    function r_getComments($response, $clientData){
        $clientData=json_decode($clientData, true);

        $comments=array();
        $page=intval($clientData["page"])-1;
        $limit=10;
        $limitMin=$page*$limit;
        $limitMax=($page*$limit)+$limit;

        $db=new DatabaseConnection();
        $result=$db->query("SELECT * FROM comments LIMIT $limitMin, $limitMax");
        if($result->num_rows>0)
            while($row=$result->fetch_assoc())
                array_push($comments, $row);

        $response["page_max"]=ceil($db->query("SELECT count(1) FROM data_prayer_requests")->fetch_array()[0]/$limit);
        $response["data"]=$comments;
        $response["page"]=$page;

        return $response;
    }

?>