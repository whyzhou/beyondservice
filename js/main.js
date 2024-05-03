$(document).ready(function(){
	    
    //if mouseover the menu item
	$("#menu li").hover(
		function() {
		    $('.current').removeClass('active');
		},
		function() {
		    $('.current').addClass('active');
		}
	);
	    
});