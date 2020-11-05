$(document).ready(function(){
    var win=$(window);
    var ww=win.width();
    var wh=win.height();

    win.resize(function(){ww=win.width();wh=win.height();});
});