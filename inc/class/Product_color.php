<?php

class Product_color extends Product{
	
	//var $Crumbs_local;
	
	protected 	$post_arr = array();
	protected 	$file_arr = array();
	protected 	$del_arr;
	protected 	$limit 	= 2; //上傳檔案大小
	protected	$tbname = COLOR;
	protected	$tbname_product = PRODUCT;
	
	var $myParent 	= 	0;
	var	$is_sort	=	false;
	
	var	$back		=	'./product_detail_color.php?myParent=';
	var	$s_size		=	array("m"=>array("w"=>330,"h"=>330),"s"=>array("w"=>140,"h"=>140),"ss"=>array("w"=>600,"h"=>600));
	
	var	$is_image	=	false;
	var $list_this;
	var $detail_this;		
	var $layout;
	var $detail_id ; //編輯細節ID
	var $this_Page	= 	"product_detail.php";
	var $resize;
	
	var $myParent_parent; //此商品之父
	
	function __construct($debug	=	false){
				
		$this	->	post_arr	= 	(is_array($_POST))	?	$_POST	:	"";
		$this	->	del_arr		= 	(isset($_REQUEST['delid']))	?	$_REQUEST['delid']	:	"";
		$this	->	detail_id	=	(is_numeric($_GET['id']))	?	$_GET['id']	:	"";
		
		$parent	=	(is_numeric($_REQUEST['myParent']))	?	$_REQUEST['myParent']	:	$_REQUEST['parent'];
						
		$this	->	set_parent($parent);
				
		DB	::	__construct($debug);
		
		self::	myParent_parent();

		if(trim($this->tbname)!='')
			$this->set_field($this->tbname);
		
	}
	
	
	function get_all($parent = ""){
		
		$parent=(trim($parent)=='')?	$this->myParent :	$parent;
		
					
		//父類有父
		$this->list_this="select * from ".$this->tbname." where parent=".$parent." order by dates desc";
				
		return parent::get_list($this->list_this);
	
	}
	
	function myParent_parent(){
		
		$sql	=	"select parent from ".$this->tbname_product." where id=".$this->myParent;
		$ret	=	$this->get_list($sql,1);
		$this->myParent_parent	=	$ret['parent'];
		return $this->myParent_parent;
	
	}
	
	function get_menu(){
	
		return parent::get_menu(0,$this->myParent_parent);
		
	}
	
	function bc_crumbs(){
	
		return parent::bc_crumbs($this->myParent_parent);
	}
	##########################################################################
	
	function renew(){
					
		parent::renew();
		$this	->	back	=	"product_detail_color.php?myParent=".$this->myParent;		
		
	}
	
	
	function killu(){
		
		Superobj::killu();
		$this	->	back	=	"product_detail_color.php?myParent=".$this->myParent;		
	}
	
	function killall($parent){	//刪除整個商品時
	
		$ret=self::get_all($parent);
		
				
		foreach($ret as $k => $v)
				$this->del_arr[$ret[$k][$this->PK]]=$ret[$k][$this->PK];
			
		
		Superobj::killu();
		return;
			
	}
}

