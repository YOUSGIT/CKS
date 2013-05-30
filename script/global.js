// JavaScript Document
$(document).ready(function(e) {
	$('.globalnav A:not(.active)').css("backgroundPosition","50% 70px").mouseenter(function(){
		//alert($(this).css('background-position'));
		$(this).animate({ backgroundPosition: "50% 53px" }, 100).find("img").animate({ height: "11px" }, 100);
	}).mouseleave(function(){
		$(this).animate({ backgroundPosition: "50% 70px" }, 100).find("img").animate({ height: "8px" }, 100);
	});
	
	

	$('.news-cycle').cycle({ 
    	fx:    'scrollDown', 
    	delay: -1000 
	});
	
});
