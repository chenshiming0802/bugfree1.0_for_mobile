<?php
/**
 * Query result file of BugFree system.
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
 * @version     $Id: QueryBug.php,v 1.15 2005/09/24 04:01:57 wwccss Exp $
 */
/* Variable defintion. */
// $_SESSION["RightBottomURL"]    // Register the url of the RightBottomFrame window.
// $_SESSION["QueryPageID"]       // Current PageID in QueryBug.php.
// $_SESSION["QueryCondition"]    // WHERE xxx=xxx
// $_SESSION["OrderCondition"]    // ORDER BY xxx DESC
// $_POST["FieldsToShow"]         // Passed from QueryBugForm.php
// $_COOKIE["CustomFields"]       // $_COOKIE vars to store custom setting fields.
// $FieldsToShow                  // Explode from $_COOKIE["CustomFields"], this is the finally vars used in query.

/* Init BugFree system. */
require_once("Include/SetupBug.inc.php");

/* 1. Register REQUEST_URI and PageID to session to keep current working status. */
$_SESSION["RightBottomURL"] = empty($_GET["Export"]) ? $_SERVER["REQUEST_URI"] : "";
$_SESSION["QueryPageID"]    = $_GET["PageID"];

/**
 * 2. Create the query sql.
 */
/* 2.1 User selected a project or a module from ListModule.php. */
if(!empty($_GET["ProjectID"]))
{
    /* Define the query condition. */
    $Where = " WHERE ProjectID = '$_GET[ProjectID]'";
    $URL   = "QueryBug.php?ProjectID=$_GET[ProjectID]";

    /* User selected a module also. */
    if(!empty($_GET["ModuleGrade"]) and !empty($_GET["ModuleID"]))
    {
        $Where .= " AND ModuleID IN (". join(",",bugGetModuleChild($_GET["ModuleID"])).")";
        $URL   .= "&ModuleGrade=$_GET[ModuleGrade]&ModuleID=$_GET[ModuleID]";

        /* Register current module id to session. */
        $_SESSION["BugModuleID"]  = $_GET["ModuleID"];
    }
}
/* 2.2 User selected one of his user defined query from UserControl.php or from a link like QueryBug.php?UserQueryID=xxx. */
elseif(!empty($_REQUEST["UserQueryID"]))
{
    $UserQueryString = $MyDB->getOne("SELECT QueryString FROM BugQuery WHERE QueryID = $_REQUEST[UserQueryID]");
    $UserQueryString = explode("WHERE",$UserQueryString);
    $Where = " WHERE " . $UserQueryString[1];
    $URL   = "QueryBug.php?UserQueryID=$_REQUEST[UserQueryID]";
}
/* 2.3 User click one of the AssignedTo, OpenedBy, ResolvedBy label in the query result window. */
elseif(!empty($_GET["QueryMode"]))
{
    $QueryMode = explode("|",$_GET["QueryMode"]);
    $Where     = " WHERE " . $QueryMode[0] . " = '" . $QueryMode[1] . "'";
    $URL       = "QueryBug.php?QueryMode=" . join("|",$QueryMode);
}
/* 2.4 User passes an query string directly to export the result. */
elseif(!empty($_GET["QueryCondition"]))
{
    $Where = stripslashes($_GET["QueryCondition"]);
}
/* 2.5 User create mixed conditions from the query form. */
elseif(!empty($_POST["PostQuery"]) or !empty($_POST["SaveQuery"]))
{
    $Where = " WHERE ";
    for($I = 0; $I < $BugConfig["QueryFieldNumber"] * 2; $I ++)
    {
        /* 2.5.1 Define the start and end of the first group. */
        if($I == 0)
        {
            $Where .= "( 1";
        }
        elseif($I == $BugConfig["QueryFieldNumber"])
        {
            $Where .= " ) " . $_POST["AndOrGroup"] . " ( 1";
        }

        /* 2.5.2 Define var name. */
        $FieldName    = "Field".$I;
        $AndOrName    = "AndOr".$I;
        $OperatorName = "Operator".$I;
        $ValueName    = "Value".$I;

        /* 2.5.3 If the value user posted is empty, continue to next cycle. */
        if(empty($_POST[$ValueName]))
        {
            continue;
        }

        /* 2.5.4 AND/OR between two groups. */
        if($I == 0 or $I == $BugConfig["QueryFieldNumber"])
        {
            $Where .= " AND ";
        }

        /* 2.5.5 AND/OR between group fields. */
        $Where .= " ".$_POST[$AndOrName]." ";

        /* 2.5.6 Add Field Name. */
        $Where .= $_POST[$FieldName];

        /*--------------------2.5.7 set the field value. -----------------*/

        /* 2.5.7.1 Get the last two letters of current Field. */
        $LastValue = substr($_POST[$FieldName],-2);

        /* 2.5.7.2 the field name like AssignTo,OpenedBy. */
        if($LastValue == "By" or $LastValue == "To")
        {
            /* If the value user posted is Active or Null, change it to empty. */
            if(ucfirst($_POST[$ValueName]) == "Active" OR ucfirst($_POST[$ValueName]) == "Null")
            {
                $FieldValue = "";
            }
            /* If the value is closed, keep it. */
            elseif(ucfirst($_POST[$ValueName]) == "Closed")
            {
                $FieldValue = "Closed";
            }
            /* Get users whose username or realname like the value user posted. */
            else
            {
                $BugUserList = bugGetUserList(" WHERE BINARY(UserName) LIKE '%" . $_POST[$ValueName] . "%'" . " OR BINARY(RealName) LIKE '%" . $_POST[$ValueName] . "%'");
                if(is_array($BugUserList))
                {
                    $FieldValue  = @join(",",@array_keys($BugUserList));

                    /* If the operator is '!=', add 'NOT' before the IN string. */
                    if($_POST[$OperatorName] == "!=")
                    {
                        $Where .= " NOT" . dbCreateIN($FieldValue);
                    }
                    else
                    {
                        $Where .= dbCreateIN($FieldValue);
                    }
                    continue;
                }
                else
                {
                    $FieldValue = $_POST[$ValueName];
                }
            }
        }
        /* 2.5.7.3 other fields. */
        else
        {
            /* if the value equal "null", change it to "" */
            if(ucfirst($_POST[$ValueName]) == "Null")
            {
                $_POST[$ValueName] = "";
            }
            $FieldValue = $_POST[$ValueName];
        }

        /* 2.5.7.4 Add operator and finish the sql. */
        if($_POST[$OperatorName] == "LIKE")
        {
            $Where .= " LIKE '%$FieldValue%' ";
        }
        elseif($_POST[$OperatorName] == "UNDER")
        {
            $Where .= " LIKE '$FieldValue%' ";
        }
        else
        {
            $Where .= $_POST[$OperatorName] . " '".$FieldValue."'";
        }
    }

    /* 2.5.8 the end of the condition string. */
    $Where .=" )";

    /* 2.5.9 If the mode is SaveQuery, add slashes to $Where and regist it to session , then go to SaveQuery.php */
    if($_GET["Mode"] == "SaveQuery")
    {
        $_SESSION["QueryCondition"] = addslashes($Where);
        $MyJS->goto("SaveQuery.php");
        exit;
    }
}

/**
 * 3. Set the custom display field to cookie.
 */

/* 3.1 User set fields in the custom set table, registe to cookie. */
if($_POST["PostQuery"])
{
    $_COOKIE["CustomFields"] = $_POST["FieldsToShow"];
}
/* 3.2 If empty, use the default value defined in $TplConfig["QueryBugForm"]["DefaultFields"]. */
if(empty($_COOKIE["CustomFields"]))
{
    $_COOKIE["CustomFields"] = @join(",", array_keys($TplConfig["QueryBugForm"]["DefaultFields"]));
}
/* 3.3 Update the lifetime. */
@setcookie("CustomFields", $_COOKIE["CustomFields"], time()+360000);

/* 4. Register the $Where condition to session. */
if(!empty($Where))
{
    $_SESSION["QueryCondition"] = $Where;
}

/* 5. Register order condition. */
if(!empty($_GET["OrderBy"]))
{
    $_SESSION["OrderCondition"] = " ORDER BY " . str_replace("|"," ",$_GET["OrderBy"]);

    /* Append Order var to URL. */
    if(empty($URL))
    {
        $URL  = $_SERVER["PHP_SELF"] . "?OrderBy=$_GET[OrderBy]";
    }
    else
    {
        $URL .= "&OrderBy=$_GET[OrderBy]";
    }
}

/* If there's 'order' in $_SESSION["QueryCondition"], keep $_SESSION["OrderCondition"] empty. */
if(eregi("Order", $_SESSION["QueryCondition"]))
{
    $_SESSION["OrderCondition"] = "";
}
elseif(empty($_SESSION["OrderCondition"]))
{
    $_SESSION["OrderCondition"] = " ORDER BY BugID ASC ";
}

//var_dump($_SESSION["QueryCondition"] . $_SESSION["OrderCondition"], $_SESSION["BugUserAclSQL"]);
/* 6. Init the MyPage. */
$PageWhere = dbMergeSQL($_SESSION["QueryCondition"] . $_SESSION["OrderCondition"], $_SESSION["BugUserAclSQL"]);
$MyPage->init("BugInfo",$_GET["RecTotal"], $BugConfig["RecordPerPage"], $_GET["PageID"], $URL, $PageWhere);

/* 7. Query and fetch the bug list. */
if(!empty($_GET["Export"]))
{
    $BugList = @array_reverse(bugGetInfo("Max", $_SESSION["QueryCondition"].$_SESSION["OrderCondition"], 100));
}
else
{
    $BugList = @array_reverse(bugGetInfo($_COOKIE["CustomFields"], $_SESSION["QueryCondition"].$_SESSION["OrderCondition"].$MyPage->limit(), $BugConfig["QueryTitleLength"], true));
}

/**
 * 8. Assign
 */
/* 8.1 Assign QueryCondition and record page. */
$TPL->assign("QueryCondition",$_SESSION["QueryCondition"]);
$TPL->assign("RecordPage",    $MyPage->show());

/* 8.2 Assign custom fields vars. */
$FieldsToShow = explode(",", $_COOKIE["CustomFields"]);
$TPL->assign("FieldsToShow", $FieldsToShow);
$TPL->assign("FieldsCount",  count($FieldsToShow) + (eregi("BugID", $_COOKIE["CustomFields"]) ? 1 : 2));  // Show two BugID columns in QueryBug.php, so if there's BugID in FieldsToShow, add 1 else 2.

/* 8.3 Assign bug list to template. */
$TPL->assign("BugList",$BugList);

/* 8.4 Assign current user info, used to export the query result. */
$TPL->assign("CurrentUser",   $_SESSION["BugUserName"]);
$TPL->assign("CurrentUserPWD",$_SESSION["BugUserPWD"]);

/* 8.5 Assign REQUEST_URI to template.(strip order strings) */
if(strpos($_SERVER["QUERY_STRING"],"&"))
{
    $QueryStringList = explode("&",$_SERVER["QUERY_STRING"]);
    foreach($QueryStringList as $QueryString)
    {
        if(!eregi("Order",$QueryString))
        {
            $RequestURI .= $QueryString . "&";
        }
    }
}
$TPL->assign("RequestURI",$_SERVER["PHP_SELF"] . "?" . $RequestURI);

/* 8.6 Assign fields list used to show the table header. */
if(!empty($_GET["Export"]))
{
    $TPL->assign("FieldList", @array_keys($BugConfig["BugFields"]));    // Export mode, show all fields.
}
else
{
    $TPL->assign("OrderByList", $FieldsToShow);                         // Normal, show fields defined in $FieldsToShow.
}
$TPL->assign("CurrentOrderBy", explode("|", $_GET["OrderBy"]));

/* 9. Display template file. */
if(!empty($_GET["Export"]))
{
    if($_GET["Export"] == "HtmlTable")
    {
        $TPL->display("ExportToHtmlTable.tpl");
    }
}
else
{
    $TPL->display("QueryBug.tpl");
}
?>