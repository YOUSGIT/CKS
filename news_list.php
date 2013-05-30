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
			if(idx<5){
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
                        <li class="catalog"><a href="news.php">NEWS</a></li>
                        <li>News</li>
                        <?php include_once "./inc/search_input.inc.php";?>
                    </ul>
                </div>
            </div>
            <div class="span-col">            	
            	<div class="news">
                <h1 class="inquiry">NEWS</h1>
                  <div class="news-list">                   
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_news">
                      <?php $news=new News;
						$ret=$news->get_all();
						foreach($ret as $k => $v){?>
					  <tr>
                        <td <?=($k=='0')?'width="100"':'';?> rowspan="3" valign="top" class="news-photo">
						<a href="news_detail.php?id=<?=$ret[$k]['id'];?>">
						<?php 
							if(is_file(NEWS_Image.'s_'.$ret[$k]['image']))
								$file=NEWS_Image.'s_'.$ret[$k]['image'];
							else
								$file=IMAGES."default_150x96.jpg";?>
						<img src="<?=$file;?>" width="150" height="100" />
						</a>
						</td>
                        <td valign="top"><a href="news_detail.php?id=<?=$ret[$k]['id'];?>"><?=$ret[$k]['title'];?></a></td>
                      </tr>
                      <tr>
                        <td valign="top" class="date"><?=date('Y-m-d',strtotime($ret[$k]['dates']));?></td>
                      </tr>
                      <tr>
                        <td valign="top"><?=mb_substr(strip_tags(stripslashes($ret[$k]['content'])),0,200,'UTF-8');?><strong>...</strong></td>
                      </tr>
					  <?php }?>
					  
                  </table>
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
