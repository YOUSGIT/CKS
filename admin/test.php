<?php
require_once('../_init.php');
// Load a MySQL Driver


$db="vhost5107-4";
$db="test";
$debug=true;
$tbname="corsage_class";

$cs_class=new superobj($db,$debug,$tbname);
if($ret=$cs_class->resort("","sequ"))
	echo 1111;
else
	echo $ret.'0';