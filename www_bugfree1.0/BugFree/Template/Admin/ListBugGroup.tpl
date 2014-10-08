<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<meta name="author"                 content="Zhenfei Liu <liuzf@pku.org.cn>; Chunsheng Wang <wwccss@263.net>">
<link href="../Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../JS/FunctionsMain.js"></script>
<title>{$BugConfig.Title}</title>
{literal}
<style type="text/css">
<!--
select   {width:4cm;}
-->
</style>
{/literal}
<script language="Javascript">
var ErrorMsg = "{$TplConfig.AddBugGroup.ErrorEmptyValue}";
{literal}
function submitForm()
{
    if(document.getElementById("GroupName").value == "")
    {
        alert(ErrorMsg);
        return false;
    }
    else
    {
        ManageGroupForm.GroupUser.value = joinItem(ManageGroupForm.GroupUserList);
        ManageGroupForm.GroupACL.value  = joinItem(ManageGroupForm.GroupAclList);
        ManageGroupForm.submit();
        this.disabled=true;
    }
}
{/literal}
</script>
</head>
<body topmargin="10" marginheight="0" leftmargin="0" marginwidth="0">
  <!-- Add or Edit form begin -->
  <form name="ManageGroupForm" method="post" action="ManageBugGroup.php">
    <table width="80%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
      <tr class="BgRow">
        <td colspan="2" align="center" class="TableHeader">{$TplConfig.ListBugGroup.AddGroupTitle}</td>
      </tr> 
      <tr class="BgRow">
        <td align="right">{$TplConfig.ListBugGroup.GroupName}</td>
        <td><input type="text" name="GroupName" class="MyInput" value="{$BugGroupInfo.GroupName}" style="width:4cm" /></td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.ListBugGroup.GroupUser}</td>
        <td>
          <!-- user setting begin -->
          <table width="40%" cellpadding="0" class="SmallFont" >
            <tr align="center" valign="middle">
              <td>{$BugUserList}</td>
              <td width="20%">
                <input type="button" value="{$TplConfig.ListBugGroup.GroupUserAddBTN}" onclick="JavaScript:addItem(ManageGroupForm.BugUserList,ManageGroupForm.GroupUserList)" /><br />
                <input type="button" value="{$TplConfig.ListBugGroup.GroupUserDelBTN}" onclick="JavaScript:delItem(ManageGroupForm.GroupUserList)" />
              </td>
              <td width="20%">
                {if $GroupUserList}
                  {$GroupUserList}
                {else}
                  <select name="GroupUserList" multiple="multiple" size="5"></select>
                {/if}
              </td>
            </tr>
          </table>
          <!-- user setting end -->
        </td>
      </tr>
      <tr class="BgRow">
        <td align="right">{$TplConfig.ListBugGroup.GroupACL}</td>
        <td>
          <!-- project setting begin -->
          <table width="40%" cellpadding="0" class="SmallFont" >
            <tr align="center" valign="middle">
              <td>{$ProjectList}</td>
              <td width="20%">
                <input type="button" value="{$TplConfig.ListBugGroup.GroupACLAddBTN}" onclick="JavaScript:addItem(ManageGroupForm.ProjectList, ManageGroupForm.GroupAclList)" /><br />
                <input type="button" value="{$TplConfig.ListBugGroup.GroupACLDelBTN}" onclick="JavaScript:delItem(ManageGroupForm.GroupAclList)" />
              </td>
              <td width="20%">
                {if $GroupAclList}
                  {$GroupAclList}
                {else}
                  <select name="GroupAclList" multiple="multiple" size="5"></select>
                {/if}
              </td>
            </tr>
          </table>
          <!-- project setting end -->
        </td>
      </tr>
      <tr class="BgRow">
        <td colspan="2" align="center">           
          <input type="hidden" name="GroupID" value="{$BugGroupInfo.GroupID}" />
          <input type="hidden" name="GroupUser" />
          <input type="hidden" name="GroupACL"  />
          <input type="hidden" name="ManageMode"  value="{$ManageMode}" />
          <input type="button" name="ManageGroup" value="{$TplConfig.ListBugGroup.ManageGroupBTN}" accesskey="S" class="MyButton" onclick="submitForm();">
        </td>
      </tr> 
    </table>
  </form>
  <!-- form edn -->
  <!-- list begin -->
  <table width="80%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable">
    <tr class="BgRow" align="center">
      <td colspan="5" class="TableHeader">{$TplConfig.ListBugGroup.GroupList}</td>
    </tr> 
    <tr class="BgRow" align="center">
      <td width="5%">{$TplConfig.ListBugGroup.GroupID}</td>
      <td>{$TplConfig.ListBugGroup.GroupName}</td>
      <td>{$TplConfig.ListBugGroup.GroupUser}</td>
      <td>{$TplConfig.ListBugGroup.GroupACL}</td>
      <td>{$TplConfig.ListBugGroup.AdminMode}</td>
    </tr> 
    {foreach from=$BugGroupList key=BugGroupID item=GroupInfo}
    <tr class="BgRow" align="center">
      <td>{$GroupInfo.GroupID}</td>
      <td>{$GroupInfo.GroupName}</td>
      <td>
        {if $GroupInfo.GroupUser}
        <select>
          {foreach from=$GroupInfo.GroupUser key=BugUserName item=BugUserRealName}<option>{$BugUserRealName}</option>{/foreach}
        </select>
        {/if}
      </td>
        
      <td>
        {if $GroupInfo.GroupACL}
        <select>
          {foreach from=$GroupInfo.GroupACL key=ProjectID item=ProjectACL}<option>{$GroupInfo.ProjectNameList.$ProjectID}</option>{/foreach}
        </select>
        {/if}
      </td>
      <td align="center">
        <a href="ListBugGroup.php?BugGroupID={$BugGroupID}">{$TplConfig.ListBugGroup.EditGroup}</a>
        <a href="DelBugGroup.php?BugGroupID={$BugGroupID}">{$TplConfig.ListBugGroup.DelGroup}</a>
      </td>
    </tr> 
    {/foreach}
  </table>
  <!-- list end -->
</body>
</html>