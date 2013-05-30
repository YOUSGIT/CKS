<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//header("Content-Type:text/html; charset=utf-8");
ob_start();
session_start();
error_reporting(E_ERROR);


define('myDB', 'cksdb');
define('Debug', false);

//========定義資料表之通用名
define('ADV', 'CKS_adv');
define('NEWS', 'CKS_news');
define('BC', 'CKS_class');
define('PRODUCT', 'CKS_product');
define('COLOR', 'CKS_product_color');
define('SPEC', 'CKS_product_spec');
define('PACK', 'CKS_product_package');
define('PRODUCT_Image', 'CKS_product_image');
define('INQ', 'CKS_inquery');
define('INQP', 'CKS_inquery_product');
define('SHOPS', 'CKS_shops');
define('LINKS', 'CKS_links');
define('SIZE', 'CKS_size');
define('ADMIN', 'CKS_admin');

define('ADM', 'admin');
define("_KEY", 192); //編號編碼
####################################################
$root_f = '/cksgp/'; #'/CKS/';
$inPage = pathinfo($_SERVER["PHP_SELF"]);
define('this_Page', $inPage["basename"]); //本頁檔名
define('_ROOT', $_SERVER['DOCUMENT_ROOT'] . $root_f); //根目錄


if (file_exists("admin.admin"))
    $root = '../';
else
    $root = './';
    
if ($inPage["dirname"] == '/admin')
{
    // echo $_SESSION['AdmiN'].'<br>';
    // echo md5(md5($_SESSION['AdmiN'])).'<br>';
    // echo $_SESSION['token'];
    
    if (! $_SESSION['AdmiN'] || md5(md5($_SESSION['AdmiN'])) != $_SESSION['token'])
    {
        if (!(
                (($inPage["basename"] == 'logout.php' || $inPage["basename"] == 'logincheck.php') || ($inPage["basename"] == 'index.php'))
                )
        )
        {
            header("location: ".$root."admin/logout.php");
            exit;
        }
    }
}
#################圖片存放位置
define('ADM_Image', $root . 'images/user_images/ad/');
define('NEWS_Image', $root . 'images/user_images/news/');
//define('SHOPS_Image',$root.'images/user_images/shops/');
define('PD_Image', $root . 'images/user_images/pd/');
define('SPEC_Image', $root . 'images/user_images/spec/');
define('PACK_Image', $root . 'images/user_images/pack/');
define('BC_Image', $root . 'images/user_images/bc/');
define('INC_CLASS', 'inc/class/');
define('IMAGES', $root . 'images/');
define('WEB', 'http://www.chungho.twmail.cc/CKS/');

$image_Prefix = array("s_", "m_", "l_", "ss_", ""); //圖檔名前綴
#######################################################

$Allp = 9; //每頁筆數
##########################################################
//require_once(_ROOT."inc/addslashes.php");
$_POST = array_map('trim', $_POST);
$_GET = array_map('trim', $_GET);
//$_REQUEST 	= array_map('trim', $_REQUEST);
##########################################################

include_once(_ROOT . "inc/function.php"); //引入常用功能函數
?>
