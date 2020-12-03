window.onload=function(){
    $(document).ready(function(){
        var url = new URL(window.location.href);
        var page = url.searchParams.get("p");
        page = (page)?page:"1";
    
        $("#cms-pagination-jump").keyup(function(e){
            if(e.keyCode==13){
                let page_number=parseInt($(this).val());
                window.location.replace((window.location.href).split("?")[0]+"?p="+page_number);
            }
        });
    
        $.ajax({
            url:"./appcore/request_handler.php",
            method:'POST',
            dataType:'json',
            data:{_request:'gComments',_data:JSON.stringify({page:page})},
            success:function(response){
    
                console.log("Loading comments");
                var content="";
                var outputCon=$(".data-listings-comments");
                var output_pagination=$(".pagination-wrapper");
                var max_pages=parseInt(response['page_max']);
    
                function deleteComment(e){
                    var commentId=e.target.dataset.id;
                    console.log("Deleting Comment: "+commentId);
                }
    
                response.data.forEach((comment, index)=>{
                    content+=`
                        <tr>
                            <td>${comment.id}</td>
                            <td>${comment.author}</td>
                            <td>${comment.email}</td>
                            <td>${comment.content}</td>
                            <td>${comment.submit_date}</td>
                            <td>${(comment.review_pass!=1)?`
                                <button class="action-btn" data-id="${comment.id}" onclick="approveComment(this)">
                                    <i class="fas fa-check"></i>
                                </button>
                            `:`Review Passed`}</td>
                            <td>
                                <button class="action-btn danger" data-id="${comment.id}" onclick="deleteComment(this)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
    
                for(var i=1;i<=max_pages;i++){
                    if(i==page){
                        output_pagination.append(`<div class="page-item"><a class="page-number active" href="cms-comment-moderation.php?p=${i}">${i}</a></div>`);
                    }
                    else{
                        output_pagination.append(`<div class="page-item"><a class="page-number" href="cms-comment-moderation.php?p=${i}">${i}</a></div>`);
                    }
                }
    
                outputCon.append(content);
            },
            error:function(xhr, e){
                console.log("Error: "+xhr.responseText);
            }
        });
    
        deleteComment=(t)=>{
            var commentId=t.dataset.id;
            
            $.ajax({
                url:"./appcore/request_handler.php",
                method:'POST',
                dataType:'json',
                data:{_request:'editComment',_data:JSON.stringify({id:commentId, action:"delete"})},
                success:function(response){
    
                    console.log("Action successful: "+response.ok);
    
                    if(response.ok==1)
                        t.parentElement.parentElement.remove();
                },
                error:function(xhr, e){
                    console.log("Error: "+xhr.responseText);
                }
            });
        }
    
        approveComment=(t)=>{
            var commentId=t.dataset.id;
            
            $.ajax({
                url:"./appcore/request_handler.php",
                method:'POST',
                dataType:'json',
                data:{_request:'editComment',_data:JSON.stringify({id:commentId, action:"approve"})},
                success:function(response){
    
                    console.log("Action successful: "+response.ok);
    
                    if(response.ok==1)
                        t.parentElement.textContent="Review Passed";
                },
                error:function(xhr, e){
                    console.log("Error: "+xhr.responseText);
                }
            });
        }
    });
};