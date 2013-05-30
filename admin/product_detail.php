<?php
$root="../";
require_once($root."_init.php"); 
define("F",'3');
define("FS",'1');

$pd=new Product;
$row=$pd->get_detail();
if(trim($row['parent'])!='')
	$_parent=$pd->join_list_crumbs($row['parent']); //得到父類&父父類

$bc=new Catalog;
	

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator Template</title>
<link href="css/original/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script/admin.js"></script>
<script type="text/javascript" src="inc/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="inc/ckeditor/adapters/jquery.js"></script>
<script>

	$(function(){
				
		$('#title').focus();
				
		$('#editor1').ckeditor().val("<?=(mysql_real_escape_string(stripslashes($row['feature'])));?>");
		$('#editor2').ckeditor().val("<?=(mysql_real_escape_string(stripslashes($row['spec'])));?>");
		$('#editor3').ckeditor().val("<?=(mysql_real_escape_string(stripslashes($row['notice'])));?>");
		
		$("form").submit(function(){
		
			var c=$('#editor').val();
			//var d=$('#datepicker').val();
			var t=$('#title').val();
			
			var s1=$('#select').val();
			var s2=$('#select2').val();

			
			if($.trim(t).length<1){
				alert("請填寫商品名稱!");
				$('#title').focus();
				return false;
			}
			
			
			if(s1=='-1' && s2=='-1'){
				alert("請選擇分類!");
				$('#select').focus();
				return false;
			}else{
				
				if(s2!='-1')
					$("#parent").val(s2);
				else
					$("#parent").val(s1);
				
			}
			
		
		});
		
		$('#select').change(function(){
						
			$.post("./inc/product_catalog.ajax.php",{myParent:$(this).val()},function(ret){
			
				$("#select2").html(ret);
				
				},'html');
		
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
                 <input name="func" type="hidden" id="func" value="pd" />
                 <input name="doit" type="hidden" id="doit" value="renew" />
				 <input name="last_parent" type="hidden" id="last_parent" value="<?=$row['parent'];?>" />
				 <input name="id" type="hidden" id="id" value="<?=$row['id'];?>" />
				 <input name="parent" type="hidden" id="parent" value="<?=$row['parent'];?>" />
                <div class="toolbar">                    	
                    <div class="group">
                        <input type="submit" value="儲存" class="button" />
                        <!--<input type="button" value="返回" class="button" />-->
                    </div>
                </div>
                
                <div class="module-detail">
                	<ul class="detail-tag">
                        <li><a href="product_detail.php?id=<?=$row['id'];?>" class="active">商品基本設定</a></li>  
						<?php if($row['id']!=''){?>
                        <li><a href="product_detail_photo.php?myParent=<?=$row['id'];?>">商品圖片設定</a></li>
                        <li><a href="product_detail_color.php?myParent=<?=$row['id'];?>">商品顏色設定</a></li>
                        <li><a href="product_detail_spec.php?myParent=<?=$row['id'];?>">商品樣式設定</a></li>
                        <li><a href="product_detail_package.php?myParent=<?=$row['id'];?>">商品包裝設定</a></li>
						<?php }?>
                  </ul>
                	<div class="detail-container">                    	
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="detail">
                   	    <tr>
                   	      <th align="right">大分類</th>
                   	      <td><select name="parent1" id="select">
								<option value="-1">請選擇大分類</option>
                          		<?php 
									$ret=$bc->get_all();
									foreach($ret as $k => $v){
										$selected	=	($ret[$k]['id']==$row['parent'] || $ret[$k]['id']==$_parent['bcid'])	?	'selected="selected"'	:	'';
										echo '<option value="'.$ret[$k]['id'].'" '.$selected.'>'.$ret[$k]['title'].'</option>';
								}?>
                 	        </select></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">小分類</th>
                   	      <td><select name="parent2" id="select2">
								<option value="-1">請選擇小分類(可不選)</option>
                          		<?php 
								
									$_parent2	=	($_parent['bcid']!='')	?	$_parent['bcid']	:	$_parent['id'];
									
									if(trim($_parent2)!=''){	//父類為子類
										$ret=$bc->get_all($_parent2);
										foreach($ret as $k => $v){
											$selected	=	($ret[$k]['id']==$row['parent'])	?	'selected="selected"'	:	'';
											echo '<option value="'.$ret[$k]['id'].'" '.$selected.'>'.$ret[$k]['title'].'</option>';
										}
								}
								?>
               	          </select></td>
						  <tr>
                   	      <th align="right">上架</th>
                   	      <td><label>
                   	        <input name="sale" type="radio" id="sale" value="1" <?=($row['sale']=='1')?'checked="checked"':'';?> />
               	          上架
                   	        <input type="radio" name="sale" id="sale2" value="0" <?=($row['sale']!='1')?'checked="checked"':'';?>/>
                   	        下架</label></td>
               	        </tr>
               	        </tr>
                          <tr>
                            <th width="100" align="right">商品名稱</th>
                            <td><input id="title" name="title" type="text" size="100" value="<?=$row['title'];?>"/></td>
                          </tr>
                          <tr>
                            <th align="right">商品型號</th>
                            <td><input name="model" type="text" size="50" value="<?=$row['model'];?>"/></td>
                          </tr>
						 <!-- <tr>
                            <th align="right">商品價格</th>
                            <td><input name="price" type="text" size="50" value="<? //=$row['price'];?>"/></td>
                          </tr>-->
                          <tr>
                            <th align="right">商品簡介</th>
                            <td><textarea name="content" cols="60" rows="5"><?=strip_tags(stripslashes($row['content']));?></textarea></td>
                          </tr>
                          <tr>
                            <th align="right" valign="top">商品特色</th>
                            <td><textarea name="feature" cols="100%" rows="40" id="editor1"></textarea></td>
                          </tr>
                          <tr>
                            <th align="right" valign="top">商品規格</th>
                            <td><textarea name="spec" cols="100%" rows="30" id="editor2"></textarea></td>
                          </tr>
                          <tr>
                            <th align="right" valign="top">注意事項</th>
                            <td><textarea name="notice" cols="100%" rows="20" id="editor3"></textarea></td>
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
