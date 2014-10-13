<?php 
/*
获取当前文件的名 
  如当前URL为 http://127.0.0.1/mbf_client/mbf_profilePage.php 
  则该值为 mbf_profilePage
*/
function pageName(){
	$url = $_SERVER['PHP_SELF'];  
	$filename = substr( $url , strrpos($url , '/')+1 ); 
	$filename = substr($filename,0,strlen($filename)-4);
	return $filename; 	
}
?> 