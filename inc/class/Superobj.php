<?php

class superobj extends DB{

	protected $tbname;
	protected $field=array(); //所有欄位屬性
	protected $field_num; //欄位數
	protected $PK;
	var $Crumbs_local;
	var $_number=array( "tinyint",
						"smallint",
						"mediumint",
						"int",
						"integer",
						"bigint",
						"float",
						"double",
						"double",
						"real",
						"decimal",
						"numeric");
						
	var $_date=array(	"date",
						"time",
						"datetime",
						"timestamp",
						"year");	

	var $alert="";
	var $back;
	
	function __construct($debug=false,$tbname=""){
		
		 parent::__construct($debug);
		 
		 if(trim($tbname)!='')
			$this->set_field($tbname);
		
	}
	
	function is_table($tbname,$tb_list=""){
	
		$tb_list=$this->list_tb();
		
		if(!in_array( trim($tbname), $tb_list))
			$this->tbname=false;
		else		
			$this->tbname=trim($tbname);
		
		return $this->tbname;
	
	}
	
	function set_field($tbname, $tb_list="", $field_list=""){ //設定所有欄位屬性
			
		
		if(!$this->is_table($tbname,$tb_list) || trim($tbname)=='')
			return false;
			
		$sql=sprintf("SHOW COLUMNS FROM %s",$tbname);
		$field_list=self::get_list($sql);
		
		$this->field_num=	count($field_list);
		$this->field	=	null;
		
		foreach($field_list as $k => $v){
			
				$Type=explode("(",$v['Type']);
				$this->field[$v['Field']]['Type']=$Type[0];
				$this->field[$v['Field']]['Key']=$v['Key'];
				
				if($v['Key']=='PRI') //找到PK
					$this->PK=$v['Field'];
		}
		//print_r($this->field);
	}
	
	function resort_link($id){
	
		//原先的頭
		$sql=sprintf("select ".$pk." from ".$tbname." where parent=n and ".$pk."=0 order by ".$pk." asc limit 1 ");

	 	if(!$ret=self::get_list($sql,1))
			return false;
			
		//剛新增的	
		$sql=sprintf("select ".$pk." from ".$tbname." where parent=n and ".$pk."=0 order by ".$pk." desc limit 1 ");

	 	if(!$ret2=self::get_list($sql,1))
			return false;
			
		$sql=sprintf("update ".$tbname." set ".$sequ."=".$ret2[$pk]);
	
	}
	function resort($where="",$sequ="sequ", $tbname="", $pk="", $asc="asc"){ //排序
		
		$tbname = (trim($tbname)=='')	? $this->tbname : $tbname;
		$pk 	= (trim($pk)=='')		? $this->PK 	: $pk;
		$where  = (trim($where)=='')	? "where ".$this->sort_where		: 	"where ".$where;
		
		$sql=sprintf("select * from %s %s order by %s %s;",$tbname,$where,$sequ,$asc); //目錄區重新編號
	 	if(!$ret=self::get_list($sql))
			return false;
				
		for($i=0;$i<count($ret);$i++){
				
			$sql=sprintf("update %s set %s=%d where %s=%d",$tbname,$sequ,mysql_real_escape_string($i+1),$pk,$ret[$i][$pk]);
			
			if(!$this->qry($sql))
				return false("排序失敗");
				
		}
		
		return true;
	}
	
	function renew($post_arr="", $upload="",$sdir="", $s_size="", $limit=2)
	{
	
		$flag=1;
		$post_arr	= 	(is_array($post_arr))	 ?	$post_arr	:	$this->post_arr;
		$upload	= 	(is_array($upload))	 ?	$upload	:	$this->file_arr;
		$sdir	=	(trim($sdir)!='')	?	$sdir	:	$this->sdir;
		$limit	=	(is_numeric($limit))	?	$limit	:	$this->limit;
		$s_size	=	(is_array($s_size))	?	$s_size	:	$this->s_size;
		
		if(is_array($upload) && count($upload)>0){
		
			$prefix=explode("_",$this->tbname);
			
			foreach($upload as $k=> $v){
				if (isset($upload[$k]['name']) && !empty($upload[$k]['tmp_name']))
				{
					
					$oFile = $upload[$k]['tmp_name'];
					$sFileName = $upload[$k]['name'];
					$sExtension=Extension($sFileName);
					$sFileName = $prefix[1] .'_'. date("U") . $sExtension;
					$sFilePath = $sdir . $sFileName;
										
					if(move_uploaded_file($oFile, $sFilePath) && round(filesize($sFilePath) / 1048576, 2)<$limit ){
						
						foreach($s_size as $x => $z){ //判斷指定大小數量決定縮圖張數
							if($x!="m")
								resizeimage($sdir, $sFilePath, $s_size[$x]["w"], $s_size[$x]["h"], $sFileName,true,$x);
						}
						$sFileName=resizeimage($sdir, $sFilePath, $s_size["m"]["w"], $s_size["m"]["h"], $sFileName);

						$flag=1;
						
						#@unlink($sdir.$post_arr['image']);
						#@unlink($sdir.'s_'.$post_arr['image']);
						#@unlink($sdir.'m_'.$post_arr['image']);
						#@unlink($sdir.'l_'.$post_arr['image']);
						#@unlink($sdir.'ss_'.$post_arr['image']);
						$post_arr['image']=$sFileName;
					
					}else{
					
						$flag=0;
						$this->alert="檔案請勿超過".$limit."MB!";				
						break;
					}
				}
			}
		}
				
		if($flag==1){
								
				$field=null;
				$insert_value=null;
				
				$j=1;
				foreach($this->field as $k=>$v){
					
					$is_time=0;
					$is_number=0;
					
					$d='"'; //預設文字類型給予引號
					
					foreach($this->_number as $v){ //數值類型不給予引號
						if(substr_count($this->field[$k]['Type'],$v)>0){
							$d='';
							$is_number=1;
							break;
						}						
					}
					foreach($this->_date as $v){ //時間類型給予引號且標記
						if(substr_count($this->field[$k]['Type'],$v)>0){
							$d='"';
							$is_time=1;
							break;
						}						
					}
					
					if($is_time==1 && $post_arr[$k]==''){
					
						$d='';
						$post_arr[$k]='now()';
					}					
					
					if($is_number==1 && $post_arr[$k]==''){
											
						$d='';
						$post_arr[$k]=0;
						
					}
					if($this->PK==$k && $post_arr[$k]=='')
						$post_arr[$k]='null'; //檢查PK是否有值
					
					//if(($k=='image' && trim($sFileName)!='') || $k!='image')
					{ //有傳圖片
						
						$field.=$k;
						#echo $k.'='.$post_arr[$k].'<br>';
						$insert_value.=(trim($post_arr[$k])!='')?$d.mysql_real_escape_string($post_arr[$k]).$d:$d.$d;
						#echo $insert_value.'<br>';
						if($j<count($this->field)){
						
							$field.=",";
							$insert_value.=",";
						}
					}
					
					$j++;
						
				}	
				$sql='replace into '.$this->tbname.' ('.$field.')values('.$insert_value.')';
				#echo $sql;
				$this->alert='更新完成';
				
				if(!$this->qry($sql))
					$this->alert='更新失敗';
				
			}
		return $this->alert;
	}
	
	function killu($del_arr, $is_image = false , $sdir=""){
		
		$del_arr	=	(is_array($del_arr))	?	$del_arr	:	$this->del_arr;
		$is_image	=	(isset($is_image))	?	$is_image	:	$this->is_image;
		$sdir	=	(trim($sdir)!='')	?	$sdir	:	$this->sdir;
		$tbname	=	(trim($tbname)!='')	?	$tbname	:	$this->tbname;
		$this->alert="刪除成功";
		
		if(!is_array($del_arr))
			$arr[$del_arr]=$del_arr;
		else
			$arr=$del_arr;
		
		//print_r($arr);
		
		foreach($arr as $k => $v){
			
			if(is_numeric($k)){
				
				if(false//$is_image=false
				){//**********
				
					$sql="select image from ".$tbname.' where '.$this->PK.'='.$k;
					$ret=self::get_list($sql,1);
					
					@unlink($sdir.$ret['image']);	
					@unlink($sdir.'s_'.$ret['image']);	
					@unlink($sdir.'m_'.$ret['image']);
					@unlink($sdir.'l_'.$ret['image']);
					@unlink($sdir.'ss_'.$ret['image']);
					
				}
				
				$sql='delete  from '.$tbname.' where '.$this->PK.'='.$k;
				
				if(!$this->qry($sql)){
					$this->alert="刪除失敗";
					break;
				}
			}
		}
		
		return $this->alert;
	}
	
	function crumbs($name){
		
		$name = (trim($name)!='')?	$name	:	$this->this_Page;
		return Crumbs($this->crumbs[$name]);
		
	}
	
	function move_sequ($sequid, $move, $c='',$table="", $obj_f="sequ" ){//改變順序
		
		$table  =	(trim($table)=='')	?	$this->tbname	:	$table;
		$sql2	=	(trim($c)!='')		?	' and '.$c		:	'';
		$sequid_move	=	($move=='up')	?	((int)$sequid-1)	:	((int)$sequid+1);
		
		$up_sql="update ".$table." set ".$obj_f."=0 where ".$obj_f."=".$sequid; //--編號-1
		$up_sql.=$sql2;
		if(!$this->qry($up_sql))	
			return false;
			
		$up_sql="update ".$table." set ".$obj_f."=".mysql_real_escape_string($sequid)." where ".$obj_f."=".$sequid_move;
		$up_sql.=$sql2;
		if(!$this->qry($up_sql))
			return false;
			
		$up_sql="update ".$table." set ".$obj_f."=".mysql_real_escape_string($sequid_move)." where ".$obj_f."=0";
		$up_sql.=$sql2;
		if(!$this->qry($up_sql))
			return false;
	}
	
	function goback($url="", $title="",$sec=0 ){
		
		$url	=trim($this->back);
		$title	=trim($this->alert);
		
			echo '<script type="text/javascript">';
			
			if($title!='')
				echo 'alert(\''.trim($title).'\');';
			echo 'window.location="'.$url.'";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			echo '</noscript>'; 
			
			exit;
	}
}

