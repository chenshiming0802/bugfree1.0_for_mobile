<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body topmargin="0" marginheight="0" leftmargin="0" marginwidth="0">
<form name="EditForm" method="post" enctype="multipart/form-data" action="UpdateBug.php">
  <!-- 1 BugID,BugTitle and Project,ModulePath-->
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
       <fieldset>
       <legend>{$TplConfig.BugInfo.ProjectAndModuleTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td width="15%" class="StrongText">{$TplConfig.BugInfo.BugID}</td>
            <td><input type="text" name="BugID" value="{$BugInfo.BugID}" readonly="readonly" class="MyInput"></td>
           </tr>
           <tr class="BgRow" class="StrongText">
            <td class="StrongText">{$TplConfig.BugInfo.ProjectAndModulePath}</td>
            <td>{$ProjectList}{$SelectProject}{$ModulePathList}{$SelectModulePath}</td>
           </tr>
           <tr class="BgRow" class="StrongText">
            <td class="StrongText">{$TplConfig.BugInfo.BugTitle}</td>
            <td><input type="text" name="BugTitle" value="{$BugInfo.BugTitle}" class="MyInput" size="60"></td>
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
             <td width="30%" class="StrongText">{$TplConfig.BugInfo.BugType}</td>
             <td>{$BugTypeList}{$SelectBugType}</td>
           </tr>
           <tr class="BgRow">
             <td class="StrongText">{$TplConfig.BugInfo.BugOS}</td>
             <td>{$BugOSList}{$SelectBugOS}</td>
           </tr>
           <tr class="BgRow">
             <td class="StrongText">{$TplConfig.BugInfo.BugSeverity}</td>
             <td>{$BugSeverityList}{$SelectBugSeverity}</td>
           </tr>
           <tr class="BgRow">
             <td class="StrongText">{$TplConfig.BugInfo.BugStatus}</td>
             <td>{$BugStatusList}{$SelectBugStatus}</td>
           </tr>
           <tr class="BgRow">
             <td class="StrongText">{$TplConfig.BugInfo.AssignedTo}</td>
             <td>
               {$AssignedToList}{$SelectAssignedTo}
               {$TplConfig.EditBugForm.On}
               <input type="text" name="AssignedDate" value="{$BugInfo.AssignedDate}" size="16" class="MyInput">
             </td>
           </tr>
           <tr class="BgRow">
             <td class="StrongText">{$TplConfig.BugInfo.LastEditedBy}</td>
             <td>
               {$LastEditedByList}{$SelectLastEditedBy}
               {$TplConfig.EditBugForm.On}
               <input type="text" name="LastEditedDate" value="{$BugInfo.LastEditedDate}" size="16" class="MyInput">
             </td>
           </tr>
           <tr class="BgRow">
             <td class="StrongText">{$TplConfig.EditBugForm.MailTo}</td>
             <td><input type="text" name="MailTo" value="{$BugInfo.MailTo}" class="MyInput"></td>
           </tr>
           <tr class="BgRow">
             <td class="StrongText">{$TplConfig.EditBugForm.LinkID}</td>
             <td><input type="text" name="LinkID" value="{$BugInfo.LinkID}" class="MyInput"></td>
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
            <td width="30%" class="StrongText">{$TplConfig.BugInfo.OpenedBy}</td>
            <td>
              {$OpenedByList}{$SelectOpenedBy}
              {$TplConfig.EditBugForm.On}
              <input type="text" name="OpenedDate" value="{$BugInfo.OpenedDate}" size="16" class="MyInput">
            </td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.OpenedBuild}</td>
            <td><input type="text" name="OpenedBuild" value="{$BugInfo.OpenedBuild}" class="MyInput"</td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
       <legend>{$TplConfig.BugInfo.ResolvedTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td width="30%" class="StrongText">{$TplConfig.BugInfo.ResolvedBy}</td>
            <td>
              {$ResolvedByList}{$SelectResolvedBy}
              {$TplConfig.EditBugForm.On}
              <input type="text" name="ResolvedDate" value="{$BugInfo.ResolvedDate}" size="16" class="MyInput">
            </td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.ResolvedBuild}</td>
            <td><input type="text" name="ResolvedBuild" value="{$BugInfo.ResolvedBuild}" class="MyInput"</td>
           </tr>
           <tr class="BgRow">
            <td class="StrongText">{$TplConfig.BugInfo.Resolution}</td>
            <td>{$ResolutionList}{$SelectResolution}</td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
       <legend>{$TplConfig.BugInfo.ClosedTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td width="30%" class="StrongText">{$TplConfig.BugInfo.ClosedBy}</td>
            <td>
              {$ClosedByList}{$SelectClosedBy}
              {$TplConfig.EditBugForm.On}
              <input type="text" name="ClosedDate" value="{$BugInfo.ClosedDate}" size="16" class="MyInput">
            </td>
           </tr>
         </table>
       </fieldset>
     </td>
   </tr>
  </table>
  <!-- 3 End of OpenedBy, Resolved, Closed info-->
  <!-- 4 Begin of Notes-->
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
        <fieldset>
        <legend>{$TplConfig.EditBugForm.DescriptionTitle}</legend>
        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
          <tr class="BgRow">
            <td width="15%" class="StrongText">{$TplConfig.EditBugForm.Description}</td>
            <td><textarea name="Notes" rows="4" class="Notes"></textarea></td>
          </tr>
        </table>
        </fieldset>
      </td>
    </tr>
  </table>
  <!-- 4 End of notes-->
  <!-- 5 Begin of AddFile-->
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
        <fieldset>
        <legend>{$TplConfig.EditBugForm.AddFileTitle}</legend>
        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
        {include file="AddFiles.tpl"}
        </table>
        </fieldset>
      </td>
    </tr>
  </table>
  <!-- 5 End of AddFile-->
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
        <fieldset>
        <legend>{$TplConfig.EditBugForm.ActionTitle}</legend>
        <input type="submit" name="UpdateBTN" value="{$TplConfig.EditBugForm.UpdateBTN}" accesskey="U" class="MyButton">
        </fieldset>
      </td>
    </tr>
  </table>
  <!-- 6 Begin of History -->
  {include file="BugHistory.tpl"}
  <!-- 6 End of History and all-->
</form>
</body>
</html>