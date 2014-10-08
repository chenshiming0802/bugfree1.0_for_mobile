<?php
require_once("include_SetupBug.inc.php");
require_once("include_FunctionsMain.inc.php");
if(!empty($_REQUEST["BugUserName"]) and !empty($_REQUEST["BugUserPWD"]))
{
    if(rest_bugJudgeUser($_REQUEST["BugUserName"],$_REQUEST["BugUserPWD"]))
    {
        if(bugGetUserACL($_REQUEST["BugUserName"]))        {
        	$arrays = array();
        	$arrays["result"] = "0";
        	$arrays["BugUserName"] = $_SESSION["BugUserName"];
        	$arrays["BugRealName"] = $_SESSION["BugRealName"];
        	$arrays["BugUserEmail"] = $_SESSION["BugUserEmail"];

            echo(json_encode($arrays));
            exit;
        }
    }
}
$arrays = array();
$arrays["result"] = "1";
$arrays["BugUserName"] = '';
$arrays["BugRealName"] = '';
$arrays["BugUserEmail"] = '';
echo(json_encode_bm($arrays));
 


?>