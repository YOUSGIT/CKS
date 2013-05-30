<?php
class DB{
	
	private $hostname_prof ;
	private $username_prof ;
	private $password_prof ;
	private $database_prof = myDB;
	private $result;
	public  $result_num;
	public  $ret_list=array();
	
	function __construct($debug=false){
		
		//$this->database_prof=$database_prof;
		
		if($debug){

			$this->hostname_prof = "localhost";
			$this->username_prof = "root";
			$this->password_prof = "10141014";

		}else{
		
			$this->hostname_prof = "182.50.133.146";
			$this->username_prof = "cksdb";
			$this->password_prof = "O92dgq9y";
		
		}
		if(!$this->prof = mysql_pconnect($this->hostname_prof, $this->username_prof, $this->password_prof))
			exit("error2");
			
		if(!mysql_select_db($this->database_prof,$this->prof)) 
            exit("error3".$this->database_prof);
		
		$this->qry("SET NAMES UTF8",$this->prof);
		$this->qry("SET CHARACTER_SET_CLIENT=UTF8",$this->prof);
		$this->qry("SET CHARACTER_SET_RESULTS=UTF8",$this->prof);
		$this->result=null;
	}


	function qry($sql){
		//echo $sql;
		if(trim($sql)!=''){
			
			if(!$this->result=mysql_query($sql,$this->prof)){
				echo "error4";
				return false;
			}
		}
		
		return true;
	}

	function num_row(){
		
		if(!$this->result)
			return false;
		else{	
			
			if(!$ret=mysql_num_rows($this->result))
				return false;
			else{			
				$this->result_num=$ret;
				return $this->result_num;
			}
		}
	}
	
	function get_list($sql='',$num=''){ //³æµ§ || ¦hµ§
		
		$this->ret_list=array();
		
		
		if(trim($sql)!=''){
			
			if(!$this->qry($sql))
				return false;
		}
		
		if(!$this->result)
			return false;
		else{
			
			if($num!=1){
					
					while($ret=mysql_fetch_assoc($this->result))
						array_push($this->ret_list,$ret);
								
				return $this->ret_list;
				
			}else{
				if(!$ret=mysql_fetch_assoc($this->result))
					return false;
				else
					return $ret;
			}
		}
	}
	
	protected function list_tb(){
			
		$this->ret_list=array();
		
		if(!$result = mysql_list_tables($this->database_prof,$this->prof))
			return false;
		else{
		 
			while($ret=mysql_fetch_row($result))
				array_push($this->ret_list,$ret[0]);
			
			return $this->ret_list;
		}
	
	}
	
	public function __call($name, $arguments) {
        
        echo "Calling object method '$name' "
             . implode(', ', $arguments). "\n";
    }
}

