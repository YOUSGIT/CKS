<?php 
require_once "./_init.php";
//define("F",3);

if($_SESSION['total']<1)
	header("location: ./");
	
$code=mt_rand(1,9).date('U');

$product=null;

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
<script type="text/javascript" src="script/jquery.validate.js"></script>
<script type="text/javascript" src="script/global.js"></script>
<script>
	function submitcart(){
		
		$("#inqcart").submit();
		
		return;
	}
/*
$.validator.setDefaults({
	submitHandler: function() { //alert("submitted!");
		$("#inqcart").submit();
	}
});
*/
	$(function(){

		$("#inqcart").validate();

	});
</script>
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
                        <li class="catalog"><a href="./catalog.php">PRODUCTS</a></li>
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
                        <td class="step2 active">&nbsp;</td>
                        <td class="step3">&nbsp;</td>
                      </tr>
                    </table>
				<form id="inqcart" action="inquiry_finished.php" method="POST">
				<input name="code" type="hidden" id="code" value="<?=$code;?>" />
                <input name="status" type="hidden" id="status" value="0" />
				<input name="product" type="hidden" id="product" value="<?=$product;?>" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				 
                        <tr>
                          <th colspan="2" align="left">Inquiry Infomations</th>
                    </tr>
                        <tr>
                          <td width="150" align="right">Subject:</td>
                          <td valign="middle"><input name="title" type="text" id="title" size="50" class="required"/></td>
                    </tr>
                        <tr>
                          <td align="right">Messages:</td>
                          <td valign="middle"><label for="content"></label>
                          <textarea name="content" id="content" cols="45" rows="5" class="required"></textarea></td>
                        </tr>
                        <tr>
                          <td align="right">Company Name: </td>
                          <td valign="middle"><input name="company" type="text" id="company" size="50" class="required"/></td>
                        </tr>
                        <tr>
                          <td align="right">Contact Name:</td>
                          <td valign="middle"><input name="contact" type="text" id="contact" size="30" class="required"/></td>
                        </tr>
                        <tr>
                          <td align="right">E-Mail: </td>
                          <td valign="middle"><input name="email" type="text" id="email" size="50" class="required"/></td>
                        </tr>
                        <tr>
                          <td align="right">Tel:</td>
                          <td valign="middle"><input name="tel" type="text" id="tel" size="30" /></td>
                        </tr>
                        <tr>
                          <td colspan="5" align="right" class="summary"><a href="inquiry_cart.php" class="bbutton">< Back</a><a href="javascript:submitcart();" class="bbutton" >Finished ></a></td>
                        </tr>
						
                </table></form>
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
