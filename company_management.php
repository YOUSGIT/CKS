<?php 
require_once "./_init.php";
define("F",1);
define("FS",2);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CKS Stationery Corporation - Taiwan(TW)</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script/jquery.backgroundPosition.js"></script>
<script type="text/javascript" src="script/jquery.lightbox-0.5.min.js"></script>
<script type="text/javascript" src="script/jquery.cycle.all.js"></script>
<script type="text/javascript" src="script/global.js"></script>
<script type="text/javascript" src="script/search.js"></script></head>


<body>
	<div class="outer red">
    	<div class="header">
        	<div class="logo"><a href="index.php"><img src="images/header_logo.png" alt="CKS Stationery Corporation - Taiwan(TW)" width="152" height="68" border="0" /></a></div>
            <div class="guide">
            	<?php include_once	"./inc/guide.inc.php";?>
			</div>
          	<ul class="globalnav">
            	<?php include_once	"./inc/menu.inc.php";?>
            </ul>
        </div>
        <div class="body">
        	<div class="news-cycle">
            	<?php include_once	"./inc/news_front.inc.php";?>               
            </div>
        	<div class="crumb">
            	<div class="bt">
                    <ul>
                        <li class="home"><a href="#">HOME</a></li>
                        <li class="catalog"><a href="#">COMPANY</a></li>
                        <li>Company Management</li>
                        <?php include_once "./inc/search_input.inc.php";?>
                    </ul>
                </div>
            </div>
            <div class="span-col">
                <div class="left-col">
                    <ul class="catalog-list">
                        <?php include_once	"./inc/company_menu.inc.php";?>
                    </ul>
                    
                </div>
                <div class="right-col">
                	<h1 class="inquiry">MANAGEMENT</h1>
                    <div class="static-content">
                      <table width="100%" border="0" class="table_normal">
                      	<caption>MANAGEMENT</caption>
                        <tr>
                          <td>R&D department is responsible for R&D of new products and development of other products.</td>
                          <td><span class="photo"><img src="web_files/company/324243manager.jpg" width="180" height="105" /><span class="info">R&amp;D Department</b></span></span></td>
                        </tr>
                        <tr>
                          <td>Automatic lathe,processing production,mould parts Automatic.</td>
                          <td><span class="photo"><img src="web_files/company/324244manager.jpg" alt="" width="180" height="105" /><span class="info">Automatic Lathe</b></span></span></td>
                        </tr>
                        <tr>
                          <td>Adopting modern printing setting with modern equipments.</td>
                          <td><span class="photo"><img src="web_files/company/324246manager.jpg" alt="" width="180" height="105" /><span class="info">Adopting Modern Printing</b></span></span></td>
                        </tr>
                        <tr>
                          <td>Inject the plastic into blowing mould machine, melt it in high temperature ,then cool it into shape.</td>
                          <td><span class="photo"><img src="web_files/company/324247manager.jpg" alt="" width="180" height="105" /><span class="info">Blowing</b></span></span></td>
                        </tr>
                        <tr>
                          <td>Production line adopting series of automatic facilities, with modern equipments</td>
                          <td><span class="photo"><img src="web_files/company/324248manager.jpg" alt="" width="180" height="105" /><span class="info">Automatic Facilities</b></span></span></td>
                        </tr>
                        <tr>
                          <td>Mould department is responsible for transforming new products into mould</td>
                          <td><span class="photo"><img src="web_files/company/324249manager.jpg" alt="" width="180" height="105" /><span class="info">Mould Department</b></span></span></td>
                        </tr>
                        <tr>
                          <td>Injection mould machine makes materials into finished products</td>
                          <td><span class="photo"><img src="web_files/company/324250manager.jpg" alt="" width="180" height="105" /><span class="info">Injection Mould Machine</b></span></span></td>
                        </tr>
                      </table>
                    	
                    </div>
                    
              </div>
	            <div class="blank"></div>
            </div>

        </div>
        
        <div class="footer">
        	<div class="logo"><img src="images/footer_logo.png" width="72" height="22" /></div>
            <div class="info">TEL: +886 (02) 26105566 | Fax: +886 (02) 26101919 | E-Mail: sales@cks.com.tw</div>
            <div class="copyright">CKS Stationery Corporation © 2012</div>
        </div>
    </div>
</body>
</html>
