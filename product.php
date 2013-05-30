<?php 
require_once "./_init.php";
define("F",3);

$pd=new Product;
$row=$pd->get_detail_front();
$crumbs=$pd->crumbs_front();

$_REQUEST['myParent']=$row['id'];

$pdi=new Product_image;
$ret_i=$pdi->get_all();

$pdc=new Product_color;
$ret_c=$pdc->get_all();

$pdp=new Product_package;
$ret_p=$pdp->get_all();

$pds=new Product_spec;
$ret_s=$pds->get_all();
?>
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
<script type="text/javascript" src="script/cart.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('.detail-photo A').lightBox();
		$('.packing-list A').lightBox();
		$('.spec A').lightBox();
		

		
		$('.slideshow').cycle({ 
			fx:     'fade', 
			speed:   500, 
			next:   '.slideshow', 
			timeout: 0, 
			pause:   2,
			pager:  '.detail-content .pager',
			pagerAnchorBuilder: function(index, element) {
				return $(".detail-content .pager A:eq("+(index)+")");
			},
			onPagerEvent:function(zeroBasedSlideIndex, slideElement){ 
				$('.detail-photo A').prop("href",$(slideElement).prop("src"));
			}
		});
		
		
		
    });
	
	
	
</script>

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
                        <li class="home"><a href="#">HOME</a></li>
						<li class="catalog"><a href="catalog.php">PRODUCTS</a></li>
							<?php
							$i=0;
							foreach($crumbs as $k => $v){	
								if($i==0){?>
							
								<li class="scatalog"><a href="bcatalog.php?myParent=<?=$v;?>"><?=$k;?></a></li>
						<?php	 }else{?>
								<li class="scatalog"><a href="scatalog.php?myParent=<?=$row['parent'];?>"><?=$k;?></a></li>
						<?php }
								$i++;
							}?>
                        <?php include_once "./inc/search_input.inc.php";?>
                    </ul>
                </div>
            </div>
            <div class="span-col">
                <div class="left-col">
                    <ul class="catalog-list">
                        <?=$pd->get_menu_front();?>
                    </ul>
                    
                    <div class="inquiry-cart">
                    	<?php include_once	"./inc/cart.inc.php";?>                                
                           
                    </div>
                    
                   
                    
                </div>
                <div class="right-col">
                	<div class="product-detail">
                   	  	<div class="detail-photo">
	                        <?php 
								if(is_file(PD_Image.'ss_'.$row['image']))
									$file=PD_Image.'ss_'.$row['image'];
								else
									$file=IMAGES."default_600x600.jpg";?>
							<a href="<?=$file;?>">
    	                   		<div class="detail-photo-contianer"><div class="detail-photo-zoom"></div></div>
                                <div class="slideshow">
								<?php 
								if(count($ret_i)>0){
									foreach($ret_i as $k=>$v){ 
										if(is_file(PD_Image.'ss_'.$ret_i[$k]['image'])){
												$file=PD_Image.'ss_'.$ret_i[$k]['image'];?>
									<div class="pc" valign="center"><img src="<?=$file;?>" width="330" border="0" align="absmiddle" /></div>
								<?php 	}
									}
								}else{?>
									<div class="pc" valign="center"><img src="<?=$file;?>" width="330" border="0" align="absmiddle" /></div>
								<?php }?>
                                </div>
							</a>
							
							
						</div>
                      <div class="detail-content">
	                        <div class="title"><?=stripslashes(($row['title']));?></div>
                            <div class="no"><?=stripslashes(($row['model']));?></div>
                            <div class="info"><?=stripslashes(nl2br($row['content']));?></div>
                            <div class="thumb pager">
                            	<?php foreach($ret_i as $k=>$v){ 
											if(is_file(PD_Image.'s_'.$ret_i[$k]['image'])){
												$file=PD_Image.'s_'.$ret_i[$k]['image'];
											//else
												//$file=IMAGES."default_50x50.jpg";?>
									<a href="#<?=$k;?>" <?=($k==0)?'class="activeSlide"':'';?>><img src="<?=$file;?>" width="50" height="50" border="0" /></a>
								<?php 	}	
										}?>
                                                  
                          	</div>
                            <div class="color">
                            	<h3>Color</h3>
								<?php foreach($ret_c as $k=>$v){ ?>
									<div style="background-color:<?=$ret_c[$k]['color'];?>;"></div>
								<?php }?>
                          	</div>
                            <div class="spec">
                            	<h3>Specification</h3>
                            	<div class="thumb">
								<?php foreach($ret_s as $k=>$v){ 
										 if(is_file(SPEC_Image.'ss_'.$ret_s[$k]['image'])){?>
                                    <a href="<?=SPEC_Image.'ss_'.$ret_s[$k]['image'];?>" title="<?=$ret_s[$k]['title'];?>"><img src="<?=SPEC_Image.$ret_s[$k]['image'];?>" width="30" height="30" border="0" /></a>
                                <?php }}?>
                                </div>
                          	</div>
                            <div class="packing">
                            	<h3>Packing</h3>
                            	<ul>
								<?php foreach($ret_p as $k=>$v){?>
                                	<li><a href="#packing"><?=$ret_p[$k]['title'];?></a></li>
								<?php }?>
                                    
                                </ul>
                          	</div>
                            
                            <div class="action">
                            	<a href="javascript:addcart(<?=$row['id'];?>);" class="add" ><span>Inquiry Cart</span></a>                               
                            </div>
						</div>
                        <div class="blank"></div>
                    </div>      
                    
                    
                    <div class="product-detail-content">
                    	<h1 class="pencil">PRODUCT <span class="normal">FEATURE</span></h1>
                        <div class="content">
							<?=stripslashes(nl2br($row['feature']));?>
                        </div>
                        
                        <h1 class="pencil">PRODUCT <span class="normal">SPECIFICATIONS</span></h1>
                        <div class="content">
                       	  <?=stripslashes(nl2br($row['spec']));?>
                        </div>
                        
                        <h1 class="pencil">NOTICE</h1>
                        <div class="content">
                       	  <?=stripslashes(nl2br($row['notice']));?>
					  </div>
                        
                      <h1 class="pencil">PACKING</h1>
                      
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="packing-list">
						<?php 
							foreach($ret_p as $k=>$v){
								if(is_file(PACK_Image.$ret_p[$k]['image']))
									$file=PACK_Image.$ret_p[$k]['image'];
								else
									$file=IMAGES."default_80x80.jpg";?>
								
									<tr>
									  <td width="50">
									  <a href="<?=$file;?>"><img src="<?=$file;?>" width="80" height="80" border="0" /></a>
									  </td>
										<td valign="middle">
										<a href="<?=$file;?>" name="packing"><?=$ret_p[$k]['title'];?></a>
										<div class="info"><?=stripslashes(nl2br($ret_p[$k]['content']));?></div>
									  </td>
									</tr>
                        <?php 
							}?>
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
