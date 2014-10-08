<?php
/**
 * Save user defined query file of BugFree system.
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
 * @version     $Id: SaveQuery.php,v 1.4 2005/09/10 02:18:39 wwccss Exp $
 */

/**
 * Init BugFree system.
 */
require_once("Include/SetupBug.inc.php");
if(!empty($_POST["SaveQuery"]))
{
    if(empty($_POST["QueryTitle"]))
    {
        $MyJS->alert($TplConfig["SaveQuery"]["MustSetQueryTitle"]);
        $MyJS->goto("Back");
        exit;
    }
    else
    {
        $SQL       = "SELECT COUNT(*) AS RecNumber FROM BugQuery WHERE QueryTitle = '$_POST[QueryTitle]' AND UserName = '$_SESSION[BugUserName]'";
        $RecNumber = $MyDB->getOne($SQL);
        if($RecNumber >= 1)
        {
            $MyJS->alert($TplConfig["SaveQuery"]["ThereisSameTitle"]);
            $MyJS->goto("Back");
            exit;
        }
        else
        {
            $SQL = "INSERT INTO BugQuery(UserName,QueryTitle,QueryString,AddDate) VALUES(
                                         '$_SESSION[BugUserName]','$_POST[QueryTitle]','$_SESSION[QueryCondition]',now())";
            if($MyDB->query($SQL))
            {
                // Show result info.
                $MyJS->alert($TplConfig["SaveQuery"]["HaveBeenSaved"]);
     
                // Refresh the UserControl.php.
                $MyJS->goto("UserControl.php","parent.LeftBottomFrame");

                // Strip slashes of the $_SESSION["QueryCondition"]
                $_SESSION["QueryCondition"] = stripslashes($_SESSION["QueryCondition"]);

                // Go to the query page.
                $MyJS->goto("QueryBug.php");
                exit;
            }
            else
            {
                die($MyDB->errorMsg());
            }
        }
    }
}
else
{
    // Display the template file.
    $TPL->display("SaveQuery.tpl");
}
?>