<?php 
	require_once "../../_init.php";
	
		
	$pi=new Product_image;
	
	$ret	=	array("ret"=>"");
	
	if($pi->active())
		$ret	=	array("ret"=>"ok");
	
	echo json_encode($ret);
	exit;