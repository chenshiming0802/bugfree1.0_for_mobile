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
 * @version     $Id: Chinese.php,v 1.41 2005/10/06 12:12:43 wwccss Exp $
 */

/* Language and charset, don't change. */
$BugConfig["Language"] = "Chinese";
$BugConfig["Charset"]  = "GB2312";

/* BugFree team info. Dont't change. */
$BugConfig["RnDTeam"]  = "易软开源BugFree研发小组";
$BugConfig["HomePage"] = "http://bugfree.1zsoft.com";
$BugConfig["Title"]    = "易软开源|BugFree -- 开源软件：基于Web的精简版Bug管理系统。版本号 " . $BugConfig["Version"];

/* Define css style list. */
$BugConfig["StyleList"]["Default"] = "Default";
$BugConfig["StyleList"]["Blue"]    = "Blue";

/* Define the length of the title to show in result list window and user control window. */
$BugConfig["QueryTitleLength"]   = 45;    // Used in QueryBug.php
$BugConfig["ControlTitleLength"] = 30;    // Used in UserControl.php

/* The fields of BugInfo table. */
$BugConfig["BugFields"] = array
(
    "BugID"          => "Bug编号",
    "ProjectID"      => "项目编号",
    "ProjectName"    => "项目名",
    "ModuleID"       => "模块编号",
    "ModulePath"     => "模块路径",
    "BugTitle"       => "Bug 标题",
    "BugSeverity"    => "严重程度",
    "BugType"        => "Bug 类型",
    "BugOS"          => "操作系统",
    "BugStatus"      => "Bug 状态",
    "LinkID"         => "相关Bug",
    "MailTo"         => "抄送给",
    "OpenedBy"       => "由谁创建",
    "OpenedDate"     => "创建日期",
    "OpenedBuild"    => "创建时Build",
    "AssignedTo"     => "指派给",
    "AssignedDate"   => "指派日期",
    "ResolvedBy"     => "由谁解决",
    "Resolution"     => "解决方案",
    "ResolvedBuild"  => "解决时Build",
    "ResolvedDate"   => "解决日期",
    "ClosedBy"       => "由谁关闭",
    "ClosedDate"     => "关闭日期",
    "LastEditedBy"   => "最后由谁编辑",
    "LastEditedDate" => "最后编辑日期"
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

/* And Or list. */
$BugConfig["AndOr"] = array("And" => "并且","Or"  => "或者");

/* Operators. */
$BugConfig["Operators"] = array
(
   "="     =>  "等于",
   "!="    =>  "不等于",
   ">"     =>  "大于",
   "<"     =>  "小于",
   "LIKE"  =>  "包含",
   "UNDER" =>  "在某路径下"
);

/* Severity. */
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
   "All"     => "全部",
   "WinXP"   => "Windows XP",
   "Win2000" => "Windows 2000",
   "WinNT"   => "Windows NT",
   "Win98"   => "Windows 98",
   "Linux"   => "Linux",
   "Unix"    => "Unix",
   "Others"  => "其他",
);

/* Define the types. */
$BugConfig["Types"] = array
(
  "CodeError"    => "代码错误",
  "Interface"    => "界面优化",
  "DesignChange" => "设计变更",
  "NewFeature"   => "新增功能",
  "CheckData"    => "数据校对",
  "TrackThings"  => "事务跟踪",
  "Others"       => "其他"
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
    "NotLogin"     => "您还没有登录到系统。\\n请首先登录 BugFree!",
    "ErrorLogin"   => "您的用户名或密码不正确。\\n请重新输入!",
    "NoPriv"       => "您现在还没有访问BugFree的权限，请联系系统管理员为您分派权限。",
);

/*-------------------------- TEMPLATE VARIABLES ------------------------------------------*/

/* Setting of common */
$TplConfig["Common"]["ListSign"]                 = "<font color='blue'>◆</font>";

/* Setting of Login.php */
$TplConfig["Login"]["LoginTitle"]                = "欢迎使用 BugFree";
$TplConfig["Login"]["BugUserName"]               = "用户名:";
$TplConfig["Login"]["BugUserPWD"]                = "密码:";
$TplConfig["Login"]["ButtonLogin"]               = "登录 BugFree (L)";
$TplConfig["Login"]["SelectLang"]                = "语言:";
$TplConfig["Login"]["SelectStyle"]               = "样式:";

/* Setting of index.php */
$TplConfig["Index"]["NotSupportFrame"]           = "很遗憾您的浏览器不支持 Frame。请您首先更新浏览器的版本。";
$TplConfig["Index"]["WarnningTitle"]              = "系统警告！";
$TplConfig["Index"]["WarnningContent"]            = <<<EOT
<ul>
  <li>系统发现在BugFree的目录下面存在Install.php或者upgrade.php程序，如果BugFree已经安装完毕，请将此程序删除，或者移到其他目录。否则会带来安全方面的问题！</li>
  <li>系统同时提示您：如果您使用了BugFree的定时程序，请务必修改Shell目录的权限，禁止别人访问，或者将Shell目录移到网站目录之外。</li>
</ul>
EOT;

/* Setting of ListModule.php.php */
$TplConfig["ListModule"]["QueryOrNew"]           = "<B><span class='PanelTitle'>切换查询和创建</span></B>";
$TplConfig["ListModule"]["QueryMode"]            = "查询模式";
$TplConfig["ListModule"]["NewMode"]              = "创建 Bug";
$TplConfig["ListModule"]["SelectProject"]        = "<B><span class='PanelTitle'>项目和模块列表</span></B>";
$TplConfig["ListModule"]["ProjectDoc"]           = "项目文档";
$TplConfig["ListModule"]["ProjectPlan"]          = "项目进度";

/* Setting of UserControl.php */
$TplConfig["UserControl"]["Latest5AssignedToMe"] = "<B><span class='PanelTitle'>最近5个指派给我的 Bug</span></B>";
$TplConfig["UserControl"]["Latest5OpenedByMe"]   = "<B><span class='PanelTitle'>最近5个由我创建的 Bug</span></B>";
$TplConfig["UserControl"]["UserQuery"]           = "<B><span class='PanelTitle'>我自定义的查询条件</span></B>";
$TplConfig["UserControl"]["ExecuteUserQuery"]    = "查询 (X)";
$TplConfig["UserControl"]["ShareUserQuery"]      = "发送 (M)";
$TplConfig["UserControl"]["DeleteUserQuery"]     = "删除 (D)";

/* Setting of QueryBugForm.php */
$TplConfig["QueryBugForm"]["Help"]               = "使用帮助";
$TplConfig["QueryBugForm"]["CheckUpdate"]        = "检查更新";
$TplConfig["QueryBugForm"]["EasySoftHomePage"]   = "易软开源网站";
$TplConfig["QueryBugForm"]["BugFreeHomePage"]    = "BugFree网站";
$TplConfig["QueryBugForm"]["BugFreeService"]     = "技术支持";
$TplConfig["QueryBugForm"]["Report"]             = "统计";
$TplConfig["QueryBugForm"]["Admin"]              = "后台管理";
$TplConfig["QueryBugForm"]["EditSelfInfo"]       = "编辑我的信息";
$TplConfig["QueryBugForm"]["LogOut"]             = "退出";
$TplConfig["QueryBugForm"]["QueryTitle"]         = "请选择你的查询条件";
$TplConfig["QueryBugForm"]["AutoComplete"]       = "自动完成";
$TplConfig["QueryBugForm"]["QueryGroup1"]        = "第一组";
$TplConfig["QueryBugForm"]["QueryGroup2"]        = "第二组";
$TplConfig["QueryBugForm"]["GroupAnd"]           = "并且";
$TplConfig["QueryBugForm"]["GroupOr"]            = "或者";
$TplConfig["QueryBugForm"]["ExecuteQueryBTN"]    = "现在查询 (Q)";
$TplConfig["QueryBugForm"]["SaveQueryBTN"]       = "保存查询 (S)";
$TplConfig["QueryBugForm"]["ResetQueryBTN"]      = "重置查询 (I)";
$TplConfig["QueryBugForm"]["CustomSetBTN"]       = "自定义显示 (C)";
$TplConfig["QueryBugForm"]["AllFieldsTitle"]     = "所有字段";
$TplConfig["QueryBugForm"]["FieldsToShowTitle"]  = "要显示的字段";
$TplConfig["QueryBugForm"]["FieldsAddBTN"]       = ">>";
$TplConfig["QueryBugForm"]["FieldsDelBTN"]       = "<<";
$TplConfig["QueryBugForm"]["FieldsDefaultBTN"]   = "默认>>";
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
$TplConfig["QueryBug"]["ExportHtmlTable"]        = "全部导出";
$TplConfig["QueryBug"]["BugSeverity"]            = "严重程度";
$TplConfig["QueryBug"]["BugID"]                  = "Bug 编号";
$TplConfig["QueryBug"]["BugTitle"]               = "Bug 标题";
$TplConfig["QueryBug"]["OpenedBy"]               = "由谁创建";
$TplConfig["QueryBug"]["AssignedTo"]             = "指派给";
$TplConfig["QueryBug"]["ResolvedBy"]             = "由谁解决";
$TplConfig["QueryBug"]["BugStatus"]              = "状态";
$TplConfig["QueryBug"]["OpenedByMe"]             = "由我创建";
$TplConfig["QueryBug"]["AssignedToMe"]           = "指派给我";
$TplConfig["QueryBug"]["ResolvedByMe"]           = "由我解决";
$TplConfig["QueryBug"]["Resolution"]             = "解决方案";
$TplConfig["QueryBug"]["OrderASC"]               = "↑";
$TplConfig["QueryBug"]["OrderDESC"]              = "↓";

/* Setting of AddBugForm.php */
$TplConfig["AddBugForm"]["AddTitle"]             = "现在新建一个 Bug";
$TplConfig["AddBugForm"]["ProjectModule"]        = "项目和模块";
$TplConfig["AddBugForm"]["BugTitle"]             = "Bug 标题";
$TplConfig["AddBugForm"]["BugBuild"]             = "Build 版本";
$TplConfig["AddBugForm"]["NewBugBuild"]          = "新增Build";
$TplConfig["AddBugForm"]["TypeAndOSAndSeverity"] = "类型、 操作系统和严重程度";
$TplConfig["AddBugForm"]["BugUserList"]          = "所有用户列表";
$TplConfig["AddBugForm"]["AssignedAndMailTo"]    = "指派、发信通知";
$TplConfig["AddBugForm"]["AssignedToTitle"]      = "指派给";
$TplConfig["AddBugForm"]["AssignedToAddBTN"]     = "<<";
$TplConfig["AddBugForm"]["AssignedToDelBTN"]     = ">>";
$TplConfig["AddBugForm"]["MailToTitle"]          = "发信通知";
$TplConfig["AddBugForm"]["MailToAddBTN"]         = ">>";
$TplConfig["AddBugForm"]["MailToDelBTN"]         = "<<";
$TplConfig["AddBugForm"]["BugDesc"]              = "Bug 描述";
$TplConfig["AddBugForm"]["BugDescTemplate"]      = "[步骤]\n1.\n2.\n3.\n[结果]\n\n[期望]\n\n[备注]";
$TplConfig["AddBugForm"]["BugFiles"]             = "相关文件";
$TplConfig["AddBugForm"]["SetFileName"]          = "显示名称";
$TplConfig["AddBugForm"]["SelectFile"]           = "选择文件";
$TplConfig["AddBugForm"]["NewBug"]               = "创建 Bug (N)";

/* Setting of AddBug.php */
$TplConfig["AddBug"]["FillNeededInfo"]           = "请填写必要的信息!";
$TplConfig["AddBug"]["ErrorEmptyTitle"]          = "错误: Bug 标题不能为空!";
$TplConfig["AddBug"]["ErrorTitleLength"]         = "错误：标题长度超过系统设定。";
$TplConfig["AddBug"]["ErrorEmptyBuild"]          = "错误: Build版本号不能为空";
$TplConfig["AddBug"]["ErrorExceedSize"]          = "超过最大尺寸!";
$TplConfig["AddBug"]["CantCreateDIR"]            = "不能创建目录!";
$TplConfig["AddBug"]["CantCopyFile"]             = "不能拷贝文件!";
$TplConfig["AddBug"]["HaveBeenAdded"]            = "已经被添加了。";
$TplConfig["AddBug"]["ErrorOccuring"]            = "但有一些错误: ";
$TplConfig["AddBug"]["CorrectError"]             = "若有任何错误，请编辑 Bug。\\n或者请联系您的系统管理员。";

/* Setting of BugInfo.php */

$TplConfig["BugInfo"]["ProjectAndModuleTitle"]   = "<B><span class='PanelTitle'>项目 : 模块</span></B>";
$TplConfig["BugInfo"]["ProjectAndModulePath"]    = "项目 : 模块";
$TplConfig["BugInfo"]["BugTitle"]                = "Bug 标题";
$TplConfig["BugInfo"]["BugID"]                   = "Bug 编号";

$TplConfig["BugInfo"]["BugStatusTitle"]          = "<B><span class='PanelTitle'>Bug 状态</span></B>";
$TplConfig["BugInfo"]["BugType"]                 = "类型";
$TplConfig["BugInfo"]["BugOS"]                   = "操作系统";
$TplConfig["BugInfo"]["BugSeverity"]             = "严重程度";
$TplConfig["BugInfo"]["BugStatus"]               = "状态";
$TplConfig["BugInfo"]["AssignedTo"]              = "指派给";
$TplConfig["BugInfo"]["AssignedDate"]            = "指派日期";
$TplConfig["BugInfo"]["LastEditedBy"]            = "最后由谁修改";
$TplConfig["BugInfo"]["LastEditedDate"]          = "最后修改日期";

$TplConfig["BugInfo"]["MailToTitle"]             = "<B><span class='PanelTitle'>发信通知</span></B>";
$TplConfig["BugInfo"]["BugFilesTitle"]           = "<B><span class='PanelTitle'>附件</span></B>";

$TplConfig["BugInfo"]["OpenedTitle"]             = "<B><span class='PanelTitle'>创建</span></B>";
$TplConfig["BugInfo"]["OpenedBy"]                = "由谁创建";
$TplConfig["BugInfo"]["OpenedDate"]              = "创建日期";
$TplConfig["BugInfo"]["OpenedBuild"]             = "创建 Build";

$TplConfig["BugInfo"]["ResolvedTitle"]           = "<B><span class='PanelTitle'>解决</span></B>";
$TplConfig["BugInfo"]["ResolvedBy"]              = "由谁解决";
$TplConfig["BugInfo"]["ResolvedDate"]            = "解决日期";
$TplConfig["BugInfo"]["ResolvedBuild"]           = "解决 Build";
$TplConfig["BugInfo"]["Resolution"]              = "解决方案";

$TplConfig["BugInfo"]["ClosedTitle"]             = "<B><span class='PanelTitle'>关闭</span></B>";
$TplConfig["BugInfo"]["ClosedBy"]                = "由谁关闭";
$TplConfig["BugInfo"]["ClosedDate"]              = "关闭日期";

$TplConfig["BugInfo"]["LinksTitle"]              = "<B><span class='PanelTitle'>相关 Bug</span></B>";

$TplConfig["BugInfo"]["ActionTitle"]             = "<B><span class='PanelTitle'>动作</span></B>";
$TplConfig["BugInfo"]["EditBTN"]                 = "编辑 Bug (E)";
$TplConfig["BugInfo"]["ResolveBTN"]              = "解决 Bug (R)";
$TplConfig["BugInfo"]["CloseBTN"]                = "关闭 Bug (C)";
$TplConfig["BugInfo"]["ActivateBTN"]             = "激活 Bug (A)";
$TplConfig["BugInfo"]["GoToQueryBTN"]            = "返回列表 (B)";
$TplConfig["BugInfo"]["HistoryTitle"]            = "<B><span class='PanelTitle'>历史</span></B>";

/* Setting of EditBugForm.php, (most items use the same setting of BugInfo.php)*/
$TplConfig["EditBugForm"]["MailTo"]              = "发信通知";
$TplConfig["EditBugForm"]["LinkID"]              = "相关 Bug";
$TplConfig["EditBugForm"]["On"]                  = "于";
$TplConfig["EditBugForm"]["AddFileTitle"]        = "<B><span class='PanelTitle'>添加附件</span></B>";
$TplConfig["EditBugForm"]["DescriptionTitle"]    = "<B><span class='PanelTitle'>描述</span></B>";
$TplConfig["EditBugForm"]["Description"]         = "描述";
$TplConfig["EditBugForm"]["ActionTitle"]         = "<B><span class='PanelTitle'>动作</span></B>";
$TplConfig["EditBugForm"]["UpdateBTN"]           = "更新 Bug 信息 (U)";

/* Setting of UpdateBug.php */
$TplConfig["UpdateBug"]["FillNeededInfo"]        = "请填写必要的信息!";
$TplConfig["UpdateBug"]["ErrorEmptyTitle"]       = "错误: Bug 标题不能为空!";
$TplConfig["UpdateBug"]["ErrorTitleLength"]      = "错误：标题长度超过系统设定。";
$TplConfig["UpdateBug"]["ErrorExceedSize"]       = "超过最大尺寸!";
$TplConfig["UpdateBug"]["CantCreateDIR"]         = "不能创建目录!";
$TplConfig["UpdateBug"]["CantCopyFile"]          = "不能拷贝文件!";
$TplConfig["UpdateBug"]["HaveBeenUpdated"]       = "已经被更新了!";
$TplConfig["UpdateBug"]["ErrorOccuring"]         = "但有一些错误: ";
$TplConfig["UpdateBug"]["CorrectError"]          = "若有任何错误，请编辑 Bug。\\n或者请联系您的系统管理员。";

/* Setting of ResolveBug.php */
$TplConfig["ResolveBug"]["NotAssignedToMe"]      = "这个 Bug 没有指派给你！\\n单击“确定”按钮把这个 Bug 指派给你并解决之; \\n单击“取消”按钮返回。";
$TplConfig["ResolveBug"]["ResolveTitle"]         = "<B><span class='PanelTitle'>解决</span></B>";
$TplConfig["ResolveBug"]["Resolution"]           = "解决方案";
$TplConfig["ResolveBug"]["LinkID"]               = "相关 Bug";
$TplConfig["ResolveBug"]["ResolvedBuild"]        = "解决 Build";
$TplConfig["ResolveBug"]["NewBugBuild"]          = "新增Build";
$TplConfig["ResolveBug"]["DescriptionTitle"]     = "<B><span class='PanelTitle'>描述</span></B>";
$TplConfig["ResolveBug"]["Description"]          = "详细信息";
$TplConfig["ResolveBug"]["HistoryTitle"]         = "<B><span class='PanelTitle'>历史</span></B>";
$TplConfig["ResolveBug"]["AddFileTitle"]         = "<B><span class='PanelTitle'>添加附件</span></B>";
$TplConfig["ResolveBug"]["ActionTitle"]          = "<B><span class='PanelTitle'>动作</span></B>";
$TplConfig["ResolveBug"]["ResolveBTN"]           = "解决它 (R)";
$TplConfig["ResolveBug"]["MustSetResolution"]    = "请指定解决方案!";
$TplConfig["ResolveBug"]["MustSetlLinkID"]       = "请指定相关的 Bug 编号!";
$TplConfig["ResolveBug"]["HaveBeenResolved"]     = "已经被解决了。";

/* Setting of CloseBug.php */
$TplConfig["CloseBug"]["NotOpenedByMe"]          = "这个 Bug 不是由你创建的。\\n单击“确定”按钮关闭它；\\n单击“取消”按钮返回。";
$TplConfig["CloseBug"]["SureToCloseIt"]          = "您同意这个 Bug 的解决方案吗？\\n单击“确定”按钮关闭它；\\n单击“取消”按钮返回。";
$TplConfig["CloseBug"]["DescriptionTitle"]       = "<B><span class='PanelTitle'>描述</span></B>";
$TplConfig["CloseBug"]["Description"]            = "详细信息";
$TplConfig["CloseBug"]["ActionTitle"]            = "<B><span class='PanelTitle'>动作</span></B>";
$TplConfig["CloseBug"]["CloseBTN"]               = "关闭它 (C)";
$TplConfig["CloseBug"]["HistoryTitle"]           = "<B><span class='PanelTitle'>历史</span></B>";
$TplConfig["CloseBug"]["HaveBeenClosed"]         = "已经被关闭了。";

/* Setting of ActivateBug.php */
$TplConfig["ActivateBug"]["AssignTitle"]         = "<B><span class='PanelTitle'>指派</span></B>";
$TplConfig["ActivateBug"]["AssignTo"]            = "指派给";
$TplConfig["ActivateBug"]["DescriptionTitle"]    = "<B><span class='PanelTitle'>描述</span></B>";
$TplConfig["ActivateBug"]["Description"]         = "详细信息";
$TplConfig["ActivateBug"]["HistoryTitle"]        = "<B><span class='PanelTitle'>历史</span></B>";
$TplConfig["ActivateBug"]["AddFileTitle"]        = "<B><span class='PanelTitle'>添加附件</span></B>";
$TplConfig["ActivateBug"]["ActionTitle"]         = "<B><span class='PanelTitle'>动作</span></B>";
$TplConfig["ActivateBug"]["ActivateBTN"]         = "激活它 (A)";
$TplConfig["ActivateBug"]["HaveBeenActivated"]   = "已经被激活了。";

/* Setting of SaveQuery.php */
$TplConfig["SaveQuery"]["QueryTitle"]            = "查询标题";
$TplConfig["SaveQuery"]["SaveQueryBTN"]          = "保存查询 (S)";
$TplConfig["SaveQuery"]["MustSetQueryTitle"]     = "请填写标题。";
$TplConfig["SaveQuery"]["ThereisSameTitle"]      = "您已经有重名的自定义查询标题了! 请输入一个不同的名字。";
$TplConfig["SaveQuery"]["HaveBeenSaved"]         = "这个查询已经被保存了。";

/* Setting of DelQuery.php */
$TplConfig["DelQuery"]["SureToDelIt"]            = "您确认删除这个自定义查询吗？\\n单击“确定”按钮删除它；\\n单击“取消”按钮返回。";
$TplConfig["DelQuery"]["HaveBeenDeled"]          = "这个查询已经被删除。";

/* Setting of Logout.php */
$TplConfig["Logout"]["SureToLogout"]             = "您确认退出吗？\\n单击“确定”按钮退出；\\n单击“取消”按钮返回。";

/* Setting of JudgeAdmin. note: JudgeAdmin is  a function in FunctionsMain.inc.php */
$TplConfig["JudgeAdmin"]["NotAdminUser"]         = "您不具备管理员权限。";

/* Setting of NoticeBug.php */
$TplConfig["NoticeBug"]["Subject"]               = "目前为止指派给您的Bug数：";
$TplConfig["NoticeBug"]["Notes"]                 = <<<EOT
<ul>
  <li>如果指派给你的Bug状态是Resolved，请尽快验证并关闭。若你不同意其解法，请激活该Bug；</li>
  <li>如果指派给你的Bug状态是Active，请尽快加上你的注释，然后指派给能够解决该Bug的人；</li>
  <li>对拿不准怎么办的Bug，请尽快加上你的注释，然后指派给该项目/模块的负责人。</li>
</ul>
EOT;
$TplConfig["NoticeBug"]["BugID"]                 = "Bug 编号";
$TplConfig["NoticeBug"]["BugTitle"]              = "Bug 标题";
$TplConfig["NoticeBug"]["OpenedBy"]              = "由谁创建";
$TplConfig["NoticeBug"]["AssignedTo"]            = "指派给";
$TplConfig["NoticeBug"]["BugStatus"]             = "状态";
$TplConfig["NoticeBug"]["Resolution"]            = "解决方案";
$TplConfig["NoticeBug"]["LastEditedDate"]        = "最后编辑日期";
$TplConfig["NoticeBug"]["ProjectName"]           = "项目名";

/* Setting of BugStat.php */
$TplConfig["StatBug"]["BugStatTitle"]            = "Bug 统计";
$TplConfig["StatBug"]["OpenedBy"]                = "由谁创建";
$TplConfig["StatBug"]["Total"]                   = "总计";

/* Setting of JudgeAdmin. note: JudgeAdmin is  a function in FunctionsMain.inc.php */
$TplConfig["JudgeAdmin"]["NotAdminUser"]         = "您不具备管理员权限。";

/* Setting of Admin/AdminMenu.php. */
$TplConfig["AdminMenu"]["AdminUserTitle"]        = "<span class='PanelTitle'>用户、用户组管理</span>";
$TplConfig["AdminMenu"]["ListGroup"]             = "浏览/维护分组";
$TplConfig["AdminMenu"]["AddGroup"]              = "添加新的分组";
$TplConfig["AdminMenu"]["ListUser"]              = "浏览/维护用户";
$TplConfig["AdminMenu"]["AdminProjectAndModule"] = "<span class='PanelTitle'>项目和模块的管理</span>";
$TplConfig["AdminMenu"]["MangeProject"]          = "维护 ";
$TplConfig["AdminMenu"]["AddProject"]            = "新建项目";
$TplConfig["AdminMenu"]["ProjectDoc"]            = "项目文档";
$TplConfig["AdminMenu"]["ProjectPlan"]           = "项目进度";
$TplConfig["AdminMenu"]["AdminHelpTitle"]        = "<span class='PanelTitle'>帮助</span>";

/* Setting of Admin/ListBugUser.php. */
$TplConfig["ListBugUser"]["UserList"]            = "所有用户列表";
$TplConfig["ListBugUser"]["UserName"]            = "用户名";
$TplConfig["ListBugUser"]["RealName"]            = "真实姓名";
$TplConfig["ListBugUser"]["Password"]            = "密码";
$TplConfig["ListBugUser"]["Email"]               = "Email";
$TplConfig["ListBugUser"]["GroupName"]           = "分组";
$TplConfig["ListBugUser"]["AdminMode"]           = "管理模式";
$TplConfig["ListBugUser"]["EditUser"]            = "编辑";
$TplConfig["ListBugUser"]["DelUser"]             = "删除";
$TplConfig["ListBugUser"]["AddUserTitle"]        = "添加一个用户";
$TplConfig["ListBugUser"]["AddUserBTN"]          = "添加(A)";

/* Setting of Admin/AddBugUser.php. */
$TplConfig["AddBugUser"]["ErrorWrongEmail"]      = "无效的Email地址。";
$TplConfig["AddBugUser"]["ErrorEmptyValue"]      = "请填充所有必要的项目。";
$TplConfig["AddBugUser"]["ErrorSameUserName"]    = "不好意思，已经有重名的用户了。";
$TplConfig["AddBugUser"]["Success"]              = "已经添加成功了。";

/* Setting of Admin/DelBugUser.php. */
$TplConfig["DelBugUser"]["ConfirmInfo"]          = "您确定删除这个用户吗？\\n请单击“确定”按钮删除用户。\\n请单击“取消”按钮返回。";
$TplConfig["DelBugUser"]["ErrorDelSelf"]         = "你不能删除你自个儿!";
$TplConfig["DelBugUser"]["Success"]              = " 已经被删除了。";

/* Setting of Admin/ListBugGroup.php. */
$TplConfig["ListBugGroup"]["GroupList"]           = "所有分组列表";
$TplConfig["ListBugGroup"]["GroupID"]             = "编号";
$TplConfig["ListBugGroup"]["GroupName"]           = "分组名称";
$TplConfig["ListBugGroup"]["GroupUser"]           = "分组用户";
$TplConfig["ListBugGroup"]["GroupACL"]            = "分组权限";
$TplConfig["ListBugGroup"]["AdminMode"]           = "管理模式";
$TplConfig["ListBugGroup"]["EditGroup"]           = "编辑";
$TplConfig["ListBugGroup"]["DelGroup"]            = "删除";
$TplConfig["ListBugGroup"]["AddGroupTitle"]       = "维护分组";
$TplConfig["ListBugGroup"]["GroupUserAddBTN"]     = ">>";
$TplConfig["ListBugGroup"]["GroupUserDelBTN"]     = "<<";
$TplConfig["ListBugGroup"]["GroupACLAddBTN"]      = ">>";
$TplConfig["ListBugGroup"]["GroupACLDelBTN"]      = "<<";
$TplConfig["ListBugGroup"]["ManageGroupBTN"]      = "保存(S)";

/* Setting of Admin/AddBugGroup.php. */
$TplConfig["ManageBugGroup"]["ErrorEmptyValue"]   = "请填写所有必要的项目。";
$TplConfig["ManageBugGroup"]["ErrorSameGroupName"]= "不好意思，已经有重名的分组了。";
$TplConfig["ManageBugGroup"]["ErrorGroupID"]      = "请指定分组编号。";
$TplConfig["ManageBugGroup"]["Success"]           = "保存成功。";

/* Setting of Admin/DelBugGroup.php. */
$TplConfig["DelBugGroup"]["ConfirmInfo"]          = "您确定删除这个用户组吗？\\n请单击“确定”按钮删除用户。\\n请单击“取消”按钮返回。";
$TplConfig["DelBugGroup"]["ErrorGroupID"]         = "请指定分组编号！";
$TplConfig["DelBugGroup"]["Success"]              = "已经被删除了。";

/* Setting of EditSelfInfo.php. */
$TplConfig["EditSelfInfo"]["EditSelfInfoTitle"]   = "编辑个人信息";
$TplConfig["EditSelfInfo"]["RealName"]            = "真实名字";
$TplConfig["EditSelfInfo"]["Password"]            = "密码";
$TplConfig["EditSelfInfo"]["PasswordNote"]        = "(若留空则不变)";
$TplConfig["EditSelfInfo"]["Email"]               = "Email";
$TplConfig["EditSelfInfo"]["EditBTN"]             = "编辑(E)";
$TplConfig["EditSelfInfo"]["ErrorWrongEmail"]     = "无效的Email地址";
$TplConfig["EditSelfInfo"]["ErrorEmptyValue"]     = "请填写所有必要的信息。";
$TplConfig["EditSelfInfo"]["Success"]             = "您个人信息已经被更新。";

/* Setting of ManageProject.php. */
$TplConfig["ManageProject"]["ManageProjectTitle"] = "管理项目";
$TplConfig["ManageProject"]["ManageMode"]         = "管理模式";
$TplConfig["ManageProject"]["Edit"]               = "编辑当前项目";
$TplConfig["ManageProject"]["Add"]                = "添加一个新项目";
$TplConfig["ManageProject"]["ProjectName"]        = "项目名";
$TplConfig["ManageProject"]["ProjectDoc"]         = "项目文档";
$TplConfig["ManageProject"]["ProjectPlan"]        = "项目计划";
$TplConfig["ManageProject"]["ManageProjectBTN"]   = "提交(S)";
$TplConfig["ManageProject"]["AddModuleTitle"]     = "添加一个模块";
$TplConfig["ManageProject"]["ParentModule"]       = "父模块";
$TplConfig["ManageProject"]["ModuleName"]         = "模块名";
$TplConfig["ManageProject"]["ManageModuleBTN"]    = "添加(A)";
$TplConfig["ManageProject"]["ErrorEmptyName"]     = "请填写项目名。";
$TplConfig["ManageProject"]["SuccessUpdated"]     = " 已经被更新。";
$TplConfig["ManageProject"]["SuccessAdded"]       = " 已经被加入。";

/* Setting of ManageModule.php. */
$TplConfig["ManageModule"]["ManageModuleTitle"]  = "管理模块";
$TplConfig["ManageModule"]["ManageMode"]         = "管理模式";
$TplConfig["ManageModule"]["Edit"]               = "编辑当前模块";
$TplConfig["ManageModule"]["Add"]                = "添加一个新的子模块";
$TplConfig["ManageModule"]["ProjectName"]        = "项目名";
$TplConfig["ManageModule"]["ParentModule"]       = "父模块";
$TplConfig["ManageModule"]["ModuleName"]         = "模块名";
$TplConfig["ManageModule"]["ManageModuleBTN"]    = "提交(S)";
$TplConfig["ManageModule"]["ErrorEmptyName"]     = "请填写模块名。";
$TplConfig["ManageModule"]["ErrorParentID"]      = "父模块不能和当前模块相同。";
$TplConfig["ManageModule"]["SuccessUpdated"]     = " 已经被更新。";
$TplConfig["ManageModule"]["SuccessAdded"]       = " 已经被加入。";

/* Setting of Install.php. */
$TplConfig["Install"]["InstallTitle"]            = "BugFree安装程序";
$TplConfig["Install"]["BugDBTitle"]              = <<<EOT
1、设置存储Bug数据的数据库参数<br />
<div align="left">
  BugFree自身有一个简单的用户验证表，您可以使用它来管理用户，<span class="RedText">这时您可以跳过第 2 项的设置</span>。 如果您的应用环境中已经有了第三方的PHP应用程序，比如论坛等等，
  您也可以选择使用它们的用户验证表进行验证，<span class="RedText">这时您需要对第 2 项进行配置。</span></div>
EOT;

$TplConfig["Install"]["BugDBHost"]               = "数据库服务器地址";
$TplConfig["Install"]["BugDBUser"]               = "数据库用户名";
$TplConfig["Install"]["BugDBPassword"]           = "数据库密码";
$TplConfig["Install"]["BugDBDatabase"]           = "Bug数据表所在的数据库名";
$TplConfig["Install"]["CreateBugDB"]             = "创建数据库";

$TplConfig["Install"]["UserDBTitle"]             = <<<EOT
2、设置用户验证表所在的数据库<br />
<span class="RedText">如果您需要采用第三方程序的验证系统，请指定相应的数据库连接参数</span>
EOT;

$TplConfig["Install"]["UserDBHost"]              = "数据库服务器地址";
$TplConfig["Install"]["UserDBUser"]              = "数据库用户名";
$TplConfig["Install"]["UserDBPassword"]          = "数据库密码";
$TplConfig["Install"]["UserDBDatabase"]          = "用户验证表所在的数据库名";

$TplConfig["Install"]["UserTableTitle"]          = <<<EOT
3、设置用户验证表对应的字段<br />
<div align="left">
如果您是使用BugFree自身的验证系统，不需要对下面几项进行修改。如果您使用第三方的程序进行验证，则需要根据实际情况进行修改，
下面括弧中以phpbb论坛为例。
</div>
EOT;

$TplConfig["Install"]["TableName"]               = "用户验证表名(phpbb:phpbb_users)";
$TplConfig["Install"]["UserName"]                = "用户名对应的字段名(phpbb:username)";
$TplConfig["Install"]["RealName"]                = "真实姓名对应的字段名(phpbb:username)";
$TplConfig["Install"]["UserPassword"]            = "密码对应的字段名(phpbb:user_password)";
$TplConfig["Install"]["Email"]                   = "Email对应的字段名(phpbb:user_email)";
$TplConfig["Install"]["EncryptType"]             = "密码加密方式(phpbb:md5)";

$TplConfig["Install"]["MailTitle"]               = <<<EOT
4、BugFree邮件功能参数配置<br />
如果你选定的发信方式为SMTP方式，需要设置smtp服务器的地址，如果smtp服务器需要验证，还需要设定用户名和密码
EOT;
$TplConfig["Install"]["FromAddress"]             = "BugFree以哪个邮箱地址进行发信";
$TplConfig["Install"]["FromName"]                = "BugFree以什么称呼进行发信";
$TplConfig["Install"]["SendMethod"]              = "BugFree自动发信的方式";
$TplConfig["Install"]["SmtpHost"]                = "SMTP服务器地址";
$TplConfig["Install"]["SmtpAuth"]                = "SMTP服务器是否需要验证";
$TplConfig["Install"]["SmtpUserName"]            = "SMTP服务器用户名";
$TplConfig["Install"]["SmtpPassword"]            = "SMTP服务器密码";

$TplConfig["Install"]["OtherTitle"]              = "5、其他配置";
$TplConfig["Install"]["UploadDirectory"]         = "上传附件存放目录，此目录必须可读可写";
$TplConfig["Install"]["MaxFileSize"]             = "上传附件最大允许尺寸，单位字节";

$TplConfig["Install"]["AdminTitle"]              = "6、成为管理员";
$TplConfig["Install"]["AdminUserName"]           = "管理员用户名";
$TplConfig["Install"]["AdminRealName"]           = "管理员称呼";
$TplConfig["Install"]["AdminUserEmail"]          = "管理员邮箱";
$TplConfig["Install"]["AdminUserPassword"]       = "管理员密码";

$TplConfig["Install"]["SubmitButton"]            = "生成配置文件(需手工保存为$BugConfig[ScriptDir]/Include/ConfigBug.inc.php)";

$TplConfig["Install"]["ErrorBugDB"]              = "BugFree数据库: ";
$TplConfig["Install"]["ErrorCreateBugDB"]        = "BugFree数据库创建失败: ";
$TplConfig["Install"]["ErrorUserDB"]             = "用户验证数据库: ";
$TplConfig["Install"]["ErrorUserTable"]          = "用户验证表: ";
$TplConfig["Install"]["ErrorWritable"]           = " 必须可读可写可执行(o=rwx)";
$TplConfig["Install"]["ErrorSmtpAuth"]           = "Smtp服务器需要验证，必须指定用户名和密码";
$TplConfig["Install"]["ErrorAdminUserInfo"]      = "请指定管理员的用户名、邮箱、密码";
$TplConfig["Install"]["ErrorCreateAdminUser"]    = "管理员创建失败";

/* Setting of Upgrade.php. */
$TplConfig["Upgrade"]["UpgradeTitle"]            = "此程序将帮助您升级到BugFree1.0版本";
$TplConfig["Upgrade"]["UpgradeNote"]             = <<<EOT
<strong>1. 升级之前需要您手工执行下面三步：</strong>
<ol>
  <li>备份您现在的程序和数据。</li>
  <li>下载最新的BugFree程序，解压缩。</li>
  <li>修改Include/ConfigBug.inc.php中的相应参数。<br />
      您也可以通过安装程序来生成配置文件，<strong>不过需要注意的是，不要再创建数据库了。</strong><br />
      <a href="install.php">安装程序>>></a>
  </li>
</ol>
<strong>2. 执行完上面三步之后，点击此页面的“升级数据库” 按钮，程序将自动更新表结构。</strong>
<ol>
  <li>新增BugGroup表。</li>
  <li>修改BugUser表，增大UserID的存储空间。</li>
</ol>
<strong>3. 执行完更新程序之后，以管理员身份登入系统，建立用户组，为用户分配相应的权限。</strong>
EOT;
$TplConfig["Upgrade"]["Upgraded"]                = "数据库已经更新，请以管理员身份进入，分派权限！<a href='Login.php'>登录>>></a>";
$TplConfig["Upgrade"]["UpgradeBTN"]              = "升级数据库";
$TplConfig["Upgrade"]["Success"]                 = "数据库升级成功，请以管理员身份进入，分派权限！";
?>