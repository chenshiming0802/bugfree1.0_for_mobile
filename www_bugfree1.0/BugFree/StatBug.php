<?php
/**
 * File to mail statics of bugs weekly of BugFree system.
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
 * @version     $Id: StatBug.php,v 1.9 2005/09/10 02:28:00 wwccss Exp $
 */
/* Init BugFree system. */
require_once("Include/SetupBug.inc.php");

/* Get today, yesterday and a week befor. */
$Today         = date("Y-m-d");
$Yesterday     = date("Y-m-d",time() - 24 * 3600);
$OneWeekBefore = date("Y-m-d",time() - 24 * 3600 * 7);

/* Get the add date of the first bug. */
$FirstBug  = bugGetInfo("Max","ORDER BY BugID ASC LIMIT 1");
$FirstDate = substr($FirstBug[@key($FirstBug)]["OpenedDate"],0,10);

/* Get statistics of the week and all time. */
$BugOfThisWeek = bugGetStat($Yesterday,$OneWeekBefore);
$BugOfAllTime  = bugGetStat($Yesterday,$FirstDate);

/* Get css style. */
$CssStyle = @join("",file("Include/LangFile/".$BugConfig["Language"].$BugConfig["CssStyle"].".css"));
$TPL->assign("CssStyle",$CssStyle);

/* Assign the date. */
$TPL->assign("Yesterday",$Yesterday);
$TPL->assign("OneWeekBefore",$OneWeekBefore);
$TPL->assign("FirstDate",$FirstDate);

/* Assign the BugList to template. */
$TPL->assign("BugOfThisWeek",$BugOfThisWeek);
$TPL->assign("BugOfAllTime",$BugOfAllTime);

/* Assign ResolutionList to template. */
$TPL->assign("ResolutionList",bugGetResolutionList());

/* Get bug list message in html. */
$Message = $TPL->fetch("StatBug.tpl");

if($_GET["ExportType"] == "Web")
{
    echo $Message;
    exit;
}

/* Define to address: if not defined in BugConfig.inc.php mail to all user. */
if(count($BugConfig["Mail"]["ReportTo"]) == 0)
{
    $To = bugGetUserEmail(@join(",", @array_keys(bugGetUserList("WHERE 1"))));
}
else
{
    $To = $BugConfig["Mail"]["ReportTo"];
}

/* Subject */
$Subject = $TplConfig["StatBug"]["BugStatTitle"];

/* Mail */
sysMail($To, "", $Subject, $Message)
?>