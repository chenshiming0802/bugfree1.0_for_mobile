<?php
/**
 * Config file of BugFree system.
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
 * @version     Creaed on {$CreateDate} 
 */
/* As usual, you should change item 2, 3, 9. For more infomation, please see Document/CONFIG.htm. */

/* 1. Define surported language list and default language. Note: you can use only one charset Chinese lanuage now. */
$BugConfig["LangList"]["English"]         = "English";
//$BugConfig["LangList"]["ChineseGB2312"] = "Chinese";
$BugConfig["LangList"]["ChineseUTF8"]     = "ChineseUTF8";
$BugConfig["DefaultLang"]                 = "{$BugConfig.Language}";

/* 2. Define admin user list. Like this: array("wangcs","liuzf") */
$BugConfig["AdminUser"] = array("{$BugConfig.AdminUserName}");

/* 3. Define the username and password of the BugFree database. */
$BugConfig["BugDB"]["User"]     = "{$BugConfig.BugDBUser}";
$BugConfig["BugDB"]["Password"] = "{$BugConfig.BugDBPassword}";
$BugConfig["BugDB"]["Host"]     = "{$BugConfig.BugDBHost}";
$BugConfig["BugDB"]["Database"] = "{$BugConfig.BugDBDatabase}";

/*
 * 4. Define the username and password of the user validating database.
 * If the user validating database is different from the BugFree database, uncomment lines below.
 */
{if not $BugConfig.UserDBUser}
/*
{/if}
$BugConfig["UserDB"]["User"]     = "{$BugConfig.UserDBUser}";
$BugConfig["UserDB"]["Password"] = "{$BugConfig.UserDBPassword}";
$BugConfig["UserDB"]["Host"]     = "{$BugConfig.UserDBHost}";
$BugConfig["UserDB"]["Database"] = "{$BugConfig.UserDBDatabase}";
{if not $BugConfig.UserDBUser}
*/
{/if}

/* 5. Define validating table and it's fields. If you don't use item 4, don't change them. */
$BugConfig["UserTable"]["TableName"]     = "{$BugConfig.TableName}";
$BugConfig["UserTable"]["UserName"]      = "{$BugConfig.UserName}";
$BugConfig["UserTable"]["RealName"]      = "{$BugConfig.RealName}";
$BugConfig["UserTable"]["UserPassword"]  = "{$BugConfig.UserPassword}";
$BugConfig["UserTable"]["Email"]         = "{$BugConfig.Email}";
$BugConfig["UserTable"]["EncryptType"]   = "{$BugConfig.EncryptType}";    // md5|text|mysqlpassword

/* 6. Query Setting. */
$BugConfig["QueryFieldNumber"] = 3;      // The fields number to query in QueryBugForm.php
$BugConfig["ShowQuery"]        = false;  // Showing query condition or not(QueryBug.php).
$BugConfig["RecordPerPage"]    = 20;     // Record count per page(QueryBug.php).

/* 7. File Setting. */
$BugConfig["File"]["BugFileName"]       = "BugFileName"; // Bug file name needed in AddBugForm.tpl and function bugAddFile() in FunctionsMain.inc.php.
$BugConfig["File"]["UploadDirectory"]   = "{$BugConfig.UploadDirectory}";     // The directory to store uploaded files which must be under the BugFree directory and can be writed by others. */
$BugConfig["File"]["MaxAddFilesCount"]  = range(1,2);    // Files number can be added one time. */
$BugConfig["File"]["MaxFileSize"]       = 1024 * 100;    // The max file size(Byte).
$BugConfig["File"]["DangerousTypeList"] = array("php","php3","php4","cgi","pl","py","asp","jsp");  // Dangerous file types list, will changed to .txt

/* 8. Mail setting. */
$BugConfig["Mail"]["On"]          = true;
$BugConfig["Mail"]["FromAddress"] = "{$BugConfig.FromAddress}";
$BugConfig["Mail"]["FromName"]    = "{$BugConfig.FromName}";
$BugConfig["Mail"]["ReportTo"]    = array();  // Where bug statistics message sened to. If empty, to all users.
$BugConfig["Mail"]["SendMethod"]  = "{$BugConfig.SendMethod}"; // "MAIL|SENDMAIL|SMTP|QMAIL";

/* 9. SMTP param setting. */
$BugConfig["Mail"]["SendParam"]["Host"]     = "{$BugConfig.SmtpHost}";        //The server to connect. Default is localhost
$BugConfig["Mail"]["SendParam"]["SMTPAuth"] = {$BugConfig.SmtpAuth};        //Whether or not to use SMTP authentication. Default is FALSE
$BugConfig["Mail"]["SendParam"]["Username"] = "{$BugConfig.SmtpUserName}";    //The username to use for SMTP authentication.
$BugConfig["Mail"]["SendParam"]["Password"] = "{$BugConfig.SmtpPassword}";    //The password to use for SMTP authentication.

/* 10. Auto update. We recommend you to set this to true, thus you can keep update with the latest version. */
$BugConfig["Version"]    = "1.0";    // Don't change.
$BugConfig["AutoUpdate"] = true;   // true|false.
?>