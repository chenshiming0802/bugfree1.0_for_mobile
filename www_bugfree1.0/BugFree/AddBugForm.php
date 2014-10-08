<?php
/**
 * New bug window of BugFree system.
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
 * @version     $Id: AddBugForm.php,v 1.5 2005/09/06 01:13:39 wwccss Exp $
 */
/* Init BugFree system. */
require_once("Include/SetupBug.inc.php");

/* Assign current REQUEST_URI to session used by RightMenu.php. */
$_SESSION["RightBottomURL"] = $_SERVER["REQUEST_URI"];

/* Set current working project id. */
if($_GET["ProjectID"])
{
    $_SESSION["BugProjectID"] = $_GET["ProjectID"];
}
elseif(empty($_SESSION["BugProjectID"]))
{
    $ProjectInfo              = bugGetProjectInfo();
    $ProjectID                = $ProjectInfo["ProjectID"];
    $_SESSION["BugProjectID"] = $ProjectID;
}

/* Set current module id. */
$_GET["ModuleID"] > 0 ? $_SESSION["BugModuleID"] = $_GET["ModuleID"] : "";

/* Assign projects list. */
$TPL->assign("ProjectList",  $MyHtml->select(bugGetProjects(),"ProjectID","Reverse","location='AddBugForm.php?ProjectID='+this.value"));
$TPL->assign("SelectProject",$MyJS->selectOption("document.AddForm.ProjectID",$_SESSION["BugProjectID"]));

/* Assign module pathes list. */
$TPL->assign("ModulePathList",  $MyHtml->select(bugGetProjectModulePathes($_SESSION["BugProjectID"]),"ModuleID","Reverse"));
$TPL->assign("SelectModulePath",$MyJS->selectOption("document.AddForm.ModuleID",$_SESSION["BugModuleID"]));

/* Assign bug users who can access current working project. */
$BugUserList = bugGetUserList("ProjectID = $_SESSION[BugProjectID]", true);
unset($BugUserList[""]);         // Remove the empty user.
unset($BugUserList["Closed"]);   // Remove the Closed user.
$TPL->assign("BugUserList",$MyHtml->select($BugUserList, "BugUserList", "Reverse", "", 5));

/* Assign bug build version, type list, severity list and os list. */
$TPL->assign("OpenedBuildList",$MyHtml->select(bugSetBuild($_SESSION["BugProjectID"]), "OpenedBuild"));
$TPL->assign("BugTypeList",    $MyHtml->select($BugConfig["Types"], "BugType", "Reverse"));
$TPL->assign("BugSeverityList",$MyHtml->select($BugConfig["Severitys"], "BugSeverity", "Reverse"));
$TPL->assign("BugOS",          $MyHtml->select($BugConfig["BugOS"], "BugOS", "Reverse"));

/* Display. */
$TPL->display("AddBugForm.tpl");
?>