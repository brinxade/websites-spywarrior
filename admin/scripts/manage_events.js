$(document).ready(function(){

    var url=new URL(window.location.href);
    var eventId = url.searchParams.get("id");
    eventId = (eventId)?eventId:"";

    loadEventData();

    function loadEventData(){

        var photosCon=$(".cms-event-photos .content");
        var videosCon=$(".cms-event-videos .content");
        var pathPrefix="appcore/storage/events/"+eventId+"/";

        $.ajax({
            url: './appcore/request_handler.php',
                type: 'POST',
                data: {_request:"gEventData", _data:JSON.stringify({id:eventId})},
                dataType: 'json',
                success: function(response){
                    console.log(response);

                    if(response.dataPhotos.length<1){
                        photosCon.html("<h3 class='nm-bottom'>No photos to show</h3>");
                    }
                    else
                    {
                        let content="";
                        response.dataPhotos.forEach((photo, index)=>{
                            content+=`
                                <div class="photo">
                                    <button class="btn btn-delete" data-id="${eventId}" data-filepath="${pathPrefix+photo}"><i class="fas fa-trash-alt"></i></button>
                                    <img src="${pathPrefix+photo}"/>
                                </div>
                            `;
                        });
                        photosCon.html(content);
                    }
                        
                    if(response.dataVideos.length<1){
                        videosCon.html("<h3 class='nm-bottom'>No videos to show</h3>");
                    }
                    else
                    {
                        let content="";
                        response.dataVideos.forEach((video, index)=>{
                            content+=`
                                <div class="video">
                                    <button class="btn btn-delete" data-id="${eventId}" data-filepath="${pathPrefix+video}"><i class="fas fa-trash-alt"></i></button>
                                    <video controls src="${pathPrefix+video}" preload="metadata"></video>
                                </div>
                            `;
                        });
                        videosCon.html(content);
                    }
                },
                error: function(xhr, e){
                    console.log("Error loading event data: "+xhr.responseText);
                }
        });
    }

    $(".cms-subsection").on("click",".btn-delete",function(){

        var eventId=$(this).data("id");
        var filepath=$(this).data("filepath");
        var mainCon=$(this).parent();

        $.ajax({
            url: './appcore/request_handler.php',
            type: 'POST',
            dataType: 'json',
            data: {_request: "dEventData", _data:JSON.stringify({id: eventId, filepath: filepath})},
            success: function(response){
                console.log(response);
                if(response.status==1){
                    mainCon.remove();
                    mainCon.parent().html("<h3>No data to show here.</h3>");
                }
                else{
                    window.alert("Failed to delete file");
                }   
            },
            error: function(xhr, e){
                console.log("Err: "+xhr.responseText);
            }
        });

    });

    $(".cms-subsection").on("click","#event-upload", function(){

        var fd = new FormData();
        var files = $('#event-file')[0].files[0];
        var statusText = $("#status-text");
        var loader = $(".cms-event-uploader .loader");
        
        if(!eventId || !parseInt(eventId))
            return;

        loader.show();
        fd.append('event-file',files);
        fd.append('event-id',eventId);

        $.ajax({
            url: './appcore/section_manager/s_events_uploader.php',
            type: 'POST',
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                loader.hide();

                if(response.status==0){
                    statusText.addClass("danger").html(response.errors[0]).show();
                }
                else{
                    statusText.removeClass("danger").html(response.text).show();
                    loadEventData();
                }   
            },
            error: function(xhr, e){
                statusText.html("Err: "+xhr.responseText).show();
            }
        });
    });

});