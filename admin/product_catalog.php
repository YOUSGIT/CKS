<?php
$root="../";
require_once($root."_init.php"); 
define("F",'3');

$bc=new Catalog;	

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
			
		$("#sale_f").change(function(){
				
			window.location='<?=$bc->this_Page;?>?myParent=<?=$bc->myParent;?>&sale='+$(this).val();
			
		});
	
			
		$("#form1").hide().fadeIn("fast");
		$(window).bind('beforeunload',function(){ 
			$("#form1").fadeOut("fast");
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
            <div class="group">
            	<input type="button" class="tool icon folder-delete-b" value="批次刪除" onclick="del_list('form1')"/>
                <input type="button" class="tool icon sale-on-b" value="批次上架" onclick="sale_list('form1','1')"/>
                <input type="button" class="tool icon sale-off-b" value="批次下架" onclick="sale_list('form1','0')"/>
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
                <div class="toolbar">                    	
                    <div class="group">
                    篩選狀態
                    <select name="sale_f" id="sale_f">
					<option>全部</option>
					<option value="1" <?=($_GET['sale']=="1")?"selected='selected'":"";?>>上架</option>
					<option value="0" <?=($_GET['sale']=="0")?"selected='selected'":"";?>>下架</option></select>
                    </div>
                </div>
                
              	<div class="module-list">                	
               	  <table border="0" cellspacing="0" cellpadding="0" class="fix-title"></table>
                    <div class="list-container">
                    <form action="func.php" method="POST" id="form1" >
                        <input name="doit" type="hidden" value="del" />
                        <input name="func" type="hidden" value="bc" />
						<input name="sale" type="hidden" value="" />
                        <input name="myParent" type="hidden" value="<?=$bc->myParent;?>" />
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
                        	<tr class="fix-title-row">
                        	  <th width="30"><input type="checkbox" class="select-all" /></th>
                        	  <th align="center">大分類</th>
                        	  <th>圖片</th>
                        	  <th align="left">名稱</th>
                        	  <th>型號</th>
                        	  <th>建立日期</th>
                        	  <th>上／下架</th>
                        	  <th>順序</th>
                        	  <th>編輯</th>
                            </tr> 
                          <?php 
							 $ret=$bc->join_list();
							 $ret_n=$bc->num_row();
							 for($i=0;$i<count($ret);$i++){
						   ?>                             	
                          <tr class="folder">
                            <td width="30" align="center"><input name="delid[<?=$ret[$i]['id'];?>]" type="checkbox" class="select" id="delid[<?=$ret[$i]['id'];?>]" value="1" /></td>
                            <td width="150" align="center"><?=$ret[$i]['bctitle'];?></td>
                            <td width="200" align="center"><?php if(is_file(BC_Image."s_".$ret[$i]['image'])){?>
                            <img src="<?=BC_Image."s_".$ret[$i]['image'];?>"  class="image" /><?php }?></td>
                            <td width="70"><a href="product_list.php?myParent=<?=$ret[$i]['id'];?>" class="icon folder-s"><?=$ret[$i]['title'];?></a></td>
                            <td width="200">&nbsp;</td>
                            <td width="100" align="center"><?=$ret[$i]['dates'];?></td>
                            <td width="70" align="center"><?=($ret[$i]['sale']=='1')?'上架':'下架';?></td>
                            <td width="150" align="center">
                            	 <?php if($i!=0){?>
                				<input type="button" value=" " class="button icon up-s" onclick="window.location='func.php?sequid=<?=$ret[$i]['sequ'];?>&doit=move&move=up&func=bc&myParent=<?=$bc->myParent;?>'"/><?php }
								   if($i<($ret_n-1)){ ?>
                            	<input type="button" value=" " class="button icon down-s" onclick="window.location='func.php?sequid=<?=$ret[$i]['sequ'];?>&doit=move&move=down&func=bc&myParent=<?=$bc->myParent;?>'"/><?php }?>
                            </td>
                            <td width="200" align="center">
                            	<input type="button" value="編輯分類" class="button"  onclick="window.location='product_catalog_detail.php?id=<?=$ret[$i]['id'];?>';" /><!--
                                <input type="button" value="刪除分類" class="button" />-->
                            </td>
                          </tr>
                          <?php  }
						  
						  $pd=new Product;
						  $ret=$pd->get_all();
						  for($i=0;$i<count($ret);$i++){
						  ?>
                         <tr class="alt">
                            <td align="center"><input name="delid_product[<?=$ret[$i]['id'];?>]" type="checkbox" class="select" id="delid_product[<?=$ret[$i]['id'];?>]" value="1" /></td>
                            <td align="center"><?=$ret[$i]['cctitle'];?></td>
                            <td align="center"><?php if(is_file(PD_Image."s_".$ret[$i]['image'])){?>
                            <img src="<?=PD_Image."s_".$ret[$i]['image'];?>"  class="image" /><?php }?></td>
                            <td><a href="product_detail.php?id=<?=$ret[$i]['id'];?>"><?=$ret[$i]['title'];?></a></td>
                            <td><?=$ret[$i]['model'];?></td>
                            <td align="center" class="date"><?=date('Y-m-d',strtotime($ret[$i]['dates']));?></td>
                            <td align="center"><?=($ret[$i]['sale']=='1')?"上架":"下架";?></td>
                            <td align="center">&nbsp;</td>
                            <td width="100" align="center" class="folder"><input type="button" value="編輯" class="button"  onclick="window.location='product_detail.php?id=<?=$ret[$i]['id'];?>';" />
							<input type="button" value="複製" class="button" onclick="window.location='func.php?func=pd&doit=copy&id=<?= $ret[$i]['id']; ?>';" /></td>
                          </tr>
                           <?php }?>               
                        </table>
                        </form>
				  </div>
                </div>
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
