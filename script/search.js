// JavaScript Document

function search_product(keyword){

	var key = event.keyCode;
	if ( key == 13 ) //key == 9 ==> Tab            Key==13==>Enter
		window.location="./search.php?q="+(encodeURI($("#search_product").val()));
		
}