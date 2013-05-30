<?php
$root="../";
require_once($root."_init.php"); 
define("F",'3');
define("FS",'4');

$pd=new Product_spec();
$ret=$pd->get_all();
$parent=$_GET['myParent'];

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
		
		
			var t=$('#title').val();
		
			
			if($.trim(t).length<1){
				alert("請填寫標題!");
				$('#title').focus();
				return false;
			}
		
		});
		
	});
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
                    	<a href="product_bcatalog.php">商品分類</a>
                        <ul class="sub-nav">
                        	<?=$pd->get_menu();?>
                        </ul>
                    </li>                                                                   
                </ul>
            </div>
        </td>
        <td class="left-panel-bar"><a id="leftPanelAdjust" href="#">&nbsp;</a></td>
        <td class="right-panel-container">
       	  	<div class="right-panel">
              	<ul class="crumb">
                   <?=$pd->bc_crumbs();?>
                </ul>
				<form action="func.php" method="post" enctype="multipart/form-data">
                 <input name="func" type="hidden" id="func" value="pds" />
                 <input name="doit" type="hidden" id="doit" value="renew" />
				 
				 <input name="parent" type="hidden" id="parent" value="<?=$parent;?>" />
                <div class="toolbar">                    	
                    <div class="group">
                        <input type="submit" value="新增" class="button" />
                        
                    </div>
                </div>
                
                <div class="module-detail">
                	<ul class="detail-tag">
                       <?php include_once("inc/product_menu.inc.php");?>
                  </ul>
                	<div class="detail-container">                    	
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="detail">
                   	    <tr>
                   	      <th align="right">名稱</th>
                   	      <td><input name="title" id="title" type="text" size="80" /></td>
               	        </tr>
                   	    <tr>
                   	      <th width="100" align="right">圖片</th>
                   	      <td>
                          	<input type="file" name="fileField" id="fileField" />
                          	<span class="highlight">圖片大小為 30 × 30 以上，正方比例為最佳效果。</span></td>
               	        </tr>
                   	    <tr>
                   	      <th colspan="2" align="right"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
                   	        <tr>
                   	          <th>圖片</th>
                   	          <th align="left">名稱</th>
                   	          <th align="center">刪除</th>
               	            </tr>
							<?php for($i=0;$i<count($ret);$i++){ ?>
                   	        <tr>
                   	          <td align="center"><?php if(is_file(SPEC_Image.$ret[$i]['image'])){?>
                            <img src="<?=SPEC_Image.$ret[$i]['image'];?>"  class="image" /><?php }?></td>
                   	          <td><?=$ret[$i]['title'];?></td>
                   	          <td align="center"><input type="button" class="button" value="刪除" onclick="if(confirm('確認刪除?'))window.location='func.php?doit=del&func=pds&myParent=<?=$ret[$i]['parent'];?>&delid=<?=$ret[$i]['id'];?>'"/></td>
               	            </tr>
							<?php }?>
                   	        
               	          </table></th>
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
