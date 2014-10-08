<?php
/**
 * Index file of BugFree system.
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
 * @version     $Id: index.php,v 1.5 2005/09/24 11:33:26 wwccss Exp $
 */
/* Init BugFree system. */  
require_once("Include/SetupBug.inc.php");

/* If there is Install.php, die. */
if(file_exists("install.php") or file_exists("upgrade.php"))
{
    $TPL->display("Error.tpl");
    exit;
}
/* Set the URL to display in RightBottom. */
if(empty($_SESSION["RightBottomURL"]))
{
    $_SESSION["RightBottomURL"] = "QueryBug.php";
}

/* Assign. */
$TPL->assign("RightBottomURL",$_SESSION["RightBottomURL"]);

/* Display. */
$TPL->display("Index.tpl");
?>