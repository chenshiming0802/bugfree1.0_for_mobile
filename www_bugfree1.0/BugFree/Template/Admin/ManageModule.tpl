<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<meta name="author"                 content="Zhenfei Liu <liuzf@pku.org.cn>; Chunsheng Wang <wwccss@263.net>">
<link href="../Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
{$SelectProject}
{$SelectParentModulePath}
{$SelectCurrentModulePath}
</head>
<body topmargin="10" marginheight="0" leftmargin="0" marginwidth="0" onload="selectProject();selectParent();">
  <form name="ManageModuleForm" method="post" action="ManageModule.php">
    <table width="80%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
      <tr class="BgRow">
        <td colspan="2" align="center" class="TableHeader">{$TplConfig.ManageModule.ManageModuleTitle}--{$ModuleName}</td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.ManageModule.ManageMode}</td>
        <td>
          <input type="radio" name="ManageMode" value="Edit" checked="checked" onclick="document.ManageModuleForm.reset();selectProject();selectParent();">{$TplConfig.ManageModule.Edit}
          <input type="radio" name="ManageMode" value="Add"  onclick="selectCurrent();document.ManageModuleForm.ModuleName.value='';">{$TplConfig.ManageModule.Add}
        </td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.ManageModule.ProjectName}</td>
        <td>{$ProjectList}<script language="Javascript">selectProject();</script></td>
        </td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.ManageModule.ParentModule}</td>
        <td>{$ModulePathList}<script language="Javascript">selectParent();</script></td>
        </td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.ManageModule.ModuleName}</td>
        <td><input type="text" name="ModuleName" value="{$ModuleName}" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td colspan="2" align="center">
          <input type="hidden" name="ModuleID"     value="{$ModuleID}">
          <input type="submit" name="ManageModule" value="{$TplConfig.ManageModule.ManageModuleBTN}" accesskey="S" class="MyButton">
        </td>
      </tr>
    </table>
  </form>
</body>
</html>