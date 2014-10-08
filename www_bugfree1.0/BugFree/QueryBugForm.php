<?php
/**
 * Query window of BugFree system.
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
 * @version     $Id: QueryBugForm.php,v 1.13 2005/09/14 14:59:38 wwccss Exp $
 */
/* Init BugFree system. */
require_once("Include/SetupBug.inc.php");

/* 1. Create two group query form and every one contains AndOr,QueryFiled,Operator and Value. */
for($I = 0; $I < $BugConfig["QueryFieldNumber"]; $I ++)
{
    /* First condition group. */
    $AndOrList[$I]      = $MyHtml->select($BugConfig["AndOr"],"AndOr".$I,"Reverse");
    $QueryFieldList[$I] = $MyHtml->select($BugConfig["QueryField"],"Field".$I,"Reverse","setQueryOperator($I);setQueryValue($I)");
    $OperatorList[$I]   = $MyHtml->select($BugConfig["Operators"],"Operator".$I,"Reverse");
    $ValueList[$I]      = "<span id='Continer$I'><input type='text' name='Value$I' id='Value$I' size='7' class='MyInput'></span>";

    /* Second condition group. */
    $NO                  = $I + $BugConfig["QueryFieldNumber"];   //the Number of the sencond condition group.
    $AndOrList2[$I]      = $MyHtml->select($BugConfig["AndOr"],"AndOr".$NO,"Reverse");
    $QueryFieldList2[$I] = $MyHtml->select($BugConfig["QueryField"],"Field".$NO,"Reverse","setQueryOperator($NO);setQueryValue($NO)");
    $OperatorList2[$I]   = $MyHtml->select($BugConfig["Operators"],"Operator".$NO,"Reverse");
    $ValueList2[$I]      = "<span id='Continer$NO'><input type='text' name='Value$NO' id='Value$NO' size='7' class='MyInput'></span>";
}

/**
 * 2. Select diffrent field according to the order defined in BugConfig["QueryField"].
 *    We use $MyJS class to create the javascript code and assign them to template later.
 */
$BugConfig["QueryField"] = @array_keys($BugConfig["QueryField"]);
for($I = 0; $I < $BugConfig["QueryFieldNumber"] * 2; $I ++)
{
    $SelectQueryFieldList[$I] = $MyJS->selectOption("document.QueryForm.Field".$I, $BugConfig["QueryField"][$I]);
}

/**
 * 3. Set the vars used to custom set. 
 */
/* Set default display fields array */
$DefaultFields = $TplConfig["QueryBugForm"]["DefaultFields"];

/* Create custom fields selected list */
if(!empty($_COOKIE["CustomFields"]))
{
    $CustomFields = explode(",", $_COOKIE["CustomFields"]);
    foreach($CustomFields as $FieldName)
    {
        $FieldsToShow[$FieldName] = $BugConfig["BugFields"][$FieldName];
    }
}
else
{
    $FieldsToShow = $DefaultFields;
}

/**
 * Assign vars to templates.
 */

/* Assign AndOr. */
$TPL->assign("AndOrList", $AndOrList);
$TPL->assign("AndOrList2",$AndOrList2);

/* Assign QueryFileds and select different Filed. */
$TPL->assign("QueryFieldList", $QueryFieldList);
$TPL->assign("QueryFieldList2",$QueryFieldList2);
$TPL->assign("SelectQueryFieldList",$SelectQueryFieldList);

/* Assign custom query fields vars and default display fields vars to template. */
$TPL->assign("BugFieldsList",      $MyHtml->select($BugConfig["BugFields"], "BugFieldsList", "Reverse", "", 5));
$TPL->assign("DefaultFieldsText",  '"' . join('","', $DefaultFields) . '"');
$TPL->assign("DefaultFieldsValue", '"' . join('","', @array_keys($DefaultFields)) . '"');

/* Assign custom query fields selected vars to template */
$TPL->assign("FieldsToShowList",$MyHtml->select($FieldsToShow, "FieldsToShowList","Reverse","",5));

/* Assign operator scrolling list to template. */
$TPL->assign("OperatorList", $OperatorList);
$TPL->assign("OperatorList2",$OperatorList2);

/* Assign value scrolling list to template. */
$TPL->assign("ValueList", $ValueList);
$TPL->assign("ValueList2",$ValueList2);

/* Assign BugStatus definition to template. */
$TPL->assign("StatusText",  '"' . join('","',$BugConfig["Status"]) . '"');
$TPL->assign("StatusValue", '"' . join('","',@array_keys($BugConfig["Status"])) . '"');

/* Assign BugSeverity definition to template. */
$TPL->assign("SeverityText",  '"' . join('","',$BugConfig["Severitys"]) . '"');
$TPL->assign("SeverityValue", '"' . join('","',@array_keys($BugConfig["Severitys"])) . '"');

/* Assign BugType definition to template. */
$TPL->assign("TypeText",  '"' . join('","',$BugConfig["Types"]) . '"');
$TPL->assign("TypeValue", '"' . join('","',@array_keys($BugConfig["Types"])) . '"');

/* Assign BugOS definition to template. */
$TPL->assign("OSText",  '"' . join('","',$BugConfig["BugOS"]) . '"');
$TPL->assign("OSValue", '"' . join('","',@array_keys($BugConfig["BugOS"])) . '"');

/* Assign BugResolution definition to template. */
$TPL->assign("ResolutionText",  '"' . join('","',$BugConfig["Resolutions"]) . '"');
$TPL->assign("ResolutionValue", '"' . join('","',@array_keys($BugConfig["Resolutions"])) . '"');

/* Assign BugUser definition to template. */
$UserACL = @join(",", @array_keys($_SESSION["BugUserACL"]));
$BugUserList = bugGetUserList("ProjectID = $UserACL",true);
$TPL->assign("UserText",  '"' . join('","',$BugUserList) . '"');
$TPL->assign("UserValue", '"' . join('","',@array_keys($BugUserList)) . '"');

/* Register frame displaying mode var from session. */
$TPL->assign("QueryFormMode",$_SESSION["QueryFormMode"]);

/* Assign the SESSION var IsAdminUser to template. */
$TPL->assign("IsAdminUser",$_SESSION["IsAdminUser"]);

/* Assign the QueryFieldNumber to template used in javascript function setQueryForm() */
$TPL->assign("QueryFieldNumber",$BugConfig["QueryFieldNumber"] * 2);

/* Assign current user to tpl. */
$TPL->assign("CurrentUser", $_SESSION["BugRealName"]);

/* Display. */
$TPL->display("QueryBugForm.tpl");
?>