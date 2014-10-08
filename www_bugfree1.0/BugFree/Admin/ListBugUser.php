<?php
/**
 * File to List users of BugFree system.
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
 * @version     $Id: ListBugUser.php,v 1.4 2005/09/08 11:37:53 leeyupeng Exp $
 */

/* Init BugFree system. */
require_once("../Include/SetupBug.inc.php");

/* Judge admin user. */
bugJudgeAdminUser();

/* Get all users. */
$BugUserList  = bugGetUserList(" WHERE 1");
$BugGroupList = bugGetGroupList("", $BugUserList);

/* Del the empty user and Closed user. */
foreach($BugUserList as $UserName => $RealName)
{
    if($UserName == "" or $UserName == "Closed")
    {
        unset($BugUserList[$UserName]);
    }
    else
    {
        if(is_array($BugGroupList))
        {
            foreach($BugGroupList as $GroupInfo)
            {
                $GroupUser = $GroupInfo["GroupUser"];
                if(in_array($UserName, array_keys($GroupUser)))
                {
                    $BugUserGroupList[$UserName][$GroupInfo["GroupID"]] = $GroupInfo["GroupName"];
                }
            }
        }
    }
}

/* Assign to the template. */
$TPL->assign("BugUserList",      $BugUserList);
$TPL->assign("BugUserGroupList", $BugUserGroupList);

/* Display the template file. */
$TPL->display("Admin/ListBugUser.tpl");
?>