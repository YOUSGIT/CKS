<?php 
require_once "./_init.php";
define("F",4);
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
<script type="text/javascript" src="script/jquery.validate.js"></script>
<script type="text/javascript" src="script/search.js"></script>
<script>
	function submit_contact(){
		
		$("#contact").submit();
		
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

		$("#contact").validate();

	});
</script>
</head>


<body>
	<div class="outer blue">
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
                        <li class="catalog"><a href="#">CONTACT</a></li>
                        <?php include_once "./inc/search_input.inc.php";?>
                    </ul>
                </div>
            </div>
            <div class="span-col">
           	  <div class="inquiry-cart-detail">
       	    	<h1 class="inquiry">CONTACT <span class="normal">US</span></h1>
				<form id="contact" action="inc/mail_contact.php" method="POST">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                          <th colspan="2" align="left">Send us your questions or comments</th>
                    </tr>
                        <tr>
                          <td width="150" align="right"> Name:</td>
                          <td valign="middle"><input name="name" type="text" id="name" size="50" class="required"/></td>
                    </tr>
                        <tr>
                          <td align="right"><span class="notranslate"> Business Name</span>:</td>
                          <td valign="middle"><label for="textarea"></label>
                          <input name="Business" type="text" id="Business" size="50" /></td>
                        </tr>
                        <tr>
                          <td align="right"><span class="notranslate"> Telephone</span>: </td>
                          <td valign="middle"><input name="Telephone" type="text" id="Telephone" size="30" /></td>
                        </tr>
                        <tr>
                          <td align="right"> Fax:</td>
                          <td valign="middle"><input name="Fax" type="text" id="Fax" size="30" /></td>
                        </tr>
                        <tr>
                          <td align="right"> E-Mail Address: </td>
                          <td valign="middle"><input name="email" type="text" id="email" size="50" class="required"/></td>
                        </tr>
                        <tr>
                          <td align="right">Subject:</td>
                          <td valign="middle"><input name="Subject" type="text" id="Subject" size="70" class="required"/></td>
                        </tr>
                        <tr>
                          <td align="right">Comments:</td>
                          <td valign="middle"><label for="Comments"></label>
                          <textarea name="Comments" id="Comments" cols="45" rows="5" class="required"></textarea></td>
                  </tr>
                        <tr>
                          <td colspan="5" align="right" class="summary"><a href="javascript:submit_contact();" class="bbutton">Continue ></a></td>
                        </tr>
                </table>
                </form>
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
