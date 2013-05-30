<?php

class News extends Superobj{
	
	//var $Crumbs_local;
	var $crumbs = array("news_detail.php"=>array("新聞管理"=>"news_list.php","編輯新聞"=>""),
						"news_list.php"=>array("新聞管理"=>"news_list.php","新聞列表"=>"")
					);
	protected 	$post_arr = array();
	protected 	$file_arr = array();
	protected 	$del_arr;
	protected 	$limit = 2; //上傳檔案大小
	protected	$sort_where = null;
	protected	$tbname = NEWS;
	var $sdir=NEWS_Image;
	var	$back='./news_list.php';
	var	$s_size=array("m"=>array("w"=>700,"h"=>6000),"s"=>array("w"=>150,"h"=>2000));
	var	$is_image=true;
	var $list_this;
	var $detail_this;
	var $this_Page= this_Page;
	var $detail_id ; //編輯細節ID
	
	function __construct($debug=false){
				
		$this->post_arr	= (is_array($_POST))	?	$_POST	:	"";
		$this->file_arr	= (is_array($_FILES))	?	$_FILES	:	"";
		$this->del_arr	= (isset($_REQUEST['delid']))	?	$_REQUEST['delid']	:	"";
		$this->detail_id=	(is_numeric($_GET['id']))	?	$_GET['id']	:	"";
		
		parent::__construct($debug);

		if(trim($this->tbname)!='')
			$this->set_field($this->tbname);
		
	}
	
	function get_all(){
		
		$this->list_this="select * from ".$this->tbname." order by dates desc";
		return parent::get_list($this->list_this);
	
	}
	
	function get_front(){
		
		$this->list_this="select * from ".$this->tbname." order by dates desc limit 5";
		return parent::get_list($this->list_this);
	
	}
	
	function get_detail($pk){
	
		$pk	=	(trim($pk)!='')	?	$pk:	$this->detail_id;
		
		if(trim($pk)!='')
			$this->detail_this="select * from ".$this->tbname." where ".$this->PK."=".$pk;
		
		return parent::get_list($this->detail_this,1);
	
	}
		
	function renew(){
	
		parent::renew($this->post_arr,	$this->file_arr	,$this->sdir,$this->s_size);
	
	}
	
	function killu(){
	
		return parent::killu($this->del_arr, $this->is_image,	$this->sdir);
		
	}
	
	function crumbs(){
		
		return parent::crumbs($this->this_Page);
	}
}

