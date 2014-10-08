<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<meta name="author"                 content="Zhenfei Liu <liuzf@pku.org.cn>; Chunsheng Wang <wwccss@263.net>">
<link href="../Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
{literal}
<script language="JavaScript1.1">
/**
 * change the fileds of name, doc, plan to empty.
 */
function resetProjectForm()
{
    document.ManageProjectForm.ProjectName.value = '';
    document.ManageProjectForm.ProjectDoc.value  = '';
    document.ManageProjectForm.ProjectPlan.value = '';
    document.getElementById("AddProject").checked=true;
}
</script>
{/literal}
<title>{$BugConfig.Title}</title>
</head>
<body topmargin="10" marginheight="0" leftmargin="0" marginwidth="0" {if $ManageMode == "Add"}onload=resetProjectForm();{/if}>
  <form name="ManageProjectForm" method="post">
    <table width="80%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
      <tr class="BgRow">
        <td colspan="2" align="center" class="TableHeader">{$TplConfig.ManageProject.ManageProjectTitle}--{$ProjectInfo.ProjectName}</td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ManageProject.ManageMode}</td>
        <td>
          <input type="radio" name="ManageMode" value="Edit" checked="checked" onclick="document.ManageProjectForm.reset();">{$TplConfig.ManageProject.Edit}
          <input type="radio" name="ManageMode" id="AddProject" value="Add"  onclick="resetProjectForm();">{$TplConfig.ManageProject.Add}
        </td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ManageProject.ProjectName}</td>
        <td><input type="text" name="ProjectName" value="{$ProjectInfo.ProjectName}" size="30" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ManageProject.ProjectDoc}</td>
        <td><input type="text" name="ProjectDoc" value="{$ProjectInfo.ProjectDoc}" size="40" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.ManageProject.ProjectPlan}</td>
        <td><input type="text" name="ProjectPlan" value="{$ProjectInfo.ProjectPlan}" size="40" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td colspan="2" align="center">
          <input type="hidden" name="ProjectID" value="{$ProjectInfo.ProjectID}">
          <input type="submit" name="ManageProject" value="{$TplConfig.ManageProject.ManageProjectBTN}" accesskey="S" class="MyButton">
        </td>
      </tr>
    </table>
  </form>
  <form name="ManageModuleForm" method="post" action="ManageModule.php">
    <table width="80%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
      <tr class="BgRow">
        <td colspan="2" align="center" class="TableHeader">{$TplConfig.ManageProject.AddModuleTitle}</td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ManageProject.ParentModule}</td>
        <td>{$ModulePathList}{$SelectModulePath}</td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ManageProject.ModuleName}</td>
        <td><input type="text" name="ModuleName" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td colspan="2" align="center">
          <input type="hidden" name="ProjectID" value="{$ProjectInfo.ProjectID}">
          <input type="submit" name="ManageModule" value="{$TplConfig.ManageProject.ManageModuleBTN}" accesskey="A" class="MyButton">
        </td>
      </tr>
    </table>
  </form>
</body>
</html>