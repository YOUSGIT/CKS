<?php 
require_once "./_init.php";
define("F",0);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script>
	$(document).ready(function(e) {
		$('.slideshow').cycle({ 
			fx:     'fade', 
			speed:   500, 			
			pause:   1,
			pager:  '#banner_pager'
			});        
		//$('#banner_pager').text('');
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
          <div class="banner">
			<div class="slideshow">
			<?php 
				$slide=new Banner;
				$ret=$slide->get_all();	
				
				foreach($ret as $k	=>	$v){?>
					
					<?php if(is_file(ADM_Image.$ret[$k]['image'])){ ?>
                	<a href="<?=$ret[$k]['link'];?>"><img src="<?=ADM_Image.$ret[$k]['image'];?>" width="1000" height="600" /></a>
					<?php }?>
			<?php }?>
                </div>                         	  	
            </div>
            <div id="banner_pager"></div>              
        </div>
        
        <div class="footer">
        	<div class="logo"><img src="images/footer_logo.png" width="72" height="22" /></div>
            <div class="info">TEL: +886 (02) 26105566 | Fax: +886 (02) 26101919 | E-Mail: sales@cks.com.tw</div>
            <div class="copyright">CKS Stationery Corporation © 2012</div>
        </div>
    </div>
</body>
</html>
