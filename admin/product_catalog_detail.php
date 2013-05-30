<?php
$root="../";
require_once($root."_init.php"); 
define("F",'3');

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
			

			//var c=$('#editor').val();
			//var d=$('#datepicker').val();
			var t=$('#title').val();
			var p=$('#parent').val();
			if($.trim(p).length<1 || p=="-1"){
				alert("請選擇分類!");
				$('#parent').focus();
				return false;
			}
			
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
			<div class="group">
            	<input type="button" class="tool icon folder-add-b" value="新增子分類" onclick="window.location='product_catalog_detail.php';" />
                <input type="button" class="tool icon file-add-b" value="新增商品" onclick="window.location='product_detail.php';" />
            </div>     	
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
                   <?=$bc->bc_Crumbs();?>
                </ul>
                <form action="func.php" method="post" enctype="multipart/form-data">
                 <input name="func" type="hidden" id="func" value="bc" />
                 <input name="doit" type="hidden" id="doit" value="renew" />
				 <input name="last_parent" type="hidden" id="last_parent" value="<?=$row['parent'];?>" />
                <div class="toolbar">                    	
                    <div class="group">
                        <input name="送出" type="submit" class="button" value="儲存" />
                        
                    </div>
                </div>
                
                <div class="module-detail">
                	<ul class="detail-tag">
                        <li><a href="#" class="active">編輯小分類</a></li>                       
                    </ul>
                	<div class="detail-container">    
                    <input name="image" type="hidden" id="image" value="<?=$row['image'];?>" />
                    <input name="id" type="hidden" id="id" value="<?=$row['id'];?>" />
                    <input name="sequ" type="hidden" id="sequ" value="<?=(is_numeric($row['sequ']))?$row['sequ']:'9999999';?>" />                          	
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="detail">
                   	    <tr>
                   	      <th align="right">大分類</th><?php $ret=$bc->get_all(0);?>
                   	      <td><select name="parent" id="parent" >
                          		<option value="-1">請選擇大分類</option>
                          		<?php foreach($ret as $k => $v){
										$selected	=	($ret[$k]['id']==$row['parent'])	?	'selected="selected"'	:	'';
										echo '<option value="'.$ret[$k]['id'].'" '.$selected.'>'.$ret[$k]['title'].'</option>';
								}?>
               	          </select></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">上架</th>
                   	      <td><label>
                   	        <input name="sale" type="radio" id="sale" value="1" <?=($row['sale']=='1')?'checked="checked"':'';?> />
               	          上架
                   	        <input type="radio" name="sale" id="sale2" value="0" <?=($row['sale']!='1')?'checked="checked"':'';?>/>
                   	        下架</label></td>
               	        </tr>
                          <tr>
                            <th width="100" align="right">小分類名稱</th>
                            <td><input name="title" type="text" id="title" value="<?=$row['title'];?>" size="100" /></td>
                          </tr>
                          <tr>
                            <th align="right">小分類圖片</th>
                            <td><input type="file" name="fileField" id="fileField" />
                              <span class="highlight">圖片大小為 300 × 140 為最佳效果。</span></td>
                          </tr>
                          <tr>
                            <th align="right">&nbsp;</th>
                            <td><span id="detail_image"><?php if(is_file(BC_Image.$row['image'])){?>
                            <a href="#doit=del&func=bc&delid=<?=$row['id'];?>" onclick="delp('<?=BC_Image;?>','<?=$row['image'];?>')" class="delete"><span class="text">移除</span>
                            <img src="<?=BC_Image.$row['image'];?>"  class="image" /></a>
                            <?php }?></span></td>
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
