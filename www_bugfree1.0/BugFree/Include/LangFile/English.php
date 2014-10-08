<?php
/**
 * The English language file of BugFree system.
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
 * @version     $Id: English.php,v 1.45 2005/10/06 12:12:43 wwccss Exp $
 */

/* Language and charset, don't change. */
$BugConfig["Language"] = "English";
$BugConfig["Charset"]  = "UTF-8";

/* BugFree team info. Dont't change. */
$BugConfig["RnDTeam"]  = "EasySoft BugFree R&D Team";
$BugConfig["HomePage"] = "http://bugfree.1zsoft.com";
$BugConfig["Title"]    = "EasySoft|BugFree -- Free Software: Web-based Bug Management System. Version " . $BugConfig["Version"];

/* Define css style list. */
$BugConfig["StyleList"]["Default"] = "Default";
$BugConfig["StyleList"]["Blue"]    = "Blue";

/* Define the length of the title to show in result list window and user control window. */
$BugConfig["QueryTitleLength"]   = 63;    // Used in QueryBug.php
$BugConfig["ControlTitleLength"] = 36;    // Used in UserControl.php

/* The fields of BugInfo table. */
$BugConfig["BugFields"] = array
(
    "BugID"          => "Bug ID",
    "ProjectID"      => "Project ID",
    "ProjectName"    => "Project Name",
    "ModuleID"       => "Module ID",
    "ModulePath"     => "Module Path",
    "BugTitle"       => "Bug Title",
    "BugSeverity"    => "Severity",
    "BugType"        => "Bug Type",
    "BugOS"          => "Bug OS",
    "BugStatus"      => "Bug Status",
    "LinkID"         => "Link Bug",
    "MailTo"         => "Mail To",
    "OpenedBy"       => "Opened By",
    "OpenedDate"     => "Opened Date",
    "OpenedBuild"    => "Opened Build",
    "AssignedTo"     => "Assigned To",
    "AssignedDate"   => "Assigned Date",
    "ResolvedBy"     => "Resovled By",
    "Resolution"     => "Resolution",
    "ResolvedBuild"  => "Resolved Build",
    "ResolvedDate"   => "Resolved Date",
    "ClosedBy"       => "Closed By",
    "ClosedDate"     => "Closed Date",
    "LastEditedBy"   => "LastEditedBy",
    "LastEditedDate" => "LastEditedDate"
);

/* The fields used to query in QueryBug.php.(Note: the field will be displayed in the order you defined here). */
$BugConfig["QueryField"] = array
(
   "ProjectName"    => $BugConfig["BugFields"]["ProjectName"],
   "ModulePath"     => $BugConfig["BugFields"]["ModulePath"],
   "BugID"          => $BugConfig["BugFields"]["BugID"],
   "OpenedBy"       => $BugConfig["BugFields"]["OpenedBy"],
   "AssignedTo"     => $BugConfig["BugFields"]["AssignedTo"],
   "BugTitle"       => $BugConfig["BugFields"]["BugTitle"],
   "BugStatus"      => $BugConfig["BugFields"]["BugStatus"],
   "BugSeverity"    => $BugConfig["BugFields"]["BugSeverity"],
   "BugType"        => $BugConfig["BugFields"]["BugType"],
   "BugOS"          => $BugConfig["BugFields"]["BugOS"],
   "OpenedDate"     => $BugConfig["BugFields"]["OpenedDate"],
   "AssignedDate"   => $BugConfig["BugFields"]["AssignedDate"],
   "ResolvedBy"     => $BugConfig["BugFields"]["ResolvedBy"],
   "Resolution"     => $BugConfig["BugFields"]["Resolution"],
   "ResolvedDate"   => $BugConfig["BugFields"]["ResolvedDate"],
   "ClosedBy"       => $BugConfig["BugFields"]["ClosedBy"],
   "ClosedDate"     => $BugConfig["BugFields"]["ClosedDate"],
   "LastEditedBy"   => $BugConfig["BugFields"]["LastEditedBy"],
   "LastEditedDate" => $BugConfig["BugFields"]["LastEditedDate"],
   "LinkID"         => $BugConfig["BugFields"]["LinkID"],
   "MailTo"         => $BugConfig["BugFields"]["MailTo"],
   "OpenedBuild"    => $BugConfig["BugFields"]["OpenedBuild"],
   "ResolvedBuild"  => $BugConfig["BugFields"]["ResolvedBuild"],
);
/* The field list used to query in QueryBug.php.(Note: the field will be displayed in the order you defined here). */
$BugConfig["QueryField"] = array
(
   "ProjectName"    => "Project Name",
   "ModulePath"     => "Module Path",
   "BugID"          => "Bug ID",
   "OpenedBy"       => "Opened By",
   "AssignedTo"     => "Assigned To",
   "BugTitle"       => "Bug Title",
   "BugStatus"      => "Bug Status",
   "BugSeverity"    => "Bug Severity",
   "BugType"        => "Bug Type",
   "BugOS"          => "Bug OS",
   "OpenedDate"     => "Opened Date",
   "AssignedDate"   => "Assigned Date",
   "ResolvedBy"     => "Resolved By",
   "Resolution"     => "Resolution",
   "ResolvedDate"   => "Resolved Date",
   "ClosedBy"       => "Closed By",
   "ClosedDate"     => "Closed Date",
   "LastEditedBy"   => "LastEditedBy",
   "LastEditedDate" => "LastEditedDate",
   "LinkID"         => "Link Bug",
   "MailTo"         => "Mail To",
   "OpenedBuild"    => "Opened Build",
   "ResolvedBuild"  => "ResolvedBuild"
);

/* And Or list. */
$BugConfig["AndOr"] = array("AND" => "AND","OR"  => "OR");

/* Define the operators. */
$BugConfig["Operators"] = array
(
   "="     =>  "Equals",
   "!="    =>  "Not Equals",
   ">"     =>  "Larger Than",
   "<"     =>  "Smaller Than",
   "LIKE"  =>  "Include",
   "UNDER" =>  "Under"
);

/* Define the severity. */
$BugConfig["Severitys"] = array
(
   3 => 3,
   1 => 1,
   2 => 2,
   4 => 4,
);

/* Define the OS list. */
$BugConfig["BugOS"] = array
(
   "All"     => "ALL",
   "WinXP"   => "Windows XP",
   "Win2000" => "Windows 2000",
   "WinNT"   => "Windows NT",
   "Win98"   => "Windows 98",
   "Linux"   => "Linux",
   "Unix"    => "Unix",
   "Others"  => "Others",
);

/* Define the types. */
$BugConfig["Types"] = array
(
  "CodeError"    => "Code Error",
  "Interface"    => "Interface",
  "DesignChange" => "Design change",
  "NewFeature"   => "New Feature",
  "CheckData"    => "Check Data",
  "TrackThings"  => "Track Things",
  "Others"       => "Others"
);

/* Define the status. */
$BugConfig["Status"] = array
(
    "Active"   => "Active",
    "Resolved" => "Resolved",
    "Closed"   => "Closed"
);

/* Define the Resolution. */
$BugConfig["Resolutions"] = array
(
    ""             => "",
    "By Design"    => "By Design",
    "Duplicate"    => "Duplicate",
    "External"     => "External",
    "Fixed"        => "Fixed",
    "Not Repro"    => "Not Repro",
    "Postponed"    => "Postponed",
    "Will not Fix" => "Won't Fix"
);

/* The error message to display when a user not logged in. */
$BugConfig["Message"] =  array
(
    "NotLogin"     => "You haven't logged into the system.\\nPlease log in first!",
    "ErrorLogin"   => "Your username or password is wrong.\\nPlease try again!",
    "NoPriv"       => "You have no privilege to access BugFree system. Please contact the administrator."
);

/*-------------------------- TEMPLATE VARIABLES ------------------------------------------*/

/* Setting of common */
$TplConfig["Common"]["ListSign"]                 = "<font color='blue'>◆</font>";

/* Setting of Login.php */
$TplConfig["Login"]["LoginTitle"]                = "Welcome to BugFree";
$TplConfig["Login"]["BugUserName"]               = "Username:";
$TplConfig["Login"]["BugUserPWD"]                = "Password:";
$TplConfig["Login"]["ButtonLogin"]               = "Login BugFree (L)";
$TplConfig["Login"]["SelectLang"]                = "Language:";
$TplConfig["Login"]["SelectStyle"]               = "Style:";

/* Setting of index.php */
$TplConfig["Index"]["NotSupportFrame"]           = "Sorry, your browser dosen't support Frame. Please update your broswer first.";
$TplConfig["Index"]["WarnningTitle"]             = "Warnning!";
$TplConfig["Index"]["WarnningContent"]           = <<<EOT
<ul>
  <li>Please remove the install.php and upgrade.php to continue use BugFree system. </li>
  <li>If you have enabled the auto sending email feature, please deny access to 'Shell' directory for others.</li>
</ul>
EOT;

/* Setting of ListModule.php.php */
$TplConfig["ListModule"]["QueryOrNew"]           = "<span class='PanelTitle'>Switch Query and New</span>";
$TplConfig["ListModule"]["QueryMode"]            = "Query Mode";
$TplConfig["ListModule"]["NewMode"]              = "New Mode";
$TplConfig["ListModule"]["SelectProject"]        = "<span class='PanelTitle'>Project And Module List</span>";
$TplConfig["ListModule"]["ProjectDoc"]           = "Project Document";
$TplConfig["ListModule"]["ProjectPlan"]          = "Project Schedule";

/* Setting of UserControl.php */
$TplConfig["UserControl"]["Latest5AssignedToMe"] = "<span class='PanelTitle'>Latest 5 Assigned To Me</span>";
$TplConfig["UserControl"]["Latest5OpenedByMe"]   = "<span class='PanelTitle'>Latest 5 Opened By Me</span>";
$TplConfig["UserControl"]["UserQuery"]           = "<span class='PanelTitle'>My Defined Query</span>";
$TplConfig["UserControl"]["ExecuteUserQuery"]    = "Query(X)";
$TplConfig["UserControl"]["ShareUserQuery"]      = "Send (M)";
$TplConfig["UserControl"]["DeleteUserQuery"]     = "Del (D)";

/* Setting of QueryBugForm.php */
$TplConfig["QueryBugForm"]["Report"]             = "Report";
$TplConfig["QueryBugForm"]["Help"]               = "Help";
$TplConfig["QueryBugForm"]["EasySoftHomePage"]   = "EasySoft";
$TplConfig["QueryBugForm"]["BugFreeHomePage"]    = "BugFree";
$TplConfig["QueryBugForm"]["BugFreeService"]     = "Support";
$TplConfig["QueryBugForm"]["Admin"]              = "Admin";
$TplConfig["QueryBugForm"]["EditSelfInfo"]       = "Edit My Info";
$TplConfig["QueryBugForm"]["LogOut"]             = "Exit";
$TplConfig["QueryBugForm"]["QueryTitle"]         = "Please select your query conditions:";
$TplConfig["QueryBugForm"]["AutoComplete"]       = "Auto Complete On/Off";
$TplConfig["QueryBugForm"]["QueryGroup1"]        = "GroupOne";
$TplConfig["QueryBugForm"]["QueryGroup2"]        = "GroupTwo";
$TplConfig["QueryBugForm"]["GroupAnd"]           = "AND";
$TplConfig["QueryBugForm"]["GroupOr"]            = "OR";
$TplConfig["QueryBugForm"]["ExecuteQueryBTN"]    = "Query Now (Q)";
$TplConfig["QueryBugForm"]["SaveQueryBTN"]       = "Save Query (S)";
$TplConfig["QueryBugForm"]["ResetQueryBTN"]      = "Reset Query (I)";
$TplConfig["QueryBugForm"]["CustomSetBTN"]       = "Custom Display (C)";
$TplConfig["QueryBugForm"]["AllFieldsTitle"]     = "All Fields";
$TplConfig["QueryBugForm"]["FieldsToShowTitle"]  = "Fields To Show";
$TplConfig["QueryBugForm"]["FieldsAddBTN"]       = ">>";
$TplConfig["QueryBugForm"]["FieldsDelBTN"]       = "<<";
$TplConfig["QueryBugForm"]["FieldsDefaultBTN"]   = "Default>>";
$TplConfig["QueryBugForm"]["DefaultFields"]      = array
(
   "BugID"        => $BugConfig["BugFields"]["BugID"],
   "BugSeverity"  => $BugConfig["BugFields"]["BugSeverity"],
   "BugTitle"     => $BugConfig["BugFields"]["BugTitle"],
   "OpenedBy"     => $BugConfig["BugFields"]["OpenedBy"],
   "AssignedTo"   => $BugConfig["BugFields"]["AssignedTo"],
   "ResolvedBy"   => $BugConfig["BugFields"]["ResolvedBy"],
   "Resolution"   => $BugConfig["BugFields"]["Resolution"]
);

/* Setting of QueryBug.php */
$TplConfig["QueryBug"]["ExportHtmlTable"]        = "Export All";
$TplConfig["QueryBug"]["BugSeverity"]            = "Severity";
$TplConfig["QueryBug"]["BugID"]                  = "Bug ID";
$TplConfig["QueryBug"]["BugTitle"]               = "Bug Title";
$TplConfig["QueryBug"]["OpenedBy"]               = "Opened By";
$TplConfig["QueryBug"]["AssignedTo"]             = "Assigned To";
$TplConfig["QueryBug"]["ResolvedBy"]             = "Resolved By";
$TplConfig["QueryBug"]["BugStatus"]              = "Status";
$TplConfig["QueryBug"]["OpenedByMe"]             = "Opened by me";
$TplConfig["QueryBug"]["AssignedToMe"]           = "Assigned to me";
$TplConfig["QueryBug"]["ResolvedByMe"]           = "Resolved by me";
$TplConfig["QueryBug"]["Resolution"]             = "Resolution";
$TplConfig["QueryBug"]["OrderASC"]               = "↑";
$TplConfig["QueryBug"]["OrderDESC"]              = "↓";

/* Setting of AddBugForm.php */
$TplConfig["AddBugForm"]["AddTitle"]             = "New Bug Now";
$TplConfig["AddBugForm"]["ProjectModule"]        = "Project and Module";
$TplConfig["AddBugForm"]["BugTitle"]             = "Bug Title";
$TplConfig["AddBugForm"]["BugBuild"]             = "Build Version";
$TplConfig["AddBugForm"]["NewBugBuild"]          = "Add a Build";
$TplConfig["AddBugForm"]["TypeAndOSAndSeverity"] = "Type, OS and Severity";
$TplConfig["AddBugForm"]["BugUserList"]          = "All User List";
$TplConfig["AddBugForm"]["AssignedAndMailTo"]    = "Assign To & Mail To";
$TplConfig["AddBugForm"]["AssignedToTitle"]      = "Assigned To";
$TplConfig["AddBugForm"]["AssignedToAddBTN"]     = "<<";
$TplConfig["AddBugForm"]["AssignedToDelBTN"]     = ">>";
$TplConfig["AddBugForm"]["MailToTitle"]          = "Mail To";
$TplConfig["AddBugForm"]["MailToAddBTN"]         = ">>";
$TplConfig["AddBugForm"]["MailToDelBTN"]         = "<<";
$TplConfig["AddBugForm"]["BugDesc"]              = "Description";
$TplConfig["AddBugForm"]["BugDescTemplate"]      = "[Steps]\n1.\n2.\n3.\n[Result]\n\n[Expect]\n\n[Note]\n";
$TplConfig["AddBugForm"]["BugFiles"]             = "Add Files";
$TplConfig["AddBugForm"]["SetFileName"]          = "Display Name";
$TplConfig["AddBugForm"]["SelectFile"]           = "Select File";
$TplConfig["AddBugForm"]["NewBug"]               = "New Bug (N)";

/* Setting of AddBug.php */
$TplConfig["AddBug"]["FillNeededInfo"]           = "Please fill needed info!";
$TplConfig["AddBug"]["ErrorEmptyTitle"]          = "Error: empty bug title!";
$TplConfig["AddBug"]["ErrorTitleLength"]         = "Error: the title is to long";
$TplConfig["AddBug"]["ErrorEmptyBuild"]          = "Error: empty build!";
$TplConfig["AddBug"]["ErrorExceedSize"]          = "Exceed the max size!";
$TplConfig["AddBug"]["CantCreateDIR"]            = "Can't create directory!";
$TplConfig["AddBug"]["CantCopyFile"]             = "Can't copy the file(s)!";
$TplConfig["AddBug"]["HaveBeenAdded"]            = "has been added.";
$TplConfig["AddBug"]["ErrorOccuring"]            = "But there are some errors:";
$TplConfig["AddBug"]["CorrectError"]             = "If there are any errors, please edit the bug. \\nOr you can contact the webmaster for this.";

/* Setting of BugInfo.php */
$TplConfig["BugInfo"]["ProjectAndModuleTitle"]   = "<span class='PanelTitle'>Project:Module</span>";
$TplConfig["BugInfo"]["ProjectAndModulePath"]    = "Project:Module";
$TplConfig["BugInfo"]["BugTitle"]                = "Bug Title";
$TplConfig["BugInfo"]["BugID"]                   = "Bug ID";

$TplConfig["BugInfo"]["BugStatusTitle"]          = "<span class='PanelTitle'>Bug Status</span>";
$TplConfig["BugInfo"]["BugType"]                 = "Type";
$TplConfig["BugInfo"]["BugOS"]                   = "OS";
$TplConfig["BugInfo"]["BugSeverity"]             = "Severity";
$TplConfig["BugInfo"]["BugStatus"]               = "Status";
$TplConfig["BugInfo"]["AssignedTo"]              = "Assigned To";
$TplConfig["BugInfo"]["AssignedDate"]            = "Assigned Date";
$TplConfig["BugInfo"]["LastEditedBy"]            = "Last Edited By";
$TplConfig["BugInfo"]["LastEditedDate"]          = "Last Edited Date";

$TplConfig["BugInfo"]["MailToTitle"]             = "<span class='PanelTitle'>Mail To</span>";
$TplConfig["BugInfo"]["BugFilesTitle"]           = "<span class='PanelTitle'>Files</span>";

$TplConfig["BugInfo"]["OpenedTitle"]             = "<span class='PanelTitle'>Opened</span>";
$TplConfig["BugInfo"]["OpenedBy"]                = "Opened By";
$TplConfig["BugInfo"]["OpenedDate"]              = "Opened Date";
$TplConfig["BugInfo"]["OpenedBuild"]             = "Opened Build";

$TplConfig["BugInfo"]["ResolvedTitle"]           = "<span class='PanelTitle'>Resolved</span>";
$TplConfig["BugInfo"]["ResolvedBy"]              = "Resolved By";
$TplConfig["BugInfo"]["ResolvedDate"]            = "Resloved Date";
$TplConfig["BugInfo"]["ResolvedBuild"]           = "Resloved Build";
$TplConfig["BugInfo"]["Resolution"]              = "Resolution";

$TplConfig["BugInfo"]["ClosedTitle"]             = "<span class='PanelTitle'>Closed</span>";
$TplConfig["BugInfo"]["ClosedBy"]                = "Closed By";
$TplConfig["BugInfo"]["ClosedDate"]              = "Closed Date";

$TplConfig["BugInfo"]["LinksTitle"]              = "<span class='PanelTitle'>Related Bugs</span>";

$TplConfig["BugInfo"]["ActionTitle"]             = "<span class='PanelTitle'>Action</span>";
$TplConfig["BugInfo"]["EditBTN"]                 = "Edit(E)";
$TplConfig["BugInfo"]["ResolveBTN"]              = "Resolve(R)";
$TplConfig["BugInfo"]["CloseBTN"]                = "Close(C)";
$TplConfig["BugInfo"]["ActivateBTN"]             = "Activate(A)";
$TplConfig["BugInfo"]["GoToQueryBTN"]            = "Back To Query (B)";
$TplConfig["BugInfo"]["HistoryTitle"]            = "<span class='PanelTitle'>History</span>";

/* Setting of EditBugForm.php, (most items use the same setting of BugInfo.php)*/
$TplConfig["EditBugForm"]["MailTo"]              = "Mail To";
$TplConfig["EditBugForm"]["LinkID"]              = "Related Bugs";
$TplConfig["EditBugForm"]["On"]                  = "On";
$TplConfig["EditBugForm"]["AddFileTitle"]        = "<span class='PanelTitle'>Add Files</span>";
$TplConfig["EditBugForm"]["DescriptionTitle"]    = "<span class='PanelTitle'>Description</span>";
$TplConfig["EditBugForm"]["Description"]         = "Description";
$TplConfig["EditBugForm"]["ActionTitle"]         = "<span class='PanelTitle'>Action</span>";
$TplConfig["EditBugForm"]["UpdateBTN"]           = "Update Bug Info (U)";

/* Setting of UpdateBug.php */
$TplConfig["UpdateBug"]["FillNeededInfo"]        = "Please fill needed info!";
$TplConfig["UpdateBug"]["ErrorEmptyTitle"]       = "Error: empty bug title!";
$TplConfig["UpdateBug"]["ErrorTitleLength"]      = "Erro: to title is to long!";
$TplConfig["UpdateBug"]["ErrorExceedSize"]       = "Exceed the max size!";
$TplConfig["UpdateBug"]["CantCreateDIR"]         = "Can't create directory!";
$TplConfig["UpdateBug"]["CantCopyFile"]          = "Can't copy the file!";
$TplConfig["UpdateBug"]["HaveBeenUpdated"]       = "has been updated!";
$TplConfig["UpdateBug"]["ErrorOccuring"]         = "But there are some erros:";
$TplConfig["UpdateBug"]["CorrectError"]          = "If there are any errors, please edit the bug. \\nOr you can contact the webmaster for this.";

/* Setting of ResolveBug.php */
$TplConfig["ResolveBug"]["NotAssignedToMe"]      = "This bug is not assigned to you! \\nPress 'OK' button to assign it to you and resolve it; \\nPress 'Cancel' to go back.";
$TplConfig["ResolveBug"]["ResolveTitle"]         = "<span class='PanelTitle'>Resolve</span>";
$TplConfig["ResolveBug"]["Resolution"]           = "Resolution";
$TplConfig["ResolveBug"]["LinkID"]               = "Related Bugs";
$TplConfig["ResolveBug"]["ResolvedBuild"]        = "Resolved Build";
$TplConfig["ResolveBug"]["NewBugBuild"]          = "Add a Build";
$TplConfig["ResolveBug"]["DescriptionTitle"]     = "<span class='PanelTitle'>Description</span>";
$TplConfig["ResolveBug"]["Description"]          = "Description";
$TplConfig["ResolveBug"]["HistoryTitle"]         = "<span class='PanelTitle'>History</span>";
$TplConfig["ResolveBug"]["AddFileTitle"]         = "<span class='PanelTitle'>Add Files</span>";
$TplConfig["ResolveBug"]["ActionTitle"]          = "<span class='PanelTitle'>Action</span>";
$TplConfig["ResolveBug"]["ResolveBTN"]           = "Resolve It (R)";
$TplConfig["ResolveBug"]["MustSetResolution"]    = "Please specify the resolution!";
$TplConfig["ResolveBug"]["MustSetlLinkID"]       = "Please specify the the related bug IDs.";
$TplConfig["ResolveBug"]["HaveBeenResolved"]     = "has been resolved.";

/* Setting of CloseBug.php */
$TplConfig["CloseBug"]["NotOpenedByMe"]          = "This bug was not opened by you. \\nPress 'OK' button to close it; \\nPress 'Cancel' to go back.";
$TplConfig["CloseBug"]["SureToCloseIt"]          = "Do you agree with the resolution? \\nPress 'OK' button to close it; \\nPress 'Cancel' to go back.";
$TplConfig["CloseBug"]["DescriptionTitle"]       = "<span class='PanelTitle'>Description</span>";
$TplConfig["CloseBug"]["Description"]            = "Description";
$TplConfig["CloseBug"]["ActionTitle"]            = "<span class='PanelTitle'>Action</span>";
$TplConfig["CloseBug"]["CloseBTN"]               = "Close It (C)";
$TplConfig["CloseBug"]["HistoryTitle"]           = "<span class='PanelTitle'>History</span>";
$TplConfig["CloseBug"]["HaveBeenClosed"]         = "has been closed.";

/* Setting of ActivateBug.php */
$TplConfig["ActivateBug"]["DescriptionTitle"]    = "<span class='PanelTitle'>Description</span>";
$TplConfig["ActivateBug"]["AssignTitle"]         = "<B><span class='PanelTitle'>AssignTo</span></B>";
$TplConfig["ActivateBug"]["AssignTo"]            = "Assign To";
$TplConfig["ActivateBug"]["Description"]         = "Description";
$TplConfig["ActivateBug"]["HistoryTitle"]        = "<span class='PanelTitle'>History</span>";
$TplConfig["ActivateBug"]["AddFileTitle"]        = "<span class='PanelTitle'>Add Files</span>";
$TplConfig["ActivateBug"]["ActionTitle"]         = "<span class='PanelTitle'>Action</span>";
$TplConfig["ActivateBug"]["ActivateBTN"]         = "Activate It (A)";
$TplConfig["ActivateBug"]["HaveBeenActivated"]   = "hss been activated.";

/* Setting of SaveQuery.php */
$TplConfig["SaveQuery"]["QueryTitle"]            = "Query Title";
$TplConfig["SaveQuery"]["SaveQueryBTN"]          = "Save Query (S)";
$TplConfig["SaveQuery"]["MustSetQueryTitle"]     = "Please fill the title.";
$TplConfig["SaveQuery"]["ThereisSameTitle"]      = "There is a query which has the same title! Please select one different name.";
$TplConfig["SaveQuery"]["HaveBeenSaved"]         = "The query has been saved.";

/* Setting of DelQuery.php */
$TplConfig["DelQuery"]["SureToDelIt"]            = "Are you sure to delete this query? \\nPress 'OK' button to delete it; \\nPress 'Cancel' to go back.";
$TplConfig["DelQuery"]["HaveBeenDeled"]          = "The query has been deleted.";

/* Setting of Logout.php */
$TplConfig["Logout"]["SureToLogout"]             = "Are you sure to logout? \\nPress 'OK' button to logout; \\nPress 'Cancel' to go back.";

/* Setting of NoticeBug.php */
$TplConfig["NoticeBug"]["Subject"]               = "Bugs assigned to you till now:";
$TplConfig["NoticeBug"]["Notes"]                 = <<<EOT
<ul>
  <li>If the bug status was "Resolved", please verify & close it in time. Or reactive it if you don't agree with the resolution;</li>
  <li>If the bug status is "Active", please add your comments then assign it to the person who can resolve it;</li>
  <li>If you don't know how to deal with the bug, please add your comments then assign it to the project/module owner.</li>
</ul>
EOT;
$TplConfig["NoticeBug"]["BugID"]                 = "Bug ID";
$TplConfig["NoticeBug"]["BugTitle"]              = "Bug Title";
$TplConfig["NoticeBug"]["OpenedBy"]              = "OpenedBy";
$TplConfig["NoticeBug"]["AssignedTo"]            = "AssignedTo";
$TplConfig["NoticeBug"]["BugStatus"]             = "Status";
$TplConfig["NoticeBug"]["Resolution"]            = "Resolution";
$TplConfig["NoticeBug"]["LastEditedDate"]        = "LastEditedDate";
$TplConfig["NoticeBug"]["ProjectName"]           = "ProjectName";

/* Setting of BugStat.php */
$TplConfig["StatBug"]["BugStatTitle"]            = "Stat of Bug";
$TplConfig["StatBug"]["OpenedBy"]                = "Opened By";
$TplConfig["StatBug"]["Total"]                   = "Total";

/* Setting of JudgeAdmin. note: JudgeAdmin is  a function in FunctionsMain.inc.php */
$TplConfig["JudgeAdmin"]["NotAdminUser"]         = "You are not the admin user.";

/* Setting of Admin/AdminMenu.php. */
$TplConfig["AdminMenu"]["AdminUserTitle"]        = "<span class='PanelTitle'>Admin User & Group</span>";
$TplConfig["AdminMenu"]["ListUser"]              = "Browse/Manage Users";
$TplConfig["AdminMenu"]["ListGroup"]             = "Browse/Manage Groups";
$TplConfig["AdminMenu"]["AddGroup"]              = "Add a Grooup";
$TplConfig["AdminMenu"]["AddUser"]               = "Add User";
$TplConfig["AdminMenu"]["AdminProjectAndModule"] = "<span class='PanelTitle'>Admin Project & Module</span>";
$TplConfig["AdminMenu"]["MangeProject"]          = "Manage  ";
$TplConfig["AdminMenu"]["AddProject"]            = "Add a Project";
$TplConfig["AdminMenu"]["ProjectDoc"]            = "Project Document";
$TplConfig["AdminMenu"]["ProjectPlan"]           = "Project Schedule";

/* Setting of Admin/ListBugUser.php. */
$TplConfig["ListBugUser"]["UserList"]            = "All Users List";
$TplConfig["ListBugUser"]["UserName"]            = "User Name";
$TplConfig["ListBugUser"]["RealName"]            = "Real Name";
$TplConfig["ListBugUser"]["Password"]            = "Password";
$TplConfig["ListBugUser"]["Email"]               = "Email";
$TplConfig["ListBugUser"]["GroupName"]           = "Group Name";
$TplConfig["ListBugUser"]["AdminMode"]           = "Admin Mode";
$TplConfig["ListBugUser"]["EditUser"]            = "Edit";
$TplConfig["ListBugUser"]["DelUser"]             = "DEL";
$TplConfig["ListBugUser"]["AddUserTitle"]        = "Add a user";
$TplConfig["ListBugUser"]["AddUserBTN"]          = "Add(A)";

/* Setting of Admin/AddBugUser.php. */
$TplConfig["AddBugUser"]["ErrorWrongEmail"]      = "Invalia email address.";
$TplConfig["AddBugUser"]["ErrorEmptyValue"]      = "Pleas fill all needed items.";
$TplConfig["AddBugUser"]["ErrorSameUserName"]    = "There's already a user with the same username.";
$TplConfig["AddBugUser"]["Success"]              = " has been added";

/* Setting of Admin/DelBugUser.php. */
$TplConfig["DelBugUser"]["ConfirmInfo"]          = "Are you sure to del this user? \\nPress 'ok' button to del the user. \\nPress 'cancle' button to go back.";
$TplConfig["DelBugUser"]["ErrorDelSelf"]         = "You can't delete yourself";
$TplConfig["DelBugUser"]["Success"]              = " has been deleted";

/* Setting of Admin/ListBugGroup.php. */
$TplConfig["ListBugGroup"]["GroupList"]           = "All Group List";
$TplConfig["ListBugGroup"]["GroupID"]             = "ID";
$TplConfig["ListBugGroup"]["GroupName"]           = "Group Name";
$TplConfig["ListBugGroup"]["GroupUser"]           = "Group Users";
$TplConfig["ListBugGroup"]["GroupACL"]            = "Group ACL";
$TplConfig["ListBugGroup"]["AdminMode"]           = "Manage Mode";
$TplConfig["ListBugGroup"]["EditGroup"]           = "Edit";
$TplConfig["ListBugGroup"]["DelGroup"]            = "Delete";
$TplConfig["ListBugGroup"]["AddGroupTitle"]       = "Manage Group";
$TplConfig["ListBugGroup"]["GroupUserAddBTN"]     = ">>";
$TplConfig["ListBugGroup"]["GroupUserDelBTN"]     = "<<";
$TplConfig["ListBugGroup"]["GroupACLAddBTN"]      = ">>";
$TplConfig["ListBugGroup"]["GroupACLDelBTN"]      = "<<";
$TplConfig["ListBugGroup"]["ManageGroupBTN"]      = "Save(S)";

/* Setting of Admin/AddBugGroup.php. */
$TplConfig["ManageBugGroup"]["ErrorEmptyValue"]   = "Please fill all the needed items";
$TplConfig["ManageBugGroup"]["ErrorSameGroupName"]= "Sorry, there's a group with the same name already.";
$TplConfig["ManageBugGroup"]["ErrorGroupID"]      = "Please specify the group id";
$TplConfig["ManageBugGroup"]["Success"]           = "Successfully saved";

/* Setting of Admin/DelBugGroup.php. */
$TplConfig["DelBugGroup"]["ConfirmInfo"]          = "Are you sure to del this group? \\nPress 'ok' button to del the group. \\nPress 'cancle' button to go back.";
$TplConfig["DelBugGroup"]["ErrorGroupID"]         = "Please specify the group id.";
$TplConfig["DelBugGroup"]["Success"]              = "Successfully deleted.";

/* Setting of EditSelfInfo.php. */
$TplConfig["EditSelfInfo"]["EditSelfInfoTitle"]   = "Edit Self Info";
$TplConfig["EditSelfInfo"]["RealName"]            = "Real Name";
$TplConfig["EditSelfInfo"]["Password"]            = "Password";
$TplConfig["EditSelfInfo"]["PasswordNote"]        = "(will not change if empty)";
$TplConfig["EditSelfInfo"]["Email"]               = "Email";
$TplConfig["EditSelfInfo"]["EditBTN"]             = "Edit(E)";
$TplConfig["EditSelfInfo"]["ErrorWrongEmail"]     = "Invalia email address.";
$TplConfig["EditSelfInfo"]["ErrorEmptyValue"]     = "Pleas fill all needed items.";
$TplConfig["EditSelfInfo"]["Success"]             = "The private info has been updated";

/* Setting of ManageProject.php. */
$TplConfig["ManageProject"]["ManageProjectTitle"] = "Manage a project";
$TplConfig["ManageProject"]["ManageMode"]         = "Manage mode";
$TplConfig["ManageProject"]["Edit"]               = "Edit current project";
$TplConfig["ManageProject"]["Add"]                = "Add a new project";
$TplConfig["ManageProject"]["ProjectName"]        = "Project Name";
$TplConfig["ManageProject"]["ProjectDoc"]         = "Project Doc";
$TplConfig["ManageProject"]["ProjectPlan"]        = "Project Plan";
$TplConfig["ManageProject"]["ManageProjectBTN"]   = "Submit(S)";
$TplConfig["ManageProject"]["AddModuleTitle"]     = "Add a module";
$TplConfig["ManageProject"]["ParentModule"]       = "Parent Module";
$TplConfig["ManageProject"]["ModuleName"]         = "ModuleName";
$TplConfig["ManageProject"]["ManageModuleBTN"]    = "Add(A)";
$TplConfig["ManageProject"]["ErrorEmptyName"]     = "Please fill the project name";
$TplConfig["ManageProject"]["SuccessUpdated"]     = " has been updatd";
$TplConfig["ManageProject"]["SuccessAdded"]       = " has been added";

/* Setting of ManageModule.php. */
$TplConfig["ManageModule"]["ManageModuleTitle"] = "Manage a module";
$TplConfig["ManageModule"]["ManageMode"]         = "Manage mode";
$TplConfig["ManageModule"]["Edit"]               = "Edit current module";
$TplConfig["ManageModule"]["Add"]                = "Add a new child module";
$TplConfig["ManageModule"]["ProjectName"]        = "Project Name";
$TplConfig["ManageModule"]["ParentModule"]       = "Parent Module";
$TplConfig["ManageModule"]["ModuleName"]         = "Module Name";
$TplConfig["ManageModule"]["ManageModuleBTN"]    = "Submit(S)";
$TplConfig["ManageModule"]["ErrorEmptyName"]     = "Please fill the module name";
$TplConfig["ManageModule"]["SuccessUpdated"]     = " has been updatd";
$TplConfig["ManageModule"]["SuccessAdded"]       = " has been added";

/* Setting of Install.php. */
$TplConfig["Install"]["InstallTitle"]            = "Install BugFree";
$TplConfig["Install"]["BugDBTitle"]              = <<<EOT
1. Set DB params of BugFree<br />
<div align="left">
  BugFree has a simple user management system and you can manage users by it. <span class="RedText">Thus you can omit step 2</span>.
  But if there are any other applications such as forums, blogs by php and mysql, you can use them to manage users too,
  <span class="RedText">then you must do step 2.</span></div>
EOT;

$TplConfig["Install"]["BugDBHost"]               = "Database server host";
$TplConfig["Install"]["BugDBUser"]               = "Database user";
$TplConfig["Install"]["BugDBPassword"]           = "Password";
$TplConfig["Install"]["BugDBDatabase"]           = "Database name";
$TplConfig["Install"]["CreateBugDB"]             = "Create it";

$TplConfig["Install"]["UserDBTitle"]             = <<<EOT
2. Set DB params of other application used to manage users <br />
<span class="RedText">If you want use other application to manage users, you must set the params of the database</span>
EOT;

$TplConfig["Install"]["UserDBHost"]              = "Database server host";
$TplConfig["Install"]["UserDBUser"]              = "Database user";
$TplConfig["Install"]["UserDBPassword"]          = "Password";
$TplConfig["Install"]["UserDBDatabase"]          = "Database name";

$TplConfig["Install"]["UserTableTitle"]          = <<<EOT
3. Set every field name of user managing table<br />
<div align="left">
If you are using BugFree's managing system, you need not to change the flowing items, but if you are using others application
you must edit the field name according to it's table structure. Here's an example of phpbb forum.
</div>
EOT;

$TplConfig["Install"]["TableName"]               = "Table name(phpbb:phpbb_users)";
$TplConfig["Install"]["UserName"]                = "Field name of 'UserName' (phpbb:username)";
$TplConfig["Install"]["RealName"]                = "Field name of 'RealName' (phpbb:username)";
$TplConfig["Install"]["UserPassword"]            = "Field name of 'UserPassword'(phpbb:user_password)";
$TplConfig["Install"]["Email"]                   = "Field name of 'Email'(phpbb:user_email)";
$TplConfig["Install"]["EncryptType"]             = "Encrypt type(phpbb:md5)";

$TplConfig["Install"]["MailTitle"]               = <<<EOT
4. Set Email params<br />
If you choose SMTP method to send email, you must setup the host address of SMTP server and if the smtp sever need username and
password, set them.
EOT;
$TplConfig["Install"]["FromAddress"]             = "From address";
$TplConfig["Install"]["FromName"]                = "From aame";
$TplConfig["Install"]["SendMethod"]              = "Send method";
$TplConfig["Install"]["SmtpHost"]                = "Smtp server host address";
$TplConfig["Install"]["SmtpAuth"]                = "Need authentication?";
$TplConfig["Install"]["SmtpUserName"]            = "User name";
$TplConfig["Install"]["SmtpPassword"]            = "Password";

$TplConfig["Install"]["OtherTitle"]              = "5. Others";
$TplConfig["Install"]["UploadDirectory"]         = "Where to put the uploaded file(this dir must be readable and writable)";
$TplConfig["Install"]["MaxFileSize"]             = "Max size of uploaded file, in bytes";

$TplConfig["Install"]["AdminTitle"]              = "6. To be the administrator";
$TplConfig["Install"]["AdminUserName"]           = "Administrator's user name";
$TplConfig["Install"]["AdminRealName"]           = "Administrator's real name";
$TplConfig["Install"]["AdminUserEmail"]          = "Administrator's email";
$TplConfig["Install"]["AdminUserPassword"]       = "Administrator's password";

$TplConfig["Install"]["SubmitButton"]            = "Create Config File Now!( You need save the file as '$BugConfig[ScriptDir]/Include/ConfigBug.inc.php)' by yourself";

$TplConfig["Install"]["ErrorBugDB"]              = "BugFree Database: ";
$TplConfig["Install"]["ErrorCreateBugDB"]        = " Create BugFree database failed: ";
$TplConfig["Install"]["ErrorUserDB"]             = " Use managing database: ";
$TplConfig["Install"]["ErrorUserTable"]          = " User managing table: ";
$TplConfig["Install"]["ErrorWritable"]           = " Must be readable and writable (o=rwx) ";
$TplConfig["Install"]["ErrorSmtpAuth"]           = " Smtp need user name and password ";
$TplConfig["Install"]["ErrorAdminUserInfo"]      = " Please specify the username,email,password of the administrator ";
$TplConfig["Install"]["ErrorCreateAdminUser"]    = " Create the administrator failed ";

/* Setting of Upgrade.php. */
$TplConfig["Upgrade"]["UpgradeTitle"]            = "Update to BugFree Version 1.0";
$TplConfig["Upgrade"]["UpgradeNote"]             = <<<EOT
<strong>1. Before upgrade, you need do the flowing steps by hand.</strong>
<ol>
  <li>Backup BugFree's program file and data.</li>
  <li>Download the latest BugFree and extract it.</li>
  <li>Set params in Include/ConfigBug.inc.php. <br />
      You can visit install program to create ConfigBug.inc.php, but <strong>not to create database again.</strong><br />
      <a href="install.php">Install>>></a>
  </li>
</ol>
<strong>2. Click the "Upgrade Database" button to upgrade the database auto.</strong>
<ol>
  <li>Add BugGroup table.</li>
  <li>Change the filed BugUserID of BugUser table to smallint</li>
</ol>
<strong>3. After upgraded, login as administrator, create group and grant priveleges to users.</strong>
EOT;
$TplConfig["Upgrade"]["Upgraded"]                = "The database has been upgraded. Please login as administrator, create group and grant priveleges to users.<a href='Login.php'>Login Now!>>></a>";
$TplConfig["Upgrade"]["UpgradeBTN"]              = "Upgrade Database";
$TplConfig["Upgrade"]["Success"]                 = "The database has been upgraded successfully. Please login as administrator, create group and grant priveleges to users.";
?>