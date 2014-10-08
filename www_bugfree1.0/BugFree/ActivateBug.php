<?php
/**
 * Activate bug file of BugFree system.
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
 * @version     $Id: ActivateBug.php,v 1.9 2005/09/06 01:10:58 wwccss Exp $
 */
/* Init BugFree system. */
require_once("Include/SetupBug.inc.php");

/* User click the Activate button, updat BugInfo table, add file, mail change, log history. */
if(!empty($_POST["ActivateBug"]))
{
    /* Change Assigned, Resolved, Closed info of BugInfo table. */
    $SQL = "UPDATE BugInfo SET BugStatus       = 'Active',
                               AssignedTo      = '$_POST[AssignedTo]',
                               AssignedDate    = now(),
                               ResolvedBy      = '',
                               Resolution      = '',
                               ResolvedDate    = '',
                               ResolvedBuild   = '',
                               ClosedBy        = '',
                               ClosedDate      = '',
                               LastEditedBy    = '$_SESSION[BugUserName]',
                               LastEditedDate  = now()
                         WHERE BugID           = '$_POST[BugID]'";
    if(!$MyDB->query($SQL))
    {
        die($MyDB->errorMsg());
    }

    /* Copy file and insert record to BugFile table. */
    $FileResultInfo = bugAddFile($_POST["ProjectID"],$_POST["BugID"]);
    if($FileResultInfo["Success"] and !empty($FileResultInfo["FileList"]))
    {
        $History[] = "<B>Add File</B> \"$FileResultInfo[FileList]\"";
    }

    /* Push the notes message. */
    !empty($_POST["Notes"]) ? $History[] = htmlspecialchars($_POST["Notes"]) : "";

    /* Insert the log histoty. */
    bugLogHistory($_POST["BugID"],"Activated", @join("\n",$History));

    /* Mail the change. */
    if($BugConfig["Mail"]["On"])
    {
        $BugInfo = bugGetInfo("Medium"," WHERE BugID='$_POST[BugID]'");
        $BugInfo = $BugInfo[key($BugInfo)];
        bugMailChange($BugInfo["BugID"],$BugInfo["AssignedTo"],$BugInfo["MailTo"],$BugInfo["BugTitle"],"Activated",@join("\n",$History));
    }

    /* If any error, show them. */
    if(!$FileResultInfo["Success"] )
    {
        $ResultInfo  = "Bug " . $_POST["BugID"] . " " . $TplConfig["ActivateBug"]["HaveBeenActivated"];
        $ResultInfo .= "\\n" . $TplConfig["AddBug"]["ErrorOccuring"];
        $ResultInfo .= "\\n" . @join("\\n",$FileResultInfo["ErrorInfo"]);
        $ResultInfo .= "\\n" . $TplConfig["AddBug"]["CorrectError"];
        $MyJS->alert($ResultInfo);
    }

    /* Refresh the UserControl.php. */
    $MyJS->goto("UserControl.php","parent.LeftBottomFrame");

    /* Go to the info page of the last added bug. */
    $MyJS->goto("BugInfo.php?ProjectID=$_POST[ProjectID]&ModuleID=$_POST[ModuleID]&BugID=$_POST[BugID]");
    exit;
}
/* Assgin variables and show the avtivate form. */
else
{
    /* Get users who can access this project. */
    $BugUserList = bugGetUserList(" ProjectID = $_GET[ProjectID]", true);
    $TPL->assign("AssignedToList",   $MyHtml->select($BugUserList,"AssignedTo","Reverse"));
    $TPL->assign("SelectAssignedTo", $MyJS->selectOption("document.ActivateForm.AssignedTo", $_GET["ResolvedBy"]));

    /* Assign ProjectID, ModuleID, BugID,FileFormMode and HistoryList. */
    $TPL->assign("ProjectID",   $_GET["ProjectID"]);
    $TPL->assign("ModuleID",    $_GET["ModuleID"]);
    $TPL->assign("BugID",       $_GET["BugID"]);
    $TPL->assign("FileFormMode","Activate");
    $TPL->assign("HistoryList",  bugGetHistory($_GET["BugID"]));

    /* Display template file. */
    $TPL->display("ActivateBug.tpl");
}
?>