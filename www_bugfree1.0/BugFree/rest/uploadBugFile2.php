<?php
require_once("include_SetupBug.inc.php");
require_once("include_FunctionsMain.inc.php");

$bugId = request("bugId",null);
$userName = request("userName",null);
assertNotNull($bugId,"Required BugID:".$bugId,"Required BugID");
assertNotNull($userName,"Required UserName".$bugId,"Required UserName");

$SQL = "SELECT t.* FROM BugInfo t  where BugID='$bugId'";
$model = getRowBySql($SQL);
assertNotNull($model,"Not Found BugID:".$bugId,"BugID ERROR");
//var_dump($model["ProjectID"]);
$FileResultInfo = rest_bugAddFile($userName,$model["ProjectID"],$model["BugID"]);

$srModel = array();
if($FileResultInfo["Success"] and !empty($FileResultInfo["FileList"]))
{
    $History = "<B>Add File</B> \"$FileResultInfo[FileList]\"";
    $SQL_insert =   " INSERT INTO BugHistory(BugID,UserName,Action,FullInfo,ActionDate) VALUES(
                                      '{$bugId}','{$userName}','Edited','{$History}',now())";
	querySql($SQL_insert);	
	$srModel['resultFlag'] = "0";
	$srModel['resultMessage'] = "";	
}else{
	$srModel['resultFlag'] = "1";
	$srModel['resultMessage'] = $FileResultInfo["ErrorInfo"][0];
}
//var_dump($srModel);
echo(json_encode($srModel));
?>