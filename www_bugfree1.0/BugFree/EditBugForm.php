<?php
/**
 * Edit bug window BugFree system.
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
 * @version     $Id: EditBugForm.php,v 1.5 2005/09/02 07:37:20 wwccss Exp $
 */

/* Init BugFree system. */  
require_once("Include/SetupBug.inc.php");

/* Assign current REQUEST_URI to session used by RightMenu.php. */
$_SESSION["RightBottomURL"] = $_SERVER["REQUEST_URI"];

/* Assign BugInfo */
$BugInfo = bugGetInfo("Max"," WHERE BugID = '$_GET[BugID]'");
$BugInfo = $BugInfo[key($BugInfo)];
$TPL->assign("BugInfo",$BugInfo);

/* Assign projects list.*/
$TPL->assign("ProjectList",  $MyHtml->select(bugGetProjects(),"ProjectID","Reverse","location='EditBugForm.php?ProjectID='+this.value+'&BugID=$_GET[BugID]'"));
$TPL->assign("SelectProject",$MyJS->selectOption("document.EditForm.ProjectID",$_GET["ProjectID"]));

/* Assign module pathes list of current working project. */
$TPL->assign("ModulePathList",    $MyHtml->select(bugGetProjectModulePathes($_GET["ProjectID"]),"ModuleID","Reverse"));
$TPL->assign("SelectModulePath",  $MyJS->selectOption("document.EditForm.ModuleID",$_GET["ModuleID"]));

/* Assign type list. */
$TPL->assign("BugTypeList",       $MyHtml->select($BugConfig["Types"],"BugType","Reverse"));
$TPL->assign("SelectBugType",     $MyJS->selectOption("document.EditForm.BugType",$BugInfo["BugType"]));

/* Assign OS list. */
$TPL->assign("BugOSList",         $MyHtml->select($BugConfig["BugOS"],"BugOS","Reverse"));
$TPL->assign("SelectBugOS",       $MyJS->selectOption("document.EditForm.BugOS",$BugInfo["BugOS"]));

/* Assign severity list. */
$TPL->assign("BugSeverityList",   $MyHtml->select($BugConfig["Severitys"],"BugSeverity","Reverse"));
$TPL->assign("SelectBugSeverity", $MyJS->selectOption("document.EditForm.BugSeverity",$BugInfo["BugSeverity"]));

/* Assign status list. */
$TPL->assign("BugStatusList",     $MyHtml->select($BugConfig["Status"],"BugStatus","Reverse"));
$TPL->assign("SelectBugStatus",   $MyJS->selectOption("document.EditForm.BugStatus",$BugInfo["BugStatus"]));

/* Get BugUserList. */
$ProjectUserList = bugGetUserList("ProjectID = $BugInfo[ProjectID]",true);    // Only users who can access current project.
$BugUserList     = bugGetUserList("",true);                                   // All users.

/* Assign AssignedTo list. */
$TPL->assign("AssignedToList",    $MyHtml->select($ProjectUserList,"AssignedTo","Reverse"));
$TPL->assign("SelectAssignedTo",  $MyJS->selectOption("document.EditForm.AssignedTo",$BugInfo["AssignedTo"]));

/* Assign LastEditedBy list. */
$TPL->assign("LastEditedByList",  $MyHtml->select($BugUserList,"LastEditedBy","Reverse"));
$TPL->assign("SelectLastEditedBy",$MyJS->selectOption("document.EditForm.LastEditedBy",$BugInfo["LastEditedBy"]));

/* Assign OpenedBy list. */
$TPL->assign("OpenedByList",      $MyHtml->select($BugUserList,"OpenedBy","Reverse"));
$TPL->assign("SelectOpenedBy",    $MyJS->selectOption("document.EditForm.OpenedBy",$BugInfo["OpenedBy"]));

/* Assign ResolvedBy list. */
$TPL->assign("ResolvedByList",    $MyHtml->select($BugUserList,"ResolvedBy","Reverse"));
$TPL->assign("SelectResolvedBy",  $MyJS->selectOption("document.EditForm.ResolvedBy",$BugInfo["ResolvedBy"]));

/* Assign Resolution list. */
$TPL->assign("ResolutionList",    $MyHtml->select($BugConfig["Resolutions"],"Resolution","Reverse"));
$TPL->assign("SelectResolution",  $MyJS->selectOption("document.EditForm.Resolution",$BugInfo["Resolution"]));

/* Assign ClosedBy list. */
$TPL->assign("ClosedByList",      $MyHtml->select($BugUserList,"ClosedBy","Reverse"));
$TPL->assign("SelectClosedBy",    $MyJS->selectOption("document.EditForm.ClosedBy",$BugInfo["ClosedBy"]));

/* Assign the file form mode. */
$TPL->assign("FileFormMode","Update");

/* Assign history. */
$TPL->assign("HistoryList",bugGetHistory($_GET["BugID"]));

/* Display. */
$TPL->display("EditBugForm.tpl");
?>