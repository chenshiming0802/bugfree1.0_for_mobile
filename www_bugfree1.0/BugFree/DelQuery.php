<?php
/**
 * File to delete user defined query of BugFree system.
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
 * @version     $Id: DelQuery.php,v 1.3 2005/09/10 02:18:39 wwccss Exp $
 */

/**
 * Init BugFree system.
 */  
require_once("Include/SetupBug.inc.php");

if($_REQUEST["UserQueryID"] != "")
{
    if($_GET["DeleteIt"] == "")
    {
        $MyJS->confirm($TplConfig["DelQuery"]["SureToDelIt"],"DelQuery.php?UserQueryID=$_POST[UserQueryID]&DeleteIt=Yes","QueryBug.php");
    }
    else
    {
        $SQL = "DELETE FROM BugQuery WHERE QueryID = '$_GET[UserQueryID]'";
        if($MyDB->query($SQL))
        {
            // Show result info.
            $MyJS->alert($TplConfig["DelQuery"]["HaveBeenDeled"]);
            
            // Refresh the UserControl.php.
            $MyJS->goto("UserControl.php","parent.LeftBottomFrame");
  
            // Go to the query page.
            $MyJS->goto("QueryBug.php");
            exit;
        }
        else
        {
            die($MyDB->getMessage());
        }
    }
}
?>