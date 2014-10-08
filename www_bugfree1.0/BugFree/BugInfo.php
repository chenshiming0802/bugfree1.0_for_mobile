<?php
/**
 * Bug info window of BugFree system.
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
 * @version     $Id: BugInfo.php,v 1.8 2005/09/02 07:35:58 wwccss Exp $
 */

/**
 * Init BugFree system.
 */  
require_once("Include/SetupBug.inc.php");

// Assign current REQUEST_URI to session used by RightMenu.php.(It's differnt from the template var:RequestURI)
$_SESSION["RightBottomURL"] = $_SERVER["REQUEST_URI"];

// Get project name.
$ProjectInfo = bugGetProjectInfo($_GET["ProjectID"]);

// Get module path.
$ModulePath = bugGetModulePath($_GET["ModuleID"]);
$ModulePath = "/" . @join("/",@array_reverse($ModulePath));

// Assign project name and module path to template.
$TPL->assign("ProjectModule",$ProjectInfo["ProjectName"] . $ModulePath);

// Get bug info 
$BugInfo = bugGetInfo("Max"," WHERE BugID = '$_GET[BugID]'");
$BugInfo = $BugInfo[key($BugInfo)];

// Set localized item.
$BugInfo["BugTypeLocalized"]     = $BugConfig["Types"][$BugInfo["BugType"]];
$BugInfo["BugOSLocalized"]       = $BugConfig["BugOS"][$BugInfo["BugOS"]];
$BugInfo["BugSeverityLocalized"] = $BugConfig["Severitys"][$BugInfo["BugSeverity"]];

// Assign buginfo to template.
$TPL->assign("BugInfo",$BugInfo);

// Assign bug file.
$TPL->assign("BugFileList",bugGetFiles($_GET["BugID"]));

// Assign history.
$TPL->assign("HistoryList",bugGetHistory($_GET["BugID"]));

// Assign linking bugs.
if(!empty($BugInfo["LinkID"]))
{
    $TPL->assign("LinkBugList",bugGetInfo("Medium"," WHERE BugID".dbCreateIN($BugInfo["LinkID"])));
}

// Assing the PageID of QueryBug.php to template.
$TPL->assign("QueryPageID",$_SESSION["QueryPageID"]);

// Display template file.
$TPL->display("BugInfo.tpl");
?>