<?php
/**
 * File to add a group of BugFree system.
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
 * @version     $Id: ManageBugGroup.php,v 1.2 2005/09/23 12:16:40 wwccss Exp $
 */

/* Init BugFree system. */
require_once("../Include/SetupBug.inc.php");

/* Judge admin. */
bugJudgeAdminUser();

/* Check values and insert into table. */
if(!empty($_POST["GroupName"]))
{
    /* Judge whether there's group with the same GroupName. */
    if($_POST["ManageMode"] == "Add" and bugGetGroupList(" WHERE GroupName = '$_POST[GroupName]'"))
    {
        $MyJS->alert($TplConfig["ManageBugGroup"]["ErrorSameGroupName"]);
        $MyJS->goto("Back");
        exit;
    }
    
    /* If the mode is edit, judge the group id. */
    if($_POST["ManageMode"] == "Edit" and empty($_POST["GroupID"]))
    {
        $MyJS->alert($TplConfig["ManageBugGroup"]["ErrorGroupID"]);
        $MyJS->goto("Back");
        exit;
    }
    
    /* Add "," at both end of the variable finally like this: ,wwccss,admin, */
    $GroupUser = !empty($_POST["GroupUser"]) ? ",$_POST[GroupUser]," : "";

    /* Set acl list and serialize it. */
    if(!empty($_POST["GroupACL"]))
    {
        $_POST["GroupACL"] = explode(",", $_POST["GroupACL"]);
        foreach($_POST["GroupACL"] as $ProjectID)
        {
            $GroupPrivSet[$ProjectID] = "All";
        }
    }
    $GroupPrivSet = serialize($GroupPrivSet);
    
    /* Insert or update. */
    if($_POST["ManageMode"] == "Edit")
    {
        $SQL = "UPDATE BugGroup SET GroupName = '$_POST[GroupName]',
                                    GroupUser = '$GroupUser',
                                    GroupACL  = '$GroupPrivSet',
                                    LastDate  = NOW()
                              WHERE GroupID   = '$_POST[GroupID]' LIMIT 1";
    }
    else
    {
        $SQL = "INSERT INTO BugGroup (GroupName, GroupUser,GroupACL, LastDate) VALUES('$_POST[GroupName]','$GroupUser','$GroupPrivSet',now())";
    }
    
    if($MyDB->query($SQL))
    {
        $MyJS->alert($TplConfig["ManageBugGroup"]["Success"]);
        $MyJS->goto("ListBugGroup.php" . ($_POST["ManageMode"] == "Edit" ? "?BugGroupID=$_POST[GroupID]" : ""));
        exit;
    }
    else
    {
        die($MyDB->errorMsg());
    }
}
else
{
    $MyJS->alert($TplConfig["ManageBugGroup"]["ErrorEmptyValue"]);
    $MyJS->goto("Back");
    exit;
}
?>