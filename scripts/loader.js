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
});