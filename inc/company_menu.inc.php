<?php
$Company = new Company;
$ret = $Company->get_all();
$detail_id = $_GET['id'];
foreach ($ret as $k => $v)
{
    if ($k == 0 && !$_GET['id'])
    {
        $detail_id = $v['id'];
    }
    ?>
    <li><a href="?id=<?= $v['id']; ?>" <?= ($v['id'] == $_GET['id'] ) ? 'class="active"' : ''; ?>><?= $v['title']; ?></a></li>
    <?php
}