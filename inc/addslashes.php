<?php
//檢查有無特殊字元
//將需要引用在資料庫查詢等等中的字元前面加上反斜線，傳回加上反斜線的字串
//if( !get_magic_quotes_gpc() )                                                   
if( true )                                                   
{                                                                               
        if( is_array($_GET) )                                                   
        {                                                                       
                while( list($k, $v) = each($_GET) )                             
                {                                                               
                        if( is_array($_GET[$k]) )                               
                        {                                                       
                                while( list($k2, $v2) = each($_GET[$k]) )       
                                {                                               
                                        $_GET[$k][$k2] = (trim($v2));       
                                }                                               
                                @reset($_GET[$k]);                              
                        }                                                       
                        else                                                    
                        {                                                       
                                $_GET[$k] = (trim($v));                     
                        }                                                       
                }                                                               
                @reset($_GET);                                                  
        }                                                                       
                                                                                
        if( is_array($_POST) )                                                  
        {                                                                       
                while( list($k, $v) = each($_POST) )                            
                {                                                               
                        if( is_array($_POST[$k]) )                              
                        {                                                       
                                while( list($k2, $v2) = each($_POST[$k]) )      
                                {                                               
                                        $_POST[$k][$k2] = (trim($v2));      
                                }                                               
                                @reset($_POST[$k]);                             
                        }                                                       
                        else                                                    
                        {                                                       
                                $_POST[$k] = (trim($v));                    
                        }                                                       
                }                                                               
                @reset($_POST);                                                 
        }                                                                       
                                                                                
        if( is_array($_COOKIE) )                                                
        {                                                                       
                while( list($k, $v) = each($_COOKIE) )                          
                {                                                               
                        if( is_array($_COOKIE[$k]) )                            
                        {                                                       
                                while( list($k2, $v2) = each($_COOKIE[$k]) )    
                                {                                               
                                        $_COOKIE[$k][$k2] = (trim($v2));    
                                }                                               
                                @reset($_COOKIE[$k]);                           
                        }                                                       
                        else                                                    
                        {                                                       
                                $_COOKIE[$k] = (trim($v));                  
                        }                                                       
                }                                                               
                @reset($_COOKIE);                                               
        }                                                                       
}   
	
	
	################
	
/*	if( true )                                                   
{                                                                               
        if( is_array($_GET) )                                                   
        {                                                                       
                while( list($k, $v) = each($_GET) )                             
                {                                                               
                        if( is_array($_GET[$k]) )                               
                        {                                                       
                                while( list($k2, $v2) = each($_GET[$k]) )       
                                {                                               
                                        $_GET[$k][$k2] = addslashes(trim($v2));       
                                }                                               
                                @reset($_GET[$k]);                              
                        }                                                       
                        else                                                    
                        {                                                       
                                $_GET[$k] = addslashes(trim($v));                     
                        }                                                       
                }                                                               
                @reset($_GET);                                                  
        }                                                                       
                                                                                
        if( is_array($_POST) )                                                  
        {                                                                       
                while( list($k, $v) = each($_POST) )                            
                {                                                               
                        if( is_array($_POST[$k]) )                              
                        {                                                       
                                while( list($k2, $v2) = each($_POST[$k]) )      
                                {                                               
                                        $_POST[$k][$k2] = addslashes(trim($v2));      
                                }                                               
                                @reset($_POST[$k]);                             
                        }                                                       
                        else                                                    
                        {                                                       
                                $_POST[$k] = addslashes(trim($v));                    
                        }                                                       
                }                                                               
                @reset($_POST);                                                 
        }                                                                       
                                                                                
        if( is_array($_COOKIE) )                                                
        {                                                                       
                while( list($k, $v) = each($_COOKIE) )                          
                {                                                               
                        if( is_array($_COOKIE[$k]) )                            
                        {                                                       
                                while( list($k2, $v2) = each($_COOKIE[$k]) )    
                                {                                               
                                        $_COOKIE[$k][$k2] = addslashes(trim($v2));    
                                }                                               
                                @reset($_COOKIE[$k]);                           
                        }                                                       
                        else                                                    
                        {                                                       
                                $_COOKIE[$k] = addslashes(trim($v));                  
                        }                                                       
                }                                                               
                @reset($_COOKIE);                                               
        }                                                                       
}  */ 
	
?>