<?php

$dir_root = "../";

require_once ($dir_root . "_init.php");
header('Content-Type: text/html; charset=utf-8');
$back = './';

$FUNC = trim($_REQUEST['func']);
$DOIT = trim($_REQUEST['doit']);

if ($FUNC)
{



    switch ($FUNC)
    {

        case "adv":

            $func = new Banner;
            break;

        case "news":

            $func = new News;
            break;

        case "bc":

            $func = new Catalog;
            break;

        case "pd":

            $func = new Product;
            break;

        case "pdc":

            $func = new Product_color;
            break;

        case "pds":

            $func = new Product_spec;
            break;

        case "pdp":

            $func = new Product_package;
            break;

        case "pdi":

            $func = new Product_image;
            break;

        case "inq":

            $func = new Inquery;
            break;

        case "password":
            $con = new DB;
            $sql = "SELECT * FROM " . ADMIN . " WHERE `id` = '" . mysql_real_escape_string($_SESSION['AdmiN']) . "' AND pw = '" . mysql_real_escape_string(md5($_POST['pw'])) . "'";

            if (!$ret = $con->get_list($sql, 1))
            {
                goback("website_adminpwd.php", 0, "原密碼錯誤");
                exit;
            }

            if (($_POST['npw1'] == $_POST['npw2']) && $_POST['npw1'] != '')
            {
                $sql = "UPDATE " . ADMIN . " SET `pw` = '" . md5($_POST['npw1']) . "' WHERE `id` = '" . $ret['id'] . "'";


                if ($con->qry($sql))
                    goback("logout.php", 0, "更新成功，請重新登入");
                else
                    goback("logout.php", 0, "更新失敗[077]");
            }
            else
                goback("website_adminpwd.php", 0, "請再次確認新密碼");

            exit;
            break;

        default:


            break;
    }
}
switch ($DOIT)
{

    case "renew":

        $func->renew();
        if ($func->is_sort)
            $func->resort();

        break;

    case "del":

        $r = $func->killu();
        if ($func->is_sort)
            $func->resort();

        break;

    case "delp":

        foreach ($image_Prefix as $v)
            @unlink($_POST['dir'] . $v . $_POST['file']);

        $ret = array('ret' => 'ok');

        echo json_encode($ret);
        exit;

        break;

    case "move":

        $func->move_sequ();
        break;

    case "sale":

        $func->sale();
        break;

    case "status":

        $func->status();
        break;

    case "copy":
        $func->pd_copy();
        break;
}

$func->goback();