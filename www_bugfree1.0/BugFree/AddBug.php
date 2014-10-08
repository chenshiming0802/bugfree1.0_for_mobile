<?php
/**
 * Add bug file of BugFree system.
 * 
 * BugFree is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * BugFree is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with BugFree; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @link        http://bugfree.1zsoft.com
 * @package     BugFree
 * @version     $Id: AddBug.php,v 1.10 2005/09/10 07:34:25 wwccss Exp $
 */
/* Init BugFree system. */  
require_once("Include/SetupBug.inc.php");

/* Add Bug to database */
if(!empty($_POST))
{
    /* Judge the info user submitted. */
    if(empty($_POST["BugTitle"]))
    {
        $MyJS->alert($TplConfig["AddBug"]["ErrorEmptyTitle"]);
        $MyJS->goto("Back");
        exit;
    }
    
    /* Judge the length of title. */    
    $FieldBugTitle     = dbGetFieldInfo("BugInfo", "BugTitle"); 
    if(strlen($_POST["BugTitle"]) > $FieldBugTitle["Length"])
    {
        $MyJS->alert($TplConfig["AddBug"]["ErrorTitleLength"] . strlen($_POST["BugTitle"]). "/". $FieldBugTitle["Length"]);
        $MyJS->goto("Back");
        exit;
    }

    /* Get project name. */
    $ProjectInfo = bugGetProjectInfo($_POST["ProjectID"]);
    $ProjectName = $ProjectInfo["ProjectName"];
    
    /* Get modulepath. */
    $ModulePath = bugGetModulePath($_POST["ModuleID"]);
    $ModulePath = "/" . @join("/", @array_reverse($ModulePath));
    
    /* explode assigned to list. */
    $AssignedToList = explode(",",$_POST["AssignedTo"]);
    foreach($AssignedToList as $AssignedTo)
    {
        $AssignedDate   = "";
        $BugTitle       = htmlspecialchars($_POST["BugTitle"]);
        $_POST["Notes"] = htmlspecialchars($_POST["Notes"]);
        
        if(!empty($AssignedTo))
        {
            $AssignedDate = date("Y-m-d: H:i:s");
            
            /* if there're many assigned to users, append every username to BugTitle. */
            if(count($AssignedToList) >=2)
            {
                $BugTitle = $_POST["BugTitle"] . "[$AssignedTo]";
            }
        }
        
        /* Add to table BugInfo¡£*/
        $SQL = "INSERT INTO BugInfo(ProjectID,ProjectName,ModuleID,ModulePath,
                                    BugTitle,BugSeverity,BugType,BugOS,BugStatus,
                                    OpenedBy,OpenedDate,OpenedBuild,
                                    AssignedTo,AssignedDate,MailTo,
                                    LastEditedBy,LastEditedDate) VALUES(
                                    '$_POST[ProjectID]','$ProjectName','$_POST[ModuleID]','$ModulePath',
                                    '$BugTitle','$_POST[BugSeverity]','$_POST[BugType]','$_POST[BugOS]','Active', 
                                    '$_SESSION[BugUserName]',now(),'$_POST[OpenedBuild]',
                                    '$AssignedTo','$AssignedDate','$_POST[MailTo]',
                                    '$_SESSION[BugUserName]',now())";
        if(!$MyDB->query($SQL))
        {
            die($MyDB->errorMsg());
        }
        else
        {
            $BugIdList[$AssignedTo] = $MyDB->insert_ID();
        }
    }

    /* Insert history. */
    bugLogHistory(join(",",$BugIdList),"Opened",$_POST["Notes"]);
    
    /* Copy file and insert record to BugFile table. */
    $FileResultInfo = bugAddFile($_POST["ProjectID"],join(",",$BugIdList));
    
    /* Mail change. */
    if($BugConfig["Mail"]["On"])
    {
        bugMailChange(join(",",$BugIdList),join(",",$AssignedToList),$_POST["MailTo"],$_POST["BugTitle"],"Opened",$_POST["Notes"]);
    }
    
    /* Show result info. */
    $ResultInfo = "Bug " . join(",",$BugIdList) ." " . $TplConfig["AddBug"]["HaveBeenAdded"];
    if(!$FileResultInfo["Success"])
    {
        $ResultInfo .= "\\n" . $TplConfig["AddBug"]["ErrorOccuring"];
        $ResultInfo .= "\\n" . @join("\\n",$FileResultInfo["ErrorInfo"]);
        $ResultInfo .= "\\n" . $TplConfig["AddBug"]["CorrectError"];
        $MyJS->alert($ResultInfo);
    }
    
    /* Refresh the UserControl.php. */
    $MyJS->goto("UserControl.php","parent.LeftBottomFrame");

    /* Go to the info page of the last added bug. */
    $MyJS->goto("BugInfo.php?ProjectID=$_POST[ProjectID]&ModuleID=$_POST[ModuleID]&BugID=".$BugIdList[key($BugIdList)]);
    exit;
}
else
{
    $MyJS->alert($TplConfig["AddBug"]["FillNeededInfo"]);
    $MyJS->goto("Back");
    exit;
}
?>