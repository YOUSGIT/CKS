<?php 
	$news_inc=new News;
	$ret_inc=$news_inc->get_front();
	foreach($ret_inc as $k	=>	$v){?>
	
		<div><a href="news_detail.php?id=<?=$ret_inc[$k]['id'];?>"><?=mb_substr($ret_inc[$k]['title'],0,192,'UTF-8').'...';?></a></div>
	
<?php }?>