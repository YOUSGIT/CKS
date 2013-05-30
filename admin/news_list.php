<?php
$root="../";
require_once($root."_init.php"); 
define("F",'2');
define("FS",'1');
$news=new News();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator Template</title>
<link href="css/original/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script/admin.js"></script>
</head>

<body>
	<div class="header">    	
    	<?php include_once "inc/guide.inc.php";?>
       
        <div class="toolbar">
        	<div class="group">
            	<input type="button" class="tool icon file-add-b" value="新增新聞" onclick="window.location='news_detail.php';" />
            </div>
            <div class="group">
            	<input type="button" class="tool icon file-delete-b" value="批次刪除" onclick="del_list('form1')"/>
            </div>
            <div class="blank"></div>
        </div>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
      <tr>
        <td class="left-panel-container">
        	<div class="left-panel">
            	<ul class="nav">
                	<li class="active">
                    	<a href="news_list.php" class="active">新聞列表</a>                        
                    </li>                                                                   
                </ul>
            </div>
        </td>
        <td class="left-panel-bar"><a id="leftPanelAdjust" href="#">&nbsp;</a></td>
        <td class="right-panel-container">
       	  	<div class="right-panel">
              	<ul class="crumb">
                   <?=$news->crumbs();?>
                </ul>
              	<div class="module-list">                	
               	  <table border="0" cellspacing="0" cellpadding="0" class="fix-title"></table>
                    <div class="list-container">
                    <form action="func.php" method="POST" id="form1" >
                        <input name="doit" type="hidden" value="del" />
                        <input name="func" type="hidden" value="news" />
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
                        	<tr class="fix-title-row">
                        	  <th width="30"><input type="checkbox" class="select-all" /></th>
                        	  <th width="50">編號</th>
                        	  <th align="left">新聞標題</th>
                        	  <th>建立日期</th>
                        	  <th>編輯</th>
                            </tr>                           	
                          <?php 
						   		 $ret=$news->get_all();

								 for($i=0;$i<count($ret);$i++){
						   ?>   
                          <tr>
                            <td width="30" align="center"><input name="delid[<?=$ret[$i]['id'];?>]" type="checkbox" class="select" id="delid[<?=$ret[$i]['id'];?>]" value="1" /></td>
                            <td width="50" align="center"><?=($i+1);?></td>
                            <td><a href="news_detail.php?id=<?=$ret[$i]['id'];?>"><?=$ret[$i]['title'];?></a></td>
                            <td width="200" align="center" class="date"><?=$ret[$i]['dates'];?></td>
                            <td width="100" align="center"><input type="button" value="編輯" class="button"  onclick="window.location='news_detail.php?id=<?=$ret[$i]['id'];?>';" /></td>
                          </tr>
                              <?php }?>
                        </table>
				  </form></div>
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
