<?php


//function myautoload($class_name) {
spl_autoload_register(function ($class_name) {	
	$path=INC_CLASS.$class_name . '.php';
		
	//if(substr_count(	$_SERVER["PHP_SELF"],'admin')>0 && $class_name !='DB')
	//	include_once _ROOT.'admin/'.$path;
	//else
	
	if(is_file(_ROOT.$path))
		include_once (_ROOT.$path);
	else
		throw new MissingException("Unable to load $class_name.");
				
});


#######################################################
function Crumbs($arg){
	
	if(file_exists("admin.admin"))
		$root="網站管理系統";
	else
		$root="首頁";
	
	$ret='<li><a href="./" class="icon home-s">'.$root.'</a> ></li>';
		if(is_array($arg)){
			
			foreach($arg as $k => $v){

             	$a='';
				$arrow='';	
				if(trim($v)!=''){
					$a='<a href="'.$v.'">';
					$arrow='>';
					}
				
			    $ret.='<li>'.$a.$k.'</a> '.$arrow.'</li>';
					
			}
					
		}
   // $ret.='  <li>首頁廣告設定</li>';	
	return $ret;
}
function send_no_cache_header () {
	header ( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
	header ( 'Last-Modified: '. gmdate ( 'D, d M Y H:i:s' ) .' GMT' );
	header ( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header ( 'Cache-Control: post-check=0, pre-check=0, false' );
	header ( 'Pragma: no-cache' );
}


function moverank_up($table, $obj_f, $upid,$c=''){ //改變順序向上

	if($c!='')
		$sql2=' and '.$c;
	else
		$sql2='';
	$up_sql="update ".$table." set ".$obj_f."=0 where ".$obj_f."=".$upid; //--編號-1
	$up_sql.=$sql2;
	qsql($up_sql);
	$up_sql="update ".$table." set ".$obj_f."=".$upid." where ".$obj_f."=".($upid-1);
	$up_sql.=$sql2;
	qsql($up_sql);
	$up_sql="update ".$table." set ".$obj_f."=".($upid-1)." where ".$obj_f."=0";
	$up_sql.=$sql2;
	qsql($up_sql);
}

function moverank_down($table, $obj_f, $downid,$c=''){ //-----------改變順序
	if($c!='')
		$sql2=' and '.$c;
	else
		$sql2='';
	$dw_sql="update ".$table." set ".$obj_f."=0 where ".$obj_f."=".$downid; //--編號+1
	$dw_sql.=$sql2;
	qsql($dw_sql);
	$dw_sql="update ".$table." set ".$obj_f."=".$downid." where ".$obj_f."=".($downid+1);
	$dw_sql.=$sql2;
	qsql($dw_sql);
	$dw_sql="update ".$table." set ".$obj_f."=".($downid+1)." where ".$obj_f."=0";
	$dw_sql.=$sql2;
	qsql($dw_sql);

}

//================================================================================================================

function AddLink2Text($str) { //==============自動判斷超聯結
   $str = preg_replace("<a href=\"\\1\">\\1</a>","<a href=\"".urlencode("\\1")."\" target=\"_blank\">\\1</a>", $str);

   $str = preg_replace("#([0-9a-z._]+@[0-9a-z._?=]+)#i","<a href=\"mailto:\\1\">\\1</a>", $str);
   return $str;
}
function AddLink2Textencode($str) { //==============自動判斷超聯結
   $str = preg_replace("#(http://[0-9a-z._/?=&;]+)#i","<a href=\"\\1\" target=\"_blank\">\\1</a>", $str);

   $str = preg_replace("#([0-9a-z._]+@[0-9a-z._?=]+)#i","<a href=\"mailto:\\1\">\\1</a>", $str);
   return $str;
}

function qsql($sql){//查詢SQL成功則返回前頁


	if(mysql_query($sql))
		return true;
	else
		die($sql);
    //echo '資料更新中...';
	// 查詢執行成功，重導網頁位址到 index.php
//	echo '<META HTTP-EQUIV="refresh" CONTENT="3; URL=pictures.php?albumid='.$pid.'">';
}

function maxmin($obj,$maxin,$table)//查詢最大或最小函數 目標欄位,最大或最小,資料表名稱
{
	$sql='select '.$maxin.'('.$obj.') from '.$table;
	mysql_query($sql) || die('die');
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	return $row[0];
}	 

function goback($url, $sec, $title){

		//if (!headers_sent()){    //If headers not sent yet... then do php redirect
			//header('Location: '.$url); exit;
		//}else{                    //If headers are sent... do java redirect... if java disabled, do html redirect.
			echo '<script type="text/javascript">';
			
			if(trim($title)!='')
				echo 'alert(\''.trim($title).'\');';
			echo 'window.location="'.$url.'";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			echo '</noscript>'; exit;
		}
	
function qsql_st(){
	global $sql, $result, $row, $num;

	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$num=mysql_num_rows($result);

}
function qsql_v($name){
	global ${'result_'.$name}, ${'row_'.$name}, ${'num_'.$name}, ${'sql_'.$name};
	${'result_'.$name}=mysql_query(${'sql_'.$name});
	${'row_'.$name}=mysql_fetch_array(${'result_'.$name});
	${'num_'.$name}=mysql_num_rows(${'result_'.$name});

}

function qsql_in(){
	global $sql_in, $result_in, $row_in, $num_in;

	$result_in=mysql_query($sql_in);
	$row_in=mysql_fetch_array($result_in);
	$num_in=mysql_num_rows($result_in);

}

function file_rename(){
	global $exists, $dir, $new_rename, $sor;
	$exists=(int)file_exists($dir.$new_rename);
	if($exists==true){ 
	rename($dir.$new_rename, $dir."temp");
	unlink($dir."temp");}
	
	rename($sor, $dir.$new_rename);
	//echo $exists;

	}
	
function RemoveExtension( $fileName )
{
	return substr( $fileName, 0, strrpos( $fileName, '.' ) ) ;
}

function Extension( $fileName )
{
	return substr( $fileName, strrpos( $fileName,'.'), strlen($fileName) ) ;
}
	
	
function resizeimage($dir, $sor, $new_w, $new_h, $new_name,$thumbnail=false,$prefix="s"){//縮圖程式區段=====================================

		$newi=$dir.'test.jpg';
		$pics_img=$new_name;
		$sorsize=getimagesize($sor);
		$img_ratio=$sorratio= $sorsize[0]/$sorsize[1]; //寬/高
		$target_ratio=$newratio= $new_w/$new_h;

		
		if ($target_ratio > $img_ratio) {
			$newsize[1] = $new_h;
			$newsize[0] = $img_ratio * $new_h;
		} else {
			$newsize[1] = $new_w / $img_ratio;
			$newsize[0] = $new_w;
		}

		if ($newsize[1] > $new_h) {
			$newsize[1] = $new_h;
		}
		if ($newsize[0] > $new_w) {
			$newsize[1] = $new_w;
		}
		//=======判斷開始=================================================
		
		  #$newsize[1]=$new_h;
		  #$newsize[0]=$new_h*$sorratio;
		 
		 $newimage=imagecreatetruecolor($newsize[0], $newsize[1]);
		 switch ($sorsize[2]) { 
					case 1: $srcimage = imagecreatefromgif($sor); break; 
					case 2: $srcimage = imagecreatefromjpeg($sor); break; 
					case 3: $srcimage = imagecreatefrompng($sor); break; 
					//case 6: $srcimage = imagecreatefromwjpeg($sor); break;
					default: return false; break; 
				} 

		  imagecopyresampled($newimage, $srcimage, 0,0,0,0, $newsize[0], $newsize[1], $sorsize[0], $sorsize[1]);
			
			
			
		  
		  switch ($sorsize[2]) { 
			  case 1: imagegif($newimage, $newi, 100); break; 
			  case 2: imagejpeg($newimage, $newi, 100); break; 
			  case 3: 
				$black = imagecolorallocate($newimage, 0, 0, 0);
				imagecolortransparent($newimage, $black);
				imagepng($newimage, $newi); break; 
				
			default:	return false; break;
			}
		  
		  
		//echo $sor;
		
		if($thumbnail)			 
			$new_name=$prefix.'_'.$new_name;
		else
			@unlink($sor);		
		
		rename($newi, $dir.$new_name);
		$pics_img=$new_name; 
		
		return $pics_img;
}

