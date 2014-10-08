<?php
/**
 * User control panel file of BugFree system.
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
 * @version     $Id: UserControl.php,v 1.8 2005/09/10 08:05:41 wwccss Exp $
 */

/**
 * Init BugFree system.
 */  
require_once("Include/SetupBug.inc.php");

// Get the Latest five buges assigned to me.
$Where = " WHERE AssignedTo = '$_SESSION[BugUserName]' AND BugStatus != 'Closed' ORDER BY BugID DESC LIMIT 0,5";
$TPL->assign("AssignToMe",bugGetInfo("Medium",$Where,$BugConfig["ControlTitleLength"],false));

// Get the Latest five buges opened by me.
$Where = " WHERE OpenedBy = '$_SESSION[BugUserName]' AND BugStatus != 'Closed' ORDER BY BugID DESC LIMIT 0,5";
$TPL->assign("OpenedByMe",bugGetInfo("Medium",$Where,$BugConfig["ControlTitleLength"],false));

// Get the user's defined query.
$UserQueryList = bugGetUserQuery();
if(is_array($UserQueryList) and count($UserQueryList) > 0)
{
    $TPL->assign("UserQueryList",  $MyHtml->select($UserQueryList,"UserQueryID' accesskey='U","Reverse"));
    $TPL->assign("SelectUserQuery",$MyJS->selectOption("document.ControlForm.UserQueryID",$_REQUEST["UserQueryID"]));
}

// Display the template file.
$TPL->display("UserControl.tpl");
?>