<?php
require_once "./_init.php";
define("F", 1);
define("FS", 1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CKS Stationery Corporation - Taiwan(TW)</title>
        <link href="css/global.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
        <script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="script/jquery.backgroundPosition.js"></script>
        <script type="text/javascript" src="script/jquery.lightbox-0.5.min.js"></script>
        <script type="text/javascript" src="script/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="script/global.js"></script>
        <script type="text/javascript" src="script/search.js"></script>
    </head>
    <body>
        <div class="outer red">
            <div class="header">
                <div class="logo"><a href="index.php"><img src="images/header_logo.png" alt="CKS Stationery Corporation - Taiwan(TW)" width="152" height="68" border="0" /></a></div>
                <div class="guide">
                    <?php include_once "./inc/guide.inc.php"; ?>
                </div>
                <ul class="globalnav">
                    <?php include_once "./inc/menu.inc.php"; ?>
                </ul>
            </div>
            <div class="body">
                <div class="news-cycle">
                    <?php include_once "./inc/news_front.inc.php"; ?>               
                </div>
                <div class="crumb">
                    <div class="bt">
                        <ul>
                            <li class="home"><a href="#">HOME</a></li>
                            <li class="catalog"><a href="#">COMPANY</a></li>
                            <li>Company Profile</li>
                            <?php include_once "./inc/search_input.inc.php"; ?>
                        </ul>
                    </div>
                </div>
                <div class="span-col">
                    <div class="left-col">
                        <ul class="catalog-list">
                            <?php include_once "./inc/company_menu.inc.php"; ?>    
                        </ul>
                    </div>
                    <?php
                        $Company = new Company;
                        $ret=$Company->get_detail($detail_id);
                        ?>
                    <div class="right-col">
                        <h1 class="inquiry"><?= $ret['title']; ?></h1>
                        <div class="static-content"><?=stripslashes($ret['content']);?></div>
                    </div>
                    <div class="blank"></div>
                </div>
            </div>
            <div class="footer">
                <div class="logo"><img src="images/footer_logo.png" width="72" height="22" /></div>
                <div class="info">TEL: +886 (02) 26105566 | Fax: +886 (02) 26101919 | E-Mail: sales@cks.com.tw</div>
                <div class="copyright">CKS Stationery Corporation © 2012</div>
            </div>
        </div>
    </body>
</html>
