$(document).ready(function()
{
	var root=".";

	loadFile(root+"/dynamic-loads/header.html",$("#header"));
	loadFile(root+"/dynamic-loads/footer.html",$("#footer"));
	loadFile(root+"/dynamic-loads/main-nav.html",$("#main-nav"));
	loadFile(root+"/dynamic-loads/change-password.html",$("#change-password"));

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
});