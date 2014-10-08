<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<script language="JavaScript1.1" src="JS/FunctionsMain.js" type="text/javascript"></script>
<script language="JavaScript1.1">
  /* Create the text arrays and value arrays used to create the select */
  var StatusText         = new Array({$StatusText});
  var StatusValue        = new Array({$StatusValue});
  var SeverityText       = new Array({$SeverityText});
  var SeverityValue      = new Array({$SeverityValue});
  var TypeText           = new Array({$TypeText});
  var TypeValue          = new Array({$TypeValue});
  var OSText             = new Array({$OSText});
  var OSValue            = new Array({$OSValue});
  var ResolutionText     = new Array({$ResolutionText});
  var ResolutionValue    = new Array({$ResolutionValue});
  var UserText           = new Array({$UserText});
  var UserValue          = new Array({$UserValue});
  var DefaultFieldsText  = new Array({$DefaultFieldsText});
  var DefaultFieldsValue = new Array({$DefaultFieldsValue});

  {literal}
  /**
   * Control the display of Query table and CustomSet table.
   *
   * @author leeyupeng <leeyupeng@gamil.com>
   */
  function setCustomSetTable()
  {
      if(document.getElementById("QueryTable").style.display == "none")
      {
          document.getElementById("QueryTable").style.display     = "";
          document.getElementById("CustomSetTable").style.display = "none";
      }
      else
      {
          document.getElementById("QueryTable").style.display     = "none";
          document.getElementById("CustomSetTable").style.display = "";
      }
  }
  
  /**
   * When submit, show the query table, hide the custom set table.
   * 
   * @author leeyupeng <leeyupeng@gmail.com>
   */
  function submitForm()
  {
      document.getElementById("QueryTable").style.display     = "";
      document.getElementById("CustomSetTable").style.display = "none";
      document.getElementById("FieldsToShow").value = joinItem(document.getElementById("FieldsToShowList"));
  }

  /**
   * Set to the default fields to show in QueryBug.php.
   * 
   * @author leeyupeng <leeyupeng@gmail.com>
   */
  function setDefaultFields(ItemList)
  {
      for(var x=ItemList.length-1; x>=0; x--)
      {
          var opt = ItemList.options[x];
          ItemList.options[x] = null;
      }

      for(var x=0; x<= DefaultFieldsText.length-1; x++)
      {
          ItemList.options[x]  = new Option(DefaultFieldsText[x], DefaultFieldsValue[x], 0, 0);
      }
      document.getElementById("FieldsToShow").style.width = "3cm";
  }
  {/literal}
</script>
<title>{$BugConfig.Title}</title>
</head>
<body leftmargin="0" topmargin="0" onload="setQueryForm({$QueryFieldNumber});">
  <form method="post" id="QueryForm" name="QueryForm" action="QueryBug.php" target="RightBottomFrame" onsubmit="submitForm();">
    <!-- 1. the menu bar begin -->
    <table width="98%" align="center" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td align="right" class="SmallFont">
          [Welcome,{$CurrentUser}]
          <a href="StatBug.php?ExportType=Web"       target="RightBottomFrame">[{$TplConfig.QueryBugForm.Report}]</a>
          <a href="EditSelfInfo.php"                 target="RightBottomFrame">[{$TplConfig.QueryBugForm.EditSelfInfo}]</a>
          {if $IsAdminUser}<a href="Admin/index.php" target="_blank">[{$TplConfig.QueryBugForm.Admin}]</a> {/if}
          <a href="Logout.php"         target="RightBottomFrame">[{$TplConfig.QueryBugForm.LogOut}]</a>
          <a href="Document/index.htm" target="RightBottomFrame">[{$TplConfig.QueryBugForm.Help}]</a>
          <a href="http://www.1zsoft.com"                 target="_blank">[{$TplConfig.QueryBugForm.EasySoftHomePage}]</a>
          <a href="http://bugfree.1zsoft.com"             target="_blank">[{$TplConfig.QueryBugForm.BugFreeHomePage}]</a>
          <a href="http://bugfree.1zsoft.com/Service.htm" target="_blank">[{$TplConfig.QueryBugForm.BugFreeService}]</a>
        </td>
      </tr>
    </table>
    <!-- 2. the query form-->
    <table width="98%" align="center" border="0" cellpadding="1" cellspacing="1" class="BgTable" id="QueryTable">
      <tr class="BgRow">
        <td colspan="3" align="center">
          {$TplConfig.QueryBugForm.QueryTitle}
          <input type="checkbox" name="AutoComplete" id="AutoComplete" checked="checked" onclick="setQueryForm({$QueryFieldNumber});" />
          {$TplConfig.QueryBugForm.AutoComplete}
        </td>
      </tr>
      <tr class="BgRow" align="center">
        <td>
          <!-- 2.1 the first group -->
          <table align="center" border="0" cellpadding="0" cellspacing="1">
            {foreach from=$QueryFieldList key=FieldNO item=Field}
            <tr class="BgRow">
              <td class="SmallFont">{if $FieldNO == "0"}{$TplConfig.QueryBugForm.QueryGroup1}{else}{$AndOrList.$FieldNO}{/if}</td>
              <td>{$Field}</td>
              <td>{$OperatorList.$FieldNO}</td>
              <td>{$ValueList.$FieldNO}</td>
            </tr>
            {/foreach}
          </table>
        </td>
        <td align="left">
          <input type="radio" name="AndOrGroup" value="AND" checked="checked"/>{$TplConfig.QueryBugForm.GroupAnd}<br />
          <input type="radio" name="AndOrGroup" value="OR">{$TplConfig.QueryBugForm.GroupOr}
        </td>
        <td>
          <!-- 2.2 The second group -->
          <table align="center" border="0" cellpadding="1" cellspacing="0">
            {foreach from=$QueryFieldList2 key=FieldNO item=Field}
            <tr class="BgRow">
              <td class="SmallFont">{if $FieldNO == "0"}{$TplConfig.QueryBugForm.QueryGroup2}{else}{$AndOrList2.$FieldNO}{/if}</td>
              <td>{$Field}</td>
              <td>{$OperatorList2.$FieldNO}</td>
              <td>{$ValueList2.$FieldNO}</td>
            </tr>
            {/foreach}
          </table>
          <!-- Select different field according to the field order -->
          {foreach from=$SelectQueryFieldList item=SelectQueryField}
          {$SelectQueryField}
          {/foreach}
        </td>
      </tr>
    </table>
    <!-- 3. the custom set table -->
    <table width="98%" align="center" border=0 id="CustomSetTable" cellpadding="1" cellspacing="1" class="BgTable" style="display:none">
      <tr align="center" valign="middle" class="BgRow">
        <td width="25%"></td>
        <td width="20%">
          <fieldset>
            <legend>{$TplConfig.QueryBugForm.AllFieldsTitle}</legend>
            {$BugFieldsList}
          </fieldset>
        </td>
        <td width="10%">
          <input type="button" value="{$TplConfig.QueryBugForm.FieldsAddBTN}"     class="MyButton" style="width:1.7cm" onclick="addItem(QueryForm.BugFieldsList,QueryForm.FieldsToShowList)" /><br />
          <input type="button" value="{$TplConfig.QueryBugForm.FieldsDefaultBTN}" class="MyButton" style="width:1.7cm" onclick="setDefaultFields(QueryForm.FieldsToShowList)" /><br />
          <input type="button" value="{$TplConfig.QueryBugForm.FieldsDelBTN}"     class="MyButton" style="width:1.7cm" onclick="delItem(QueryForm.FieldsToShowList)" />
        </td>
        <td width="20%">
          <fieldset>
          <legend>{$TplConfig.QueryBugForm.FieldsToShowTitle}</legend>
          {$FieldsToShowList}
          </fieldset>
        </td>
        <td width="25%" align="left">
          <input type="button" value="{$TplConfig.QueryBug.OrderASC}" onclick="JavaScript:upItem(QueryForm.FieldsToShowList)" /><br />
          <input type="button" value="{$TplConfig.QueryBug.OrderDESC}" onclick="JavaScript:downItem(QueryForm.FieldsToShowList)" />
        </td>
      </tr>
    </table>
    <!-- 4. the control buttons -->
    <table width="98%" align="center" border=0 cellpadding="1" cellspacing="1" style="border-left:solid 1px #999;border-right:solid 1px #999;border-bottom:solid 1px #999">
      <tr class="BgRow">
        <td align="center" class="SmallFont">
          <input type="hidden" name="FieldsToShow" id="FieldsToShow" />
          <input type="submit" name="PostQuery"  value="{$TplConfig.QueryBugForm.ExecuteQueryBTN}" accesskey="Q" class="MyButton" onclick="QueryForm.action='QueryBug.php?Mode=Query';QueryForm.submit();">
          <input type="submit" name="SaveQuery"  value="{$TplConfig.QueryBugForm.SaveQueryBTN}"    accesskey="S" class="MyButton" onclick="QueryForm.action='QueryBug.php?Mode=SaveQuery';QueryForm.submit();">
          <input type="button" name="ResetQuery" value="{$TplConfig.QueryBugForm.ResetQueryBTN}"   accesskey="I" class="MyButton" onclick="location.reload(true);">
          <input type="button" name="CustomSet"  value="{$TplConfig.QueryBugForm.CustomSetBTN}"    accesskey="C" class="MyButton" onclick="setCustomSetTable();">
        </td>
      </tr>
    </table>
  </form>
</body>
</html>