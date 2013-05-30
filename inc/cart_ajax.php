<?php 
	session_start();
	
	if(trim($_SESSION['sid'])=='')
		$_SESSION['sid']==session_id();
		
	if(is_numeric($_POST['id'])){	
		$_SESSION[$_SESSION['sid']][$_POST['id']]=$_POST['id'];
		$_SESSION['total']=count($_SESSION[$_SESSION['sid']]);
	}
	