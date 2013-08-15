<?php 
	require("../../_init.php");
	foreach($_GET	as	$k	=>	$v)
		$$k=$v;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$Subject;?></title>
</head>

<body>
<div style="width:80%; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:10pt;">
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="150" bgcolor="#000"><a href="<?=WEB;?>" target="_blank"><img src="<?=WEB;?>images/header_logo.png" width="152" height="68" border="0" /></a></td>
    <td align="right" valign="bottom" bgcolor="#000" style="color:#FFF; font-size:9pt;"><?=date("Y/m/d");?></td>
    </tr>  
  <tr>
    <td colspan="2" style="font-size:14pt; font-weight:bold; border-bottom:solid 1px #AAA;" bgcolor="#EEE">Questions or Comments</td>
  </tr>
  <tr>
    <th align="right" style="border-bottom:dotted 1px #AAA;">Name</th>
    <td style="border-bottom:dotted 1px #AAA;"><?=$name;?></td>
  </tr>
  <tr>
    <th align="right" style="border-bottom:dotted 1px #AAA;">Business Name</th>
    <td style="border-bottom:dotted 1px #AAA;"><?=$Business;?></td>
  </tr>
  <tr>
    <th align="right" style="border-bottom:dotted 1px #AAA;">Telephone</th>
    <td style="border-bottom:dotted 1px #AAA;"><?=$Telephone;?></td>
  </tr>
  <tr>
    <th align="right" style="border-bottom:dotted 1px #AAA;">Fax</th>
    <td style="border-bottom:dotted 1px #AAA;"><?=$Fax;?></td>
  </tr>
  <tr>
    <th align="right" style="border-bottom:dotted 1px #AAA;">E-Mail Address</th>
    <td style="border-bottom:dotted 1px #AAA;"><?=$email;?></td>
  </tr>
  <tr>
    <th align="right" style="border-bottom:dotted 1px #AAA;"> Subject</th>
    <td style="border-bottom:dotted 1px #AAA;"><?=$Subject;?></td>
  </tr>
  <tr>
    <th align="right" style="border-bottom:dotted 1px #AAA;">Comments</th>
    <td style="border-bottom:dotted 1px #AAA;"><?=nl2br($Comments);?></td>
  </tr>
</table>
</div>
</body>
</html>
