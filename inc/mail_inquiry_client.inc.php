<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inquiry Infomations</title>
</head>

<body>
<div style="width:80%; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:10pt;">
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="150" bgcolor="#000"><a href="<?=WEB;?>" target="_blank"><img src="<?=WEB;?>images/header_logo.png" width="152" height="68" border="0" /></a></td>
    <td align="right" valign="bottom" bgcolor="#000" style="color:#FFF; font-size:9pt;"><?=date("Y/m/d");?></td>    </tr>
  <tr>
    <td colspan="2"><p>Dear <?=$_POST['contact'];?>,</p>
      </td>
    </tr>
  <tr>
    <td colspan="2" style="font-size:14pt; font-weight:bold; border-bottom:solid 1px #AAA;" bgcolor="#EEE">Inquiry Products</td>
  </tr>
  
  <?php 
  
	foreach($_POST['inq']	as	$k	=>	$v)
	{?>
  <tr>
    <td width="150" align="center" style="border-bottom:dotted 1px #AAA;">
    	<a href="#id" >
		<?php 
			if(is_file(PD_Image.'s_'.$_POST['inq'][$k]['image']))
				$file=PD_Image.'s_'.$_POST['inq'][$k]['image'];
			else
				$file=IMAGES.'default_50x50.jpg';
		?>
        	<img src="<?=WEB.$file;?>" width="50" height="50" border="0" />
		</a>
	</td>
    <td style="border-bottom:dotted 1px #AAA;">
      <a href="#id"  style=" font-size:12pt; font-weight:bold; text-decoration:none; display:block; margin-bottom:5px; color:#000;"><?=$_POST['inq'][$k]['title'];?></a>
      <span><?=$_POST['inq'][$k]['model'];?></span>
      </td>
  </tr>
  <?php }?>
  
</table>
</div>
</body>
</html>
