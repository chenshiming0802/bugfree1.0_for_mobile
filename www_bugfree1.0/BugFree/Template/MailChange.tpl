<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<style type="text/css">
{$CssStyle}
</style>
<title>{$BugConfig.Title}</title>
</head>
<body leftmargin="0" topmargin="10">
  <table width="98%" align="center" border=0 cellpadding="2" cellspacing="1" class="BgTable">
    <tr class="BgRow">
      <td>
      {foreach from=$BugList item=BugInfo}
      <a target="_blank" href="{$BugConfig.BaseURL}/BugInfo.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}">[{$BugInfo.BugID}=>{$BugInfo.AssignedToRealName}]</a>
      {/foreach}
      </td>
    </tr>
    <tr class="BgRow">
      <td>
      <span class="StrongText">{$ActionInfo}</span><br>
      <div class="History">{$Notes}</div>
      </td>
    </tr>
  </table>
</body>
</html>
