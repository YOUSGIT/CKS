<?php
$root="../";
require_once($root."_init.php"); 
define("F",'1');
define("FS",'1');

$adv=new Banner;

$row=$adv->get_detail();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator Template</title>
<link href="css/original/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script/admin.js"></script>
<script>
	$(function(){
		$('#link').focus();
		
		$('form').submit(function(){
			var t=$('#link').val();
			var i1=$('#ad_image').val();
			var i2=$('#image').val();
			
			if(i1 == '' && i2 == ''){
			
				alert("請選取圖片!");
				$('#ad_image').focus();
				return false;
			}
			
			if($.trim(t).length<1){
				alert("請填寫連結!");
				$('#link').focus();
				return false;
			}
			$('#link').val(encodeURI(t));
			//return true;
		});
		
	});
	
	
</script>
</head>

<body>
	<div class="header">    	
    	<?php include_once "inc/guide.inc.php";?>
        
        
        <div class="toolbar">        	
            <div class="blank"></div>
        </div>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
      <tr>
        <td class="left-panel-container">
        	<?php include_once "inc/wbmenu.inc.php";?>
        </td>
        <td class="left-panel-bar"><a id="leftPanelAdjust" href="#">&nbsp;</a></td>
        <td class="right-panel-container">
       	  	<div class="right-panel">
              	
                
                <ul class="crumb">
                    <?=$adv->crumbs();?>
                </ul>
                <form action="func.php" method="post" enctype="multipart/form-data" onsubmit="return check();">
                 <input name="func" type="hidden" id="func" value="adv" />
                 <input name="doit" type="hidden" id="doit" value="renew" />
                <div class="toolbar">                    	
                    <div class="group">
                        <input type="submit" value="儲存" class="button" />
                        <!--<input type="button" value="取消" class="button" />-->
                    </div>
                </div>
                
                <div class="module-detail">
                	<ul class="detail-tag">
                        <li><a href="#" class="active">新增廣告</a></li>                       
                    </ul>
                	<div class="detail-container">                    	
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="detail">
                          <tr>
                            <th align="right">廣告圖片</th>
                            <td><input type="file" name="ad_image" id="ad_image" />
                            <input name="image" type="hidden" id="image" value="<?=$row['image'];?>" />
                            <input name="id" type="hidden" id="id" value="<?=$row['id'];?>" />
                            <span class="highlight">圖片大小為 1000 × 600 為最佳效果。</span></td>
                          </tr>
                          <tr>
                            <th align="right">&nbsp;</th>
                            <td><?php if(is_file(ADM_Image.$row['image'])){?>
                            <a href="func.php?doit=del&func=adv&delid=<?=$row['id'];?>" onclick="return confirm('確認刪除?')" class="delete"><span class="text">移除</span>
                            <img src="<?=ADM_Image.$row['image'];?>"  class="image" /></a>
                            <?php }?>
</td>
                          </tr>
                          <tr>
                            <th width="100" align="right"> 廣告連結 </th>
                            <td><input name="link" type="text" id="link" size="100" value="<?=$row['link'];?>"/></td>
                          </tr>
                        </table>

                    </div>
                </div></form>
       	  	</div>
		</td>
      </tr>
    </table>
    <div class="footer">
    	<span class="copyright">YOUS © 2012</span>
        <span class="vision"></span>
        <span class="nav"></span>
    </div>
</body>
</html>
