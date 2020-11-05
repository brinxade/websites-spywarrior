window.onload=function(){
$(document).ready(function(){
    $("#cms-pagination-jump").keyup(function(e){
        if(e.keyCode==13){
            let page_number=parseInt($(this).val());
            window.location.replace((window.location.href).split("?")[0]+"?page="+page_number);
        }
    });

    var page=getUrlParameter("page");
        if(!page) page=1;

    function prayer_listings(){
        $.ajax({
            url:'./appcore/request_handler.php',
            method:'POST',
            data:{_request:'gPrayerRequest',_data:JSON.stringify({page:page})},
            dataType:'json',
            success:function(response){

                var output_results=$(".table-prayer-request");
                var output_pagination=$(".pagination-wrapper");
                var max_pages=parseInt(response['data']['page_max']);

                response['data']['results'].forEach(function(result){
                    output_results.append(`
                        <tr>
                            <td>${result['name']}</td>
                            <td>${result['email']}</td>
                            <td>${result['prayer']}</td>
                        </tr>
                    `);
                });
                
                for(var i=1;i<=max_pages;i++){
                    if(i==page){
                        output_pagination.append(`<div class="page-item"><a class="page-number active" href="cms-prayer-request.php?page=${i}">${i}</a></div>`);
                    }
                    else{
                        output_pagination.append(`<div class="page-item"><a class="page-number" href="cms-prayer-request.php?page=${i}">${i}</a></div>`);
                    }
                }
            },
            error:function(xhr, e){
                console.log("Error fetching prayer requests: "+e);
                console.log("Response: "+xhr.responseText);
            },
            cache:false
        });
    }

    deleteListing=(e)=>{
        
        $.ajax({
            url:"./appcore/request_handler.php",
            method:'POST',
            dataType:'json',
            data:{_request:'dListings',_data:JSON.stringify({target:e.dataset.target, id:e.dataset.id})},
            success:function(response){
                console.log(response);

                if(response.ok)
                    $(e).closest("tr").remove();
            }, 
            error:function(xhr,e){
                console.log("ERR_DELETE_LISTING - "+xhr.responseText);
            }
        })
    }

    editListing=()=>{
        console.log("Editing listing");
    }

    function getListings(target, fields, output=".data-listings"){
        $.ajax({
            url:'./appcore/request_handler.php',
            method:'POST',
            data:{_request:'gListings',_data:JSON.stringify({target:target})},
            dataType:'json',
            success:function(response){
                var output_data="";

                if(response.data){
                    response.data.forEach((row, index)=>{
                        fields.forEach((data_item, index)=>{
                            
                            var di=(row[data_item])?row[data_item]:`<b style="color:red;">n/a</b>`;
                            if(data_item=="last_update"){
                                di = new Date(parseInt(row[data_item]) * 1000);
                                
                                let day=di.getDate();
                                let month=di.getMonth();
                                let year=di.getFullYear();

                                di=`${day}-${month}-${year}`;
                            }
                            
                            output_data+=`
                                <td>${di}</td>
                            `;
                        });

                        action_buttons=`
                            <td>
                                <button class="action-btn action-edit" data-id="${row.id}" data_target="${target}" data-action="edit" onclick="editListing(this)">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <button class="action-btn danger" data-id="${row.id}" data-target="${target}" data-action="delete" onclick="deleteListing(this)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>`;
                        output_data=`<tr data-id="${row.id}">${output_data}${action_buttons}</tr>`;
                    });
                }
                else{
                    output_data=`<h4 class="placeholder">There are no listings to show. Upload to get started.</h4>`;
                }

                $(output).append(output_data);
                $(".data-listings button[data-action='delete]").click(deleteListing);
            },
            error:function(xhr, e){
                console.log("Error fetching listings: "+e);
                console.log("Response: "+xhr.responseText);
            },
            cache:false
        });    
    }

    var filename = window.location.pathname.split("/").pop();
    switch(filename){
        case "cms-prayer-request.php":
            prayer_listings();    
            break;

        case "cms-music.php":
            getListings("songs",['id','name','album','artist','last_update']);
            break;

        case "cms-movies.php":
            getListings("movies",['id','name','last_update']);
            break;
    }
});
};