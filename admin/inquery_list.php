<?php
$root="../";
require_once($root."_init.php"); 
define("F",'4');

$inq=new Inquery;	

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
			
		$("#status_f").change(function(){
				
			window.location='<?=$inq->this_Page;?>?status='+$(this).val();
			
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
            	<input type="button" class="tool icon folder-delete-b" value="批次刪除" onclick="del_list('form1')"/>        
            </div>
            <div class="group">
            	<input type="button" class="tool icon sale-off-b" value="完成" onclick="status_list('form1','1')"/>
                <input type="button" class="tool icon sale-on-b" value="未處理" onclick="status_list('form1','0')"/>
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
                    	<a href="inquery_list.php" class="active">客戶詢價紀錄</a>                        
                    </li>                                                                   
                </ul>
            </div>
        </td>
        <td class="left-panel-bar"><a id="leftPanelAdjust" href="#">&nbsp;</a></td>
        <td class="right-panel-container">
       	  	<div class="right-panel">
              	<ul class="crumb">
                    <?=$inq->crumbs();?>
                </ul>
                <div class="toolbar">                    	
                    <div class="group">
                    篩選狀態
					<select name="status_f" id="status_f">
						<option value="0" <?=($_GET['status']=="0")?"selected='selected'":"";?>>未處理</option>
						<option value="1" <?=($_GET['status']=="1")?"selected='selected'":"";?>>已處理</option>
						<option <?=($_GET['status']!="1" && $_GET['status']!="0")?"selected='selected'":"";?>>全部</option>
					</select>
                    </div>
                </div>
              	<div class="module-list">                	
               	  <table border="0" cellspacing="0" cellpadding="0" class="fix-title"></table>
                    <div class="list-container">
					 <form action="func.php" method="POST" id="form1" >
                        <input name="doit" type="hidden" value="del" />
                        <input name="func" type="hidden" value="inq" />
						<input name="status" type="hidden" value="" />
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
                        	<tr class="fix-title-row">
                        	  <th><input type="checkbox" class="select-all" /></th>
                        	  <th align="center">編號</th>
                        	  <th align="center">主題</th>
                        	  <th align="center">公司名稱</th>
                        	  <th>聯絡人</th>
                        	  <th align="left">E-Mail</th>
                        	  <th>電話</th>
                        	  <th>狀態</th>
                        	  <th>日期</th>
                        	  <th>詳細</th>
                            </tr>
						<?php 
							$ret=$inq->get_all();
							foreach($ret as $k	=>	$v){?>
						
                          <tr class="alt">
                            <td width="30" align="center"><input type="checkbox" class="select" id="delid[<?=$ret[$k]['id'];?>]" name="delid[<?=$ret[$k]['id'];?>]"/></td>
                            <td width="80" align="center"><a href="inquery_detail.php?id=<?=$ret[$k]['id'];?>"><?=$ret[$k]['code'];?></a></td>
                            <td align="center"><?=$ret[$k]['title'];?></td>
                            <td width="150" align="center"><?=$ret[$k]['company'];?></td>
                            <td width="100" align="center"><?=$ret[$k]['contact'];?></td>
                            <td width="150"><?=$ret[$k]['email'];?></td>
                            <td width="150"><?=$ret[$k]['tel'];?></td>
                            <td width="80" align="center"><?=($ret[$k]['status']=='1')?'已處理':'未處理';?></td>
                            <td width="150" align="center" class="date"><?=$ret[$k]['dates'];?></td>
                            <td width="100" align="center" class="folder"><input type="button" value="詳細" class="button"  onclick="window.location='inquery_detail.php?id=<?=$ret[$k]['id'];?>';" /></td>
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
