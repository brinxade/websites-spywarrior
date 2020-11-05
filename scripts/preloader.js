$(document).ready(function(){
	particlesJS.load('webpage-preloader', '/scripts/libraries/particles-js/config.json', function() {
		console.log('particles-js config loaded');
	});

	setTimeout(function(){$("#webpage-preloader .inner").fadeOut(300);},300)
	setTimeout(function(){$("#webpage-preloader").fadeOut(600);},800)
	
});