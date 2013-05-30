<?php

class Catalog extends Superobj{
	
	//var $Crumbs_local;
	var $crumbs = array("product_bcatalog.php"			=>array("商品管理"=>"product_bcatalog.php","商品大分類"=>""),
						"product_bcatalog_detail.php"	=>array("商品管理"=>"product_bcatalog.php","商品大分類"=>"product_bcatalog.php","編輯大分類"=>""),
						"product_catalog.php"			=>array("商品管理"=>"product_bcatalog.php","商品大分類"=>"product_bcatalog.php"),
						"product_catalog_detail.php"	=>array("商品管理"=>"product_bcatalog.php","商品大分類"=>"product_catalog.php?myParent=","編輯小分類"=>"")
					);
	protected 	$post_arr = array();
	protected 	$file_arr = array();
	protected 	$del_arr;
	protected	$del_product_arr; //商品
	protected 	$limit = 2; //上傳檔案大小
	protected	$sort_where = "parent=0";
	protected	$tbname = BC;
	var $myParent = 0;
	var	$is_sort=true;
	var	$sdir=BC_Image;
	var	$back='./product_bcatalog.php';
	var	$s_size		=	array("m"=>array("w"=>620,"h"=>1400),"s"=>array("w"=>155,"h"=>280));
	var	$ss_size	=	array("m"=>array("w"=>300,"h"=>1400),"s"=>array("w"=>155,"h"=>280)); //子分類縮圖
	var	$is_image=true;
	var $list_this;
	var $detail_this;		
	var $layout;
	var $detail_id ; //編輯細節ID
	var $this_Page= this_Page;
	var $resize;
	var $last_parent; //換分類之後，原先的父
	
	#########################################################################################
	
	function __construct($debug=false){
				
		$this->post_arr	= (is_array($_POST))	?	$_POST	:	"";
		$this->file_arr	= (is_array($_FILES))	?	$_FILES	:	"";
		$this->del_arr	= (isset($_REQUEST['delid']))	?	$_REQUEST['delid']	:	"";
		$this->del_product_arr	= (isset($_REQUEST['delid_product']))	?	$_REQUEST['delid_product']	:	"";
		$this->detail_id=	(is_numeric($_GET['id']))	?	$_GET['id']	:	"";
		$this->last_parent	=	$_POST['last_parent'];
		$parent	=	(is_numeric($_REQUEST['myParent']))	?	$_REQUEST['myParent']	:	$_REQUEST['parent'];
		
				
		$this->set_parent($parent);
			
		if((int)$this->myParent!=0){	//子分類
		
			$this->resize	=	$this->ss_size;
			$this->back	=	"product_catalog.php?myParent=".$this->myParent;	
			$this->sort_where="parent=".$this->myParent;
		}
		
		
		parent::__construct($debug);

		if(trim($this->tbname)!='')
			$this->set_field($this->tbname);
		
	}
	
	function set_parent($parent){
		
		if(is_numeric($parent))
			$this->myParent=$parent;
		
	
	}
	
	function get_all($parent = ""){
		
		$parent=(trim($parent)=='')?	$this->myParent :	$parent;
		
		$this->list_this="select * from ".$this->tbname." where parent=".$parent." order by sequ asc";
		
		return parent::get_list($this->list_this);
	
	}
	
	function get_detail($pk){

		$pk	=	(trim($pk)!='')	?	$pk	:	$this->detail_id;
		
		if(trim($pk)!='')
			$this->detail_this="select * from ".$this->tbname." where ".$this->PK."=".$pk;
		
		$ret=parent::get_list($this->detail_this,1);
		
		if($this->detail_id!='')
			$this->set_parent($ret['parent']);
		
		
		
		return $ret;
	
	}
	
	function get_menu($parent = 0,$active=0){
		
		$active= $this->myParent;
		$menu=self::get_all($parent);
		foreach($menu as $k => $v){
		
			$class=null;
			
			if($menu[$k]['parent']==0)
				$link='product_catalog';
			else
				$link='product_list';
			
			if($menu[$k]['id']==$active)
				$class=' active';
				
			$this->layout.='<li><a href="'.$link.'.php?myParent='.$menu[$k]['id'].'" class="icon folder-s'.$class.'">'.$menu[$k]['title'].'</a><ul class="sub-nav">';
							
			self::get_menu($menu[$k]['id']);
					
			$this->layout.='</ul></li>';
		}
		
		return $this->layout;
		
	}
	
	function bc_crumbs($parent=""){ //子分類麵包屑
		
		$parent	= $this->myParent;
		$menu=$this->get_detail($parent);
		$this->crumbs['product_catalog.php'][$menu['title']]='';
		$this->crumbs['product_catalog_detail.php']['商品大分類']	=	$this->crumbs['product_catalog_detail.php']['商品大分類'].$menu['id'];
		return parent::crumbs($this->this_Page);
	
	}

	function crumbs(){
		
		return parent::crumbs($this->this_Page);
	}
	
	function join_list(){	//子分類顯示用
	
		if(is_numeric($_GET['sale']))
			$sale=" and a.sale='".$_GET['sale']."'";
			
		$this->join_list="select a.*,b.title as bctitle from ".$this->tbname." as a left join ".$this->tbname." as b on a.parent = b.id where a.parent =".$this->myParent." ".$sale." order by a.sequ asc";
		
		return parent::get_list($this->join_list);
		
	}
	##########################################################################前台
	
	function get_all_front($parent = ""){
		
		$parent=(trim($parent)=='')?	$this->myParent :	$parent;
		
		$this->list_this="select * from ".$this->tbname." where parent=".$parent." and sale='1'	order by sequ asc";
		
		return parent::get_list($this->list_this);
	
	}
	
	function join_list_front(){	//子分類顯示用
				
		$this->join_list="select a.*,b.title as bctitle from ".$this->tbname." as a left join ".$this->tbname." as b on a.parent = b.id where a.parent =".$this->myParent." and a.sale='1' order by a.sequ asc";
		
		return parent::get_list($this->join_list);
		
	}
	
	function get_detail_front($pk){

		$pk	=	(trim($pk)!='')	?	$pk	:	$this->myParent;
		
		if(trim($pk)!='')
			$this->detail_this="select * from ".$this->tbname." where ".$this->PK."=".$pk." and sale='1'";
		
		$ret=parent::get_list($this->detail_this,1);
		
		return $ret;
	
	}
	
	
	function get_menu_front($parent = 0,$active=0){
		
		$active= $this->myParent;
		$menu=self::get_all_front($parent);
		foreach($menu as $k => $v){
		
			$class=null;
			
			if($menu[$k]['parent']==0)
				$link='bcatalog';
			else
				$link='scatalog';
			
			if($menu[$k]['id']==$active)
				$class='class= "active"';
				
			$child=self::get_all_front($menu[$k]['id']);
							
			$this->layout.='<li><a href="'.$link.'.php?myParent='.$menu[$k]['id'].'" '.$class.'>'.$menu[$k]['title'].'</a>';
			
			if(	count(	$child	)>0	)//有子類則ul
				$this->layout.='<ul class="catalog-sub-list">';
				
			self::get_menu_front($menu[$k]['id']);
					
			if(	count(	$child	)>0	)//有子類則ul
				$this->layout.='</ul>';
				
			$this->layout.='</li>';
		}
		
		return $this->layout;
		
	}
	##########################################################################功能
	
	function renew(){
		
				
		parent::renew($this->post_arr,	$this->file_arr	,$this->sdir,$this->resize);
		
	}
	
	function move_sequ(){
		
					
		if(($_GET['sequid'])!='' && $_GET['move']!='')
		{
			$sequid	=	$_GET['sequid'];
			$move	=	$_GET['move'];
			parent::move_sequ($sequid, $move,$this->sort_where);
		
		}
	
	}
	
	function resort(){
		
		parent::resort($this->sort_where);
		
		if(is_numeric($this->last_parent))
			parent::resort("parent=".$this->last_parent);
	}
	
	function killu(){
						
		parent::killu($this->del_arr, $this->is_image,	$this->sdir);
		
		foreach($this->del_arr as $k	=>	$v){ //將父類ID取出，查詢商品之父為此ID者
			
			$dpd	=	new	Product;
			$ret	=	$dpd->get_all_delete($k);
			foreach($ret	as	$k2	=>	$v2)
				$_REQUEST['delid_product'][$ret[$k2]['id']]=$ret[$k2]['id'];
				
			
			unset($dpd,$ret);
			
			
		}
				
		$dpd	=	new Product;
		$dpd	->	killu();
		
		return;
	}
	
	function sale(){
	
		foreach($this->del_arr as $k	=>	$v){
			$sql="update ".$this->tbname." set sale='".$this->post_arr['sale']."' where ".$this->PK."=".$k;
			//echo $sql;
			if(!$this->qry($sql)){
				$this->alert="刪除失敗";
				break;
			}
			
		}
		
		$spd	=	new Product;
		$spd	->	sale();
		
		
	}
}

