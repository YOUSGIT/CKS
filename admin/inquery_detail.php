<?php
$root="../";
require_once($root."_init.php"); 
define("F",'4');

$inq=new Inquery;	
$row=$inq->get_detail();
$product_arr=$inq->get_product_all();

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
				 <form action="func.php" method="post" enctype="multipart/form-data">
                 <input name="func" type="hidden" id="func" value="inq" />
                 <input name="doit" type="hidden" id="doit" value="renew" />
				 <input name="id" type="hidden" id="id" value="<?=$row['id'];?>" />
				 <input name="code" type="hidden" id="code" value="<?=$row['code'];?>" />
				 <input name="title" type="hidden" id="title" value="<?=$row['title'];?>" />
				 <input name="company" type="hidden" id="company" value="<?=$row['company'];?>" />
				 <input name="contact" type="hidden" id="contact" value="<?=$row['contact'];?>" />
				 <input name="email" type="hidden" id="email" value="<?=$row['email'];?>" />
				 <input name="tel" type="hidden" id="tel" value="<?=$row['tel'];?>" />
				 <input name="dates" type="hidden" id="dates" value="<?=$row['dates'];?>" />
				 <input name="content" type="hidden" id="content" value="<?=$row['content'];?>" />
                <div class="toolbar">                    	
                    <div class="group">
                        <input type="submit" value="儲存" class="button" />
                        
                    </div>
                </div>
              	<div class="module-detail">
                	<ul class="detail-tag">
                        <li><a href="#inquery" class="active">詳細詢價紀錄</a></li>                         
                  	</ul>
                	<div class="detail-container">                    	
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="detail">
                   	    <tr>
                   	      <th width="100" align="right">編號</th>
                   	      <td><?=$row['code'];?></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">主題</th>
                   	      <td><?=$row['title'];?></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">公司名稱</th>
                   	      <td><?=$row['company'];?></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">聯絡人</th>
                   	      <td><?=$row['contact'];?></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">E-Mail</th>
                   	      <td><a href="mailto:<?=$row['email'];?>"><?=$row['email'];?></a></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">電話</th>
                   	      <td><?=$row['tel'];?></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">詢價日期</th>
                   	      <td class="date"><?=$row['dates'];?></td>
               	        </tr>
                   	    <tr>
                   	      <th align="right">狀態</th>
                   	      <td>
                          	<select name="status">
								<option value="0" <?=($row['status']=="0")?"selected='selected'":"";?>>未處理</option>
								<option value="1" <?=($row['status']=="1")?"selected='selected'":"";?>>已處理</option>
           		            </select>
                          </td>
               	        </tr>
                   	    <tr>
                   	      <th align="right" valign="top">詢價內容</th>
                   	      <td><?=stripslashes(nl2br($row['content']));?></td>
               	        </tr>
						
                   	    <tr>
                   	      <th colspan="2" align="right">
						  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
                   	        <tr>
                   	          <th>商品圖片</th>
                   	          <th align="left">商品名稱</th>
                   	          <th align="center">商品型號</th>
                   	          <th align="left">商品簡介</th>
               	            </tr>
                   	        
               	          
               	        </tr>
						<?php 
							
							
							foreach($product_arr as $k	=>	$v){
								
								if(is_file(PD_Image.$product_arr[$k]['image']))
									$file=PD_Image.$product_arr[$k]['image'];
								else
									$file=IMAGES."default_80x80.jpg";
						?>
						<tr>
                   	          <td align="center"><a href="#id<?=$product_arr[$k]['id'];?>" class="delete" ><img src="<?=$file;?>" alt="" width="80" height="80" align="absmiddle" class="image" /></a></td>
                   	          <td><a href="#id<?=$product_arr[$k]['id'];?>" class="delete" ><?=$product_arr[$k]['title'];?></a></td>
                   	          <td align="center"><?=$product_arr[$k]['model'];?></td>
                   	          <td><?=stripslashes(nl2br(mb_substr($product_arr[$k]['content'],0,50,'utf-8'))).'...';?></td>
               	            </tr>
						<?php }
						
						?>
						</table></th>
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
