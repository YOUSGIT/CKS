<?php 
require_once "./_init.php";
define("F",3);

$bc=new Catalog;

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
	<div class="outer green">
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
                        <li class="home"><a href="./">HOME</a></li>                        
                        <li class="catalog"><a href="catalog.php">PRODUCTS</a></li>
                        <?php include_once "./inc/search_input.inc.php";?>
                    </ul>
                </div>
            </div>
            <div class="span-col">
                <div class="left-col">
                    <ul class="catalog-list">
                        <?=$bc->get_menu_front();?>
                    </ul>
                    
                  	<div class="inquiry-cart">
                    	<?php include_once	"./inc/cart.inc.php";?>                                
                           
                    </div>
                    
                   
                    
                </div>
                <div class="right-col">                	                	                    
                    <div class="catalog-product-block">     
						<?php 
						 $ret=$bc->get_all_front();
						 $ret_n=$bc->num_row();
						 foreach($ret as $k =>	$v){?>
						   				
                   	  	<div class="catalog-banner">
                        	<h1 class="product"><?=$ret[$k]['title'];?></h1>
                        	<a href="bcatalog.php?myParent=<?=$ret[$k]['id'];?>">
                        	<div class="container"></div>
                            <?php 
							if(is_file(BC_Image.$ret[$k]['image']))
								$file=BC_Image.$ret[$k]['image'];
							else
								$file=IMAGES."default_620x140.jpg";
							?>
							<img src="<?=$file;?>" width="620" height="140" border="0" />
                            </a>
                        </div>
						<?php } ;?>
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
