<?php
/**
 * File to manage module of BugFree system.
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
 * @version     $Id: ManageModule.php,v 1.3 2005/09/01 07:19:22 wwccss Exp $
 */
/**
 * Init BugFree system.
 */  
require_once("../Include/SetupBug.inc.php");

/**
 * Judge whether the user is an admin user.
 */
bugJudgeAdminUser();

if(!empty($_POST["ManageModule"]))
{
    if(empty($_POST["ModuleName"]))
    {
        $MyJS->alert($TplConfig["ManageModule"]["ErrorEmptyName"]);
        $MyJS->goto("Back");
        exit;
    }
    else
    {
        if($_POST["ManageMode"] == "Edit")
        {
            if($_POST["ParentID"] == $_POST["ModuleID"])
            {
                $MyJS->alert($TplConfig["ManageModule"]["ErrorParentID"]);
                $MyJS->goto("Back");
                exit;
            }
        }
        // Get the parent module grade.
        $ParentModuleID     = $MyDB->getOne("SELECT ModuleGrade  AS ParentModuleGrade FROM BugModule WHERE ModuleID = '$_POST[ParentID]'");
        
        // Set the current module grade.
        $CurrentModuleGrade = $ParentModuleID + 1;
        
        // Define the main of the query string.
        $SQL = " SET ProjectID   = '$_POST[ProjectID]',
                     ModuleName  = '$_POST[ModuleName]',
                     ModuleGrade = '$CurrentModuleGrade',
                     ParentID    = '$_POST[ParentID]'";
        
        // Set the begin of the query string.                    
        if($_POST["ManageMode"] == "Edit")
        {
            $SQL = "Update BugModule " . $SQL . " WHERE ModuleID = '$_POST[ModuleID]'";
        }
        else
        {
            $SQL = "INSERT INTO BugModule " . $SQL;
        }
        
        // Execute the sql and show the result info.
        if($MyDB->query($SQL))
        {
            if($_POST["ManageMode"] == "Edit")
            {
                // Update ProjectID, ProjectName fields of BugInfo table.
                $ProjectInfo = bugGetProjectInfo($_POST["ProjectID"]);
                $SQL         = "UPDATE BugInfo SET ProjectID = '$ProjectInfo[ProjectID]', 
                                                 ProjectName = '$ProjectInfo[ProjectName]'
                                           WHERE ModuleID    = '$_POST[ModuleID]'";
                $MyDB->query($SQL);
                
                // Update ModulePath field of BugInfo table.
                $ModulePath = bugGetModulePath($_POST["ModuleID"]);
                $ModulePath = "/" . join("/",@array_reverse($ModulePath));
                $SQL        = "UPDATE BugInfo SET ModulePath = '$ModulePath' WHERE ModuleID = '$_POST[ModuleID]'";
                $MyDB->query($SQL);
                
                // Show Result Info.
                $ModuleID = $_POST["ModuleID"];
                $MyJS->alert($_POST["ModuleName"] . $TplConfig["ManageModule"]["SuccessUpdated"]);
            }
            else
            {
                $ModuleID = $MyDB->insert_ID();
                $MyJS->alert($_POST["ModuleName"] . $TplConfig["ManageModule"]["SuccessAdded"]);
            }
            
            // Reload the url of the two frams.
            $ModuleName =  urlencode($_POST["ModuleName"]);
            $MyJS->goto("AdminMenu.php?ProjectID=$_POST[ProjectID]","parent.AdminMenuFrame");
            $MyJS->goto("ManageModule.php?ProjectID=$_POST[ProjectID]&ModuleID=$ModuleID&ModuleGrade=$CurrentModuleGrade&ParentID=$_POST[ParentID]&ModuleName=$ModuleName","parent.AdminMainFrame");
            exit;
       }
    }
}
// Assign project info to template.
$TPL->assign("ProjectInfo",bugGetProjectInfo($_GET["ProjectID"]));

// Get all projects list.
$TPL->assign("ProjectList",  $MyHtml->select(bugGetProjects(),"ProjectID","Reverse","location='ManageModule.php?ProjectID='+this.value+'&ModuleID='+document.ManageModuleForm.ModuleID.value+'&ModuleName='+document.ManageModuleForm.ModuleName.value"));
$TPL->assign("SelectProject",$MyJS->selectOption("document.ManageModuleForm.ProjectID",$_GET["ProjectID"],"selectProject"));

// Get module pathes list of the project.
$TPL->assign("ModulePathList",          $MyHtml->select(bugGetProjectModulePathes($_GET["ProjectID"]),"ParentID","Reverse"));
$TPL->assign("SelectParentModulePath",  $MyJS->selectOption("document.ManageModuleForm.ParentID",$_GET["ParentID"],"selectParent"));
$TPL->assign("SelectCurrentModulePath", $MyJS->selectOption("document.ManageModuleForm.ParentID",$_GET["ModuleID"],"selectCurrent"));

// Assign the module info to template.
$TPL->assign("ModuleID",$_GET["ModuleID"]);
$TPL->assign("ModuleName",$_GET["ModuleName"]);

// Display the template file.
$TPL->display("Admin/ManageModule.tpl");
?>