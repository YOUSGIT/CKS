<?php
$root = "../";
require_once($root . "_init.php");
define("F", '5');
define("FS", '1');
$Company = new Company();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administrator Template</title>
        <link href="css/original/admin.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="script/admin.js"></script>
    </head>
    <body>
        <div class="header">
            <?php include_once "inc/guide.inc.php"; ?>
            <div class="toolbar">
                <div class="group">
                    <input type="button" class="tool icon file-add-b" value="新增簡介" onclick="window.location = 'company_detail.php';" />
                </div>
                <div class="group">
                    <input type="button" class="tool icon file-delete-b" value="批次刪除" onclick="del_list('form1')"/>
                </div>
                <div class="blank"></div>
            </div>
        </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
            <tr>
                <td class="left-panel-container">
                    <div class="left-panel">
                        <ul class="nav">
                            <li class="active">
                                <a href="company_list.php" class="active">簡介列表</a>
                            </li>
                        </ul>
                    </div>
                </td>
                <td class="left-panel-bar"><a id="leftPanelAdjust" href="#">&nbsp;</a></td>
                <td class="right-panel-container">
                    <div class="right-panel">
                        <ul class="crumb">
                            <?= $Company->crumbs(); ?>
                        </ul>
                        <div class="module-list">
                            <table border="0" cellspacing="0" cellpadding="0" class="fix-title"></table>
                            <div class="list-container">
                                <form action="func.php" method="POST" id="form1" >
                                    <input name="doit" type="hidden" value="del" />
                                    <input name="func" type="hidden" value="company" />
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
                                        <tr class="fix-title-row">
                                            <th width="30"><input type="checkbox" class="select-all" /></th>
                                            <th align="left">標題</th>
                                            <th width="100">順序</th>
                                            <th width="100">編輯</th>
                                        </tr>
                                        <?php
                                        $ret = $Company->get_all();
                                        $ret_n=$Company->num_row();
                                        $count = count($ret);

                                        for ($i = 0; $i < $count; $i++)
                                        {
                                            ?>
                                            <tr>
                                                <td width="30" align="center"><input name="delid[<?= $ret[$i]['id']; ?>]" type="checkbox" class="select" id="delid[<?= $ret[$i]['id']; ?>]" value="1" /></td>
                                                <td><?= $ret[$i]['title']; ?></td>
                                                <td width="100" align="center">
                                                    <?php
                                                    if ($i != 0)
                                                    {
                                                        ?>
                                                        <input type="button" value=" " class="button icon up-s" onclick="window.location = 'func.php?sequid=<?= $ret[$i]['sequ']; ?>&doit=move&move=up&func=company'"/>
                                                        <?php
                                                    }
                                                    if ($i < ($ret_n - 1))
                                                    {
                                                        ?>
                                                        <input type="button" value=" " class="button icon down-s" onclick="window.location = 'func.php?sequid=<?= $ret[$i]['sequ']; ?>&doit=move&move=down&func=company'"/>
                                                    <?php } ?>
                                                </td>
                                                <td width="100" align="center"><input type="button" value="編輯" class="button"  onclick="window.location = 'company_detail.php?id=<?= $ret[$i]['id']; ?>';" /></td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="footer">
            <span class="copyright">YOUS © 2012</span>
            <span class="vision"></span>
            <span class="nav"></span>
        </div>
    </body>
</html>
