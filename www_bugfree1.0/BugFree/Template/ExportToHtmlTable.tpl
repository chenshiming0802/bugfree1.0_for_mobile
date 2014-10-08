<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<body leftmargin="0" topmargin="0">
  {if $QueryCondition}
    <div align="center" class="SmallerFont">{$QueryCondition}</div>
  {/if}
  <table border=0 cellpadding="2" cellspacing="1" class="BgTable">
    <tr align="center" class="BgRow">
      <!-- show the head of the table-->
      {foreach from=$FieldList item=FieldName}
        <td><nobr>{$BugConfig.QueryField.$FieldName}</nobr></td>
      {/foreach}
    </tr>
    {foreach from=$BugList item=BugInfo}
    <tr class="BgRow">
      {foreach from=$FieldList item=FieldName}
        <td>
          <nobr>
          {assign var=FieldValue value=$BugInfo.$FieldName}
          {if $FieldName=="BugType"}
            {$BugConfig.Types.$FieldValue}
          {elseif $FieldName=="BugOS"}
            {$BugConfig.BugOS.$FieldValue}
          {elseif $FieldName=="MailTo" or $FieldName=="AssignedTo" or $FieldName=="OpenedBy" or $FieldName=="ResolvedBy" or $FieldName=="ClosedBy" or $FieldName=="LastEditedBy"}
            {assign var=FieldName value=$FieldName|cat:"RealName"}
            {$BugInfo.$FieldName}
          {else}
            {$FieldValue}
          {/if}
          </nobr>
        </td>
      {/foreach}
    </tr>
    {/foreach}
  </table>
</body>
</html>