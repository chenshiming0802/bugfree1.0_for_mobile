<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<meta name="author"                 content="Zhenfei Liu <liuzf@pku.org.cn>; Chunsheng Wang <wwccss@263.net>">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="JS/FunctionsMain.js"></script>
<script language="Javascript">
var ErrorEmptyTitle = "{$TplConfig.AddBug.ErrorEmptyTitle}";
var ErrorEmptyBuild = "{$TplConfig.AddBug.ErrorEmptyBuild}";
{literal}
function submitForm()
{
    if(document.getElementById("BugTitle").value == "")
    {
        alert(ErrorEmptyTitle);
        return false;
    }
    //else if(document.getElementById("OpenedBuild").value == "")
    //{
    //    alert(ErrorEmptyBuild);
    //    return false;
    //}
    else
    {
        AddForm.AssignedTo.value = joinItem(AddForm.AssignedToList);
        AddForm.MailTo.value     = joinItem(AddForm.MailToList);
        AddForm.submit();
        this.disabled=true;
    }
}
{/literal}
</script>
<title>{$BugConfig.Title}</title>
</head>
<body topmargin="0" marginheight="0" leftmargin="0" marginwidth="0">
  <form action="AddBug.php" method="post" enctype="multipart/form-data" name="AddForm" id="">
    <table width="98%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
      <tr align="center" class="BgRow">
        <td colspan="2">{$TplConfig.AddBugForm.AddTitle}</td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.AddBugForm.ProjectModule}</td>
        <td>{$ProjectList}{$SelectProject}{$ModulePathList}{$SelectModulePath}</td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.AddBugForm.BugTitle}</td>
        <td><input type="text" name="BugTitle" id="BugTitle" size="40" class="MyInput" value="{$BugTitle}" onclick="this.select();"></td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.AddBugForm.BugBuild}</td>
        <td>
          <span id="BuildContiner">{$OpenedBuildList}</span>
          <input type="button" value="{$TplConfig.AddBugForm.NewBugBuild}" class="MyButton" 
            onclick="document.getElementById('BuildContiner').innerHTML = '<input type=text name=OpenedBuild size=40 class=MyInput>';this.style.display='none';">
        </td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.AddBugForm.TypeAndOSAndSeverity}</td>
        <td>{$BugTypeList}{$BugOS}{$BugSeverityList}</td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.AddBugForm.AssignedAndMailTo}</td>
        <td>
          <!-- assignto and Mailto selection-->
          <table width="80%" cellpadding="0" class="SmallFont" >
            <tr align="center" valign="middle">
              <td width="20%">
                <fieldset>
                  <legend>{$TplConfig.AddBugForm.AssignedToTitle}</legend>
                  <select name="AssignedToList" multiple="multiple" size="5" style="width:3cm"></select>
                </fieldset>
              </td>
              <td width="20%">
                <input type="button" value="{$TplConfig.AddBugForm.AssignedToAddBTN}" onclick="JavaScript:addItem(AddForm.BugUserList,AddForm.AssignedToList)" /><br />
                <input type="button" value="{$TplConfig.AddBugForm.AssignedToDelBTN}" onclick="JavaScript:delItem(AddForm.AssignedToList)" />
              </td>
              <td width="20%">
                <fieldset>
                  <legend>{$TplConfig.AddBugForm.BugUserList}</legend>
                  {$BugUserList}
                </fieldset>
              </td>
              <td width="20%">
                <input type="button" value="{$TplConfig.AddBugForm.MailToAddBTN}" onclick="JavaScript:addItem(AddForm.BugUserList,AddForm.MailToList)" /><br />
                <input type="button" value="{$TplConfig.AddBugForm.MailToDelBTN}" onclick="JavaScript:delItem(AddForm.MailToList)" />
              </td>
              <td width="20%">
                <fieldset>
                  <legend>{$TplConfig.AddBugForm.MailToTitle}</legend>
                  <select name="MailToList" multiple="multiple" size="5" style="width:3cm"></select>
                </fieldset>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.AddBugForm.BugDesc}</td>
        <td>
          <textarea name="Notes" rows="10" class="Notes">{$TplConfig.AddBugForm.BugDescTemplate}</textarea>
        </td>
      </tr>
      {include file="AddFiles.tpl"}
      <tr align="center" class="BgRow">
        <td colspan="2">
          <input type="hidden" name="AssignedTo">
          <input type="hidden" name="MailTo">
          <input type="button" name="NewBug" value="{$TplConfig.AddBugForm.NewBug}" accesskey="N" class="MyButton" onclick="submitForm()">
        </td>
      </tr>
    </table>
  </form>
</body>
</html>