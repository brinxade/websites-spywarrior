/**
 * Mini Gallery Model/View
 */
window.onload=()=>{
    $(document).ready(function(){

        let gallery=new MiniGallery("*");

    });

    class MiniGallery{

        requestHandler="admin/appcore/request_handler.php";
        contentPathPrefix="admin/appcore/storage/"
        content={};
        contentTarget;

        constructor(contentTarget){
            this.contentTarget=contentTarget;
            this.fetchData(this);
        }

        fetchData(miniGallery){
            let req=$.ajax({
                url:this.requestHandler,
                method:'POST',
                dataType:'json',
                data:{_request:'gMiniGallery',_data:JSON.stringify({contentTarget:this.contentTarget})},
                success:function(response){
                    miniGallery.content=response['data'];
                    console.log(`Fetched ${miniGallery.content['songs'].length} songs, ${miniGallery.content['movies'].length} movies, ${miniGallery.content['events'].length} events`);

                    miniGallery.loadMusic();
                    miniGallery.loadMovies();
                    miniGallery.loadEvents();
                },
                error:function(xhr, e){
                    //console.log(xhr.responseText);
                }
            });
        }

        loadMusic(){
            let sectionCon=$(".section-music .data-container");
            let contentCon=sectionCon.find(".data-main");
            let content="";

            if(this.content['songs']){
                if(this.content['songs'].length==0)
                {
                    let innerContainer=sectionCon.parent();
                    innerContainer.css('padding','0').html(`
                    <h5 class="placeholder-text">There are no recent Song uploads, check again later!</h5>
                    `);

                    return;
                }
                this.content['songs'].forEach((song, index)=>{
                    content+=`
                    <div class="music-player">
                        <div class="inner" style="background:url(/${this.contentPathPrefix+"music/thumbnails/"+song.thumbnail});">
                            <div class="music-container">
                                <span class="music-title">${song.name}</span>
                                <audio src="${this.contentPathPrefix+"music/"+song.filepath}" controls preload="null"></audio>
                            </div>
                        </div>
                    </div>
                    `;
                });
                contentCon.html(content);
                $("audio").audioPlayer();
                $(contentCon).slick({
                    infinite: true,
                    speed: 300,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                        }
                    }
                    ]
                });
            }
            
            contentCon.show();
        }

        loadMovies(){
            let sectionCon=$(".section-movies .data-container");
            let contentCon=sectionCon.find(".data-main");
            let content="";
            
            if(this.content['movies'])
            {
                if(this.content['movies'].length==0)
                {
                    let innerContainer=sectionCon.parent();
                    innerContainer.css('padding','0').html(`
                    <h5 class="placeholder-text">There are no Movies to showcase</h5>
                    `);

                    return;
                }
                this.content['movies'].forEach((movie, index)=>{
                    content+=`
                    <div class="video-player">
                        <div class="inner"">
                            <div class="video-container">
                                <video id="mg-vid-${movie.id}"
                                    class="video-js"
                                    controls
                                    preload="auto"
                                    poster="${this.contentPathPrefix+"movies/thumbnails/"+movie.thumbnail}"
                                    data-setup="{}"
                                    preload="null"
                                >
                                <source src="${this.contentPathPrefix+"movies/"+movie.filepath}" type="video/mp4"/>
                              </video>
                            </div>
                            <span class="video-title"><a href="watch.php?id=${movie.id}">${movie.name}</a></span>
                        </div>
                    </div>
                    `;
                });

                contentCon.html(content);
                $(contentCon).slick({
                    infinite: true,
                    speed: 300,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    responsive: [
                      {
                        breakpoint: 1024,
                        settings: {
                          slidesToShow: 2,
                          slidesToScroll: 1,
                          infinite: true,
                          dots: true
                        }
                      },
                      {
                        breakpoint: 600,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1
                        }
                      }
                    ]
                });
                contentCon.show();
            }
        }

        loadEvents(){
            let sectionCon=$(".section-events .data-container");
            let contentCon=sectionCon.find(".data-main");
            let content="";

            if(this.content['events'].length>0)
            {
                
                for(let i=0;i<this.content['events'].length;i++)
                {
                    content+=`
                    <div class="event-tile">
                        <div class="tile-inner">
                            <i class="icon fas fa-calendar-week"></i>
                            <div class="info">
                                <p class="location"><strong>Location</strong><span class="t-center">${this.content['events'][i].location}</span></p>
                                <p class="date"><strong>Time</strong><span class="t-center">${this.content['events'][i].date}</span></p>
                            </div>
                        </div>
                        <h1 class="title">${this.content['events'][i].name}</h1>
                        <a href="event.php?view=${this.content['events'][i].id}" class="btn">View Event</a>
                    </div>
                    `;
                }

                contentCon.html(content);
            }
            else
            {
                let innerContainer=sectionCon.parent();
                innerContainer.css({
                    'padding':'0',
                    'border':'none',
                    'background':'transparent'}).html(`
                <h5 class="placeholder-text">There are no upcoming events for now. See the previous events <a href="events.php">here!</a></h5>
                `);

                return;
            }
        }
    }
};