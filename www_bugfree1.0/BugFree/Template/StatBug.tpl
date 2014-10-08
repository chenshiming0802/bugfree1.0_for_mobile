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
    <tr align="right" class="BgRow">
      <td colspan="20" align="center">{$TplConfig.StatBug.BugStatTitle} [{$OneWeekBefore} -- {$Yesterday}]</td>
    </tr>
    <tr align="right" class="BgRow">
      <td>{$TplConfig.StatBug.OpenedBy}</td>
      <td>{$TplConfig.StatBug.Total}</td>
      {foreach from=$ResolutionList item=Resolution}
      <td>{$Resolution}</td>
      {/foreach}
    </tr>
   {foreach from=$BugOfThisWeek key=BugUserName item=UserBugList}
    <tr align="right" class="BgRow">
      <td>{$UserBugList.RealName}</td>
      <td>{$UserBugList.BugCount}
      {foreach from=$ResolutionList item=Resolution}
      <td>{$UserBugList.$Resolution}</td>
      {/foreach}
    </tr>
   {/foreach}
  </table>
  <br />
  <table width="98%" align="center" border=0 cellpadding="2" cellspacing="1" class="BgTable">
    <tr align="right" class="BgRow">
      <td colspan="20" align="center">{$TplConfig.StatBug.BugStatTitle} [{$FirstDate} -- {$Yesterday}]</td>
    </tr>
    <tr align="right" class="BgRow">
      <td>{$TplConfig.StatBug.OpenedBy}</td>
      <td>{$TplConfig.StatBug.Total}</td>
      {foreach from=$ResolutionList item=Resolution}
      <td>{$Resolution}</td>
      {/foreach}
    </tr>
   {foreach from=$BugOfAllTime key=BugUserName item=UserBugList}
    <tr align="right" class="BgRow">
      <td>{$UserBugList.RealName}</td>
      <td>{$UserBugList.BugCount}
      {foreach from=$ResolutionList item=Resolution}
      <td>{$UserBugList.$Resolution}</td>
      {/foreach}
    </tr>
   {/foreach}
  </table>
</body>
</html>