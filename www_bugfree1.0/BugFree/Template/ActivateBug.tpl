<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body topmargin="0" marginheight="0" leftmargin="0" marginwidth="0">
<form name="ActivateForm" method="post" enctype="multipart/form-data">
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
        <fieldset>
        <legend>{$TplConfig.ActivateBug.AssignTitle}</legend>
        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
          <tr class="BgRow">
            <td width="15%" class="StrongText">{$TplConfig.ActivateBug.AssignTo}</td>
            <td>{$AssignedToList}{$SelectAssignedTo}</td>
          </tr>
        </table>
        </fieldset>
      </td>
    </tr>
  </table>
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
        <fieldset>
        <legend>{$TplConfig.ActivateBug.DescriptionTitle}</legend>
        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
          <tr class="BgRow">
            <td width="15%" class="StrongText">{$TplConfig.ActivateBug.Description}</td>
            <td><textarea name="Notes" rows="6" class="Notes"></textarea></td>
          </tr>
        </table>
        </fieldset>
      </td>
    </tr>
  </table>
  <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
        <fieldset>
        <legend>{$TplConfig.ActivateBug.AddFileTitle}</legend>
        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
        {include file="AddFiles.tpl"}
        </table>
        </fieldset>
      </td>
    </tr>
  </table>
    <table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
    <tr class="BgRow">
      <td align="center">
       <fieldset>
       <legend>{$TplConfig.ActivateBug.ActionTitle}</legend>
         <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="BgTable">
           <tr class="BgRow">
            <td align="center">
              <input type="hidden" name="ProjectID"   value="{$ProjectID}">
              <input type="hidden" name="ModuleID"    value="{$ModuleID}">
              <input type="hidden" name="BugID"       value="{$BugID}">
              <input type="submit" name="ActivateBug" value="{$TplConfig.ActivateBug.ActivateBTN}" class="MyButton" accesskey="A">
            </td>
           </tr>
         </table>
       </fieldset>
     </td>
   </tr>
  </table>
  <!-- include Bug History tpl -->
  {include file="BugHistory.tpl"}
</form>
</body>
</html>