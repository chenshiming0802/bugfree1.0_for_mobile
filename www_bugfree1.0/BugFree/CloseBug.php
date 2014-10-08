<?php
/**
 * Close bug file of BugFree system.
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
 * @version     $Id: CloseBug.php,v 1.6 2005/09/06 01:15:02 wwccss Exp $
 */
/* Init BugFree system. */  
require_once("Include/SetupBug.inc.php");

if(!empty($_POST["CloseBug"]))
{
    /* Update Assign, Close fileds of BugInfo table. */
    $SQL = "UPDATE BugInfo SET BugStatus       = 'Closed',
                               AssignedTo      = 'Closed',
                               AssignedDate    = now(),
                               ClosedBy        = '$_SESSION[BugUserName]',
                               ClosedDate      = now(),
                               LastEditedBy    = '$_SESSION[BugUserName]',
                               LastEditedDate  = now()  
                         WHERE BugID           = '$_POST[BugID]'";
    if(!$MyDB->query($SQL))
    {
        die($MyDB->errorMsg());
    }
    
    /* Push the notes message. */
    !empty($_POST["Notes"]) ? $History[] = htmlspecialchars($_POST["Notes"]) : "";
    
    bugLogHistory($_POST["BugID"],"Closed", @join("\n",$History));
    
    /* Mail the change. */
    if($BugConfig["Mail"]["On"])
    {
        $BugInfo = bugGetInfo("Medium"," WHERE BugID='$_POST[BugID]'");
        $BugInfo = $BugInfo[key($BugInfo)];
        bugMailChange($BugInfo["BugID"],$BugInfo["AssignedTo"],$BugInfo["MailTo"],$BugInfo["BugTitle"],"Closed",@join("\n",$History));
    }
    
    /* Refresh the UserControl.php. */
    $MyJS->goto("UserControl.php","parent.LeftBottomFrame");
    
    /* Go to the info page of the last added bug. */
    $MyJS->goto("BugInfo.php?ProjectID=$_POST[ProjectID]&ModuleID=$_POST[ModuleID]&BugID=$_POST[BugID]");
    exit;
}
else
{
    /* Judge whether the bug has been opened by me. */
    if($_GET["CloseIt"] != "Yes")
    {
        if($_GET["OpenedBy"] != $_SESSION["BugUserName"])
        { 
            $MyJS->confirm($TplConfig["CloseBug"]["NotOpenedByMe"],$_SERVER["REQUEST_URI"]."&CloseIt=Yes","Back","self");
            exit;
        }
        else
        {
            $MyJS->confirm($TplConfig["CloseBug"]["SureToCloseIt"],$_SERVER["REQUEST_URI"]."&CloseIt=Yes","Back","self");
            exit;
        }
    }
    else
    {        
        /* Assign. */
        $TPL->assign("ProjectID",   $_GET["ProjectID"]);
        $TPL->assign("ModuleID",    $_GET["ModuleID"]);        
        $TPL->assign("BugID",       $_GET["BugID"]);
        $TPL->assign("OpenedBy",    $_GET["OpenedBy"]);
        $TPL->assign("HistoryList",bugGetHistory($_GET["BugID"]));
        
        /* Display template file. */
        $TPL->display("CloseBug.tpl");
    }
}
?>