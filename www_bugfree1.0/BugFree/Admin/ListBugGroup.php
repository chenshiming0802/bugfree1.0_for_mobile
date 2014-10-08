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
 * @version     $Id: ListBugGroup.php,v 1.1 2005/09/01 07:25:08 wwccss Exp $
 */
/**
 * Init BugFree system.
 */
require_once("../Include/SetupBug.inc.php");

/* Judge admin user. */
bugJudgeAdminUser();

/* Get all user, project and group list. */
$BugUserList  = bugGetUserList(" WHERE 1", true);
$ProjectList  = bugGetProjects();
$BugGroupList = bugGetGroupList("", $BugUserList, $ProjectList);

/* Assign. */
$TPL->assign("ProjectList",  $MyHtml->select($ProjectList, "ProjectList","Reverse","",5));
$TPL->assign("BugUserList",  $MyHtml->select($BugUserList, "BugUserList","Reverse","",5));
$TPL->assign("BugGroupList", $BugGroupList);
$TPL->assign("ManageMode",   "Add");

/* Edit a group. */
if(!empty($_GET["BugGroupID"]))
{
    $BugGroupID   = $_GET["BugGroupID"];
    $BugGroupInfo = bugGetGroupList("WHERE GroupID = '$BugGroupID'");
    $BugGroupInfo = $BugGroupInfo[$BugGroupID];
    $TPL->assign("BugGroupInfo",  $BugGroupInfo);
    $TPL->assign("GroupUserList", $MyHtml->select($BugGroupInfo["GroupUser"],       "GroupUserList","Reverse","",5));
    $TPL->assign("GroupAclList",  $MyHtml->select($BugGroupInfo["ProjectNameList"], "GroupAclList","Reverse","",5));
    $TPL->assign("ManageMode",    "Edit");
}

/* Display. */
$TPL->display("Admin/ListBugGroup.tpl")
?>