$(document).ready(function(){
    $("#pr-submit").click(function(){
        var name_=$("#pr-name").val().trim();
        var email_=$("#pr-email").val().trim();
        var prayer_=$("#pr-prayer").val().trim();
        var data=JSON.stringify({name:name_, email:email_, prayer:prayer_});
        var output=$("#pr-status");

        if(name_ && email_ && prayer_)
        {
            console.log("Sending Request");

            $.ajax({
                url:'admin/appcore/request_handler.php',
                method:'POST',
                dataType:'json',
                data:{_request:'pPrayerRequest',_data:data},
                success:function(response){
                    var output=$("#pr-status");
                    var modal=$(".modal");

                    if(response['ok']=="1")
                    {
                        modal.find(".data").text(response['response']);
                        modal.stop().fadeIn(300);
                        setTimeout(function(){modal.fadeOut(400);},2000);

                        $("#pr-name").val('');
                        $("#pr-email").val('');
                        $("#pr-prayer").val('');
                        output.html('');
                    }
                    else
                    {
                        output.css('color','red');
                        output.html(response['response']);
                    }
                },
                error:function(xhr,e){
                    console.log("Error occured: "+e);
                }
            });
        }
        else
        {
            output.html("Please fill in all the fields");
        }
    });
});