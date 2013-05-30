// JavaScript Document
$(document).ready(function(e) {	
	$(window).resize(resize);
	resize();    
	init();
});


function resize(){
	var h = $(window).height()-$('.header').outerHeight()-$('.footer').outerHeight();	
	$('.body').height(h);
	$('.body .right-panel').height(h);
	$('.body .left-panel').height(h);	
	resizeModule();	
}

function resizeModule(){
	
	//module-list

	var row = $('.module-list .fix-title-row th').each(function(){$(this).css('width',$(this).width());});
	$('.module-list .fix-title').append(row).width($('.module-list .list-container').width());
	var h = $(window).height()-$('.header').outerHeight()-$('.footer').outerHeight()-$('.crumb').outerHeight(true)-$('.module-list .fix-title').outerHeight()-$('.right-panel .toolbar').outerHeight();
	$('.module-list .list-container').height(h);
	$('.module-detail').height(h);
	
	$('.module-list .select-all').click(function(){
		$('.module-list .select').prop('checked',$(this).prop('checked')).each(function(){
			$(this).parent().parent().toggleClass('select',$(this).prop('checked'));
		});
	});
	$('.module-list .list .select').click(function(){
		$(this).parent().parent().toggleClass('select',$(this).prop('checked'));
	});
	
	//login
	h = ($(window).height()/2)-($('.module-login').outerHeight()/2);	
	$('.module-login').css('marginTop',h);
}


function init(){
	$('#leftPanelAdjust').click(function(){
		$('.left-panel-container').toggleClass("collapse");
		return false;
	});
}
function countChecked() {
  var n = $("input:checked").length;
  //$("div").text(n + (n <= 1 ? " is" : " are") + " checked!");
  return n;
}

function del_list(form){
		
		if(countChecked()>0){
	
			if(confirm("確認刪除?"))
				$("#"+form).submit();
			else
				return false;
		
		}else
			alert("並未勾選!");
			
		return false;
}
function sale_list(form,status){
		
		if(status=='1'){
			var t="上架";	
			$("input[name='sale']").val("1");
		
		}else{
			var t="下架";
			$("input[name='sale']").val("0");
		}
		
		$("input[name='doit']").val("sale");
		
		if(countChecked()>0){
	
			if(confirm("確認"+t+"?"))
				$("#"+form).submit();
			else
				return false;
		
		}else
			alert("並未勾選!");
			
		return false;
}

function status_list(form,status){
		
		if(status=='1'){
			var t="已處理";	
			$("input[name='status']").val("1");
		
		}else{
			var t="未處理";
			$("input[name='status']").val("0");
		}
		
		$("input[name='doit']").val("status");
		
		if(countChecked()>0){
	
			if(confirm("確認"+t+"?"))
				$("#"+form).submit();
			else
				return false;
		
		}else
			alert("並未勾選!");
			
		return false;
}