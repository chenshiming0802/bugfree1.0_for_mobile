<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body leftmargin="0" topmargin="80">
<form name="Install" method="post">
  <table width="560" align="center" border="0" cellpadding="2" cellspacing="1" class="BgTable">
    <tr class="BgRow" align="center"><td class="TableHeader">{$TplConfig.Upgrade.UpgradeTitle}</td></tr>
    <tr class="BgRow">
      <td>
        {if $Upgraded}
        {$TplConfig.Upgrade.Upgraded}
        {else}
        {$TplConfig.Upgrade.UpgradeNote}
        <div align="center"><input type="submit" name="Submit" value="{$TplConfig.Upgrade.UpgradeBTN}" class="MyButton" /></div>
        {/if}
       </td>
    </tr>
  </table>
</form>
</body>
</html>