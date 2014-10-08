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
<body leftmargin="0" topmargin="0">
  <table width="100%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
    <tr class="BgRow">
      <td colspan="8">{$TplConfig.NoticeBug.Notes}</td>
    </tr>
    <tr class="BgRow" align="center"> 
      <td>{$TplConfig.NoticeBug.BugID}</td>
      <td>{$TplConfig.NoticeBug.BugTitle}</td>
      <td>{$TplConfig.NoticeBug.OpenedBy}</td>
      <td>{$TplConfig.NoticeBug.AssignedTo}</td>
      <td>{$TplConfig.NoticeBug.BugStatus}</td>
      <td>{$TplConfig.NoticeBug.Resolution}</td>
      <td>{$TplConfig.NoticeBug.LastEditedDate}</td>
      <td>{$TplConfig.NoticeBug.ProjectName}</tr>
    </tr>
    {foreach from=$UserBugList item=BugInfo}
    <tr class="BgRow" align="center"> 
      <td>
        <a target="_blank" href="{$BugConfig.BaseURL}/BugInfo.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}">{$BugInfo.BugID}</a>
      </td>
      <td align="left" title="{$BugInfo.BugTitle}">{$BugInfo.BugTitle}</td>
      <td>{$BugInfo.OpenedByRealName}</td>
      <td>{$BugInfo.AssignedToRealName}</td>
      <td>{$BugInfo.BugStatus}</td>
      <td>{$BugInfo.Resolution}</td>
      <td>{$BugInfo.LastEditedDate}</td>
      <td>{$BugInfo.ProjectName}</tr>
    </tr>
    {/foreach}
  </table>
</body>
</html>
