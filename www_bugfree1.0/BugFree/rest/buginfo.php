<?php
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");
 
    $BugID = $_POST['BugID'];//$BugID = '0055571';

    $model = getRowBySql("SELECT t.*,(SELECT max(a.RealName) FROM BugUser a WHERE a.UserName=t.AssignedTo) AssignedToUserName FROM BugInfo t where BugID='$BugID'");
    if($model!=null){
        $model['comments'] = getListBySql("SELECT t.*,(SELECT MAX(a.RealName) FROM BugUser a WHERE a.UserName=t.UserName) RealUserName FROM BugHistory t where BugID='{$BugID}'");
    }
    echo(json_encode_bm($model));

?>