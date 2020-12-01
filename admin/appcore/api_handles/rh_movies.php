<?php

    function r_getMoviesWithComments($response, $clientData){
        $clientData=json_decode($clientData, true);
        $movieId=$clientData["id"];
        $movieData=false;
        $comments=array();

        $db=new DatabaseConnection();
        $result=$db->query("SELECT * FROM data_movies WHERE id=$movieId");

        if($result->num_rows>0)
            $movieData=$result->fetch_assoc();
        else
            $response["response"]="Movie not found";

        if($movieData)
        {
            $result=$db->query("SELECT * FROM comments WHERE (data_target='movies' AND data_target_id=$movieId AND review_pass=1)");
            if($result->num_rows>0)
                while($row=$result->fetch_assoc())
                    array_push($comments, $row);
        }        

        $response["movieData"]=$movieData;
        $response["comments"]=$comments;

        return $response;
    }

?>