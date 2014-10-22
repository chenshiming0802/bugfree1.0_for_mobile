<?php
 //http://127.0.0.1/BugFree/rest/resolveBug2.php?bugId=0000008&userName=chenshiming&resolution=Fixed&notes=3
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");


    $bugId = $_REQUEST['bugId']; //$UserName = "chenshiming";
    $userName = $_REQUEST['userName'];
    $resolution = $_REQUEST['resolution'];
    $Notes = $_POST['notes'];
    $Notes = iconv("UTF-8","GB2312//IGNORE",$Notes);

	$_SESSION["BugUserAclSQL"] = " 1=1 ";
	$_SESSION["BugUserName"] = $userName;

    $srModel = array();
    $arrays = array();

    if(!empty($bugId) && $userName!=null){
	    $SQL = "UPDATE BugInfo SET BugStatus   = 'Resolved',
	                           AssignedTo      = OpenedBy,
	                           AssignedDate    = now(),
	                           ResolvedBy      = '{$userName}',
	                           Resolution      = '{$resolution}',
	                           ResolvedDate    = now(),
	                           LastEditedBy    = '{$userName}',
	                           LastEditedDate  = now()
	                     WHERE BugID           = '{$bugId}'";  
	               // echo $SQL;die();    
	    querySql($SQL);
	    bugLogHistory($bugId,"Assigned To \"" . $userName . "\"");

	    /* 4.2 Push the notes message. */
	    !empty($notes) ? $History[] = htmlspecialchars($notes) : "";
	    /* 4.3 Define the action. */
	    $Action  = "Resolved AS \"" . $resolution . "\"";
	    /* 4.4 Insert the log histoty. */
	    bugLogHistory($bugId,$Action, @join("\n",$History));
	    /* 5 Mail the change. */
	    if($BugConfig["Mail"]["On"])
	    {
	        $BugInfo = bugGetInfo("Medium"," WHERE BugID='$bugId'");
	        $BugInfo = $BugInfo[key($BugInfo)];
	        bugMailChange($BugInfo["BugID"],$BugInfo["AssignedTo"],$BugInfo["MailTo"],$BugInfo["BugTitle"],$Action,@join("\n",$History));
	    }	
	        

		$srModel['resultFlag'] = "0";
		$srModel['resultMessage'] = "";


	}else{
		$srModel['resultFlag'] = "1";
		$srModel['resultMessage'] = "bugId or userName is required";		
	}
	echo(json_encode_bm($srModel));                   

?>                     