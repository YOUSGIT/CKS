// JavaScript Document

function addcart(pid){
			
			$(".inquiry-cart").fadeOut("fast");
			alert("in Cart!");		
			$.post("./inc/cart_ajax.php",{id:pid},function(){
					
					$.post("./inc/cart.inc.php",{ajax:'1'},function(ret){
						
						$(".inquiry-cart").html(ret).show("fast");
						
					},"html");

					
			});
			
			return;
	}

function removecart(pid){

	$.post("./inc/inquiry_cart_ajax.php",{id:pid},function(){
	
		window.location="./inquiry_cart.php";
		
		
	
	});

	return;

}