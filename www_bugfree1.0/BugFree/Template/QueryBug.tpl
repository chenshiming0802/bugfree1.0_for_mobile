<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
{literal}
<script>
/**
 * Change the background of rows of the table, works under ie and opera.
 * 
 * @ author  Chunsheng Wang <wwccss@263.net>
 */
function changeBG(RowID)
{
    if(document.all)
    {
        var Row = document.getElementById(RowID)
        var BackGround = Row.style.background.toUpperCase();
        if (BackGround.match("#FFB062"))
        {
            Row.style.background = "#FFFFFF";
        }
        else
        {
            Row.style.background = "#FFB062";
        }
    }
}
</script>
{/literal}
</head>
<body leftmargin="0" topmargin="0">
  {if $QueryCondition and $BugConfig.ShowQuery}<div align="center" class="SmallerFont">{$QueryCondition}</div>{/if}
  <table width="98%" align="center" border=0 cellpadding="2" cellspacing="1" class="BgTable">
    <!-- show the pager-->
    <tr class="BgRow">
      <td colspan="{$FieldsCount}">
        <table border="0" align="left" cellpadding="0" cellspacing="0" class="SmallFont">
          <tr>
            <td width="5"></td>
            <td>{$RecordPage}</td>
            <td width="5"></td>
            <td>
              <span class="OpenedBy">  <a href="QueryBug.php?QueryMode=OpenedBy|{$CurrentUser}">{$TplConfig.QueryBug.OpenedByMe}</a></span>
              <span class="AssignedTo"><a href="QueryBug.php?QueryMode=AssignedTo|{$CurrentUser}">{$TplConfig.QueryBug.AssignedToMe}</a></span>
              <span class="ResolvedBy"><a href="QueryBug.php?QueryMode=ResolvedBy|{$CurrentUser}">{$TplConfig.QueryBug.ResolvedByMe}</a></span>
            </td>
            <td width="5"></td>
            <td><a href="QueryBug.php?Export=HtmlTable&BugUserName={$CurrentUser}&BugUserPWD={$CurrentUserPWD}&QueryCondition={$QueryCondition}" target="_blank">{$TplConfig.QueryBug.ExportHtmlTable}</a></td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- show the head of the table-->
    <tr align="center" class="TableHeader" bgcolor="#CCCCCC">
      <td class="SmallerFont"><nobr>
        {if $CurrentOrderBy.0 == "BugID"}
          {if $CurrentOrderBy.1 == "ASC"}
            <a href="{$RequestURI}OrderBy=BugID|DESC">{$BugConfig.BugFields.BugID}</a>{$TplConfig.QueryBug.OrderASC}
          {else}
            <a href="{$RequestURI}OrderBy=BugID|ASC">{$BugConfig.BugFields.BugID}</a>{$TplConfig.QueryBug.OrderDESC}
          {/if}
        {else}
          <a href="{$RequestURI}OrderBy=BugID|DESC">{$BugConfig.BugFields.BugID}</a>
        {/if}
      </nobr></td>
      {foreach from=$OrderByList item=OrderBy}
        {if $OrderBy != "BugID"}
        <td class="SmallerFont">
        <nobr>
        {if $CurrentOrderBy.0 == $OrderBy}
          {if $CurrentOrderBy.1 == "ASC"}
            <a href="{$RequestURI}OrderBy={$OrderBy}|DESC">{$BugConfig.BugFields.$OrderBy}</a>{$TplConfig.QueryBug.OrderASC}
          {else}
            <a href="{$RequestURI}OrderBy={$OrderBy}|ASC">{$BugConfig.BugFields.$OrderBy}</a>{$TplConfig.QueryBug.OrderDESC}
          {/if}
        {else}
          <a href="{$RequestURI}OrderBy={$OrderBy}|DESC">{$BugConfig.BugFields.$OrderBy}</a>
        {/if}
        </nobr>
        </td>
        {/if}
      {/foreach}
      <td class="SmallerFont"><nobr>
        {if $CurrentOrderBy.0 == "BugID"}
          {if $CurrentOrderBy.1 == "ASC"}
            <a href="{$RequestURI}OrderBy=BugID|DESC">{$BugConfig.BugFields.BugID}</a>{$TplConfig.QueryBug.OrderASC}
          {else}
            <a href="{$RequestURI}OrderBy=BugID|ASC">{$BugConfig.BugFields.BugID}</a>{$TplConfig.QueryBug.OrderDESC}
          {/if}
        {else}
          <a href="{$RequestURI}OrderBy=BugID|DESC">{$BugConfig.BugFields.BugID}</a>
        {/if}
      </nobr></td>
    </tr>
    <!-- show the bug list. -->
    {foreach from=$BugList key=BugID item=BugInfo}
      <tr align="center" id="Row{$BugID}" class="{cycle values="BgRow,BgDarkRow"}" onclick="changeBG('Row{$BugID}');">
         <td><nobr><a href="BugInfo.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}">{$BugInfo.BugID}</a></nobr></td>
        {foreach from=$FieldsToShow item=FieldName}
          {if $FieldName == "BugTitle"}
            <td align="left" title="{$BugInfo.BugTitle}"><nobr>{$BugInfo.ShortBugTitle}</nobr></td>
          {elseif $FieldName == "OpenedBy"}
            <td {if $BugInfo.OpenedBy == $CurrentUser} class="OpenedBy" {/if}>
              <nobr><a href="QueryBug.php?QueryMode=OpenedBy|{$BugInfo.OpenedBy}">{$BugInfo.OpenedByRealName}</a></nobr>
            </td>
          {elseif $FieldName == "AssignedTo"}
            <td {if $BugInfo.AssignedTo == $CurrentUser} class="AssignedTo" {/if}>
              <nobr><a href="QueryBug.php?QueryMode=AssignedTo|{$BugInfo.AssignedTo}">{$BugInfo.AssignedToRealName}</a></nobr>
            </td>
          {elseif $FieldName == "ResolvedBy"}
            <td {if $BugInfo.ResolvedBy == $CurrentUser} class="ResolvedBy" {/if}>
              <nobr><a href="QueryBug.php?QueryMode=ResolvedBy|{$BugInfo.ResolvedBy}">{$BugInfo.ResolvedByRealName}</a></nobr>
            </td>
          {elseif $FieldName == "Resolution"}
            <td>
              <nobr><a href="QueryBug.php?QueryMode=Resolution|{$BugInfo.Resolution}">{$BugInfo.Resolution}</a></nobr>
            </td>
          {elseif $FieldName == "ProjectName" or $FieldName == "ModulePath"}
            <td align="left"><nobr>{$BugInfo.$FieldName}</nobr></td>
          {elseif $FieldName == "BugType"}
            {assign var=FieldValue value=$BugInfo.$FieldName}
            <td><nobr>{$BugConfig.Types.$FieldValue}</nobr></td>
          {elseif $FieldName == "BugOS"}
            {assign var=FieldValue value=$BugInfo.$FieldName}
            <td><nobr>{$BugConfig.BugOS.$FieldValue}</nobr></td>
          {elseif $FieldName == "MailTo" or $FieldName == "AssignedTo" or $FieldName=="OpenedBy" or $FieldName=="ResolvedBy" or $FieldName=="ClosedBy" or $FieldName=="LastEditedBy"}
            {assign var=FieldName value=$FieldName|cat:"RealName"}
            <td><nobr>{$BugInfo.$FieldName}</nobr></td>
          {elseif $FieldName != "BugID"}
            <td><nobr>{$BugInfo.$FieldName}</nobr></td>
          {/if}
        {/foreach}
        <td><nobr><a href="BugInfo.php?ProjectID={$BugInfo.ProjectID}&ModuleID={$BugInfo.ModuleID}&BugID={$BugInfo.BugID}">{$BugInfo.BugID}</a></nobr></td>
      </tr>
    {/foreach}
  </table>
</body>
</html>