<?php

class Inquery extends Superobj{
	
	//var $Crumbs_local;
	var $crumbs = array("inquery_list.php"=>array("詢價管理"=>"inquery_list.php","客戶詢價紀錄"=>""),
						"inquery_detail.php"=>array("詢價管理"=>"inquery_list.php","詳細詢價紀錄"=>"")
					);
	protected 	$post_arr = array();
	protected 	$file_arr = array();
	protected 	$del_arr;
	protected 	$limit = 2; //上傳檔案大小
	protected	$sort_where = null;
	protected	$tbname = INQ;
	protected	$tbname_product = INQP;
	
	var	$back='./inquery_list.php';
	var $code;	//訂單編號
	var	$is_image=false;
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
	
		if(is_numeric($_GET['status']))
			$status=" and status='".$_GET['status']."'";
		
		$this->list_this="select * from ".$this->tbname." where 1 ".$status." order by dates desc";
		return parent::get_list($this->list_this);
	
	}
	
	function get_product_all($code=""){
		
		if(trim($code)==''	&&	$this->code=='')
			return false;
			
		$code	=	($this->code=='')	?	$code	:	$this->code;
		$this->list_this="select * from ".$this->tbname_product." where parent='".$code."' order by id desc";
		
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
		
		$ret=parent::get_list($this->detail_this,1);
		$this->code=$ret['code'];
		return $ret;
	
	}
	
	function crumbs(){
		
		return parent::crumbs($this->this_Page);
	}	
	
	###############################################################################
	
	function renew(){
	
		parent::renew($this->post_arr,	$this->file_arr	,$this->sdir,$this->s_size);
		
	}
	
	function renew_inqp($post_arr){
		
		$this->set_field($this->tbname_product);
		
		parent::renew($post_arr);
		
	}
	
	function killu(){
	
		return parent::killu($this->del_arr, $this->is_image,	$this->sdir);
		
	}
	
	function status(){
	
		foreach($this->del_arr as $k	=>	$v){
			$sql="update ".$this->tbname." set status='".$this->post_arr['status']."' where ".$this->PK."=".$k;
			//echo $sql;
			if(!$this->qry($sql)){
				$this->alert="刪除失敗";
				break;
			}
			
		}
		
	}
}

