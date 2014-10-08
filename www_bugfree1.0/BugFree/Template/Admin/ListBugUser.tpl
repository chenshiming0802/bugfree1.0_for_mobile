<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<meta name="author"                 content="Zhenfei Liu <liuzf@pku.org.cn>; Chunsheng Wang <wwccss@263.net>">
<link href="../Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body topmargin="10" marginheight="0" leftmargin="0" marginwidth="0">
  <form name="AddUserForm" method="post" action="AddBugUser.php">
    <table width="50%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
      <tr class="BgRow">
        <td colspan="2" align="center" class="TableHeader">{$TplConfig.ListBugUser.AddUserTitle}</td>
      </tr> 
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ListBugUser.UserName}</td>
        <td><input type="text" name="UserName" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ListBugUser.RealName}</td>
        <td><input type="text" name="RealName" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ListBugUser.Password}</td>
        <td><input type="text" name="Password" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td  align="right">{$TplConfig.ListBugUser.Email}</td>
        <td><input type="text" name="Email" class="MyInput"></td>
      </tr>
      <tr class="BgRow">
        <td colspan="2" align="center">
          <input type="submit" name="AddUser" value="{$TplConfig.ListBugUser.AddUserBTN}" accesskey="A" class="MyButton">
        </td>
      </tr> 
    </table>
  </form>
  <table width="50%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
    <tr class="BgRow">
      <td colspan="4" align="center" class="TableHeader">{$TplConfig.ListBugUser.UserList}</td>
    </tr> 
    <tr class="BgRow" align="center">
      <td>{$TplConfig.ListBugUser.UserName}</td>
      <td>{$TplConfig.ListBugUser.RealName}</td>
      <td>{$TplConfig.ListBugUser.GroupName}</td>
      <td>{$TplConfig.ListBugUser.AdminMode}</td>
    </tr> 
    {foreach from=$BugUserList key=BugUserName item=BugRealName}
    <tr class="BgRow" align="center">
      <td>{$BugUserName}</td>
      <td>{$BugRealName}</td>
      <td>
        {if $BugUserGroupList.$BugUserName}
          <select style="width:4cm">
          {foreach from=$BugUserGroupList.$BugUserName item=GroupName key=GroupID}<option>{$GroupName}</option>{/foreach}
          </select>
        {/if}
      </td>
      <td><a href="DelBugUser.php?BugUserName={$BugUserName}">{$TplConfig.ListBugUser.DelUser}</a></td>
    </tr> 
    {/foreach}
  </table>
</body>
</html>