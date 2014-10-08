<?php
/**
 * File to edit self info of BugFree system.
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
 * @version     $Id: EditSelfInfo.php,v 1.4 2005/09/01 02:03:18 wwccss Exp $
 */

/**
 * Init BugFree system.
 */  
require_once("Include/SetupBug.inc.php");

// Update self info if the user click the button.
if(!empty($_POST["EditSelfInfo"]))
{
    if(empty($_POST["RealName"]) or empty($_POST["Email"]))
    {
        $MyJS->alert($TplConfig["EditSelfInfo"]["ErrorEmptyValue"]);
        $MyJS->goto("EditSelfInfo.php");
        exit;
    }
    
    // Judge the email address.
    if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$",$_POST["Email"]))
    {
        $MyJS->alert($TplConfig["AddBugUser"]["ErrorWrongEmail"]);
        $MyJS->goto("EditSelfInfo.php");
        exit;
    }
    
    if(!empty($_POST["Password"]))
    {
        $BugUserPWD = bugEncryptUserPWD($_POST["Password"]);
    }
    else
    {
        $BugUserPWD = $BugConfig["UserTable"]["UserPassword"];
    }
    
    // the sql to query.
    $SQL = "UPDATE {$BugConfig["UserTable"]["TableName"]} SET {$BugConfig["UserTable"]["RealName"]}     = '$_POST[RealName]',
                                                              {$BugConfig["UserTable"]["UserPassword"]} = $BugUserPWD,
                                                              {$BugConfig["UserTable"]["Email"]}        = '$_POST[Email]'
                                                        WHERE {$BugConfig["UserTable"]["UserName"]}     = '$_SESSION[BugUserName]'";
    
    $DBName = !empty($BugConfig["UserDB"]) ? "MyUserDB" : "MyDB";
    
    // the result info.                                                  
    if($$DBName->query($SQL))
    {
        // Update the session.
        $_SESSION["BugRealName"]  = $_POST["RealName"];
        $_SESSION["BugUserEmail"] = $_POST["Email"];
        
        $MyJS->alert($TplConfig["EditSelfInfo"]["Success"]);
        $MyJS->goto("EditSelfInfo.php");
        exit;
    }
    else
    {
        die($$DBName->errorMsg());
    }
}

// Assign user info to the template.
$TPL->assign("RealName",$_SESSION["BugRealName"]);
$TPL->assign("Email",$_SESSION["BugUserEmail"]);

// Display the template file.
$TPL->display("EditSelfInfo.tpl");
?>