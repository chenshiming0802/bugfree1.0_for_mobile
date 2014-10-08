<?php
/**
 * Update bug info file of BugFree system.
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
 * @version     $Id: UpdateBug.php,v 1.9 2005/09/10 07:34:25 wwccss Exp $
 */
/* Init BugFree system. */
require_once("Include/SetupBug.inc.php");

/* Judge the bug info. */
if(empty($_POST["BugID"]) or empty($_POST["BugTitle"]))
{
  $MyJS->Alert($TplConfig["UpdateBug"]["FillNeededInfo"]);
  $MyJS->goto("Back");
  exit;
}

/* Judge the length of title. */    
$FieldBugTitle  = dbGetFieldInfo("BugInfo", "BugTitle"); 
if(strlen($_POST["BugTitle"]) > $FieldBugTitle["Length"])
{
    $MyJS->alert($TplConfig["UpdateBug"]["ErrorTitleLength"] . strlen($_POST["BugTitle"]). "/". $FieldBugTitle["Length"]);
    $MyJS->goto("Back");
    exit;
}

/* Deal with specialchars of Title and notes. */
$_POST["BugTitle"] = htmlspecialchars($_POST["BugTitle"]);
$_POST["Notes"]    = htmlspecialchars($_POST["Notes"]);

/* Get origianl info. */
$BugInfo = bugGetInfo("Max"," WHERE BugID = '$_POST[BugID]'");
$BugInfo = $BugInfo[key($BugInfo)];

/* Get current ProjectName. */
$ProjectInfo = bugGetProjectInfo($_POST["ProjectID"]);

/* Get module path. */
$ModulePath = bugGetModulePath($_POST["ModuleID"]);
$ModulePath = "/" . @join("/",@array_reverse($ModulePath));

/* Push ProjectName and ModulePath to $_POST. */
$_POST["ProjectName"] = $ProjectInfo["ProjectName"];
$_POST["ModulePath"]  = $ModulePath;

/* Cycle the $BugInfo and compare with $_POST to get changed field, so we can create the history content. */
foreach ($BugInfo as $FieldName=>$FieldValue)
{
    !get_magic_quotes_runtime() ? $FieldValue = addslashes($FieldValue) : "";

    /* Don't judge item whoes name include"ID" or "Date" or "Real". */
    if($FieldName != "BugID" and $FieldName != "ShortBugTitle" and !eregi("Real",$FieldName) and !eregi("LastEdited",$FieldName) and $FieldValue != $_POST[$FieldName])
    {
        $History[] = "Change <B>$FieldName</B> FROM <B>\"$FieldValue\"</B> TO <B>\"$_POST[$FieldName]\"</B>";
    }
}

/* Set the LastEditedBy Info. */
if($_POST["LastEditedBy"] != $BugInfo["LastEditedBy"])
{
    $LastEditedBy = $_POST["LastEditedBy"];
}
else
{
    $LastEditedBy = $_SESSION["BugUserName"];
}

/* Set LastEditedDate. */
if($_POST["LastEditedDate"] != $BugInfo["LastEditedDate"])
{
    $LastEditedDate = $_POST["LastEditedDate"];
}
else
{
    $LastEditedDate = date("Y-m-d H:i:s");
}

/* If AssignedTo is changed but AssignedDate not changed, change AssignedDate to now. */
if($_POST["AssignedTo"] != $BugInfo["AssignedTo"] and $_POST["AssignedDate"] == $BugInfo["AssignedDate"])
{
    $_POST["AssignedDate"] = date("Y-m-d H:i:s");
    $History[] = "Change <B>AssignedDate</B> FROM <B>\"$BugInfo[AssignedDate]\"</B> TO <B>\"$_POST[AssignedDate]\"</B>";
}

/* Update BugInfo table. */
$SQL = "UPDATE BugInfo SET ProjectID       = '$_POST[ProjectID]',
                           ProjectName     = '$_POST[ProjectName]',
                           ModuleID        = '$_POST[ModuleID]',
                           ModulePath      = '$_POST[ModulePath]',
                           BugTitle        = '$_POST[BugTitle]',
                           OpenedBuild     = '$_REQUEST[OpenedBuild]',
                           BugType         = '$_POST[BugType]',
                           BugOS           = '$_POST[BugOS]',
                           BugSeverity     = '$_POST[BugSeverity]',
                           BugStatus       = '$_POST[BugStatus]',
                           AssignedTo      = '$_POST[AssignedTo]',
                           AssignedDate    = '$_POST[AssignedDate]',
                           MailTo          = '$_POST[MailTo]',
                           OpenedBy        = '$_POST[OpenedBy]',
                           OpenedDate      = '$_POST[OpenedDate]',
                           ResolvedBy      = '$_POST[ResolvedBy]',
                           Resolution      = '$_POST[Resolution]',
                           ResolvedDate    = '$_POST[ResolvedDate]',
                           ResolvedBuild   = '$_POST[ResolvedBuild]',
                           ClosedBy        = '$_POST[ClosedBy]',
                           ClosedDate      = '$_POST[ClosedDate]',
                           LastEditedBy    = '$LastEditedBy',
                           LastEditedDate  = '$LastEditedDate',
                           LinkID          = '$_POST[LinkID]'
                     WHERE BugID           = '$_POST[BugID]'";

if(!$MyDB->query($SQL))
{
    die($MyDB->errorMsg());
}

/* Copy file and insert record to BugFile table. */
$FileResultInfo = bugAddFile($_POST["ProjectID"],$BugInfo["BugID"]);
if($FileResultInfo["Success"] and !empty($FileResultInfo["FileList"]))
{
    $History[] = "<B>Add File</B> \"$FileResultInfo[FileList]\"";
}

/* Add Notes to history. */
if(!empty($_POST["Notes"]))
{
    $History[] = $_POST["Notes"];
}

if(!empty($History))
{
    /* Insert history. */
    bugLogHistory($BugInfo["BugID"],"Edited",join("\n",$History));

    /* Mail change. */
    if($BugConfig["Mail"]["On"])
    {
        bugMailChange($BugInfo["BugID"],$_POST["AssignedTo"],$_POST["MailTo"],$_POST["BugTitle"],"Edited",join("\n",$History));
    }
}

/* Show the result info. */
if(!$FileResultInfo["Success"] )
{
    $ResultInfo  = "Bug " . $BugInfo["BugID"] . " " . $TplConfig["UpdateBug"]["HaveBeenUpdated"];
    $ResultInfo .= "\\n" . $TplConfig["AddBug"]["ErrorOccuring"];
    $ResultInfo .= "\\n" . @join("\\n",$FileResultInfo["ErrorInfo"]);
    $ResultInfo .= "\\n" . $TplConfig["AddBug"]["CorrectError"];
    $MyJS->alert($ResultInfo);
}

/* Refresh the UserControl.php. */
$MyJS->goto("UserControl.php","parent.LeftBottomFrame");

/* Go to the info page of the last added bug. */
$MyJS->goto("BugInfo.php?ProjectID=$_POST[ProjectID]&ModuleID=$_POST[ModuleID]&BugID=".$BugInfo["BugID"]);
?>