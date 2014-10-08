<?php
/**
 * Login file of BugFree system.
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
 * @version     $Id: Login.php,v 1.7 2005/09/02 08:23:11 wwccss Exp $
 */

/* Init BugFree system. */  
require_once("Include/SetupBug.inc.php");

/* If the user submit username and password, check him and registe session. */
if(!empty($_REQUEST["BugUserName"]) and !empty($_REQUEST["BugUserPWD"]) and $_REQUEST["ActionMode"] != "Lang" and $_REQUEST["ActionMode"] != "Style")
{
    if(bugJudgeUser($_REQUEST["BugUserName"],$_REQUEST["BugUserPWD"]))
    {
        if(bugGetUserACL($_REQUEST["BugUserName"]))
        {
            $MyJS->goto("index.php");
            exit;
        }
    }
}
/* If the user changed language or style, change them. */
elseif(!empty($_POST["Lang"]) or !empty($_POST["CssStyle"]))
{
    setcookie("BugLang",  $_POST["Lang"], time()+360000);
    setcookie("CssStyle", $_POST["CssStyle"], time()+360000);
    $MyJS->goto("Login.php");
    exit;
}
/* Assign temmplates vars and display the login form. */
else
{
    $TPL->assign("LangList",    $MyHtml->select($BugConfig["LangList"],"Lang","Normal","submitForm('Lang');"));         // Assign Language list.
    $TPL->assign("SelectLang",  $MyJS->selectOption("document.LoginForm.Lang",$BugConfig["BugLang"]));                     // Assign the javascript to select the language user are using now.
    $TPL->assign("StyleList",   $MyHtml->select($BugConfig["StyleList"],"CssStyle","Normal","submitForm('Style');"));   // Assign CSS Style list.
    $TPL->assign("SelectStyle", $MyJS->selectOption("document.LoginForm.CssStyle",$BugConfig["CssStyle"]));             // Assign the javascript to select the CSS style user are using now.
    $TPL->assign("ServerInfo",  $_SERVER["SERVER_SOFTWARE"]);
    $TPL->display("Login.tpl");
}
?>