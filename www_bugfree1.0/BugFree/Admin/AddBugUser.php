<?php
/**
 * File to add a user of BugFree system.
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
 * @version     $Id: AddBugUser.php,v 1.4 2005/09/01 07:15:07 wwccss Exp $
 */

/**
 * Init BugFree system.
 */
require_once("../Include/SetupBug.inc.php");

/**
 * Judge whether the user is an admin user.
 */
bugJudgeAdminUser();

if(!empty($_POST["UserName"]) and !empty($_POST["RealName"]) and !empty($_POST["Password"]))
{
    // Judge the email address.
    if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$",$_POST["Email"]))
    {
        $MyJS->alert($TplConfig["AddBugUser"]["ErrorWrongEmail"]);
        $MyJS->goto("Back");
        exit;
    }

    // Judge whether there's user with the same UserName.
    if(bugGetUserList("WHERE " . $BugConfig["UserTable"]["UserName"] . "= '" . $_POST[UserName] . "'"))
    {
        $MyJS->alert($TplConfig["AddBugUser"]["ErrorSameUserName"]);
        $MyJS->goto("Back");
        exit;
    }

    // Set the password according to the encrypt type in BugConfig.
    $BugUserPWD = bugEncryptUserPWD($_POST["Password"]);

    // Insert the user.
    $SQL = <<<EOT
INSERT INTO  {$BugConfig["UserTable"]["TableName"]} ( {$BugConfig["UserTable"]["UserName"]},{$BugConfig["UserTable"]["RealName"]},{$BugConfig["UserTable"]["UserPassword"]},{$BugConfig["UserTable"]["Email"]}) VALUES(
                                                      '$_POST[UserName]','$_POST[RealName]',$BugUserPWD,'$_POST[Email]')
EOT;

    $DBName = !empty($BugConfig["UserDB"]) ? "MyUserDB" : "MyDB";

    if($$DBName->query($SQL))
    {
        $MyJS->alert($_POST["UserName"] . $TplConfig["AddBugUser"]["Success"]);
        $MyJS->goto("ListBugUser.php");
        exit;
    }
    else
    {
        die($$DBName->errorMsg());
    }
}
else
{
    $MyJS->alert($TplConfig["AddBugUser"]["ErrorEmptyValue"]);
    $MyJS->goto("Back");
    exit;
}
?>