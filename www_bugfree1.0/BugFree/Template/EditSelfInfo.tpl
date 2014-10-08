<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body topmargin="10" marginheight="0" leftmargin="0" marginwidth="0">
  <form name="EditSelfInfoFrom" method="post">
    <table width="50%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
      <tr class="BgRow">
        <td colspan="2" align="center">{$TplConfig.EditSelfInfo.EditSelfInfoTitle}</td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.EditSelfInfo.RealName}</td>
        <td><input type="text" name="RealName" value="{$RealName}" class="MyInput"></td>
      </tr> 
      <tr class="BgRow">
        <td  align="right">{$TplConfig.EditSelfInfo.Email}</td>
        <td><input type="text" name="Email" value="{$Email}" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.EditSelfInfo.Password}</td>
        <td><input type="text" name="Password" class="MyInput">{$TplConfig.EditSelfInfo.PasswordNote}</td>
      </tr>
      <tr class="BgRow">
        <td colspan="2" align="center">
          <input type="submit" name="EditSelfInfo" value="{$TplConfig.EditSelfInfo.EditBTN}" accesskey="E" class="MyButton">
        </td>
      </tr> 
    </table>
  </form>
</body>
</html>