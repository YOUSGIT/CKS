<?php
$root="../";
require_once($root."_init.php"); 
define("F",'3');
define("FS",'1');

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
		
		$("#form1").hide().fadeIn("fast");
		$(window).bind('beforeunload',function(){ 
			$("#form1").fadeOut("fast");
});
		});</script>
</head>

<body>
	<div class="header">    	
    	<?php include_once "inc/guide.inc.php";?>
               
        <div class="toolbar">
        	<div class="group">
            	<input type="button" class="tool icon folder-add-b" value="新增大分類" onclick="window.location='product_bcatalog_detail.php';" />
            </div>
            <div class="group">
            	<input type="button" class="tool icon folder-delete-b" value="批次刪除" onclick="del_list('form1')"/>
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
                   <?=$bc->crumbs();?>
                </ul>
              	<div class="module-list">                	
               	  <table border="0" cellspacing="0" cellpadding="0" class="fix-title"></table>
                    <div class="list-container">
                   		<form action="func.php" method="POST" id="form1" >
                        <input name="doit" type="hidden" value="del" />
                        <input name="func" type="hidden" value="bc" />
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
                        	<tr class="fix-title-row">
                        	  <th width="30"><input type="checkbox" class="select-all" /></th>
                        	  <th width="50">編號</th>
                        	  <th align="center">分類圖片</th>
                        	  <th align="left">大分類名稱</th>
                        	  <th>順序</th>
                                <th>編輯</th>
                            </tr>                           	
                         <?php 
						   		 $ret=$bc->get_all();
								 $ret_n=$bc->num_row();
								 for($i=0;$i<count($ret);$i++){
						   ?>   
                          <tr class="alt">
                            <td align="center"><input name="delid[<?=$ret[$i]['id'];?>]" type="checkbox" class="select" id="delid[<?=$ret[$i]['id'];?>]" value="1" /></td>
                            <td align="center"><?php $nid=sprintf("%05d",$ret[$i]['id']); echo $nid;?></td>
                            <td align="center"><?php if(is_file(BC_Image."s_".$ret[$i]['image'])){?>
                            <img src="<?=BC_Image."s_".$ret[$i]['image'];?>"  class="image" /><?php }?></td>
                            <td><a href="product_catalog.php?myParent=<?=$nid;?>"><?=$ret[$i]['title'];?></a></td>
                            <td width="150" align="center">
                             <?php if($i!=0){?>
                				<input type="button" value=" " class="button icon up-s" onclick="window.location='func.php?sequid=<?=$ret[$i]['sequ'];?>&doit=move&move=up&func=bc'"/><?php }
								   if($i<($ret_n-1)){ ?>
                            	<input type="button" value=" " class="button icon down-s" onclick="window.location='func.php?sequid=<?=$ret[$i]['sequ'];?>&doit=move&move=down&func=bc'"/><?php }?>
							</td>
                            <td width="100" align="center"><input type="button" value="編輯" class="button"  onclick="window.location='product_bcatalog_detail.php?id=<?=$nid;?>';" /></td>
                          </tr>    
                          <?php } ?>                      
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
