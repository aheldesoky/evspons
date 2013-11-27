$(function(){
	$(".form-container .signin-link").click(function(){
			$(".card").addClass("card-override");
			$(".front").addClass("front-override");
	});
	$(".form-container .signup-link").click(function(){
			$(".card").removeClass("card-override");
			$(".front").removeClass("front-override");
	});
});