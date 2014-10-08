<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$CurrentLanguage}Default.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body leftmargin="0" topmargin="10">
{if $ErrorMsg}
<table width="480" align="center" border="0" class="SmallFont">
  <tr>
    <td>
      <fieldset>
        <legend style="color:red">ERROR:</legend>
        {$ErrorMsg}
      </fieldset>
    </td>
  </tr>
  <tr>
    <td align="center"><input type="button" value="Back" onclick="history.go(-1)" style="width:60" /></td>
  </tr>
</table>
{else}
<form name="Install" method="post">
  <div align="center">
    <h3>{$TplConfig.Install.InstallTitle}</h3>
    <select name="Language" onchange="location.href='install.php?Language=' + this.value;">
      {foreach from=$LanguageList item=Language}
        {if $Language eq $CurrentLanguage}
          <option value="{$Language}" selected="selected">{$Language}</option>
        {else}
          <option value="{$Language}">{$Language}</option>
        {/if}
      {/foreach}
    </select>
  </div>
  <table width="760" align="center" border=0 cellpadding="2" cellspacing="1" class="BgTable">
    <!-- 1. Setting of BugFree Database -->
    <tr class="BgRow">
      <td colspan="2" align="center"><strong>{$TplConfig.Install.BugDBTitle}</strong></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.BugDBHost}</td>
      <td><input type="text" name="BugDBHost" size="30" class="MyInput" value="localhost" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.BugDBUser}</td>
      <td><input type="text" name="BugDBUser" size="30" class="MyInput" value="root" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.BugDBPassword}</td>
      <td><input type="text" name="BugDBPassword" size="30" class="MyInput" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.BugDBDatabase}</td>
      <td>
        <input type="text" name="BugDBDatabase" size="30" class="MyInput" value="BugFree" />
        <input type="checkbox" name="CreateBugDB" value="true">{$TplConfig.Install.CreateBugDB}
      </td>
    </tr>

    <!-- 2. Setting of user validating database -->
    <tr class="BgRow">
      <td colspan="2" align="center"><strong>{$TplConfig.Install.UserDBTitle}</strong></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.UserDBHost}</td>
      <td><input type="text" name="UserDBHost" size="30" class="MyInput" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.UserDBUser}</td>
      <td><input type="text" name="UserDBUser" size="30" class="MyInput" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.UserDBPassword}</td>
      <td><input type="text" name="UserDBPassword" size="30" class="MyInput" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.UserDBDatabase}</td>
      <td><input type="text" name="UserDBDatabase" size="30" class="MyInput" /></td>
    </tr>

    <!-- 3. Setting of user validating table fields -->
    <tr class="BgRow">
      <td colspan="2" align="center"><strong>{$TplConfig.Install.UserTableTitle}</strong></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.TableName}</td>
      <td><input type="text" name="TableName" size="30" class="MyInput" value="BugUser" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.UserName}</td>
      <td><input type="text" name="UserName" size="30" class="MyInput" value="UserName" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.RealName}</td>
      <td><input type="text" name="RealName" size="30" class="MyInput" value="RealName" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.UserPassword}</td>
      <td><input type="text" name="UserPassword" size="30" class="MyInput" value="UserPassword" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.Email}</td>
      <td><input type="text" name="Email" size="30" class="MyInput" value="Email" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.EncryptType}</td>
      <td>
        <select name="EncryptType">
          <option value="md5">md5</option>
          <option value="text">text</option>
          <option value="mysqlpassowrd">mysql's password() function</option>
        </select>
      </td>
    </tr>

    <!-- 4. Setting of mail -->
    <tr class="BgRow">
      <td colspan="2" align="center"><strong>{$TplConfig.Install.MailTitle}</strong></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.FromAddress}</td>
      <td><input type="text" name="FromAddress" size="30" class="MyInput" value="bugfree@{$ServerName}" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.FromName}</td>
      <td><input type="text" name="FromName" size="30" class="MyInput" value="BugFree" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.SendMethod}</td>
      <td>
        <select name="SendMethod">
          <option value="SMTP">smtp</option>
          <option value="MAIL">php's mail() function</option>
          <option value="QMAIL">Qmail</option>
          <option value="SENDMAIL">Sendmail</option>
        </select>
      </td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.SmtpHost}</td>
      <td><input type="text" name="SmtpHost" size="30" class="MyInput" value="localhost" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.SmtpAuth}</td>
      <td>
        <input type="radio" name="SmtpAuth" value="true" /> True
        <input type="radio" name="SmtpAuth" value="false" checked="checked" /> False
      </td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.SmtpUserName}</td>
      <td><input type="text" name="SmtpUserName" size="30" class="MyInput" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.SmtpPassword}</td>
      <td><input type="text" name="SmtpPassword" size="30" class="MyInput" /></td>
    </tr>
    
    <!-- 5. Setting of others -->
    <tr class="BgRow">
      <td colspan="2" align="center"><strong>{$TplConfig.Install.OtherTitle}</strong></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.UploadDirectory}</td>
      <td><input type="text" name="UploadDirectory" size="30" class="MyInput" value="BugFile" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.MaxFileSize}</td>
      <td><input type="text" name="MaxFileSize" size="30" class="MyInput" value="102400" /></td>
    </tr>
    
    <!-- 6. Setting of admin user -->
    <tr class="BgRow">
      <td colspan="2" align="center"><strong>{$TplConfig.Install.AdminTitle}</strong></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.AdminUserName}</td>
      <td><input type="text" name="AdminUserName" size="30" class="MyInput" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.AdminRealName}</td>
      <td><input type="text" name="AdminRealName" size="30" class="MyInput" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.AdminUserEmail}</td>
      <td><input type="text" name="AdminUserEmail" size="30" class="MyInput" /></td>
    </tr>
    <tr class="BgRow">
      <td>{$TplConfig.Install.AdminUserPassword}</td>
      <td><input type="text" name="AdminUserPassword" size="30" class="MyInput" /></td>
    </tr>
    
    <!-- 7. Submit form -->
    <tr class="BgRow">
      <td colspan="2" align="center">
        <input type="submit" name="Submit" value="{$TplConfig.Install.SubmitButton}" style="width:700px" class="MyButton" />
      </td>
    </tr>
  </table>
</form>
{/if}
</body>
</html>