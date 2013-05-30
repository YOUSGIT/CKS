<?php

// ini_set('display_errors', '1');

require_once("../_init.php");

if (($_POST['imgcode'] != $_SESSION['IMGCODE'] || time() >= $_SESSION['IMGCODE_EXPIRED']))
{
    header("Location: ./ ");
    exit;
}

$obj = new DB;

$sql = "SELECT * FROM " . ADMIN . " WHERE `id` = '" . mysql_real_escape_string($_POST['id']) . "' AND pw = '" . mysql_real_escape_string(md5($_POST['pw'])) . "'";
if (!$ret = $obj->get_list($sql,1))
{
    
    header("Location: ./ ");
    exit;
}
else
{
    $_SESSION['AdmiN'] = ($ret['id']);
    $_SESSION['token'] = md5(md5($ret['id']));
    header("Location: ./website_banner.php");
    exit;
}