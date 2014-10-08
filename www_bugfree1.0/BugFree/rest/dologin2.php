<?php
//http://192.168.1.101/BugFree/rest/dologin2.php?userName=chenshiming&userPassword=password
require_once("include_SetupBug.inc.php");
require_once("include_FunctionsMain.inc.php");
$userName = $_REQUEST["userName"];
$userPassword = $_REQUEST["userPassword"];

if(!empty($userName) and !empty($userPassword))
{
    if(rest_bugJudgeUser($userName,$userPassword))
    {
        if(bugGetUserACL($userName))        {
        	$srModel = array();
        	$srModel["userName"] = $_SESSION["BugUserName"];
        	$srModel["userRealName"] = $_SESSION["BugRealName"];
        	$srModel["bugUserEmail"] = $_SESSION["BugUserEmail"];
            $srModel['resultFlag'] = "0";
            $srModel['resultMessage'] = "";            
            echo(json_encode($srModel));
            exit;
        }
    }
}


$srModel['resultFlag'] = "1";
$srModel['resultMessage'] = "帐号或密码不存在";   
$srModel['resultMessageCode'] = "USER_OR_PASSWORD_NOTFOUND";
echo(json_encode_bm($srModel));
 


?>