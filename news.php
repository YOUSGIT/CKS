<?php 
require_once "./_init.php";
define("F",2);


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
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".news-gallery .main:eq(0)").fadeIn();
		$(".news-gallery .nav A").click(function(){
			
			var idx = $(".news-gallery .nav A").index($(this));
			if(idx<5 && $(this).attr("class")!="more"){ //排除more
				$(".news-gallery .nav A").removeClass("active");
				$(this).addClass("active");
				$(".news-gallery .main").hide().eq(idx).fadeIn();
				return false;
			}
		});
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
                        <li class="home"><a href="#">HOME</a></li>
                        <li class="catalog"><a href="<?=this_Page;?>">NEWS</a></li>
                        <li>News</li>
                        <?php include_once "./inc/search_input.inc.php";?>
					</ul>
                </div>
            </div>
            <div class="span-col">            	
            	<div class="news">
                <h1 class="inquiry">NEWS</h1>
                  <div class="news-gallery">
				  <?php $news=new News;
						$ret=$news->get_front();
						foreach($ret as $k => $v){?>
							<div class="main">
								<a href="news_detail.php?id=<?=$ret[$k]['id'];?>" class="photo">
								<?php 
									if(is_file(NEWS_Image.$ret[$k]['image']))
										$file=NEWS_Image.$ret[$k]['image'];
									else
										$file=IMAGES."default_700x450.jpg";
								?>
								<img src="<?=$file;?>" width="700" height="450" /></a>                        
							  <a href="news_detail.php?id=<?=$ret[$k]['id'];?>" class="subject"><?=$ret[$k]['title'];?><div class="date"><?=date('Y-m-d',strtotime($ret[$k]['dates']));?></div></a>                        
								<div class="content"><?=(stripslashes($ret[$k]['content']));?></div>
							</div>
                    <?php	}?>
                    <ul class="nav">  
						<?php foreach($ret as $k => $v){?>
							<?php 
								if(is_file(NEWS_Image.'s_'.$ret[$k]['image']))
									$file=NEWS_Image.'s_'.$ret[$k]['image'];
								else
									$file=IMAGES."default_150x96.jpg";?>
							<li>
							<a href="#" <?=($k=='0')?'class="active"':'';?> style="background-image:url(<?=$file;?>)"></a>
							</li>
						<?php }?>
                        <li><a href="news_list.php" class="more">more..</a></li>                                                
                    </ul>
                    <div class="blank"></div>
                  </div>
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
