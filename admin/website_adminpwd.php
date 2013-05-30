<?php
$root="../";
require_once($root."_init.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <form method="post" action="func.php">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
      <tr>
        <td class="left-panel-container">
        	<div class="left-panel">
            	<ul class="nav">
                	<li><a href="website_banner.php">首頁廣告設定</a></li>
                    <li><a href="website_adminpwd.php" class="active">管理者密碼</a></li>                                               
                </ul>
            </div>
        </td>
        <td class="left-panel-bar"><a id="leftPanelAdjust" href="#">&nbsp;</a></td>
        <td class="right-panel-container">
       	  	<div class="right-panel">
              	<ul class="crumb">
                    <li><a href="index.php" class="icon home-s">網站管理系統</a> ></li>
                    <li><a href="website_banner.php">網站管理</a> ></li>                    
                    <li>管理者密碼</li>
                </ul>
                <div class="toolbar">                    	
                    <div class="group">
                        <input type="submit" value="儲存" class="button" />
                        <!--<input type="button" value="取消" class="button" />-->
                    </div>
                </div>
                
                <div class="module-detail">
                	<ul class="detail-tag">
                        <li><a href="#" class="active">管理者密碼</a></li>                       
                    </ul>
                	<div class="detail-container">                    	
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="detail">
                          <tr>
                            <th width="100" align="right">原管理者密碼</th>
                            <td><input name="pw" type="password" size="40" /></td>
                          </tr>
                          <tr>
                            <th align="right">變更管理者密碼</th>
                            <td><input name="npw1" type="password" size="40" /></td>
                          </tr>
                          <tr>
                            <th align="right">確認管理者密碼</th>
                            <td><input name="npw2" type="password" size="40" /></td>
                          </tr>
                        </table>

                    </div>
                </div>
       	  	</div>
		</td>
      </tr>
    </table>
    <input type="hidden" name="func" value="password"/>
    </form>
    <div class="footer">
    	<span class="copyright">YOUS © 2012</span>
        <span class="vision"></span>
        <span class="nav"></span>
    </div>
</body>
</html>
