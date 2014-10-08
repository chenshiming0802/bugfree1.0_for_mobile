<?php
/**
 * Admin Menu file of BugFree system.
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
 * @version     $Id: AdminMenu.php,v 1.2 2005/09/01 07:15:07 wwccss Exp $
 */

/**
 * Init BugFree system.
 */  
require_once("../Include/SetupBug.inc.php");

/**
 * Judge whether the user is an admin user.
 */
bugJudgeAdminUser();

/**
 * Include HTML_TreeMenu class file.
 */
require_once("TreeMenu.class.php");

// Register current selected project id to session. 
if($_REQUEST["ProjectID"] > 0)
{
    $_SESSION["BugProjectID"] = $_REQUEST["ProjectID"];
}

// Get current project info.
$ProjectInfo = bugGetProjectInfo($_SESSION["BugProjectID"]);

// Set the link url.
$LinkURL = "ManageModule.php";

/*
 * Create module tree of current project. 
 */

// Create an object of HTML_TreeMenu class whose name is TreeMenu defined by function bugGetModules().
$TreeMenu  = new HTML_TreeMenu();

// Eval the HTML_TreeMenu code creaed by bugGetModules() to fill the nodes of module tree.
eval (bugGetModules($ProjectInfo["ProjectID"],1,0,"Module",$LinkURL,"AdminMainFrame"));

// Create an object of HTML_TreeMenu_DHTML class from $TreeMenu.
$ModuleTree = &new HTML_TreeMenu_DHTML($TreeMenu, array('images' => '../Images/TreeMenu', 'defaultClass' => 'treeMenuDefault'));

// Get the DHTML tree content and assign to template.
$TPL->assign("ModuleTree",$ModuleTree->printMenu(false));

// Assign project vars to template.
$TPL->assign("ProjectList",  $MyHtml->select(bugGetProjects(),"ProjectID","Reverse","ProjectForm.submit();parent.AdminMainFrame.location='ManageProject.php?ProjectID='+document.ProjectForm.ProjectID.value"));
$TPL->assign("SelectProject",$MyJS->selectOption("document.ProjectForm.ProjectID",$ProjectInfo["ProjectID"]));
$TPL->assign("ProjectInfo",  $ProjectInfo);

// Display the template file.
$TPL->display("Admin/AdminMenu.tpl");
?>