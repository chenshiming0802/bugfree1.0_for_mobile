<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<script language="JavaScript1.1" src="JS/TreeMenu.js" type="text/javascript"></script>
<title>{$BugConfig.Title}</title>
</head>
<body topmargin=5 marginheight=5 leftmargin=5 marginwidth=5>
  <form name="ProjectForm" id="ProjectForm" method="post">
    <div align="center">
      <fieldset>
        <legend>{$TplConfig.ListModule.QueryOrNew}</legend>
        <div align="left">
          {$TplConfig.Common.ListSign} <a href="QueryBug.php"   target="RightBottomFrame" onclick="location='ListModule.php?ActionMode=Query';">{$TplConfig.ListModule.QueryMode}</a>
          {$TplConfig.Common.ListSign} <a href="AddBugForm.php" target="RightBottomFrame" onclick="ProjectForm.action='ListModule.php?ActionMode=New';ProjectForm.submit();">{$TplConfig.ListModule.NewMode}</a>
        </div>
      </fieldset>
      <fieldset>
        <legend>{$TplConfig.ListModule.SelectProject}</legend>
        <table width="100%" align="center" border=0 cellpadding="2" cellspacing="0" class="SmallFont">
          <tr>
            <td>{$ProjectList}{$SelectProject}</td>
          </tr>
          <tr>
            <td>{$ModuleTree}</td>
          </tr>
          <tr>
            <td>
              {if $ProjectInfo.ProjectDoc}
                {$TplConfig.Common.ListSign} <a href="{$ProjectInfo.ProjectDoc}"  target="_blank">{$TplConfig.ListModule.ProjectDoc}</a><br />
              {else}
                {$TplConfig.Common.ListSign} {$TplConfig.ListModule.ProjectDoc}<br />
              {/if}
              {if $ProjectInfo.ProjectPlan}
                {$TplConfig.Common.ListSign} <a href="{$ProjectInfo.ProjectPlan}" target="_blank">{$TplConfig.ListModule.ProjectPlan}</a>
              {else}
                {$TplConfig.Common.ListSign} {$TplConfig.ListModule.ProjectPlan}
              {/if}
            </td>
          </tr>
        </table>  
      </fieldset>
    </div>
  </form>
</body>
</html>