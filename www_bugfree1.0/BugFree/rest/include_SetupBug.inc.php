<?php
/**
 * Init file of BugFree system.
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
 * @version     $Id: SetupBug.inc.php,v 1.16 2005/09/24 11:39:17 wwccss Exp $
 */
/* Report all errors except E_NOTICE. */
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Get the BugFree Directory path and base url address.
 * If the php script is in the Admin directory then strip Admin from the ScriptDir.
 * If BugFree does not work, you can specify the path of BugFree by hand.
 * For example /var/www/BugFree on linux, f:/www/bugfree on windows.
 */
$BugConfig["ScriptDir"]   = eregi_replace("[/\\]Admin" , "" , dirname($_SERVER["SCRIPT_FILENAME"]));
//$BugConfig["ScriptDir"] = "Your path to BugFree";

/* Set the separator of include path. On windows it's ";" while on linux it's ":". */
$BugConfig["PathSeparator"] = eregi("WIN",PHP_OS) ? ";" : ":";

/* Set the include path. */
ini_set("include_path", $BugConfig["ScriptDir"] . "/Include/" . $BugConfig["PathSeparator"] . $BugConfig["ScriptDir"] . "/Include/Class/" . $BugConfig["PathSeparator"] . $BugConfig["ScriptDir"] . "/Include/Class/PhpMailer");

/* Create the BaseURL of BugFree system.
 * If the url of BugFree is wrong, you can specify it by hand, for example: http://www.test.com/BugFree.
 * Note: No "/" at the end of the url.
 */
$BugConfig["BaseURL"]   = "http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . eregi_replace("/Admin" , "", dirname($_SERVER["SCRIPT_NAME"]));
//$BugConfig["BaseURL"] = "http://BugFree URL";

/* Require config, functions and class files. */
require_once("../Include/ConfigBug.inc.php");        // Config file.
require_once("../Include/FunctionsMain.inc.php");    // Functions file.
require_once('../Include/Class/ADO/adodb.inc.php');        // ADO class.
//require_once("Smarty/Smarty.class.php");  // Smarty class.
//require_once('JS.class.php');             // JS class.
//require_once('Html.class.php');           // Html class.
//require_once('Page.class.php');           // Page class.

/* Connect to BugFree database server and return the global DB handler -- $MyDB which is used anywhere and set the FETCH_MODE to ASSOC. */
$MyDB = &ADONewConnection("mysql");
$MyDB->Connect($BugConfig["BugDB"]["Host"],$BugConfig["BugDB"]["User"],$BugConfig["BugDB"]["Password"],$BugConfig["BugDB"]["Database"]);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

/* Connect to validating database if it's different from BugFree database and return the global DB handler --$MyUserDB. */
if(!empty($BugConfig["UserDB"]))
{
    $MyUserDB = &ADONewConnection("mysql");
    $MyUserDB->NConnect($BugConfig["UserDB"]["Host"],$BugConfig["UserDB"]["User"],$BugConfig["UserDB"]["Password"],$BugConfig["UserDB"]["Database"]);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
}

/* Init smarty class. */
//$TPL = new Smarty;
//$TPL->caching       = false;
//$TPL->template_dir  = $BugConfig["ScriptDir"] . "/" . 'Template';
//$TPL->compile_dir   = $BugConfig["ScriptDir"] . "/" . 'Compile';
//$TPL->compile_check = true;

/* Init JS, Html, Page classes. */
//$MyJS   = new JS;
//$MyHtml = new Html;
//$MyPage = new Page;

/* Start session. */
@session_start();

/* Set the language. */
$BugConfig["BugLang"] = isset($_COOKIE["BugLang"]) ? $_COOKIE["BugLang"] : $BugConfig["DefaultLang"];
@setcookie("BugLang", $BugConfig["BugLang"], time()+360000);

/* Include the Language file, send heard info. */
//require_once("LangFile/" . $BugConfig["BugLang"] . ".php");
@header("Content-Type: text/json; Language=".$BugConfig["Charset"]);
@header("Cache-control: private");

/* Set the css style. */
//$BugConfig["CssStyle"] = isset($_COOKIE["CssStyle"]) ? $_COOKIE["CssStyle"] : "Default";
//@setcookie("CssStyle", $BugConfig["CssStyle"], time()+360000);

/* Add slashes to REQUEST, GET, POST, COOKIE, FILES vars. */
if(!get_magic_quotes_gpc())
{
    $_REQUEST = sysAddSlash($_REQUEST);
    $_GET     = sysAddSlash($_GET);
    $_POST    = sysAddSlash($_POST);
    $_COOKIE  = sysAddSlash($_COOKIE);
    $_FILES   = sysAddSlash($_FILES);
}

/* Turn off the runtime magic_quotes feature. */
ini_set("magic_quotes_runtime", 0);

/* Judge whether the user is a valid user. */
//if(!eregi("Login.php|upgrade.php",$_SERVER["PHP_SELF"]))
//{
    //bugJudgeUser($_REQUEST["BugUserName"], $_REQUEST["BugUserPWD"]);
    //bugGetUserACL($_SESSION["BugUserName"]);
//}

/* Assign $Config defined in the Lang file to the template. */
//$TPL->assign("BugConfig", $BugConfig);
//$TPL->assign("TplConfig", $TplConfig);
//$TPL->assign("CssStyle",  $BugConfig["CssStyle"]);
?>