$(document).ready(function(){
    $(".search-hero input").on("keyup",function(){
        
        var section_name=$(this).data("output");
        var search_target=$(this).data("target");
        var search_results=$(`.${section_name} .data-container`);
        var search_placeholder_text=search_results.find(".search-placeholder-text");
        var placeholder_text=search_results.find(".placeholder-text");

        var q=$(this).val().trim();

        if(!q)
        {
            search_placeholder_text.hide().text("");
            placeholder_text.show();
        }
        else
        {
            placeholder_text.hide();
            search_placeholder_text.text("We could not find anything for what your searched").show();
        }
    });
});