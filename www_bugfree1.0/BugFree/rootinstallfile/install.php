<?php
/**
 * Install program of BugFree system.
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
 * @version     $Id: Install.php,v 1.7 2005/09/24 07:41:30 wwccss Exp $
 */
/* Report all errors except E_NOTICE */
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Get the BugFree Directory path and base url address.
 * If the php script is in the Admin directory then strip Admin from the ScriptDir.
 * If BugFree does not work, you can specify the path of BugFree by hand.
 * For example /var/www/BugFree on linux, f:/www/bugfree on windows.
 */
$BugConfig["ScriptDir"]   = eregi_replace("/Admin" , "" , dirname($_SERVER["SCRIPT_FILENAME"]));
//$BugConfig["ScriptDir"] = "Your path to BugFree";

/* Set the separator of include path. On windows it's ";" while on linux it's ":". */
$BugConfig["PathSeparator"] = eregi("WIN",PHP_OS) ? ";" : ":";

/* Set the include path. */
ini_set("include_path", $BugConfig["ScriptDir"] . "/Include/" . $BugConfig["PathSeparator"] . $BugConfig["ScriptDir"] . "/Include/Class/" . $BugConfig["PathSeparator"] . $BugConfig["ScriptDir"] . "/Include/Class/PhpMailer");

/* Set language to use when installing */
$Language = !empty($_REQUEST["Language"]) ? $_REQUEST["Language"] : "ChineseUTF8";
require_once("LangFile/" . $Language . ".php");

/* Init the Smarty class. */
require_once("Smarty/Smarty.class.php");
$TPL = new Smarty;
$TPL->caching       = false;
$TPL->template_dir  = $BugConfig["ScriptDir"] . "/" . 'Template';
$TPL->compile_dir   = $BugConfig["ScriptDir"] . "/" . 'Compile';
$TPL->compile_check = true;

/* Create config file */
if($_POST["Submit"])
{
    /* Check BugDB param */
    $LinkBugDB = @mysql_connect($_POST["BugDBHost"], $_POST["BugDBUser"], $_POST["BugDBPassword"]);
    if(!$LinkBugDB)
    {
        $ErrorMsg[] = $TplConfig["Install"]["ErrorBugDB"] . @mysql_error();
    }
    else
    {
        if($_POST["CreateBugDB"])
        {
            @mysql_query(" CREATE DATABASE $_POST[BugDBDatabase]") or $ErrorMsg[] = $TplConfig["Install"]["ErrorCreateBugDB"] . @mysql_error($LinkBugDB);
        }

        @mysql_select_db($_POST["BugDBDatabase"]) or $ErrorMsg[] = $TplConfig["Install"]["ErrorBugDB"] . @mysql_error($LinkBugDB);

        if($_POST["CreateBugDB"])
        {
            createBugFreeTables();
        }
    }

    /* Check UserDB param */
    if(!empty($_POST["UserDBHost"]))
    {
        $LinkUserDB = @mysql_connect($_POST["UserDBHost"], $_POST["UserDBUser"], $_POST["UserDBPassword"]);
        if(!$LinkUserDB)
        {
            $ErrorMsg[] = $TplConfig["Install"]["ErrorUserDB"] . "Can't connect to mysql server.";
        }
        else
        {
            @mysql_select_db($_POST["UserDBDatabase"]) or $ErrorMsg[] = $TplConfig["Install"]["ErrorUserDB"] . @mysql_error($LinkUserDB);
        }
    }

    /* Check User Table */
    $SQL = " SELECT  $_POST[UserName], $_POST[UserPassword], $_POST[RealName], $_POST[Email] FROM $_POST[TableName]";
    if($LinkUserDB)
    {
        @mysql_query($SQL, $LinkUserDB) or $ErrorMsg[] = $TplConfig["Install"]["ErrorUserTable"] . @mysql_error($LinkUserDB);
    }
    else
    {
        @mysql_query($SQL, $LinkBugDB) or $ErrorMsg[] = $TplConfig["Install"]["ErrorUserTable"] . @mysql_error($LinkBugDB);
    }

    /* Check compile and BugFile directory */
    if(!is_writable($BugConfig["ScriptDir"] . "/Compile"))
    {
        $ErrorMsg[] = "Compile " . $TplConfig["Install"]["ErrorWritable"];
    }
    if(!is_writable($BugConfig["ScriptDir"] . "/" . $_POST["UploadDirectory"]))
    {
        $ErrorMsg[] = $_POST["UploadDirectory"] . $TplConfig["Install"]["ErrorWritable"];
    }

    /* Check SMTP */
    if($_POST["SmtpAuth"] == "true" and empty($_POST["SmtpUserName"]))
    {
        $ErrorMsg[] = $TplConfig["Install"]["ErrorSmtpAuth"];
    }

    /* Create admin user */
    if(!empty($_POST["AdminUserName"]))
    {
        if(empty($_POST["AdminRealName"]) or empty($_POST["AdminUserEmail"]) or empty($_POST["AdminUserPassword"]))
        {
            $ErrorMsg[] = $TplConfig["Install"]["ErrorAdminUserInfo"];
        }
        else
        {
            /* Create password */
            if($_POST["EncryptType"] == "md5")
            {
                $AdminUserPassword = md5($_POST["AdminUserPassword"]);
            }
            elseif($_POST["EncryptType"] == "mysqlpassword")
            {
                $AdminUserPassword = "PASSWORD('$_POST[AdminUserPassword]')";
            }
            else
            {
                $AdminUserPassword = $_POST["AdminUserPassword"];
            }

            /* Create SQL  */
            $SQL = "INSERT INTO $_POST[TableName] ($_POST[UserName], $_POST[RealName], $_POST[Email], $_POST[UserPassword]) VALUES
                                                  ('$_POST[AdminUserName]', '$_POST[AdminRealName]', '$_POST[AdminUserEmail]', '$AdminUserPassword') ";
            if($LinkUserDB)
            {
                @mysql_query($SQL, $LinkUserDB) or $ErrorMsg[] = $TplConfig["Install"]["ErrorCreateAdminUser"] . @mysql_error();
            }
            else
            {
                @mysql_query($SQL, $LinkBugDB) or $ErrorMsg[] = $TplConfig["Install"]["ErrorCreateAdminUser"] . @mysql_error();
            }
        }
    }

    /* If any errors, display them and go back */
    if(!empty($ErrorMsg))
    {                          
        @header("Content-Type: text/html; Language=".$BugConfig["Charset"]);
        $TPL->assign("BugConfig",       $BugConfig);
        $TPL->assign("CurrentLanguage", $Language);
        $TPL->assign("TplConfig",       $TplConfig);
        $TPL->assign("ErrorMsg", join("<br />\n", $ErrorMsg));
        $TPL->display("Install.tpl");
        exit;
    }
    else
    {
        header("Content-type: application/x-httpd-php");
        header("Content-Disposition: attachment; filename=ConfigBug.inc.php");
        $TPL->assign("BugConfig", $_POST);
        $TPL->assign("CreateDate", date("Y-m-d H:i:s"));
        echo $TPL->fetch("ConfigBug.tpl");
    }
}
else
{
    /* Send header to browser */
    @header("Content-Type: text/html; Language=".$BugConfig["Charset"]);
    @header("Cache-control: private");

    /* Display template file */
    $TPL->assign("BugConfig",       $BugConfig);
    $TPL->assign("LanguageList",    array("English","ChineseUTF8"));
    $TPL->assign("CurrentLanguage", $Language);
    $TPL->assign("TplConfig",       $TplConfig);
    $TPL->assign("ServerName",      $_SERVER["SERVER_NAME"]);
    $TPL->display("Install.tpl");
}

/**
 * Create BugFree database.
 *
 * @author                      phpmyadmin group
 */
function createBugFreeTables()
{
    global $LinkBugDB;
    global $ErrorMsg;

    // Read the table structure definition sql.
    $sql = addslashes(fread(fopen("Document/BugFree.sql", "r"), filesize("Document/BugFree.sql")));
    $sql = trim($sql);
    $sql = ereg_replace("#[^\n]*\n", "", $sql);
    $buffer = array();
    $ret    = array();
    $in_string = false;
    for($i=0; $i<strlen($sql)-1; $i++)
    {
        if($sql[$i] == ";" && !$in_string)
        {
            $ret[] = substr($sql, 0, $i);
            $sql = substr($sql, $i + 1);
            $i = 0;
        }

        if($in_string && ($sql[$i] == $in_string) && $buffer[0] != "\\")
        {
            $in_string = false;
        }
        elseif(!$in_string && ($sql[$i] == "\"" || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\"))
        {
            $in_string = $sql[$i];
        }
        if(isset($buffer[1]))
        {
            $buffer[0] = $buffer[1];
        }
        $buffer[1] = $sql[$i];
    }
    if(!empty($sql))
    {
        $ret[] = $sql;
    }

    // Excute the sql.
    for ($i=0; $i<count($ret); $i++)
    {
        $ret[$i] = stripslashes(trim($ret[$i]));
        if(!empty($ret[$i]) && $ret[$i] != "#")
        {
            @mysql_query($ret[$i], $LinkBugDB) or $ErrorMsg[] = @mysql_error();
        }
    }
}
?>