<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<meta name="author"                 content="Zhenfei Liu <liuzf@pku.org.cn>; Chunsheng Wang <wwccss@263.net>">
<link href="../Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<script language="JavaScript1.1" src="../JS/TreeMenu.js" type="text/javascript"></script>
<title>{$BugConfig.Title}</title>
</head>
<body topmargin=5 marginheight=5 leftmargin=5 marginwidth=5>
  <form name="ProjectForm" id="ProjectForm" method="post">
    <div align="center">
      <fieldset>
        <legend>{$TplConfig.AdminMenu.AdminUserTitle}</legend>
        <div align="left">
          {$TplConfig.Common.ListSign} <a href="ListBugGroup.php" target="AdminMainFrame">{$TplConfig.AdminMenu.ListGroup}</a><br />
          {$TplConfig.Common.ListSign} <a href="ListBugGroup.php" target="AdminMainFrame">{$TplConfig.AdminMenu.AddGroup}</a><br />
          {$TplConfig.Common.ListSign} <a href="ListBugUser.php"  target="AdminMainFrame">{$TplConfig.AdminMenu.ListUser}</a><br />
        </div>
      </fieldset>
      <fieldset>
        <legend>{$TplConfig.AdminMenu.AdminProjectAndModule}</legend>
        <table width="100%" align="center" border=0 cellpadding="2" cellspacing="0" class="SmallFont">
          <tr>
            <td>
              {$TplConfig.Common.ListSign} <a href="ManageProject.php?ManageMode=Add" target="AdminMainFrame">{$TplConfig.AdminMenu.AddProject}</a><br />
              {$TplConfig.Common.ListSign} <a href="ManageProject.php?ProjectID={$ProjectInfo.ProjectID}" target="AdminMainFrame">{$TplConfig.AdminMenu.MangeProject}{$ProjectInfo.ProjectName}</a><br />
              {$ProjectList}{$SelectProject}
            </td>
          </tr>
          <tr>
            <td>{$ModuleTree}</td>
          </tr>
          <tr>
            <td>
              {$TplConfig.Common.ListSign} <a href="{$ProjectInfo.ProjectDoc}"  target="_blank">{$TplConfig.AdminMenu.ProjectDoc}</a><br />
              {$TplConfig.Common.ListSign} <a href="{$ProjectInfo.ProjectPlan}" target="_blank">{$TplConfig.AdminMenu.ProjectPlan}</a>
            </td>
          </tr>
        </table>  
      </fieldset>
    </div>
  </form>
</body>
</html>