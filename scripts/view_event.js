$(document).ready(function(){

    var url=new URL(window.location.href);
    var eventId = url.searchParams.get("view");
    eventId = (eventId)?eventId:"";

    loadEventData();

    function loadEventData(){

        var eventName=$("#event-name");
        var eventDesc=$("#event-desc");
        var eventDate=$("#event-date");
        var eventLocation=$("#event-location");
        var photosCon=$(".event-photos .content-inner");
        var videosCon=$(".event-videos .content-inner");
        var pathPrefix="admin/appcore/storage/events/"+eventId+"/";

        $.ajax({
            url: 'admin/appcore/request_handler.php',
                type: 'POST',
                data: {_request:"gEventData", _data:JSON.stringify({id:eventId})},
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    
                    eventName.text(response.dataEventInfo.name);
                    eventDesc.text(response.dataEventInfo.description);
                    eventDate.text(response.dataEventInfo.date);
                    eventLocation.text(response.dataEventInfo.location);

                    if(response.dataPhotos.length<1){
                        photosCon.html("<p class='nm-bottom'>No photos to show</p>");
                    }
                    else
                    {
                        let content="";
                        response.dataPhotos.forEach((photo, index)=>{
                            content+=`
                                <div class="photo">
                                    <a class="photo-popup" href="${pathPrefix+photo}">
                                        <img src="${pathPrefix+photo}">
                                    </a>
                                </div>
                            `;
                        });
                        photosCon.html(content);
                    }
                        
                    if(response.dataVideos.length<1){
                        videosCon.html("<p class='nm-bottom'>No videos to show</p>");
                    }
                    else
                    {
                        let content="";
                        response.dataVideos.forEach((video, index)=>{
                            content+=`
                                <div class="video">
                                    <video controls src="${pathPrefix+video}" preload="metadata"></video>
                                </div>
                            `;
                        });
                        videosCon.html(content);
                    }

                    $(".photo-popup").magnificPopup({
                        type: 'image'
                    });
                },
                error: function(xhr, e){
                    console.log("Error loading event data: "+xhr.responseText);
                }
        });
    }

});