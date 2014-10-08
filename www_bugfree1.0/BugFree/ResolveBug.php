<?php
/**
 * Resolve bug info file of BugFree system.
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
 * @version     $Id: ResolveBug.php,v 1.7 2005/09/06 01:17:32 wwccss Exp $
 */
/* Init BugFree system. */
require_once("Include/SetupBug.inc.php");

if(!empty($_POST["ResolveBug"]))
{
    /* 1.1 Must set the resolution. */
    if (empty($_POST["Resolution"]))
    {
        $MyJS->Alert($TplConfig["ResolveBug"]["MustSetResolution"]);
        $MyJS->goto("Back");
        exit;
    }

    /* 1.2 If the Resolution is Duplicate, must set the LinkID. */
    if ($_POST[Resolution] == "Duplicate" && $_POST[LinkID] == "")
    {
        $MyJS->Alert($TplConfig["ResolveBug"]["MustSetlLinkID"]);
        $MyJS->goto("Back");
        exit;
    }

    /* 2 Update Bug Info: AssingedTo, Resolved, LastEdit. */
    $SQL = "UPDATE BugInfo SET BugStatus   = 'Resolved',
                           LinkID          = '$_POST[LinkID]',
                           AssignedTo      = OpenedBy,
                           AssignedDate    = now(),
                           ResolvedBy      = '$_SESSION[BugUserName]',
                           Resolution      = '$_POST[Resolution]',
                           ResolvedDate    = now(),
                           ResolvedBuild   = '$_POST[ResolvedBuild]',
                           LastEditedBy    = '$_SESSION[BugUserName]',
                           LastEditedDate  = now()
                     WHERE BugID           = '$_POST[BugID]'";
    if(!$MyDB->query($SQL))
    {
        die($MyDB->errorMsg());
    }

    /* 3 Copy file and insert record to BugFile table. */
    $FileResultInfo = bugAddFile($_POST["ProjectID"],$_POST["BugID"]);
    if($FileResultInfo["Success"] and !empty($FileResultInfo["FileList"]))
    {
        $History[] = "<B>Add File</B> \"$FileResultInfo[FileList]\"";
    }

    /* 4 Log history. */

    /* 4.1 If the AssignedTo not is current operating user, insert a AssignedTo log. */
    if($_POST["AssignedTo"] != $_SESSION["BugUserName"])
    {
        bugLogHistory($_POST["BugID"],"Assigned To \"" . $_SESSION["BugUserName"] . "\"");
    }

    /* 4.2 Push the notes message. */
    !empty($_POST["Notes"]) ? $History[] = htmlspecialchars($_POST["Notes"]) : "";

    /* 4.3 Define the action. */
    $Action  = "Resolved AS \"" . $_POST["Resolution"] . "\"";

    /* 4.4 Insert the log histoty. */
    bugLogHistory($_POST["BugID"],$Action, @join("\n",$History));

    /* 5 Mail the change. */
    if($BugConfig["Mail"]["On"])
    {
        $BugInfo = bugGetInfo("Medium"," WHERE BugID='$_POST[BugID]'");
        $BugInfo = $BugInfo[key($BugInfo)];
        bugMailChange($BugInfo["BugID"],$BugInfo["AssignedTo"],$BugInfo["MailTo"],$BugInfo["BugTitle"],$Action,@join("\n",$History));
    }

    /* 6 Show the result info. */
    $ResultInfo = "Bug " . $_POST["BugID"] . " " . $TplConfig["ResolveBug"]["HaveBeenResolved"];
    if(!$FileResultInfo["Success"] )
    {
        $ResultInfo .= "\\n" . $TplConfig["AddBug"]["ErrorOccuring"];
        $ResultInfo .= "\\n" . @join("\\n",$FileResultInfo["ErrorInfo"]);
        $ResultInfo .= "\\n" . $TplConfig["AddBug"]["CorrectError"];
        $MyJS->alert($ResultInfo);
    }

    /* 7 Refresh the UserControl.php. */
    $MyJS->goto("UserControl.php","parent.LeftBottomFrame");

    /* 8 Go to the info page of the last added bug. */
    $MyJS->goto("BugInfo.php?ProjectID=$_POST[ProjectID]&ModuleID=$_POST[ModuleID]&BugID=$_POST[BugID]");
    exit;
}
else
{
    /* Judge whether the bug has been assigned to me. */
    if($_GET["AssignedTo"] != $_SESSION["BugUserName"] and $_GET["AssignToMe"] != "Yes")
    {
        $MyJS->confirm($TplConfig["ResolveBug"]["NotAssignedToMe"],$_SERVER["REQUEST_URI"]."&AssignToMe=Yes","Back","self");
        exit;
    }
    else
    {
        /* Assign. */
        $TPL->assign("ProjectID",    $_GET["ProjectID"]);
        $TPL->assign("ModuleID",     $_GET["ModuleID"]);
        $TPL->assign("BugID",        $_GET["BugID"]);
        $TPL->assign("AssignedTo",   $_GET["AssignedTo"]);
        $TPL->assign("HistoryList",  bugGetHistory($_GET["BugID"]));
        $TPL->assign("FileFormMode", "Resolve");     // Used in AddFiles.tpl to control the width of table.

        /* Assign Resolution list. */
        $TPL->assign("ResolutionList",  $MyHtml->select($BugConfig["Resolutions"],"Resolution","Reverse"));
        $TPL->assign("SelectResolution",$MyJS->selectOption("document.ResolveForm.Resolution","Fixed"));
        $TPL->assign("ResolvedBuildList",$MyHtml->select(bugSetBuild($_GET["ProjectID"]), "ResolvedBuild"));

        /* Display template file. */
        $TPL->display("ResolveBug.tpl");
    }
}
?>