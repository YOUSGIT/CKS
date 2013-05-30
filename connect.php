<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
header("Content-Type:text/html; charset=utf-8");
ob_start(); 
session_start();
error_reporting(0);

$hostname_prof = "localhost";
$database_prof = "vhost5107-4";

$username_prof = "vhost5107";
$password_prof = "mimifrog";

//========定義資料表之通用名
define('WA','corsage_wb');
define('AD','corsage_ad');
define('NEWS','corsage_news');
define('BC','corsage_class');
define('PRODUCT','corsage_product');
define('COLOR','corsage_color');
define('PRODUCT_Image','corsage_product_image');
define('SHOPS','corsage_shops');
define('LINKS','corsage_links');
define('SIZE','corsage_size');
define('ADM', 'admin');

if(file_exists("admin.admin"))
	$root='../';
else
	$root='./';

define('ADM_Image',$root.'images/ad/');
define('SHOPS_Image',$root.'images/shops/');
define('PD_Image',$root.'images/pd/');
define('INC_CLASS'),$root.'inc/class/);'

//=============連結資料庫
$prof = mysql_pconnect($hostname_prof, $username_prof, $password_prof) or die(mysql_error());

mysql_select_db($database_prof) 
                or die("Could not select database");

mysql_query("SET NAMES UTF8",$prof);
mysql_query('SET CHARACTER_SET_CLIENT=UTF8',$prof);
mysql_query("SET CHARACTER_SET_RESULTS=UTF8'",$prof);

$allp=9; //每頁筆數

	$inPage = pathinfo($_SERVER["PHP_SELF"]); 


require_once("function/addslashes.php");
require_once("function/function.php"); //引入常用功能函數

?>
