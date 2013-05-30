<?php 
	if(trim($_POST['ajax'])	=='1'){
		require_once "../_init.php";
		$root_inc="../";
	}
	if(trim($_SESSION['sid'])=='')
		$_SESSION['sid']==session_id();
	
?>
<h1 class="cart">Inquiry Cart <?=($_SESSION['total']>0)?'( '.$_SESSION['total'].' )':'';?></h1>
                        <div class="bg">
                            <ul class="item" id="ajax_cart">
							

<?php	
	if(($_SESSION['total'])<1){
?>

		<li>Your inquiry cart is empty</li>
<?php			
}
	$total=0;
	$pd_cart=new Product;
	foreach(array_reverse($_SESSION[$_SESSION['sid']]) as $k => $v){
		
		if($v!=''){
			if($total>5)
				break;
			
	?>
								<li>
                                    <a href="product.php?id=<?=$v;?>">
									<?php 
										
										$row_cart=$pd_cart->get_detail_front($v);
										
										?>	
										<?php if(is_file($root_inc.PD_Image.$row_cart['image']))
												$file=PD_Image.$row_cart['image'];
											  else
												$file=IMAGES."default_50x50.jpg";
										
										?>
											
										<img src="<?=$file?>" width="50" height="50" />
										
                                        <div class="container">
                                            <div class="title"><?=$row_cart['title'];?></div>
                                            <div class="model"><?=$row_cart['model'];?></div>
                                        </div>
                                        <div class="blank"></div>
                                    </a>
                                </li>
	<?php 
			$total++;
		} 	
	}
	
	?>
	
	
</ul>                            
                        </div>
                        <div class="summary"><?php if($_SESSION['total']>0){?><a href="inquiry_cart.php">Check Out ></a><?php }?></div>