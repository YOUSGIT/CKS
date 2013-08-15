<?php 
require_once "./_init.php";
//define("F",3);



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
<script type="text/javascript" src="script/cart.js"></script>
<script type="text/javascript" src="script/search.js"></script></head>


<body>
	<div class="outer">
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
                        <li>INQUIRY CART</li>
                        <?php include_once "./inc/search_input.inc.php";?>
                    </ul>
                </div>
            </div>
            <div class="span-col">
           	  <div class="inquiry-cart-detail">
       	    	<h1 class="cart">INQUIRY <span class="normal">CART</span></h1>
       	    	<table border="0" cellspacing="0" cellpadding="0" class="inquiry-step">
       	    	  <tr>
       	    	    <td class="step1 active">&nbsp;</td>
       	    	    <td class="step2">&nbsp;</td>
       	    	    <td class="step3">&nbsp;</td>
   	    	      </tr>
   	    	    </table>
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <th colspan="2" align="left">Items to inquiry now</th>
                          <th>&nbsp;</th>
                    </tr>
					<?php 
						$total=0;
						$pd_cart=new Product;
						foreach(array_reverse($_SESSION[$_SESSION['sid']]) as $k => $v){
		
							if($v!=''){
								$total++;
								
								$row_cart=$pd_cart->get_detail_front($v);?>
					   <tr>
                          <td width="50">
							<?php if(is_file(PD_Image.$row_cart['image']))
									$file=PD_Image.$row_cart['image'];
								  else
									$file=IMAGES."default_50x50.jpg";
							?>
                          	<img src="<?=$file;?>" width="50" height="50" class="product-photo" />
                          </td>
                          <td valign="middle">
                            <a href="product.php?id=<?=$row_cart['id'];?>" class="caption"><?=$row_cart['title'];?></a>
                            <div class="no"><?=$row_cart['model'];?></div></td>
                          <td width="100" align="center"><a href="javascript:removecart(<?=$row_cart['id'];?>);" class="sbutton">DELETE</a></td>
						</tr>
                     <?php }
						}
						
						$_SESSION['total']=$total;
						?>  
                        <tr>
                          <td colspan="3" align="right" class="summary">
						  <?php if($_SESSION['total']>0){?><a href="inquiry_shipping.php" class="bbutton">Continue ></a><?php }?>
						  </td>
                        </tr>
                </table>
                
              </div>              
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
