<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
{literal}
<script language="Javascript">
/**
 * Change the value of Action dynamic which is used to judge whether judge user or just set language or style.
 */
function submitForm(ActionMode)
{
    document.getElementById("ActionMode").value = ActionMode;
    document.getElementById("LoginForm").submit();
}
</script>
{/literal}
</head>
<body leftmargin="0" topmargin="80">
  <form method="post" name="LoginForm" id="LoginForm">
    <table width="360" align="center" border=0 cellpadding="2" cellspacing="1" class="BgTable">
      <tr class="BgRow">
        <td align="center" colspan="2"><strong>{$TplConfig.Login.LoginTitle}</strong></td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.Login.BugUserName}</td>
        <td><input type="text" name="BugUserName" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.Login.BugUserPWD}</td>
        <td><input type="password" name="BugUserPWD" class="MyInput"></td>
      </tr>
      <tr align="center" class="BgRow">
        <td colspan="2">
          <input type="submit" value="{$TplConfig.Login.ButtonLogin}" accesskey="L" class="MyButton" onclick="submitForm('Login');">
        </td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.Login.SelectLang}</td>
        <td>{$LangList}{$SelectLang}</td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.Login.SelectStyle}</td>
        <td>{$StyleList}{$SelectStyle}</td>
        <input type="hidden" name="HttpRefer"  value="{$HttpRefer}">
        <input type="hidden" name="ActionMode" id="ActionMode" value="">
      </tr>
    </table>
    <div align="center" style="margin: 10px 0 0 0" class="SmallFont">
      <script language="Javascript">document.LoginForm.BugUserName.focus();</script>
      <a href="{$BugConfig.HomePage}" target="_blank">{$BugConfig.RnDTeam}</a>
      {if $BugConfig.AutoUpdate}<script language="Javascript" src="{$BugConfig.HomePage}/CheckUpdate.php?Version={$BugConfig.Version}&ServerInfo={$ServerInfo}"></script>{/if}
    </div>
  </form>
</body>
</html>