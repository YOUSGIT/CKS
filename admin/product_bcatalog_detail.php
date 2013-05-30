<?php
$root="../";
require_once($root."_init.php"); 
define("F",'3');
define("FS",'1');

$bc=new Catalog();
$row=$bc->get_detail();
	

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
		$('#title').focus();
				
		$("form").submit(function(){
			
			var c=$('#editor').val();
			//var d=$('#datepicker').val();
			var t=$('#title').val();

			if($.trim(t).length<1){
				alert("請填寫標題!");
				$('#title').focus();
				return false;
			}
			
		
		});
	});
	
	function delp(dir, filename){
		
		if(confirm("確認刪除?")){
			$.post("func.php", {doit:"delp",dir:dir,file:filename}, function(ret){
				
				if(ret.ret=='ok'){
						
						//alert("已刪除");
						$("#detail_image").fadeOut(500);
						
					}else
						alert("刪除失敗");
				
				
				},"json");
		}else
			return false;
		
	}
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
        	<div class="left-panel">
            	<ul class="nav">
                	<li>
                    	<a href="product_bcatalog.php" class="active">商品分類</a>
                        <ul class="sub-nav">
                        	<?=$bc->get_menu();?>
                        </ul>
                    </li>                                                                   
                </ul>
            </div>
        </td>
        <td class="left-panel-bar"><a id="leftPanelAdjust" href="#">&nbsp;</a></td>
        <td class="right-panel-container">
       	  	<div class="right-panel">
              	<ul class="crumb">
                   <?=$bc->crumbs();?>
                </ul>
                <form action="func.php" method="post" enctype="multipart/form-data">
                 <input name="func" type="hidden" id="func" value="bc" />
                 <input name="doit" type="hidden" id="doit" value="renew" />
                <div class="toolbar">                    	
                    <div class="group">
                        <input name="送出" type="submit" class="button" value="儲存" />
                        
                  </div>
                </div>
                
                <div class="module-detail">
                	<ul class="detail-tag">
                        <li><a href="#" class="active">編輯大分類</a></li>                       
                    </ul>
                	<div class="detail-container">    
                    <input name="image" type="hidden" id="image" value="<?=$row['image'];?>" />
                    <input name="id" type="hidden" id="id" value="<?=$row['id'];?>" />
					 <input name="sale" type="hidden" id="sale" value="1" />
					 <input name="sequ" type="hidden" id="sequ" value="<?=(is_numeric($row['sequ']))?$row['sequ']:'9999999';?>" />                    	
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="detail">
                          <tr>
                            <th width="100" align="right">大分類標題</th>
                            <td><input name="title" type="text" id="title" value="<?=$row['title'];?>" size="100" /></td>
                        </tr>
                          <tr>
                            <th align="right">大分類圖片</th>
                            <td><input type="file" name="bc_image" id="bc_image" />
                              <span class="highlight">圖片大小為 620 × 140 為最佳效果。</span></td>
                          </tr>
                          <tr>
                            <th align="right">&nbsp;</th>
                            <td><span id="detail_image"><?php if(is_file(BC_Image.$row['image'])){?>
                            <a href="#doit=del&func=bc&delid=<?=$row['id'];?>" onclick="delp('<?=BC_Image;?>','<?=$row['image'];?>')" class="delete"><span class="text">移除</span>
                            <img src="<?=BC_Image.$row['image'];?>"  class="image" /></a>
                            <?php }?></span></td>
                          </tr>
                          <tr>
                            <th align="right">大分類說明</th>
                            <td><textarea name="content" id="content" cols="100" rows="10"><?=strip_tags(stripslashes($row['content']));?></textarea></td>
                          </tr>
                      </table>

                    </div>
                </div>
                </form>
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
