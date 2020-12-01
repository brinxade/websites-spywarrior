window.onload=()=>{
    $(document).ready(function(){
        var content;
        var requestHandler="admin/appcore/request_handler.php";
        var url = new URL(window.location.href);
		var page = url.searchParams.get("p");
		console.log("Page Number: "+page);

        var config={
            movies:{
                path:"admin/appcore/storage/movies/",
                placeholder:"No Movies Found"
            },
            songs:{
                path:"admin/appcore/storage/music/",
                placeholder:"No Songs Found"
            }
        };

        page=(page)?page:1;
        
        /**
         * Gallery Loaders
         */

        function loadMovies(outputCon, data){
            var content="";
            data.forEach((movie, index)=>{
                content+=`
                    <div class="movie-item">
                        <div class="thumbnail">
                            <img src="${config.movies.path+"thumbnails/"+movie.thumbnail}"/>
                        </div>
                        <div class="info">
                            <p class="title">${movie.name}</p>
                            <p class="desc">${movie.description}</p>
                        </div>
                        <a href="watch.php?id=${movie.id}" class="btn">Watch Now</a>
                    </div>
                `;
            });

            outputCon.html(content);
        }

        function loadSongs(outputCon, data){
            var content="";
            data.forEach((song, index)=>{
                content+=`
                    <div class="music-item">
                        <div class="info">
                            <p class="title">${song.name}</p>
                            <p class="artist">${(song.artist)?song.artist:"Artist Unknown"}</p>
							<p class="album">${(song.album)?song.album:"Single Track"}</p>
                        </div>
                        <audio controls src="${config.songs.path+song.filepath}">
						</audio>
						<a class="download" href="${config.songs.path+song.filepath}"><i class="fas fa-download"></i></a>
                    </div>
                `;
            });

            outputCon.html(content);
			$("audio").audioPlayer();
			$(".audioplayer").css({
				paddingLeft:"50px",
				paddingRight:"50px",
				marginLeft:"-35px"
			});
        }
		

        $.ajax({
            url:requestHandler,
            method:'POST',
            dataType:'json',
            data:{_request:'gMiniGallery',_data:JSON.stringify({contentTarget:"*",page:page})},
            success:function(response){
                content=response['data'];

                /**
                 * Debug Info
                 */
                /*
                console.log(`Fetched ${content['songs'].length} songs, ${content['movies'].length} movies`);
                console.log("Content Range: "+response['contentRange']);
                console.log("Page Count: "+response['pageCount']);
                */
                
                let outputCon=$(".data-container");
                let dataTarget=outputCon.data("target");
                let paginationCon=$(".content-pagination");

                if(content[dataTarget].length==0)
                    outputCon.html(`<h2 class="placeholder">${config[dataTarget]['placeholder']}</h2>`);
                else
                {
                    let pagination="";
                    switch(dataTarget){
                        case "movies":
                            if(response['paginationDisable']==0)
                            {
                                for(let i=0;i<response['pageCount'][0];i++){
                                    pagination+=`
                                        <a href="/movies.php?p=${i+1}" class="page">${i+1}</a>
                                    `;
                                }
                                paginationCon.html(pagination);
                            }
                            else
                            {
                                paginationCon.remove();
                            }
                            loadMovies(outputCon, content.movies);
                            break;
                        case "songs":
                            if(response['paginationDisable']==0)
                            {
                                for(let i=0;i<response['pageCount'][1];i++){
                                    pagination+=`
                                        <a href="/music.php?p=${i+1}" class="page">${i+1}</a>
                                    `;
                                }
                                paginationCon.html(pagination);
                            }
                            else
                            {
                                paginationCon.remove();
                            }
                            loadSongs(outputCon, content.songs);
                            break;
                        default:
                            console.log("Invalid Data Target for Gallery");
                            break;
                    }
				}
				
				/**
				 * Search
				 */
				$("#search").on("keyup",(e)=>{

                    let dataTarget=e.target.dataset.target;
					let outputCon=$(".data-container");
                    let q=e.target.value;
					let qKeywords=q.split(" ");
					let results=[];
                    
                    console.log("Searching...");
					if(q)
					{
						for(let i=0;i<content[dataTarget].length;i++){
                            let qMatch=true;
							let keywords=content[dataTarget][i].name.toLowerCase().split(" ");
                            
                            console.log(qKeywords);
							for(let g=0;g<qKeywords.length;g++){
								if(qKeywords[g] && keywords.indexOf(qKeywords[g])==-1){
									qMatch=false;
									break;
								}
                            }

                            if(qMatch)
                                results.push(content[dataTarget][i]);
						}
						
						if(results.length>0){
                            switch(dataTarget)
                            {
                                case "songs":
                                    loadSongs(outputCon, results);
                                    break;
                                case "movies":
                                    loadMovies(outputCon, results);
                                    break;
                                case "default":
                                    window.alert("Failed to load search results");
                                    break;
                            }
                        }
						else{
                            outputCon.html(`<h2 class="placeholder">${config[dataTarget]['placeholder']}</h2>`);
                        }
					}
					else
					{
                        switch(dataTarget)
                        {
                            case "songs":
                                loadSongs(outputCon, content[dataTarget]);
                                break;
                            case "movies":
                                loadMovies(outputCon, content[dataTarget]);
                                break;
                            case "default":
                                window.alert("Failed to load search results");
                                break;
                        }
					}
				});
            },
            error:function(xhr, e){
                console.log(xhr.responseText);
            }
        });
    });
};