$(document).ready(function(){
	var t1=200;
	var url = new URL(window.location.href);

	//commons
	$(".close-btn").click(function(){
		var target=$(this).data("target");	
		$("#"+target).stop().slideUp(t1);
	});
	
	$("#btn-uiChangePassword").click(function(){
		console.log("Cliked");
		$("#change-password").stop().slideToggle(t1);
	});

	$("#btn-change-password").click(function(){
		var cp=$("#current-password").val();
		var np=$("#new-password").val();
		var npc=$("#new-password-confirm").val();

		
		{
			$.ajax({
				url:'appcore/auth/change_password.php',
				method:"POST",
				dataType:"json",
				data:{current_password:cp, new_password:np, new_password_confirm:npc},
				success:function(response){
					$("#change-password .status").text(response);
				},
				error:function(xhr, e)
				{
					$("#change-password .status").text(response);
				},
				cache:false
			});
		}
	});

	//Upload UI
	var cms_response_status=url.searchParams.get("status");
	var cms_response=url.searchParams.get("response");
	var cms_response_class=(cms_response_status==0)?"fail":"success";
	var cms_response_output=$("#cms-response");

	if(cms_response_status==0){
		cms_response_output.addClass(cms_response_class).find(".inner").html(`
			<p><strong>Upload Failed:</strong> ${cms_response}</p>
		`);
		cms_response_output.show();
	}else if(cms_response_status==1){
		cms_response_output.addClass(cms_response_class).find(".inner").html(`
		<p><strong>Upload Successful</strong></p>
		`);
		cms_response_output.show();
	}

	$("#cms-response .close-btn").click(function(){
		$("#cms-response").hide();
	});

	$(".cms-m-form-submit").on("submit",function(){
		$(this).append(`
			<div class="loader" style="position:relative;top:20px;"><p>Uploading</p><img src="images/loaders/bar-blue.gif"/></div>
		`);
	});

	/**
	 * Modal Controls
	 */

	 $(".modal .close").click((e)=>{
		$(e.target).parent().parent().hide();
	 });
});