<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<meta http-equiv="Refresh"          content="600,UserControl.php">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body topmargin="0" marginheight="0" leftmargin="5" marginwidth="5">
  <form name="ControlForm" action="QueryBug.php" method="post" target="RightBottomFrame">
    <hr>
    <div align="center">
      <fieldset>
        <legend>{$TplConfig.UserControl.Latest5AssignedToMe}</legend>
        <div align="left">
          {foreach from=$AssignToMe key=BugID item=BugInfo}
            {$TplConfig.Common.ListSign} <a href="BugInfo.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}" title="{$BugInfo.BugTitle}" target="RightBottomFrame">{$BugInfo.ShortBugTitle}</a><br />
          {/foreach}
        </div>
      </fieldset>
      <fieldset>
        <legend>{$TplConfig.UserControl.Latest5OpenedByMe}</legend>
        <div align="left">
          {foreach from=$OpenedByMe key=BugID item=BugInfo}
            {$TplConfig.Common.ListSign} <a href="BugInfo.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}" title="{$BugInfo.BugTitle}" target="RightBottomFrame">{$BugInfo.ShortBugTitle}</a><br />
          {/foreach}
        </div>
      </fieldset>
      <fieldset>
        <legend>{$TplConfig.UserControl.UserQuery}</legend>
        {if $UserQueryList}
          {$UserQueryList}
          {$SelectUserQuery}
          <br>
          <input type="button" name="ExecuteQuery" value="{$TplConfig.UserControl.ExecuteUserQuery}" accesskey="X" style="width:58px" class="MyInput" onclick="ControlForm.action='QueryBug.php';ControlForm.submit();">
          <input type="button" name="ShareQuery"   value="{$TplConfig.UserControl.ShareUserQuery}"   accesskey="M" style="width:58px" class="MyInput" onclick="window.open('mailto:?Subject={$BugConfig.BaseURL}/QueryBug.php?UserQueryID=' + document.getElementById('UserQueryID').value)">
          <input type="button" name="DeleteQuery"  value="{$TplConfig.UserControl.DeleteUserQuery}"  accesskey="D" style="width:58px" class="MyInput" onclick="ControlForm.action='DelQuery.php';ControlForm.submit();">
        {/if}
      </fieldset>
    </div>
  </form>
</body>
</html>