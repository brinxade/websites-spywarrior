window.onload=function(){

    var url = new URL(window.location.href);
    var movieId = url.searchParams.get("id");

    $.ajax({
        url:"admin/appcore/request_handler.php",
        method:"POST",
        dataType:'json',
        data: { _request:"gMovieWithComments",_data:JSON.stringify({id: movieId}) },
        success:function(response){
            
            let comments="";

            $("#movie").attr('src','/admin/appcore/storage/movies/'+response.movieData.filepath);
            $("#movie-image img").attr('src','/admin/appcore/storage/movies/thumbnails/'+response.movieData.thumbnail);
            $("#movie-name").text(response.movieData.name);
            $("#movie-desc").text(response.movieData.description);
            

            response.comments.forEach((comment, index)=>{
                comments+=`
                    <div class="comment">
                        <div class="avatar"><i class="fas fa-user"></i></div>
                        <div class="data">
                            <p class="author">${comment.author}</p>
                            <p class="date">${comment.submit_date}</p>
                            <p class="content">${comment.content}</p>
                        </div>
                    </div>
                `;
            });
            
            if(comments)
                $("#comments").html(comments);
        },
        error:function(xhr, e){
            console.log("Error: "+xhr.responseText);
        }
    });

    $("#user-comment").on("click",".button",function(){

        var commentData={
            name: $("#user-comment .name").val().trim(),
            comment: $("#user-comment .input-comment").val().trim(),
            email: $("#user-comment .email").val().trim(),
            target: "movies",
            targetId: movieId,
            parentId: 0,
            date: new Date().toJSON().slice(0,10).replace(/-/g,'/')
        };

        if(commentData.name && commentData.comment && commentData.email)
        {
            $.ajax({
                url:"admin/appcore/request_handler.php",
                method:"POST",
                dataType:'json',
                data: { _request:"pComment",_data:JSON.stringify({comment:commentData}) },
                success:function(response){
                    console.log(response);
                    if(response.ok==1){
                        $("#comment-response").text("Comment submitted. Pending review from our moderator.");
                    }
                    else{
                        $("#comment-response").text("Failed to publish your comment");
                    }
                },
                error:function(xhr, e){
                    console.log("Error: "+xhr.responseText);
                }
            });
        }
        else
        {
            $("#comment-response").text("Please fill in all the fields");
        }
    });
}