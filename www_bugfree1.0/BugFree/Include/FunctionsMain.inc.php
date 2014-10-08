<?php
/**
 * Common functions library of BugFree system.
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
 * @version     $Id: FunctionsMain.inc.php,v 1.32 2005/09/24 11:38:37 wwccss Exp $
 */

//------------------------- SYSTEM FUNCTIONS -----------------------------------//

/**
 * Return part of a string(Enhance the function substr())
 *
 * @author                  Chunsheng Wang <wwccss@263.net>
 * @param  string  $String  the string to cut.
 * @param  int     $Length  the length of returned string.
 * @param  booble  $Append  whether append "...": false|true
 * @return string           the cutted string.
 */
function sysSubStr($String,$Length,$Append = false)
{
    if (strlen($String) <= $Length )
    {
        return $String;
    }
    else
    {
        $I = 0;
        while ($I < $Length)
        {
            $StringTMP = substr($String,$I,1);
            if ( ord($StringTMP) >=224 )
            {
                $StringTMP = substr($String,$I,3);
                $I = $I + 3;
            }
            elseif( ord($StringTMP) >=192 )
            {
                $StringTMP = substr($String,$I,2);
                $I = $I + 2;
            }
            else
            {
                $I = $I + 1;
            }
            $StringLast[] = $StringTMP;
        }
        $StringLast = implode("",$StringLast);
        if($Append)
        {
            $StringLast .= "...";
        }
        return $StringLast;
    }
}
/**
 * Enhance the function addslashes())
 *
 * @author                  Chunsheng Wang <wwccss@263.net>
 * @param  mix     $Data    the variable to addslashes.
 * @return mix              formated variable.
 */
function sysAddSlash($Data)
{
    if(!get_magic_quotes_gpc())
    {
        if(is_array($Data))
        {
            foreach($Data as $Key => $Value)
            {
                if(is_array($Value))
                {
                    $Data[$Key] = sysAddSlash($Value);
                }
                else
                {
                    $Data[$Key] = addslashes($Value);
                }
            }
        }
        else
        {
            $Data = addslashes($Data);
        }
    }
    return $Data;
}
/**
 * Strip html tages, perserver spaces and <br /><B>, nl2br.
 *
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @param   string      $Html
 * @return  string      $Html
 */
function sysHtml2Txt($Html)
{
    $Html = str_replace("<br />", "<br>", $Html);        // Change <br /> to <br>, because the space will be replaced by &nbsp.
    $Html = str_replace(" ", "&nbsp;", $Html);           // Change space to &nbsp to perserve the space.
    $Html = str_replace("<br>", "<br />", $Html);        // Change <br> to <br />，so there are only <br>, no <br />.
    $Html = strip_tags($Html, "<br><B>");                // Strip html tages except <br> and <B>.
    $Html = nl2br($Html);                                // Change newline to <br />.
    $Html = str_replace("<br /><br />","<br />", $Html); // Change two <br /> to one <br>.
    return $Html;
}
/**
 * Enhanced mail function.
 *
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @param   string      $ToList       To address list.
 * @param   string      $CCList       CC address list.
 * @param   string      $Subject      Subject.
 * @param   string      $Message      Message.
 */
function sysMail($ToList,$CCList,$Subject,$Message)
{
    require_once("class.phpmailer.php");
    global $BugConfig;
    global $MyJS;

    // Create an object of PHPMailer class and set the send method
    $Mail = new PHPMailer();
    switch(strtoupper($BugConfig["Mail"]["SendMethod"]))
    {
        case "SMTP":
            $Mail->isSMTP();
            $Mail->Host     = $BugConfig["Mail"]["SendParam"]["Host"];
            $Mail->SMTPAuth = $BugConfig["Mail"]["SendParam"]["SMTPAuth"];
            $Mail->Username = $BugConfig["Mail"]["SendParam"]["Username"];
            $Mail->Password = $BugConfig["Mail"]["SendParam"]["Password"];
            break;
        case "MAIL":
            $Mail->isMail();
            break;
        case "SENDMAIL":
            $Mail->isSendmail();
            break;
        case "QMAIL":
            $Mail->isQmail();
            break;
    }

    // Define From Address.
    $Mail->From     = $BugConfig["Mail"]["FromAddress"];
    $Mail->FromName = $BugConfig["Mail"]["FromName"];

    // Add To Address.
    foreach($ToList as $To)
    {
        $Mail->addAddress($To);
    }
    if(is_array($CCList))
    {
        foreach($CCList as $CC)
        {
            $Mail->addCC($CC);
        }
    }
    // Add Subject.
    $Mail->Subject  =  stripslashes($Subject);

    // Set Body.
    $Mail->IsHTML(true);
    $Mail->CharSet = $BugConfig["Charset"];
    $Mail->Body    = stripslashes($Message);
    if(!$Mail->Send())
    {
       $MyJS->alert($Mail->ErrorInfo);
    }
}

/**
 * Sort an two-dimension array by some level two items use array_multisort() function.
 *
 * sysSortArray($Array,"Key1","SORT_ASC","SORT_RETULAR","Key2"……)
 * @author                      Chunsheng Wang <wwccss@263.net>
 * @param  array   $ArrayData   the array to sort.
 * @param  string  $KeyName1    the first item to sort by.
 * @param  string  $SortOrder1  the order to sort by("SORT_ASC"|"SORT_DESC")
 * @param  string  $SortType1   the sort type("SORT_REGULAR"|"SORT_NUMERIC"|"SORT_STRING")
 * @return array                sorted array.
 */
function sysSortArray($ArrayData,$KeyName1,$SortOrder1 = "SORT_ASC",$SortType1 = "SORT_REGULAR")
{
    if(!is_array($ArrayData))
    {
        return $ArrayData;
    }

    // Get args number.
    $ArgCount = func_num_args();

    // Get keys to sort by and put them to SortRule array.
    for($I = 1;$I < $ArgCount;$I ++)
    {
        $Arg = func_get_arg($I);
        if(!eregi("SORT",$Arg))
        {
            $KeyNameList[] = $Arg;
            $SortRule[]    = '$'.$Arg;
        }
        else
        {
            $SortRule[]    = $Arg;
        }
    }

    // Get the values according to the keys and put them to array.
    foreach($ArrayData AS $Key => $Info)
    {
        foreach($KeyNameList AS $KeyName)
        {
            ${$KeyName}[$Key] = $Info[$KeyName];
        }
    }

    // Create the eval string and eval it.
    $EvalString = 'array_multisort('.join(",",$SortRule).',$ArrayData);';
    eval ($EvalString);
    return $ArrayData;
}

//------------------------- DATABASE FUNCTIONS -----------------------------------//

/**
 * Create string like "IN('a','b')"  from "a,b"
 *
 * @author                     Chunsheng Wang <wwccss@263.net>
 * @param  string $ItemList    item list like "a,b,c".
 * @return string $ItemList    string like "IN('a','b','c')".
 */
function dbCreateIN($ItemList)
{
    if(empty($ItemList))
    {
        return false;
    }
    else
    {
        $ItemList = explode(",",$ItemList);
        foreach($ItemList AS $Item)
        {
            $ItemListTMP[] = "'$Item'";
        }
        return " IN (".join(",",$ItemListTMP).") ";
    }
}

/**
 * Merge $SourceSQL to $TargetSQL.
 *
 * @author                     Chunsheng Wang <wwccss@263.net>
 * @param  string $TargetSQL
 * @param  string $SourceSQL
 * @return string $MergedSQL
 */
function dbMergeSQL($TargetSQL, $SourceSQL)
{
    if(eregi("WHERE", $TargetSQL))
    {
        $TargetSQL = eregi_replace("where", "WHERE", $TargetSQL);
        $TargetSQL = explode("WHERE", $TargetSQL);
        $MergedSQL = " WHERE $SourceSQL AND" . $TargetSQL[1];
    }
    else
    {
        $MergedSQL = " WHERE $SourceSQL" . $TargetSQL;
    }
    //echo ($MergedSQL);
    //echo "<hr>";
    return $MergedSQL;
}

/**
 * Get info of one filed.
 *
 * @author                     Chunsheng Wang <wwccss@263.net>
 * @global object              Object of ADO class.
 * @param  string $TableName   
 * @param  string $FieldName
 * @return array  $FieldInfo
 */
function dbGetFieldInfo($TableName, $FieldName)
{
    global $MyDB;
    $ResultID = $MyDB->query("DESCRIBE $TableName $FieldName");
    if($ResultID)
    {
        $FieldInfo           = $ResultID->fetchRow();
        $SubStart            = strpos($FieldInfo["Type"], "(") +1;
        $SubEnd              = strpos($FieldInfo["Type"], ")");
        $SubDelta            = $SubEnd - $SubStart;
        $FieldInfo["Length"] = substr($FieldInfo["Type"], $SubStart, $SubDelta);
        return $FieldInfo;
    }
    else
    {
        die($MyDB->errorMsg());
    }
}
//------------------------- BUG USER & GROUP FUNCTIONS -----------------------------------//

/**
 * Judge valid user.
 *
 * @author                       Chunsheng Wang <wwccss@263.net>
 * @global object                the object of Javascript class created in SetupBug.inc.php.
 * @global array                 the bug config array.
 * @global object                the object of ADO class created in SetupBug.inc.php.
 * @param  string  $BugUserName  the user name used to login BugFree system.
 * @param  string  $BugUserPWD   the user password used to login BugFree system.
 */
function bugJudgeUser($BugUserName = "",$BugUserPWD = "")
{
    global $MyJS;
    global $BugConfig;

    $DBName = !empty($BugConfig["UserDB"]) ? "MyUserDB" : "MyDB";
    global $$DBName;

    if(!empty($BugUserName) and !empty($BugUserPWD))
    {
        // Register user password to session, thus it can be passed in the export page.
        $_SESSION["BugUserPWD"]   = $BugUserPWD;

        // Encrypt the password.
        $BugUserPWD = bugEncryptUserPWD($BugUserPWD);

        // The query sql.
        $SQL      = " SELECT " . $BugConfig["UserTable"]["UserName"] . " AS UserName,
                             " . $BugConfig["UserTable"]["RealName"] . " AS RealName,
                             " . $BugConfig["UserTable"]["Email"]    . " AS Email
                        FROM " . $BugConfig["UserTable"]["TableName"]. "
                       WHERE " . $BugConfig["UserTable"]["UserName"]     . " = '$BugUserName' AND
                             " . $BugConfig["UserTable"]["UserPassword"] . " = " . $BugUserPWD ;
        $ResultID = $$DBName->query($SQL);
        if($ResultID)
        {
            $BugUserInfo = $ResultID->fetchRow();
            if(empty($BugUserInfo))
            {
                $MyJS->alert($BugConfig["Message"]["ErrorLogin"]);
                $MyJS->goto($BugConfig["BaseURL"] . "/Login.php");
                exit;
            }
            else
            {
                $_SESSION["BugUserName"]  = $BugUserInfo["UserName"];
                $_SESSION["BugRealName"]  = $BugUserInfo["RealName"];
                $_SESSION["BugUserEmail"] = $BugUserInfo["Email"];

                // If the user is Admin, then register session var IsAdminUser to ture.
                if(in_array($BugUserInfo["UserName"],$BugConfig["AdminUser"]))
                {
                    $_SESSION["IsAdminUser"] = true;
                }
                else
                {
                    $_SESSION["IsAdminUser"] = false;
                }
                return true;
            }
        }
        else
        {
            die($$DBName->errorMsg());
        }
    }

    if(empty($_SESSION["BugUserName"]))
    {
        // Register the REQUEST_URI to session if the url is BugInfo.php or QueryBug.php
        if(eregi("BugInfo.php|QueryBug.php",$_SERVER["REQUEST_URI"]))
        {
            $_SESSION["RightBottomURL"] = $_SERVER["REQUEST_URI"];
        }
        $MyJS->goto($BugConfig["BaseURL"] . "/Login.php", "top");
        exit;
    }
}
/**
 * Encrypt the password according to the EncryptType defined in ConfigBug.inc.php.
 *
 * @author                         Chunsheng Wang <wwccss@263.net>
 * @global  array                  config vars of BugFree system.
 * @param   string  $BugUserPWD    the password before encrypting.
 * @return  string                 encrypted password.
 */
function bugEncryptUserPWD($BugUserPWD)
{
    global $BugConfig;

    if($BugConfig["UserTable"]["EncryptType"] == "md5")
    {
        $BugUserPWD = "'" . md5($BugUserPWD) ."'";
    }
    elseif($BugConfig["UserTable"]["EncryptType"] == "mysqlpassword")
    {
        $BugUserPWD = "PASSWORD('$BugUserPWD')";
    }
    else
    {
        $BugUserPWD = "'" . $BugUserPWD . "'";
    }
    return $BugUserPWD;
}

/**
 * Judge current operating user is AdminUser or not. If not, destroy the session and go to the Login.php
 *
 * @author              Chunsheng Wang <wwccss@263.net>
 * @global  array       config vars of BugFree system.
 * @global  array       config vars of template.
 * @global  obj         the object of JS class created in SetupBug.inc.php file.
 */
function bugJudgeAdminUser()
{
    global $BugConfig;
    global $TplConfig;
    global $MyJS;
    if(!$_SESSION["IsAdminUser"])
    {
        $MyJS->alert($TplConfig["JudgeAdmin"]["NotAdminUser"]);
        session_destroy();
        $MyJS->goto($BugConfig["BaseURL"] . "/Login.php");
        exit;
    }
}

/**
 * Get ACL of a user.
 *
 * @author                       Chunsheng Wang <wwccss@263.net>
 * @global object                the object of Javascript class created in SetupBug.inc.php.
 * @global array                 the bug config array.
 * @global object                the JS class.
 * @param  string  $BugUserName  the user name used to login BugFree system.
 */
function bugGetUserACL($BugUserName)
{
    global $MyDB;
    global $BugConfig;
    global $MyJS;

    /* Register Session already. */
    if(!empty($_SESSION["BugUserACL"]))
    {
        return true;
    }

    /* If the user is admin, assign all projects' access to him. */
    if($_SESSION["IsAdminUser"])
    {
        $SQL = "SELECT ProjectID FROM BugProject ORDER BY ProjectID";
        $ResultID = $MyDB->query($SQL);
        if($ResultID)
        {
            while($ProjectInfo = $ResultID->fetchRow())
            {
                $UserACL[$ProjectInfo["ProjectID"]] = "All";
            }
        }
    }
    /* If common user, query from BugGroup table. */
    else
    {
        $SQL = "SELECT * FROM BugGroup WHERE GroupUser LIKE '%,$BugUserName,%'";
        $ResultID = $MyDB->query($SQL);
        if($ResultID)
        {
            $UserACL = array();
            while($GroupInfo = $ResultID->fetchRow())
            {
                /* User ACL inherits from group ACL. */
                $GroupACL = unserialize($GroupInfo["GroupACL"]);
                if(is_array($GroupACL))
                {
                    $UserACL  = $UserACL + $GroupACL;    // Merge acl.
                }
            }
        }
        else
        {
            die($MyDB->errorMsg());
        }
    }

    /* Registe to session. */
    if(!empty($UserACL))
    {
        $_SESSION["BugUserACL"]    = $UserACL;
        $_SESSION["BugUserAclSQL"] = "ProjectID " . dbCreateIN(@join(",", @array_keys($UserACL)));    // To used in query.
        return true;
    }
    /* If no ACL, go to login page. */
    else
    {
        $MyJS->alert($BugConfig["Message"]["NoPriv"]);
        $MyJS->goto($BugConfig["BaseURL"] . "/Login.php");
        exit;
    }
}
/**
 * Get email address of some users.
 *
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @global  array                     the config of BugFree system.
 * @global  obj                       the object of ADO class created in SetupBug.inc.php file.
 * @param   string      $BugUserList  bug user list.
 * @return  array       $EmaiList     email address list.
 */
function bugGetUserEmail($BugUserList)
{
    global $BugConfig;
    $DBName = !empty($BugConfig["UserDB"]) ? "MyUserDB" : "MyDB";
    global $$DBName;

    if(empty($BugUserList))
    {
        return false;;
    }

    $SQL = "SELECT " . $BugConfig["UserTable"]["UserName"]  . " AS UserName,"
                     . $BugConfig["UserTable"]["Email"]     . " AS Email
              FROM " . $BugConfig["UserTable"]["TableName"] . "
             WHERE " . $BugConfig["UserTable"]["UserName"]  . dbcreateIN($BugUserList);
    $ResultID = $$DBName->query($SQL);
    if($ResultID)
    {
        while($Email = $ResultID->fetchRow())
        {
            $EmailList[$Email["UserName"]] = $Email["Email"];
        }
        return $EmailList;
    }
    else
    {
        die($$DBName->errorMsg());
    }
}

/**
 * Get the user defined query SQL.
 *
 * @author                        Chunsheng Wang <wwccss@263.net>
 * @global  obj                   the object of ADO class created in SetupBug.inc.php file.
 * @return  array  $UserQueryList the user's defined query list.
 */
function bugGetUserQuery()
{
    global $MyDB;

    $SQL = " SELECT QueryTitle,QueryID FROM BugQuery WHERE UserName = '$_SESSION[BugUserName]'";

    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        $Prefix = "A";
        while($QueryInfo = $ResultID->fetchRow())
        {
            $UserQueryList[$QueryInfo["QueryID"]] = $Prefix .": ".$QueryInfo["QueryTitle"];
            $Prefix = chr(ord($Prefix) + 1);
        }
        return $UserQueryList;
    }
    else
    {
        die($MyDB->errorMsg());
    }
}

/**
 * Get the bug user list.
 *
 * @author                        Chunsheng Wang <wwccss@263.net>
 * @global  array                 the bug config array.
 * @global  obj                   the object of ADO class created in SetupBug.inc.php file.
 * @param   string   $Where       the query condition.
 * @param   booble   $PreAppend   whether preaddpend the first letter of UserName to RealName or not: true|false.
 * @return  array    $BugUserList bug user list.
 */
function bugGetUserList($Where = "",$PreAppend = false)
{
    global $BugConfig;

    $DBName = !empty($BugConfig["UserDB"]) ? "MyUserDB" : "MyDB";
    global $$DBName;

    /* Add an empty user. */
    empty($Where) ? $BugUserList[""] = "" : "";

    /* If user specify project(s), strip ProejctIdList from $Where. */
    if(eregi("ProjectID", $Where))
    {
        $ProjectIdList = explode("=", $Where);
        $ProjectIdList = explode(",", $ProjectIdList[1]);
    }

    /* Select from BugUser table. */
    $SQL = " SELECT " . $BugConfig["UserTable"]["UserName"] . " AS BugUserName,
                    " . $BugConfig["UserTable"]["RealName"] . " AS BugUserRealName
               FROM " . $BugConfig["UserTable"]["TableName"]. " " . (!eregi("ProjectID", $Where) ? $Where : "") . "
           ORDER BY " . $BugConfig["UserTable"]["UserName"];
    $ResultID = $$DBName->query($SQL);
    if($ResultID)
    {
        while($BugUserInfo = $ResultID->fetchRow())
        {
            if($PreAppend)
            {
                $BugUserList[$BugUserInfo["BugUserName"]] = strtoupper(substr($BugUserInfo["BugUserName"],0,1)) . ": " . $BugUserInfo["BugUserRealName"];
            }
            else
            {
                $BugUserList[$BugUserInfo["BugUserName"]] =  $BugUserInfo["BugUserRealName"];
            }
        }

        /* If user specify a project(s), select users can access this(these) project(s). */
        if(!empty($ProjectIdList))
        {
            $ProjectUserList[""] = "";
            $BugGroupList        = bugGetGroupList("", $BugUserList);
            if(is_array($BugGroupList))
            {
                foreach($BugGroupList as $GroupID => $GroupInfo)
                {
                    foreach($ProjectIdList as $ProjectID)
                    {
                        if(@in_array($ProjectID, @array_keys($GroupInfo["GroupACL"])) and is_array($GroupInfo["GroupUser"]))
                        {
                            $ProjectUserList = $ProjectUserList + $GroupInfo["GroupUser"];
                        }
                    }
                }
            }
            $ProjectUserList["Closed"] = "Closed";
            return $ProjectUserList;
        }

        /* Add users from BugInfo table who are not in BugUser table. */
        if(empty($Where))
        {
            global $MyDB;
            $SQL      = "SELECT LastEditedBy AS BugUserName FROM BugInfo GROUP BY LastEditedBy";
            $ResultID = $MyDB->query($SQL);
            while($BugUserInfo = $ResultID->fetchRow())
            {
                if(!in_array($BugUserInfo["BugUserName"],@array_keys($BugUserList)))
                {
                    $BugUserList[$BugUserInfo["BugUserName"]] = $BugUserInfo["BugUserName"];
                }
            }
        }

        /* Add an Closed user. */
        empty($Where) ? $BugUserList["Closed"] = "Closed" : "";

        return $BugUserList;
    }
    else
    {
        die($$DBName->errorMsg());
    }
}
/**
 * Get the bug group list.
 *
 * @author                         Chunsheng Wang <wwccss@263.net>
 * @global  obj                    the object of ADO class created in SetupBug.inc.php file.
 * @param   string   $Where        the query condition.
 * @param   array    $BugUserList  bug user list array.
 * @param   array    $ProjectList  bug project list array.
 * @return  array    $BugGroupList bug group list.
 */
function bugGetGroupList($Where = "",$BugUserList = "", $ProjectList = "")
{
    global $MyDB;

    empty($BugUserList) ? $BugUserList = bugGetUserList(" WHERE 1") : "";
    empty($ProjectList) ? $ProjectList = bugGetProjects() : "";

    $SQL         = "SELECT * FROM BugGroup $Where ORDER BY GroupID";
    $ResultID    = $MyDB->query($SQL);
    if($ResultID)
    {
        while($GroupInfo = $ResultID->fetchRow())
        {
            /* Set user real name. */
            $GroupInfo["GroupUser"] = explode(",", $GroupInfo["GroupUser"]);
            if(@is_array($GroupInfo["GroupUser"]))
            {
                foreach($GroupInfo["GroupUser"] as $Key => $BugUserName)
                {
                    unset($GroupInfo["GroupUser"][$Key]);
                    if(!empty($BugUserName))
                    {
                        $GroupInfo["GroupUser"][$BugUserName] = $BugUserList[$BugUserName];
                    }
                }
                @ksort($GroupInfo["GroupUser"]);
            }

            /* Set ACL. */
            $GroupInfo["GroupACL"] = unserialize($GroupInfo["GroupACL"]);
            if(is_array($GroupInfo["GroupACL"]))
            {
                foreach($GroupInfo["GroupACL"] as $ProjectID => $ProjectACL)
                {
                    $GroupInfo["ProjectNameList"][$ProjectID] = $ProjectList[$ProjectID];
                }
            }
            $BugGroupList[$GroupInfo["GroupID"]] = $GroupInfo;
        }
        return $BugGroupList;
    }
    else
    {
        die($MyDB->errorMsg());
    }
}
//------------------------- BUG PROJECT & MODULE FUNCTIONS -----------------------------------//
/**
 * Get all projects list.
 *
 * @author                        Chunsheng Wang <wwccss@263.net>
 * @global  obj                   the object of ADO class created in SetupBug.inc.php file.
 * @return  array $ProjectList    the list of all projects.
 */
function bugGetProjects()
{
    global $MyDB;
    $SQL      = " SELECT ProjectID,ProjectName FROM BugProject WHERE $_SESSION[BugUserAclSQL] ORDER BY ProjectID ";
    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        while($ProjectInfo = $ResultID->fetchRow())
        {
            $ProjectList[$ProjectInfo["ProjectID"]] = $ProjectInfo["ProjectName"];
        }
        return $ProjectList;
    }
    else
    {
        die($MyDB->errorMsg());
    }
}

/**
 * Get one project info.
 *
 * @author                        Chunsheng Wang <wwccss@263.net>
 * @global  obj                   the object of ADO class created in SetupBug.inc.php file.
 * @param   int   $ProjectID      the id number of the project to query.
 * @return  array $ProjectInfo    full info of the project.
 */
function bugGetProjectInfo($ProjectID = "")
{
    global $MyDB;
    $SQL      = " SELECT ProjectID,ProjectName,ProjectDoc,ProjectPlan FROM BugProject ";
    if($ProjectID > 0)
    {
        $SQL .= " WHERE ProjectID = '$ProjectID' AND $_SESSION[BugUserAclSQL]";
    }
    else
    {
        $SQL .= " WHERE $_SESSION[BugUserAclSQL] ORDER BY ProjectID DESC LIMIT 1";
    }

    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        return $ResultID->fetchRow();
    }
    else
    {
        die($MyDB->errorMsg());
    }
}

/**
 * Get all modules of a project.
 *
 * We use HTML_TreeMenu class to display the modules. This function don't create the tree list directly but to return
 * the php code to eval manualy out of the function. For more about the HTML_TreeMenu, please visit pear.php.net.
 * @author                          Chunsheng Wang <wwccss@263.net>
 * @global  obj                     the object of ADO class created in SetupBug.inc.php file.
 * @param   int     $ProjectID      the id number of a project.
 * @param   int     $ModuleGrade    the grade number of a module.
 * @param   int     $ParnetID       the parent module id.
 * @param   string  $ParnetModeName the parent module name.
 * @param   string  $LinkURL        the url to open when click an item.
 * @param   string  $LinkTarget     the target windown of the url to open at when click an item.
 * @return  string                  the php code to eval.
 */
function bugGetModules($ProjectID = 1,$ModuleGrade=1,$ParentID=0,$ParentModuleName = "Module",$LinkURL="QueryBug.php",$LinkTarget="RightBottomFrame")
{
    global $MyDB;

    static $EvalCodeParent;    // The first level tree node code.
    static $EvalCodeChild;     // The child level tree node code.

    // Query Module info.
    $SQL = "SELECT ModuleName,ModuleID,ModuleGrade,ParentID
              FROM BugModule
             WHERE ModuleGrade = '$ModuleGrade' AND
                   ParentID    = '$ParentID'    AND
                   ProjectID   = '$ProjectID'   AND $_SESSION[BugUserAclSQL]
          ORDER BY ModuleID ";
    $ResultID = $MyDB->query($SQL);

    while($ModuleInfo = $ResultID->fetchRow())
    {
        // Pass module info to the url. ProjctID,ModueID and ModuleGrade.
        $FullLinkURL = $LinkURL . "?ProjectID=$ProjectID&ModuleID=$ModuleInfo[ModuleID]&ModuleGrade=$ModuleInfo[ModuleGrade]&ParentID=$ModuleInfo[ParentID]&ModuleName=" . urlencode($ModuleInfo["ModuleName"]);

        // Set the name of current node: ParentModuleName_ModuleID
        $NodeName  = $ParentModuleName."_".$ModuleInfo["ModuleID"];

        /**
         * Create the HTML_TreeMenu code.
         */

        // Define the node name.
        $EvalCodeChild .= '$NodeName  = '.$ParentModuleName."_".$ModuleInfo["ModuleID"].';'."\n";

        // Define the node options include text to diplayed, the url to link and the link target.
        $EvalCodeChild .= '$NodeSet   = array("text"       => "'.$ModuleInfo["ModuleName"].'",
                                              "link"       => "'.$FullLinkURL.'",
                                              "linkTarget" => "'.$LinkTarget.'"
                                              );'."\n";
        // Create a tree node named by $NodeName by $NodeSet options
        $EvalCodeChild .= '$$NodeName = new HTML_TreeNode($NodeSet);'."\n";

        // If the tree node level is first, add the node to $TreeMenu which is created out of the function manually.
        // else add the node to the parent node named by $ParentModuleName.
        if($ModuleGrade == 1)
        {
            $EvalCodeParent .= '$TreeMenu->addItem($'.$NodeName.');'."\n";
        }
        elseif($ModuleGrade > 1)
        {
            $EvalCodeChild .= '$'.$ParentModuleName.' ->addItem($$NodeName);'."\n";
        }
        $EvalCodeChild .= "\n";

        // Recursion to get all child module.
        bugGetModules($ProjectID,$ModuleGrade+1,$ModuleInfo["ModuleID"],$NodeName,$LinkURL,$LinkTarget);
    }

    // Return the HTML_TreeMenu code in child, parent order.
    return $EvalCodeChild . $EvalCodeParent;
}

/**
 * Get module id list of one module: include itself and all it's child module.
 *
 * @author                       Chunsheng Wang <wwccss@263.net>
 * @global  obj                  the object of ADO class created in SetupBug.inc.php file.
 * @param   int    $ModuleID     the module id number.
 * @return  array  $ModuleList   module id list.
 */
function bugGetModuleChild($ModuleID)
{
    global $MyDB;

    static $ModuleList;

    // Put itself to the array.
    $ModuleList[] = $ModuleID;

    // Get child module.
    $SQL = "SELECT ModuleID FROM BugModule WHERE ParentID = '$ModuleID' AND $_SESSION[BugUserAclSQL]";
    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        while($ModuleInfo = $ResultID->fetchRow())
        {
            bugGetModuleChild($ModuleInfo["ModuleID"]);
        }
    }
    return $ModuleList;
}
/**
 * Get path of a module.
 *
 * @author                       Chunsheng Wang <wwccss@263.net>
 * @global  obj                  the object of ADO class created in SetupBug.inc.php file.
 * @global  boole                whether init the ModulePath variable or not.
 * @param   int    $ModuleID     the module id number.
 * @param   array  $ModulePath   the array to store module path.
 * @return  array  $ModulePath   the changed ModulePath array.
 */
function bugGetModulePath($ModuleID)
{
    global $MyDB;
    global $InitModulePath;
    static $ModulePath;
    $InitModulePath ? $ModulePath = array() : "";

    if($ModuleID > 0)
    {
        // Get the parent module name and id.
        $SQL      = "SELECT ModuleName,ParentID FROM BugModule WHERE ModuleID = '$ModuleID' AND ParentID != '$ModuleID' AND $_SESSION[BugUserAclSQL]";
        $ResultID = $MyDB->query($SQL);
        if($ResultID)
        {
            while($ModuleInfo = $ResultID->fetchRow())
            {
                $ModulePath[]   = $ModuleInfo["ModuleName"];
                $InitModulePath = false;
                bugGetModulePath($ModuleInfo["ParentID"]);
            }
        }
    }
    return $ModulePath;
}
/**
 * Get all module pathes of a project.
 *
 * @author                           Chunsheng Wang <wwccss@263.net>
 * @global  obj                      the object of ADO class created in SetupBug.inc.php file.
 * @global  boole                    whether init the ModulePath variable or not.
 * @param   int    $ProjectID        the project id number.
 * @return  array  $ModulePathList   the path of the project.
 */
function bugGetProjectModulePathes($ProjectID)
{
    global $MyDB;
    global $InitModulePath;

    // Get all module ids of the project.
    $SQL      = "SELECT ModuleID FROM BugModule WHERE ProjectID = '$ProjectID' AND $_SESSION[BugUserAclSQL] ORDER BY ParentID";
    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        while($ModuleInfo = $ResultID->fetchRow())
        {
            // Get path of current module.
            $InitModulePath = true;
            $ModulePath     = bugGetModulePath($ModuleInfo["ModuleID"]);

            // Reverse the path.
            $ModulePath = @array_reverse($ModulePath);

            // Join the path by "/".
            $ModulePath = "/".implode("/",$ModulePath);

            // Add to ModulePathList array.
            $ModulePathList[$ModuleInfo["ModuleID"]] = $ModulePath;
        }

        // Add the root path.
        $ModulePathList[0] = "/";

        // Sort the array.
        asort($ModulePathList,SORT_STRING);

        // Return the path list.
        return ($ModulePathList);
    }
    else
    {
        die($MyDB->errorMsg());
    }
}

//------------------------- BUG MANAGEMENT FUNCTIONS -----------------------------------//
/**
 * Get bug info according to the condication defined in $Where
 *
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @global  obj                       the object of ADO class created in SetupBug.inc.php file.
 * @param   string $Fields            Mini|Medium|All|FieldsList like BugID,ProjectID...
 * @param   string $Where             condition string.
 * @param   int    $ShortTitleLength  the length to cut part string from bug title as short title.
 * @param   booble $Append            whether append "...": false|true to short title
 * @return  array  $BugList           the bug list.
 */
function bugGetInfo($Fields = "Mini", $Where = "", $ShortTitleLength = 20, $Append = true)
{
    global $MyDB;

    // Create the first part of the SQL according to the QueryMode.
    if($Fields == "Mini")
    {
        $SQL = " SELECT BugID,BugTitle FROM BugInfo ";
    }
    elseif($Fields == "Medium")
    {
        $SQL = " SELECT ProjectID,ModuleID,BugID,BugSeverity,BugTitle,OpenedBy,AssignedTo,MailTo,ResolvedBy,BugStatus,Resolution FROM BugInfo ";
    }
    elseif($Fields == "Max" or $Fields == "All")
    {
        $SQL = "SELECT * FROM BugInfo ";
    }
    else
    {
        $Fields = explode(",", $Fields);
        
        /* BugID, ProjectID, ModuleID, BugTitle must in the fields list. */
        $FieldsList["BugID"]     = "BugID";
        $FieldsList["ProjectID"] = "ProjectID";
        $FieldsList["ModuleID"]  = "ModuleID";
        $FieldsList["BugTitle"]  = "BugTitle";
        
        /* Merge the $Fields to $FieldsList. */
        foreach($Fields as $FieldName)
        {
            $FieldsList[$FieldName] = $FieldName;
        }
        
        /* Create the query sql. */
        $FieldsList = join(",", $FieldsList);
        $SQL = " SELECT $FieldsList FROM BugInfo ";
    }
    
    /* Merge the $_SESSION["BugUserAclSQL"] and param $Where. */
    $SQL .= dbMergeSQL($Where, $_SESSION["BugUserAclSQL"]);

    // Execute the SQL.
    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        // Get all user list.
        $BugUserList = bugGetUserList();

        while($BugInfo = $ResultID->fetchRow())
        {
            // Set the realname of MailTo,AssignedTo, OpenedBy, ResolvedBy, ClosedBy, LastEditedBy
            foreach($BugInfo as $Key => $Value)
            {
                if($Key == "MailTo")
                {
                    $MailToList = explode(",",$Value);
                    foreach($MailToList AS $MailTo)
                    {
                        $BugInfo["MailToRealName"][] = !empty($BugUserList[$MailTo]) ? $BugUserList[$MailTo] : $MailTo;
                    }
                    $BugInfo["MailToRealName"] = join(",",$BugInfo["MailToRealName"]);
                }
                elseif(eregi("To|By",$Key))
                {
                    $RealName           = $Key . "RealName";
                    $BugInfo[$RealName] = !empty($BugUserList[$Value]) ? $BugUserList[$Value] : $Value;
                }
            }

            // Set the short title.
            $BugInfo["ShortBugTitle"]   = sysSubStr($BugInfo["BugTitle"],$ShortTitleLength,$Append);
            $BugList[$BugInfo["BugID"]] = $BugInfo;
        }
        return $BugList;
    }
    else
    {
        die($MyDB->errorMsg());
    }
}
/**
 * Create default build version
 *
 * @author  Chunsheng Wang <wwccss@263.net>
 * @return  string
 */
function bugSetBuild($ProjectID = "")
{
    $DayBuild             = "1.0.".date("Ymd");
    $BuildList[$DayBuild] = $DayBuild;
    if($ProjectID > 0)
    {
        global $MyDB;
        $SQL      = "SELECT OpenedBuild, COUNT(OpenedBuild) AS UsedTimes FROM BugInfo WHERE ProjectID = '$ProjectID' GROUP BY OpenedBuild ORDER BY OpenedBuild DESC, UsedTimes DESC LIMIT 10";
        $ResultID = $MyDB->query($SQL);
        if($ResultID)
        {
            while($BuildInfo = $ResultID->fetchRow())
            {
                $BuildList[$BuildInfo["OpenedBuild"]] = $BuildInfo["OpenedBuild"];
            }
        }
    }
    return $BuildList;
}
/**
 * Copy uploaded files to corresponding directory, insert record to BugFile Table.
 *
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @global  obj                       the object of ADO class created in SetupBug.inc.php file.
 * @global  array                     config vars of BugFree system.
 * @global  array                     config vars of template.
 * @param   int      $ProjectID       the id number of the project which the added bug belongs to.
 * @param   int      $BugIdList       the id number list of bugs, which may be id list joined by ",": 1,2,3
 * @return  array    $ResultInfo      the result info: If success, return file titles, else return the error info.
 */
function bugAddFile($ProjectID,$BugIdList)
{
    global $MyDB;
    global $BugConfig;
    global $TplConfig;

    // Explode the BugIdList to array.
    $BugIdList = explode(",",$BugIdList);

    // Get uploaded files array.
    $BugFileList = $_FILES[$BugConfig["File"]["BugFileName"]];

    // Init the return array ResultInfo.
    $ResultInfo["Success"] = true;

    // Cycle the array, deal with every file.
    for($I = 0 ; $I < count($BugFileList["name"]); $I ++)
    {
        if(!empty($BugFileList["name"][$I]))
        {
            // Set file title.
            if(!empty($_POST["FileTitle"][$I]))
            {
                $FileTitle = $_POST["FileTitle"][$I];
            }
            else
            {
                $FileTitle = $BugFileList["name"][$I];
            }

            // Push FileTitle to $FileTitleList.
            $FileTitleList[] = $FileTitle;

            // Get fize size.
            $FileSize = $BugFileList["size"][$I];

            // Judge the fize.
            if($FileSize > $BugConfig["File"]["MaxFileSize"])
            {
                $ResultInfo["Success"]     = false;
                $ResultInfo["ErrorInfo"][] = $FileTitle . ":" . $TplConfig["AddBug"]["ErrorExceedSize"];
                continue;
            }
            // Change file size to human type.
            else
            {
                if($FileSize <= 1024 * 1024 )
                {
                    $FileSize = round($FileSize / 1024,2) . "KB";
                }
                else
                {
                    $FileSize = round($FileSize / (1024 * 1024),2) . "MB";
                }
            }

            // Get file type.
            $FileType = explode(".",$BugFileList["name"][$I]);
            $FileType = strtolower($FileType[1]);

            // Change dangerous file to txt.
            if(in_array($FileType,$BugConfig["File"]["DangerousTypeList"]) or empty($FileType))
            {
                $FileType = "txt";
            }

            // Create dir to store all uploaded files of this project.
            $PartProjectPath = "Project". $ProjectID;
            $FullProjectPath = $BugConfig["ScriptDir"] . "/" . $BugConfig["File"]["UploadDirectory"] . "/" . $PartProjectPath;
            if(!is_dir($FullProjectPath))
            {
                if(!@mkdir($FullProjectPath))
                {
                    $ResultInfo["Success"]     = false;
                    $ResultInfo["ErrorInfo"][] = $TplConfig["AddBug"]["CantCreateDIR"] . ": " . $FullProjectPath;
                    return $ResultInfo;
                }
            }

            // Make directory under the project directory to store today uploaded files.
            $PartTodayPath   = date("Ym");
            $FullTodayPath   = $FullProjectPath . "/" .$PartTodayPath;
            if(!is_dir($FullTodayPath))
            {
                if(!@mkdir($FullTodayPath))
                {
                    $ResultInfo["Success"]     = false;
                    $ResultInfo["ErrorInfo"][] = $TplConfig["AddBug"]["CantCreateDIR"] . ": " . $FullTodayPath;;
                    return $ResultInfo;
                }
            }

            // Copy file
            $PartFileName = date("His") . $I . "." .$FileType;
            $FullFileName = $PartProjectPath . "/" . $PartTodayPath . "/" . $PartFileName;
            if(!@copy ($BugFileList["tmp_name"][$I],$FullTodayPath . "/" . $PartFileName))
            {
                $ResultInfo["Success"]     = false;
                $ResultInfo["ErrorInfo"][] = $TplConfig["AddBug"]["CantCopyFile"] . ": " . $FullFileName;
                continue;
            }

            // Insert into BugFile table.
            foreach($BugIdList as $BugID)
            {
                $SQL = "INSERT INTO BugFile(BugID,FileTitle,FileName,FileType,FileSize,AddUser,AddDate) VALUES(
                                            '$BugID','$FileTitle','$FullFileName','$FileType','$FileSize','$_SESSION[BugUserName]',now())";
                if(!$MyDB->query($SQL))
                {
                    die($MyDB->errorMsg());
                }
            }

            // Delete the temp file.
            @unlink($BugFileList["tmp_name"][$I]);
        }
    }

    // Return.
    if($ResultInfo["Success"])
    {
        $ResultInfo["Success"]  = true;
        $ResultInfo["FileList"] = @join(",",$FileTitleList);
    }
    return $ResultInfo;
}
/**
 * Log bug history.
 *
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @global  obj                       the object of ADO class created in SetupBug.inc.php file.
 * @param   string      $BugIdList    the id number list of Bug.
 * @param   string      $Action       the action mode: Opened|Edited|Resolved|Closed|Activated
 * @param   text        $FullInfo
 */
function bugLogHistory($BugIdList,$Action,$FullInfo = "")
{
    global $MyDB;

    // Explode BugIdList to array.
    $BugIdList = explode(",",$BugIdList);

    // Insert to BugHistory.
    foreach($BugIdList as $BugID)
    {
        $SQL = "INSERT INTO BugHistory(BugID,UserName,Action,FullInfo,ActionDate) VALUES(
                                      '$BugID','$_SESSION[BugUserName]','$Action','$FullInfo',now())";
        if(!$MyDB->query($SQL))
        {
            die($MyDB->errorMsg());
        }
    }
}
/**
 * Mail bug change.
 *
 * 1. Get the users should be mailed to including AssignedTo, MailTo, <br>
 *    and users whoes userdefined query meet current bugs, not including current operating user.<br>
 * 2. Get the users' email address, dived into To group and CC group.<br>
 * 3. Create the content of the mail.<br>
 * 4. call sysMail() function to send the message.<br>
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @global  obj                       the object of ADO class created in SetupBug.inc.php file.
 * @param   string      $BugID        the id number list of Bug.
 * @param   string      $AssignedTo   AssignedTo user list.
 * @param   string      $MailTo       MailTo user list.
 * @param   text        $Subject      the subject.
 * @param   text        $Action       Action mode: Opened|Edited|Closed|Resolved|Activated
 * @param   text        $Notes        the Notes.
 */
function bugMailChange($BugID,$AssignedTo,$MailTo,$Subject,$Action,$Notes)
{
    global $MyDB;

    if(empty($BugID))
    {
        return false;
    }

    // explode $AssignedTo to array.
    $AssignedTo = explode(",",$AssignedTo);

    // Merget  $AssignedTo and $MailTo to $MailToList.
    $MailUserList = @array_merge($AssignedTo,explode(",",$MailTo));

    // Add current operating user to MailToList.
    $MailUserList[] = $_SESSION["BugUserName"];

    // Get unique value of $MailUserList.
    $MailUserList = @array_unique($MailUserList);

    // Get query strings of the users who are not in $MailUserList.
    $SQL = "SELECT UserName,QueryString FROM BugQuery WHERE UserName NOT " . dbCreateIN(join(",",$MailUserList));
    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        while($UserQuery = $ResultID->fetchRow())
        {
            if(in_array($UserQuery["UserName"],$MailUserList))
            {
                continue;
            }

            // Explde the QueryString by ORDER.
            $QueryString  = explode("ORDER", $UserQuery["QueryString"]);

            // Append HAVING condition to the QueryString.
            $QueryString  = $QueryString[0] . " HAVING BugID" . dbCreateIN($BugID);

            // If the new QueryString return true, add the user to MailToList.
            if($MyDB->getOne($QueryString))
            {
                $MailUserList[] = $UserQuery["UserName"];
            }
        }
    }
    else
    {
        die($MyDB->errorMsg());
    }

    if(!is_array($MailUserList))
    {
        return false;;
    }

    // Delete current operating user from MailToUserList.
    foreach($MailUserList AS $MailUser)
    {
        if($MailUser != $_SESSION["BugUserName"])
        {
            $LastMailToList[] = $MailUser;
        }
    }

    // Get email address list.
    $EmailList = bugGetUserEmail(@join(",",$LastMailToList));

    if(!is_array($EmailList))
    {
        return false;;
    }

    // Split email address list to To address and cc address.
    foreach($EmailList as $MailUser => $Email)
    {
        if(in_array($MailUser,$AssignedTo))
        {
            $LastEmailList["To"][] = $Email;
        }
        else
        {
            $LastEmailList["CC"][] = $Email;
        }
    }

    // If To address is empty, use the first email of EmailList as To address.
    if(empty($LastEmailList["To"]))
    {
        reset($EmailList);
        $LastEmailList["To"][] = $EmailList[key($EmailList)];
    }

    // Mail the change.
    $Message = bugCreateMailMessage($BugID,$Action,$Notes);
    sysMail($LastEmailList["To"],$LastEmailList["CC"],$Subject,$Message);
}
/**
 * Create message to mail.
 *
 * We use the fetch method of smarty template to fetch the content of an mail template file,
 * so we must assign the vars needed.
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @global  array                     config vars of BugFree system.
 * @global  object                    object of templates.
 * @param   string      $BugIdList    id numbers of bugs: 00001,000002
 * @param   string      $Action       Action mode: Opened|Closed|Resolved|Activated|Edited
 * @param   text        $Notes        Notes.
 * @return  text        $Message      Change info of the bugs in HTML type.
 */
function bugCreateMailMessage($BugIdList,$Action,$Notes)
{
    global $BugConfig;
    global $TPL;

    if(empty($BugIdList))
    {
        return false;;
    }
    // Get css style.
    $CssStyle = join("",file("Include/LangFile/".$BugConfig["Language"].$BugConfig["CssStyle"].".css"));
    $TPL->assign("CssStyle",$CssStyle);

    // Bug Info.
    $TPL->assign("BugList",bugGetInfo("Medium"," WHERE BugID".dbCreateIN($BugIdList)));

    // Change info.
    $TPL->assign("ActionInfo", date("Y-m-d H:i") . " " . $Action . " By ".$_SESSION["BugRealName"]);
    $TPL->assign("Notes",sysHtml2Txt(stripslashes($Notes)));    // Because the Notes are $_POST vars and has formatted  by addslashes(), so strip the slahes here.

    // Get change info in html.
    return ($TPL->fetch("MailChange.tpl"));
}

/**
 * Get files of a bug.
 *
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @global  obj                       the object of ADO class created in SetupBug.inc.php file.
 * @param   string      $BugID        the id number of bug.
 * @return  array       $FileList     the file list of the bug.
 */
function bugGetFiles($BugID)
{
    global $MyDB;
    if(empty($BugID))
    {
        return false;;
    }
    $SQL = "SELECT FileID,FileTitle,FileName,FileType,FileSize,AddUser,AddDate FROM BugFile WHERE BugID = '$BugID'";
    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        while($FileInfo = $ResultID->fetchRow())
        {
            $FileList[$FileInfo["FileID"]] = $FileInfo;
        }
        return $FileList;
    }
    else
    {
        die($MyDB->errorMsg());
    }
}
/**
 * Get history of a bug.
 *
 * @author                            Chunsheng Wang <wwccss@263.net>
 * @global  obj                       the object of ADO class created in SetupBug.inc.php file.
 * @param   string      $BugID        the id number of bug.
 * @return  array       $HistoryList  the history list of the bug.
 */
function bugGetHistory($BugID)
{
    global $MyDB;
    if(empty($BugID))
    {
        return false;;
    }
    // Get all user list.
    $BugUserList = bugGetUserList();

    $SQL      = "SELECT HistoryID,UserName,Action,FullInfo,ActionDate FROM BugHistory WHERE BugID = '$BugID' ORDER BY HistoryID ASC";
    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        while($HistoryInfo = $ResultID->fetchRow())
        {
            $HistoryInfo["UserName"]   = $BugUserList[$HistoryInfo["UserName"]];
            $HistoryInfo["ActionDate"] = substr($HistoryInfo["ActionDate"],0,16);
            $HistoryInfo["FullInfo"]   = sysHtml2Txt($HistoryInfo["FullInfo"]);
            $HistoryList[$HistoryInfo["HistoryID"]] = $HistoryInfo;
        }
        return $HistoryList;
    }
    else
    {
        die($MyDB->errorMsg());
    }
}

/**
 * Get statistics of bugs between $BeginDate and $EndDate.
 *
 * @author                      Chunsheng Wang <wwccss@263.net>
 * @global object               the object of Javascript class created in SetupBug.inc.php.
 * @global array                the bug config array.
 * @global array                the tpl config array.
 * @param  date   $EndDate      the end date
 * @param  date   $BeginDate    the begin date
 * @return array                Statistics of the bugs.
 */
function bugGetStat($EndDate,$BeginDate="")
{
    global $MyDB;
    global $BugConfig;
    global $TplConfig;

    // Get all user list.
    $BugUserList = bugGetUserList();

    // get all bugs between $BeginDate and EndDate, grouped by OpenedBy and then Resolution.
    if(!empty($BeginDate))
    {
        $SQL = " SELECT OpenedBy, Resolution, count(OpenedBy) as CountResolution FROM BugInfo WHERE OpenedDate < '$EndDate' AND OpenedDate >= '$BeginDate' GROUP BY OpenedBy, Resolution ";
    }
    else
    {
        $SQL = " SELECT OpenedBy, Resolution, count(OpenedBy) as CountResolution FROM BugInfo WHERE OpenedDate < '$EndDate' GROUP BY OpenedBy, Resolution";
    }

    $ResultID = $MyDB->query($SQL);
    if($ResultID)
    {
        // Group by the bug by OpenedBy and then by Resolution.
        while($BugInfo = $ResultID->fetchRow())
        {
            // change the empty Resolution to Active.
            if($BugInfo["Resolution"] == "")
            {
                $BugInfo["Resolution"] = "Active";
            }
            $BugStatList[$BugInfo["OpenedBy"]][$BugInfo["Resolution"]] = $BugInfo["CountResolution"];
            $BugStatList[$BugInfo["OpenedBy"]]["BugCount"]            += $BugInfo["CountResolution"];
        }
    }

    // Sort the BugList by BugCount item desc.
    $BugStatList = sysSortArray($BugStatList,"BugCount","SORT_DESC");

    if(!is_array($BugStatList))
    {
        return false;
    }

    // Get all posibble resolutions.
    $ResolutionList = bugGetResolutionList();

    // Comput the count of all kinds of Resolution.
    foreach($BugStatList as $BugUserName => $UserBugInfo)
    {
        // Add RealName to BugStatList.
        $BugStatList[$BugUserName]["RealName"] = !empty($BugUserList[$BugUserName]) ? $BugUserList[$BugUserName] : $BugUserName;

        foreach($ResolutionList as $Key => $Resolution)
        {
            $BugStatList[$BugUserName][$Resolution] = (int)$UserBugInfo[$Resolution];
            $BugStatList["Total"][$Resolution]      += $UserBugInfo[$Resolution];
        }
        $BugStatList["Total"]["BugCount"] += $UserBugInfo["BugCount"];
    }

    $BugStatList["Total"]["RealName"] = $TplConfig["StatBug"]["Total"];
    return $BugStatList;
}

/**
 * Get all posibble resolutions from BugConfig(change empty value to "Active" )
 *
 * @author                      Chunsheng Wang <wwccss@263.net>
 * @global array                the bug config array.
 * @return array                all posibble resolutions.
 */
function bugGetResolutionList()
{
    global $BugConfig;

    // Set all posibble resolution from $BugConfig["Resolutions"] and then add an Active resolution.
    $ResolutionList[] = "Active";
    $ResolutionList   = array_merge($ResolutionList,@array_keys($BugConfig["Resolutions"]));
    foreach($ResolutionList as $Key => $Resolution)
    {
        if(empty($Resolution))
        {
            unset($ResolutionList[$Key]);
        }
    }
    return $ResolutionList;
}
