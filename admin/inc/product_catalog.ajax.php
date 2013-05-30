<?php 
	require_once "../../_init.php";
	
		
	$cc=new Catalog;
	$ret=$cc->get_all();
	
	?>
	<option value="-1">請選擇小分類(可不選)</option>
	<?php 
		foreach($ret as $k => $v){
			$selected	=	($ret[$k]['id']==$row['parent'])	?	'selected="selected"'	:	'';
			echo '<option value="'.$ret[$k]['id'].'" '.$selected.'>'.$ret[$k]['title'].'</option>';
	}
	
	