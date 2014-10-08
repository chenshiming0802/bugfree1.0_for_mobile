<?php
/**
 * File to del a user of BugFree system.
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
 * @version     $Id: DelBugUser.php,v 1.4 2005/09/08 13:37:39 wwccss Exp $
 */

/* Init BugFree system. */
require_once("../Include/SetupBug.inc.php");

/* Judge whether the user is an admin user. */
bugJudgeAdminUser();

/* The user to delete is current user, don't delete. */
if($_GET["BugUserName"] == $_SESSION["BugUserName"])
{
    $MyJS->alert($TplConfig["DelBugUser"]["ErrorDelSelf"]);
    $MyJS->goto("Back");
    exit;
}
/* Del the user. */
else
{
    if($_GET["Delete"] == "Yes")
    {
        /* 1. Update the BugGroup table. */
        $BugGroupList = bugGetGroupList(" WHERE GroupUser LIKE '%,$_GET[BugUserName],%'");
        if(is_array($BugGroupList))
        {
            foreach($BugGroupList as $GroupID => $GroupInfo)
            {
                /* Delete the user  from current group. */
                $GroupUser = $GroupInfo["GroupUser"];
                unset($GroupUser[$_GET["BugUserName"]]);  
                
                /* Create new group user list then update the table. */  
                $GroupUser = "," . @join(",", @array_keys($GroupUser)) . ",";
                $SQL = "UPDATE BugGroup SET GroupUser = '$GroupUser' WHERE GroupID = '$GroupID'";
                if(!$MyDB->query($SQL))
                {
                    die($MyDB->errorMsg());
                }
            }
        }
        
        /* 2. Dele from the BugUser table. */
        $SQL    = "DELETE FROM {$BugConfig["UserTable"]["TableName"]} WHERE {$BugConfig["UserTable"]["UserName"]} = '$_GET[BugUserName]'";
        $DBName = !empty($BugConfig["UserDB"]) ? "MyUserDB" : "MyDB";
        if(!$$DBName->query($SQL))
        {
            die($$DBName->errorMsg());
        }
        
        /* 3. Show the result info. */
        $MyJS->alert($_GET["BugUserName"] . $TplConfig["DelBugUser"]["Success"]);
        $MyJS->goto("ListBugUser.php");
        exit;
    }
    else
    {
        $MyJS->Confirm($TplConfig["DelBugUser"]["ConfirmInfo"],"DelBugUser.php?Delete=Yes&BugUserName=$_GET[BugUserName]","Back");
    }
}
?>