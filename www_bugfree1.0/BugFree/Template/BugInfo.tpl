<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body topmargin="0" marginheight="0" leftmargin="0" marginwidth="0">
<form name="InfoForm" method="post">
  <!-- 1 Begin of BugID,BugTitle and Project,ModulePath-->
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
       <fieldset>
       <legend>{$TplConfig.BugInfo.ProjectAndModuleTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td width="20%" class="StrongText">{$TplConfig.BugInfo.BugID}</td>
            <td>{$BugInfo.BugID}</td>
           </tr>
           <tr class="BgRow" class="StrongText">
            <td class="StrongText">{$TplConfig.BugInfo.BugTitle}</td>
            <td>{$BugInfo.BugTitle}</td>
           </tr>
           <tr class="BgRow" class="StrongText">
            <td class="StrongText">{$TplConfig.BugInfo.ProjectAndModulePath}</td>
            <td>{$ProjectModule}</td>
           </tr>
         </table>
       </fieldset>
     </td>
   </tr>
  </table>
  <!-- 1 End of BugID,BugTitle and Project,ModulePath-->
  <!-- 2 Begin of bug basic info-->
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow" valign="top">
      <td width="50%" align="center">
       <fieldset>
       <legend>{$TplConfig.BugInfo.BugStatusTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.BugType}</td>
            <td>{$BugInfo.BugTypeLocalized}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.BugOS}</td>
            <td>{$BugInfo.BugOSLocalized}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.BugSeverity}</td>
            <td>{$BugInfo.BugSeverityLocalized}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.BugStatus}</td>
            <td>{$BugInfo.BugStatus}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.AssignedTo}</td>
            <td>{$BugInfo.AssignedToRealName}</td>
           </tr>
           <tr class="BgRow">
            <td width="40%" class="StrongText">{$TplConfig.BugInfo.AssignedDate}</td>
            <td>{$BugInfo.AssignedDate}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.LastEditedBy}</td>
            <td>{$BugInfo.LastEditedByRealName}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.LastEditedDate}</td>
            <td>{$BugInfo.LastEditedDate}</td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
       <legend>{$TplConfig.BugInfo.MailToTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr height="14" class="BgRow">
            <td align="center">{$BugInfo.MailToRealName}</td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
       <legend>{$TplConfig.BugInfo.BugFilesTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td height="33" align="center">
              {foreach from=$BugFileList item=FileInfo}
              <a href="{$BugConfig.File.UploadDirectory}/{$FileInfo.FileName}" title="{$FileInfo.FileType},{$FileInfo.FileSize},{$FileInfo.AddUser},{$FileInfo.AddDate})" target="_blank">[{$FileInfo.FileTitle}]</a>
              {/foreach}
            </td>
           </tr>
         </table>
       </fieldset>
     </td>
     <!-- 2 End of bug basic info-->
     <!-- 3 Begin of OpenedBy, Resolved, Closed info-->
     <td align="center">
       <fieldset>
       <legend>{$TplConfig.BugInfo.OpenedTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td width="40%" class="StrongText">{$TplConfig.BugInfo.OpenedBy}</td>
            <td>{$BugInfo.OpenedByRealName}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.OpenedDate}</td>
            <td>{$BugInfo.OpenedDate}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.OpenedBuild}</td>
            <td>{$BugInfo.OpenedBuild}</td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
       <legend>{$TplConfig.BugInfo.ResolvedTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td width="40%" class="StrongText">{$TplConfig.BugInfo.ResolvedBy}</td>
            <td>{$BugInfo.ResolvedByRealName}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.ResolvedDate}</td>
            <td>{$BugInfo.ResolvedDate}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.ResolvedBuild}</td>
            <td>{$BugInfo.ResolvedBuild}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.Resolution}</td>
            <td>{$BugInfo.Resolution}</td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
       <legend>{$TplConfig.BugInfo.ClosedTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td width="40%" class="StrongText">{$TplConfig.BugInfo.ClosedBy}</td>
            <td>{$BugInfo.ClosedByRealName}</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.ClosedDate}</td>
            <td>{$BugInfo.ClosedDate}</td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
       <legend>{$TplConfig.BugInfo.LinksTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td align="center" height="15">
            {foreach from=$LinkBugList item=LinkBugInfo}
              <a href="BugInfo.php?ProjectID={$LinkBugInfo.ProjectID}&ModuleID={$LinkBugInfo.ModuleID}&BugID={$LinkBugInfo.BugID}" title="{$LinkBugInfo.BugTitle}">[{$LinkBugInfo.BugID}]</a>
            {/foreach}
            </td>
           </tr>
         </table>
       </fieldset>
     </td>
   </tr>
  </table>
  <!-- 3 End of OpenedBy, Resolved, Closed info-->
  <!-- 4 Begin of Action -->
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
       <fieldset>
       <legend>{$TplConfig.BugInfo.ActionTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td align="center">
              <input type="button" name="EditBTN"      value="{$TplConfig.BugInfo.EditBTN}"  class="MyButton" accesskey="E"
                 onclick="location='EditBugForm.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}';">
              <input type="button" name="ResolveBTN"   value="{$TplConfig.BugInfo.ResolveBTN}"  {if $BugInfo.Resolution} disabled="disabled"{/if} class="MyButton" accesskey="R"
                 onclick="location='ResolveBug.php?AssignedTo={$BugInfo.AssignedTo}&ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}';">
              <input type="button" name="CloseBTN"     value="{$TplConfig.BugInfo.CloseBTN}"    {if not $BugInfo.Resolution or $BugInfo.BugStatus == "Closed"}  disabled="disabled"{/if} class="MyButton" accesskey="C"
                 onclick="location='CloseBug.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}&OpenedBy={$BugInfo.OpenedBy}';">
              <input type="button" name="ActivateBTN"  value="{$TplConfig.BugInfo.ActivateBTN}" {if $BugInfo.BugStatus == "Active"} disabled="disabled"{/if} class="MyButton" accesskey="A"
                 onclick="location='ActivateBug.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}&ResolvedBy={$BugInfo.ResolvedBy}';">
              <input type="button" name="GoToQueryBTN" value="{$TplConfig.BugInfo.GoToQueryBTN}" class="MyButton" accesskey="B"
                 onclick="location='QueryBug.php?PageID={$QueryPageID}';">
            </td>
           </tr>
         </table>
       </fieldset>
     </td>
   </tr>
  </table>
  <!-- 4 End of Action -->
  <!-- 5 Begin of History -->
  {include file="BugHistory.tpl"}
  <!-- 5 End of History and all-->
</form>
</body>
</html>