<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body leftmargin="0" topmargin="10" onload="document.SaveQueryForm.QueryTitle.focus();">
  <form method="post" name="SaveQueryForm">
    <table width="50%" align="center" border=0 cellpadding="2" cellspacing="1" class="BgTable">
      <tr class="BgRow">
        <td align="right">{$TplConfig.SaveQuery.QueryTitle}</td>
        <td><input type="text" name="QueryTitle" size="30" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td align="center" colspan="2">
          <input type="submit" name="SaveQuery" value="{$TplConfig.SaveQuery.SaveQueryBTN}" class="MyButton" accesskey="S">
        </td>
      </tr>
    </table>
  </form>
</body>
</html>