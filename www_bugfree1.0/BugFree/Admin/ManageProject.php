<?php
/**
 * File to Manage project of BugFree system.
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
 * @version     $Id: ManageProject.php,v 1.3 2005/09/01 07:20:31 wwccss Exp $
 */

/**
 * Init BugFree system.
 */  
require_once("../Include/SetupBug.inc.php");

/**
 * Judge whether the user is an admin user.
 */
bugJudgeAdminUser();

// If the user click the ManageProejct button, the update the project info or insert a new project.
if(!empty($_POST["ManageProject"]))
{
    // Judge the project info.
    if(empty($_POST["ProjectName"]))
    {
        $MyJS->alert($TplConfig["ManageProject"]["ErrorEmptyName"]);
        $MyJS->goto("Back");
        exit;
    }
    else
    {
        // Define the main sql.
        $SQL = " SET ProjectName = '$_POST[ProjectName]',
                     ProjectDoc  = '$_POST[ProjectDoc]',
                     ProjectPlan = '$_POST[ProjectPlan]'";
        
        // Set the begin of the SQL.
        if($_POST["ManageMode"] == "Edit")
        {
            $SQL = " UPDATE BugProject " . $SQL . " WHERE ProjectID = '$_POST[ProjectID]'";
        }
        else
        {
            $SQL = "INSERT INTO BugProject" . $SQL;
        }
        
        // Execute the sql and show the result info.
        if($MyDB->query($SQL))
        {
            if($_POST["ManageMode"] == "Edit")
            {
                // Update BugInfo table.
                $SQL = "UPDATE BugInfo SET ProjectName = '$_POST[ProjectName]' WHERE ProjectID = '$_POST[ProjectID]'";
                $MyDB->query($SQL);
                
                // show the result info.
                $ProjectID = $_POST["ProjectID"];
                $MyJS->alert($_POST["ProjectName"] . $TplConfig["ManageProject"]["SuccessUpdated"]);
            }
            else
            {
                $ProjectID = $MyDB->insert_ID();   // Get the insert id.
                $MyJS->alert($_POST["ProjectName"] . $TplConfig["ManageProject"]["SuccessAdded"]);
            }
            
            // Reload the url of the two frams.
            $MyJS->goto("AdminMenu.php?ProjectID=$ProjectID","parent.AdminMenuFrame");
            $MyJS->goto("ManageProject.php?ProjectID=$ProjectID","parent.AdminMainFrame");
            exit;
        }
    }
}

// If get the ProjectID var, update session.
if(!empty($_GET["ProjectID"]))
{
    $_SESSION["BugProjectID"] = $_GET["ProjectID"];
}

// Get current project info
$ProjectInfo = bugGetProjectInfo($_SESSION["BugProjectID"]);

// Assign project info to template.
$TPL->assign("ProjectInfo",$ProjectInfo);

// Get module pathes list of the project.
$TPL->assign("ModulePathList",    $MyHtml->select(bugGetProjectModulePathes($ProjectInfo["ProjectID"]),"ParentID","Reverse"));
$TPL->assign("SelectModulePath",  $MyJS->selectOption("document.ManageModuleForm.ParentID",$_GET["ParentID"]));

// Assign manage mode.
$TPL->assign("ManageMode", $_GET["ManageMode"]);    // If the mode is add, then reset the form to empty onload.

// Display the template file.
$TPL->display("Admin/ManageProject.tpl");
?>