<?php

class Banner extends Superobj{
	
	//var $Crumbs_local;
	var $crumbs = array("website_banner.php"=>array("網站管理"=>"website_banner.php","首頁廣告設定"=>""),
						"website_banner_detail.php"=>array("網站管理"=>"website_banner.php","首頁廣告設定"=>"website_banner.php","新增廣告"=>"")
					);
	
	protected 	$post_arr = array(); //新增修改資料
	protected 	$file_arr = array(); //上傳陣列
	protected 	$del_arr; //刪除者
	protected 	$limit = 2; //上傳檔案大小
	protected	$sort_where = null; //排序
	protected	$tbname = ADV;
	var	$is_sort = false; //是否排序
	var	$sdir=ADM_Image;
	var	$back='./website_banner.php';
	var	$s_size=array("m"=>array("w"=>1000,"h"=>6000),"s"=>array("w"=>200,"h"=>2000));
	var $detail_id ; //編輯細節ID
	var	$is_image=true;
	var $list_this;
	var $detail_this;
	var $this_Page= this_Page;
	
	function __construct($debug=false){
				
		$this->post_arr	= (is_array($_POST))	?	$_POST	:	"";
		$this->file_arr	= (is_array($_FILES))	?	$_FILES	:	"";
		$this->del_arr	= (isset($_REQUEST['delid']))	?	$_REQUEST['delid']	:	"";
		$this->detail_id=	(is_numeric($_GET['id']))	?	$_GET['id']	:	"";
		
		parent::__construct($debug);

		if(trim($this->tbname)!='')
			$this->set_field($this->tbname);
		
	}
	
	function get_all(){ //列出全部資料
		
		$this->list_this="select * from ".$this->tbname." order by dates desc";
		return parent::get_list($this->list_this);
	
	}
	
	function get_detail($pk){ //列出單筆細節
	
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

