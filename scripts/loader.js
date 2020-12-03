$(document).ready(function()
{
	loadFile("/dynamic-loads/header.html",$("#header"));
	loadFile("/dynamic-loads/footer.html",$("#footer"));

	function loadFile(href, target)
	{
		$.ajax({
			url: href,
			cache: false,
			dataType: "html",
			async: false,
			success: function(data) {
				$(target).html(data);
			}
		});
	}

	$(".resp-trigger").click(function(){
		if($(this).hasClass("active"))
		{
			$("#header .main-nav ul").stop().slideUp(200);
			$(this).removeClass("active");
		}
		else
		{
			$("#header .main-nav ul").stop().slideDown(200);
			$(this).addClass("active");
		}
	});
});