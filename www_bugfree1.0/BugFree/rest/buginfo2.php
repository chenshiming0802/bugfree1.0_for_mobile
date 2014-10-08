<?php
//http://service.bsteel.com/BugFree1.0/rest/buginfo2.php?bugId=0055571
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");
 
    $BugID = $_REQUEST['bugId'];//$BugID = '0055571';
    $SQL = "SELECT ";
    $SQL .=   "(SELECT MAX(a.RealName) FROM BugUser a WHERE a.UserName=t.AssignedTo) AssignedToRealUserName,";
    $SQL .=   "(SELECT MAX(a.RealName) FROM BugUser a WHERE a.UserName=t.OpenedBy) OpenedByRealUserName,";
    $SQL .= "t.* FROM BugInfo t  where BugID='$BugID'";
    $model = getRowBySql($SQL);
    if($model!=null){
        $model['comments'] = getListBySql("SELECT t.*,(SELECT MAX(a.RealName) FROM BugUser a WHERE a.UserName=t.UserName) RealUserName FROM BugHistory t where BugID='{$BugID}'");
    }
    //var_dump($model);
	$srModel = array();
	$srModel['resultFlag'] = "0";
	$srModel['resultMessage'] = "";
	$srModel['bugTitle'] = $model["BugTitle"];
	$srModel['moduleName'] = $model["ModulePath"];
	$srModel['projectId'] = $model["ProjectID"];
	$srModel['projectName'] = $model["ProjectName"];
	$srModel['bugId'] = $model["BugID"];
	$srModel['assignedTo'] = $model["AssignedTo"];
	$srModel['assignedToRealUserName'] = $model["AssignedToRealUserName"];
	$srModel['bugStatus'] = $model["BugStatus"];	
    $srModel['openedBy'] = $model["OpenedBy"];//创建人
    $srModel['openedByRealUserName'] = $model["OpenedByRealUserName"];//创建人姓名
    $srModel['openedDate'] = $model["OpenedDate"];//创建时间
    $srModel['fixedTime'] = $model["FixedTime"];//期望完成时间
    $srModel['lastEditedDate'] = $model["LastEditedDate"];	
    $srModel['bugType'] = $model["BugType"];	
    $srModel['bugSeverity'] = $model["BugSeverity"];	
	$srModel['comments'] = array();
	foreach($model['comments'] as $key=>$m){
		$item = array();
		$item['bugId'] = $m["BugID"];
		$item['userName'] = $m["UserName"];
		$item['action'] = $m["Action"];
		$item['fullInfo'] = $m["FullInfo"];
		$item['actionDate'] = $m["ActionDate"];
		$srModel['comments'][] = $item;
	}
    echo(json_encode_bm($srModel));

?>