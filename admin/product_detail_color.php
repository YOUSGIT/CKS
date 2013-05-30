<?php
$root="../";
require_once($root."_init.php"); 
define("F",'3');
define("FS",'3');

$pd=new Product_color;
$ret=$pd->get_all();
$parent=$_GET['myParent'];

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator Template</title>
<link href="css/original/admin.css" rel="stylesheet" type="text/css" />
<link href="css/colorpicker/jquery.colorpicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script/jquery.colorpicker.js"></script>
<script type="text/javascript" src="script/admin.js"></script>
<script type="text/javascript">
	    $(document).ready(function(){
		
			$('#colorPicker').colorPicker(
			{			
			  defaultColor:100, // index of the default color
			  columns:13,     // number of columns 
			  click:function(c){
			    $('#hfSelectColor').val(c);
			  }
			});
			
		}); 
</script>
<style type="text/css">
.color A{
	width:45px;
	height:45px;
	display:inline-block;
	border:solid 1px #333;
}
</style>
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
                 <input name="func" type="hidden" id="func" value="pdc" />
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
                   	      <th width="100" align="right">新增顏色</th>
                   	      <td><span id="colorPicker"></span><input id="hfSelectColor" type="hidden" name="color"/>
						  <!--<input type="submit" value="新增顏色" class="button" style="margin-top:10px;" />--></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">目前顏色</th>
                   	      <td class="color">
						  <?php for($i=0;$i<count($ret);$i++){ ?>
                          	<a href="func.php?doit=del&func=pdc&myParent=<?=$ret[$i]['parent'];?>&delid=<?=$ret[$i]['id'];?>" onclick="return confirm('確認刪除?')" class="delete" style="background-color:<?=$ret[$i]['color'];?>;">&nbsp;<span class="text">移除</span></a>
                            
							<?php }?>
                          </td>
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
