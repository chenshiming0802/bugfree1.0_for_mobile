<?php
    header("Content-Type: text/html;charset=utf-8");
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");

    $BugID = $_POST['bugId'];//$BugID = '0000004';
    $Notes = $_POST['notes'];
    $Notes = iconv("UTF-8","GB2312//IGNORE",$Notes);
    $UserName = $_POST['userName']; 
    $AssignedTo = $_POST['assignedTo'];//$BugID = '0000004';
    $Action = $_POST['action'];
    //$Action = "Edited";

    $AssignedDate = date("Y-m-d H:i:s");
    $LastEditedDate = date("Y-m-d H:i:s");

    $arrays = array();
    if(!empty($BugID) && $UserName!=null){
		$bug = getRowBySql("select t.* from BugInfo t where t.BugID='{$BugID}'");	
		if($bug!=null && $bug['BugStatus']!='Closed'){
            //如果有指派人选择，则更新指派人和指派时间
            $sql1 = "";
            if(!empty($AssignedTo)){
                $sql1 = "AssignedTo      = '$AssignedTo', AssignedDate    = '$AssignedDate',   ";
            }
			$SQL_update = "UPDATE BugInfo SET   {$sql1}                 
                           LastEditedBy    = '$UserName',
                           LastEditedDate  = '$LastEditedDate'
                     WHERE BugID           = '$BugID'";	
            $SQL_insert =   " INSERT INTO BugHistory(BugID,UserName,Action,FullInfo,ActionDate) VALUES(
                                      '$BugID','$UserName','$Action','$Notes',now())";   
            //echo $SQL_update; break;    //for debug	
            if(querySql($SQL_update)){
                querySql($SQL_insert);
                $arrays["resultFlag"] = "0";
			}else{
                $arrays["resultFlag"] = "1";
                $arrays["resultMessage"] = " db error!";
            }         
		}else{
            $arrays["resultFlag"] = "1";
            $arrays["resultMessage"] = "No found bugId:{$BugID}!";
        }
    }else{
        $arrays["resultFlag"] = "1";
        $arrays["resultMessage"] = "Required BugID!";
    }
    echo(json_encode($arrays));
?>