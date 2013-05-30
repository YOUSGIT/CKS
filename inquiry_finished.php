<?php 
require_once "./_init.php";
//define("F",3);

if($_POST && count($_SESSION[$_SESSION['sid']])>0	){

	$func=new Inquery;
	$func->renew();
	
	$pd=new	Product;
	foreach($_SESSION[$_SESSION['sid']] as $k => $v)
	{
		if($v!=''){
			$ret=$pd->get_detail_inq($v);
			
			foreach($ret as $k2	=>	$v2){
				$_POST['inq'][$v][$k2]=$v2;
				$_POST['inq'][$v]['parent']=$_POST['code'];
			}
			
			$func->renew_inqp($_POST['inq'][$v]);
		}
	}
	
	
	session_destroy();

}else
	header("location: ./");
	
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
                        <li>Inquiry Cart</li>
                        <?php include_once "./inc/search_input.inc.php";?>
                    </ul>
                </div>
            </div>
            <div class="span-col">
           	  <div class="inquiry-cart-detail">
       	    	<h1 class="cart">INQUIRY <span class="normal">CART</span></h1>
                <table border="0" cellspacing="0" cellpadding="0" class="inquiry-step">
                      <tr>
                        <td class="step1">&nbsp;</td>
                        <td class="step2">&nbsp;</td>
                        <td class="step3 active">&nbsp;</td>
                      </tr>
                    </table>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <th colspan="2" align="left">Mail Sent</th>
                    </tr>
                        <tr>
                          <td colspan="2" align="right">&nbsp;</td>
                    </tr>
                </table>
                <h1 class="pencil">NOTICE</h1>
                <p>The price and availability of items at Amazon.com are subject to change. The Inquiry Cart is a temporary place to store a list of your items and reflects each item's most recent price. <a href="http://www.amazon.com/exec/obidos/tg/browse/-/468468/pop-up/ref=ord_cart_lm" target="AmazonHelp" onclick="return amz_js_PopWin('/exec/obidos/tg/browse/-/468468/pop-up/ref=ord_cart_lm','AmazonHelp','width=340,height=340,resizable=1,scrollbars=1,toolbar=1,status=1');">Learn more</a></p>
                <p>Do you have a gift card or promotional code? We'll ask you to enter your claim code when it's time to pay.</p>
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
<?php
	$out_finish = ob_get_contents();
	ob_end_clean();
	
	ob_start();
	include_once	("./inc/mail_inquiry_client.inc.php");
	$_POST['name']=$_POST['contact'];
	$_POST['Subject']=$_POST['title'];
	include	("./inc/mailer.inc.php");
	
	
	ob_start();
	include_once	("./inc/mail_inquiry_server.inc.php");
	$_POST['email']=$hostemail;
	$_POST['name']=$hostname;
	include	("./inc/mailer.inc.php");
	
	echo $out_finish;