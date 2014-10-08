<?php
/**
 * File to Mail bugs assigned to somebody of BugFree system.
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
 * @version     $Id: NoticeBug.php,v 1.4 2005/09/01 02:09:27 wwccss Exp $
 */
/**
 * Init BugFree system.
 */
require_once("Include/SetupBug.inc.php");

// Get all bugs not cloased.
$BugList = bugGetInfo("Max"," WHERE AssignedTo != 'Closed' ORDER BY LastEditedDate DESC");

// Cycle $BugList to group bugs by AssignedTo.
foreach($BugList as $BugInfo)
{
    $BugGroupedList[$BugInfo["AssignedTo"]][] = $BugInfo;
}

// Get all AssignedTo user's email list.
$EmailList = bugGetUserEmail(@join(",",@array_keys($BugGroupedList)));

// Cycle the BugGroupedList to mail.
foreach($BugGroupedList as $AssignedTo => $UserBugList)
{
    // Get css style.
    $CssStyle = join("",file("Include/LangFile/".$BugConfig["Language"].$BugConfig["CssStyle"].".css"));
    $TPL->assign("CssStyle",$CssStyle);

    // Bug Info.
    $TPL->assign("UserBugList",$UserBugList);

    // Get bug list message in html.
    $Message = $TPL->fetch("NoticeBug.tpl");
    $Subject = $TplConfig["NoticeBug"]["Subject"] . " ". count($UserBugList);

    // Mail.
    if(!empty($EmailList[$AssignedTo]))
    {
        $To = array($EmailList[$AssignedTo]);
        @sysMail($To,'',$Subject,$Message);
    }
}
?>